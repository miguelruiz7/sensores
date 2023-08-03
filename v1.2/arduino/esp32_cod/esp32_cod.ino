

  #if defined(ESP32)
  #include <WiFi.h>
  #elif defined(ESP8266)
  #include <ESP8266WiFi.h>
  #endif

#include <WiFiClient.h>

// Libreria de JSON para codificarlo
#include <ArduinoJson.h>

// Humedad y Temperatura

#include <DHT.h>
#include <Adafruit_Sensor.h>
#define DHTPIN 34
#define DHTTYPE DHT11
DHT dht(DHTPIN, DHTTYPE);


//Anemometro 
#define READ_TIME 1000    
#define pinSensor 2
#define WIND_SPEED_20_PULSE_SECOND 1.75
#define ONE_ROTATION_SENSOR 20.0
volatile unsigned long rotaciones;      
unsigned long gulStart_Read_Timer = 0;

//Humedad y Temperatura SHT20
#include <DFRobot_SHT20.h>
#include <Wire.h>
DFRobot_SHT20 sht20;

//PH
const int analogInPin = 35; 
int sensorValue = 0; 
unsigned long int avgValue; 
float b;
int buf[10],temp;

//Ultrasonico
int PinT = 33;
int PinE = 25;


// Led
#define led 2

// Datos para conectar a la red
const char* ssid = "CITNOVA";
const char* password = "PRU3B@C1TN0V@";

//Datos para conectar al servidor web
const char* server = "20.20.2.120";
const int port = 1234;

//Inicializamos el cliente WiFi
WiFiClient client;

void setup()
{
//Configuracion [LED]
  pinMode(led, OUTPUT);
  digitalWrite(led, HIGH);

//Configuracion [Serial]
  Serial.begin(115200);

//Configuracion [WiFi]

  WiFi.begin(ssid, password);

  while (WiFi.status() != WL_CONNECTED) {
    Serial.println("Conectando a la red Wi-Fi...");
    digitalWrite(led, LOW);
    delay(250);
    digitalWrite(led, HIGH);
    delay(250);
  }
  Serial.println("Conexión establecida");
  digitalWrite(led, LOW);

//Configuracion [DTH11]
  dht.begin();

//Configuracion [SHT20]
  sht20.initSHT20();                 
  delay(100);
  sht20.checkSHT20(); 

//Configuracion [Anemometro]
  pinMode(pinSensor, INPUT_PULLUP);
  attachInterrupt(digitalPinToInterrupt(pinSensor), isr_rotation, CHANGE); 
   sei(); //Habilitar interrupciones
  gulStart_Read_Timer = millis();

//Configuracion [Ultrasonico]

  pinMode(PinT, OUTPUT);
  pinMode(PinE, INPUT);
  digitalWrite(PinT, LOW);

}


void loop() {

//ESP32 me! ID: 16
  objectoSensor("31", String(obtenerTemperaturaSTH20()));
  
  objectoSensor("32", String(obtenerPh()));

//ESP8266 me! ID: 17
 // objectoSensor("33", String(obtenerHumedadSTH20()));
  objectoSensor("34", String(obtenerLuz()));

//ESP32 Eduard ID: 18
objectoSensor("35", String(obtenerVelocidadViento()));
objectoSensor("36", String(obtenerPresencia()));

}


int obtenerLuz() {
   //Fecha de prueba: 06/2023 <Funcional>
  // CONEXIONES: 3.3V, GND, A0 -> 36
  int datos = analogRead(26);
  int datosInv = 4095 - datos; 

  int porcentajeLuz = (datosInv * 100) / 4095;
  return porcentajeLuz;
}

String obtenerPresencia() {
  #define sensorIR 14
  String valorLetra;
  int datos = digitalRead(sensorIR);
  int datosInv = (datos == 1) ? 0 : 1;

  if (datosInv == 0) {
    valorLetra = "Sin detectar obstaculo";
  } else {
    valorLetra = "Detecta obstaculo";
  }
  return valorLetra;
}


float obtenerTemperatura() {
 //Fecha de prueba: 1/07/2023 <Funcional>
  // CONEXIONES: 3.3V, GND, 34
float h = dht.readHumidity();
float t = dht.readTemperature();
return t;
}


float obtenerHumedad() {
    //Fecha de prueba: 1/07/2023 <Funcional>
  // CONEXIONES: 3.3V, GND, 34
float h = dht.readHumidity();
float t = dht.readTemperature();
return h;
}


float obtenerTemperaturaSTH20(){
  //Fecha de prueba: 24/07/2023 <Funcional>
  // CONEXIONES: 3.3V, GND, SDA, SCL  
  float temperatura = sht20.readTemperature();
  float temperaturaFahrenheit = (temperatura * 1.8) + 32; 
  float temperaturaKelvin = temperatura + 273.15;

  return temperatura;
}

float obtenerHumedadSTH20(){
  //Fecha de prueba: 24/07/2023 <Funcional>
  // CONEXIONES: 3.3V, GND, SDA, SCL  
  float humedad = sht20.readHumidity();
  return humedad;
}



// F

float obtenerVelocidadViento() {
  //Fecha de prueba: 25/07/2023 <Funcional>
  // CONEXIONES: 3.3V, GND, 25  

  float velocidad;
  float velocidad_kph;                    
  float velocidad_mph;   

 if((millis() - gulStart_Read_Timer) >= READ_TIME)
  {
    cli(); 
    
    // Convertir el contador de rotaciones a velocidad de viento en m/s
    velocidad = WIND_SPEED_20_PULSE_SECOND / ONE_ROTATION_SENSOR * (float)rotaciones;
    // Convertir velocidad de m/s a km/h
    velocidad_kph = velocidad * 3.6;
    // Convertir velocidad de m/s a mph
    velocidad_mph = velocidad * 2.23694;
    
    sei();
    rotaciones = 0;                 
    gulStart_Read_Timer = millis();     

    return velocidad;
  }
  
}


float obtenerPh() {
//Fecha de prueba: 27/07/2023 <Funcional>
// CONEXIONES: GND, GND, 3.3V, Po -> 34,

  for (int i = 0; i < 10; i++) {
    buf[i] = analogRead(analogInPin);
    delay(10);
  }

  for (int i = 0; i < 9; i++) {
    for (int j = i + 1; j < 10; j++) {
      if (buf[i] > buf[j]) {
        temp = buf[i];
        buf[i] = buf[j];
        buf[j] = temp;
      }
    }
  }

  avgValue = 0;
  for (int i = 2; i < 8; i++)
    avgValue += buf[i];

  float pHVol = (float)avgValue * 3.3 / 4095 / 7;
  float phValue = -5.70 * pHVol + 21.34;

  return phValue;

}


float obtenerDistancia(){

  long tiempo;
  long dist;

  digitalWrite(PinE, HIGH);
  delayMicroseconds(10);
  digitalWrite(PinT, LOW);

  tiempo = pulseIn(PinE, HIGH);
  dist = tiempo / 59;

  // Calcular las conversiones
  float dist_m = dist / 100.0; // Convertir a metros
  float dist_mm = dist * 10.0; // Convertir a milímetros
  float dist_pie = dist_m * 3.28084; // Convertir a pies
  float dist_pulg = dist * 0.393701; // Convertir a pulgadas

  return dist;
  
  }


void isr_rotation() {
  rotaciones++;
}




////////////////////////////////////////////////////////////////////////////////////
///                                                                              ///
///                  FUNCIONES PARA ENVIO DE DATOS AL SERVIDOR                   ///
///                                                                              ///
////////////////////////////////////////////////////////////////////////////////////

void objectoSensor(String id, String valor) {
  DynamicJsonDocument jsonDoc(1024); 
  String identificador = id;
  String valores = valor;

  jsonDoc["id"] = identificador;
  jsonDoc["valor"] = valores;

  EnviarDatosServidor(jsonDoc);
}

void EnviarDatosServidor(DynamicJsonDocument& jsonDoc) {

  if (client.connect(server, port)) {
    digitalWrite(led, LOW);
   
    String jsonString;
    serializeJson(jsonDoc, jsonString);

    // Enviar los datos al servidor
    client.print(jsonString);

    // Cerrar la conexión con el servidor
    // client.stop();
  } else {
    Serial.println("Error al conectar con el servidor");
    digitalWrite(led, LOW);
    delay(125);
    digitalWrite(led, HIGH);
    delay(125);
  }
}
