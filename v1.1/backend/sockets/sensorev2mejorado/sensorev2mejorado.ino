#include <ArduinoJson.h>
#include <ESP8266WiFi.h>
#include <WiFiClient.h>
#include <WiFiClient.h>


#include <DHT.h>
#include <Adafruit_Sensor.h>
#define DHTPIN 5
#define DHTTYPE DHT11
DHT dht(DHTPIN, DHTTYPE);

#define led 2

const char* ssid = "sensores";
const char* password = "sensores";
const char* server = "192.168.144.178";
const int port = 1234;

WiFiClient client;

void setup()
{
  dht.begin();
  pinMode(led, OUTPUT);
  digitalWrite(led, HIGH);


  
  Serial.begin(115200);
  
  // Conéctate a la red Wi-Fi
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

  }

void loop() {

  objectoSensor("30",String(obtenerValorSensorMov()));
  objectoSensor("29",String(obtenerValorSensorLuz()));
  objectoSensor("28",String(obtenerTemperatura()));



}


void objectoSensor(String id, String valor){
  DynamicJsonDocument jsonDoc(1024); // Tamaño adecuado para tus datos
  String identificador = id;
  String valores = valor;
 
  // Añadir los valores de los sensores al documento JSON
  jsonDoc["id"] = identificador;
  jsonDoc["valor"] = valores;
 
  EnviarDatosServidor(jsonDoc);
  }

void EnviarDatosServidor(DynamicJsonDocument& jsonDoc){
// Enviar el documento JSON al servidor
  if (client.connect(server, port)) {
     digitalWrite(led, LOW);
    // Convertir el documento JSON en una cadena
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


 // CREAR FUNCIONES DE SENSORES
 
int obtenerValorSensorLuz(){
int datos = analogRead(A0);
int datosInv = 1023 - datos;

int porcentajeLuz = (datosInv*100)/1023;
return porcentajeLuz ;
}


 
String obtenerValorSensorMov(){
  #define sensorMic 2
String valorLetra;
int datos = digitalRead(sensorMic);
int datosInv = (datos == 1) ? 0 : 1; // Invierte el valor

if(datosInv == 0){
  valorLetra = "Sin detectar obstaculo";
  }else{
     valorLetra = "Detecta obstaculo";
    }
return valorLetra;
}


int obtenerValorPir(){
#define sensorPir 5
//const int sensorPot = 4;
int datos = digitalRead(sensorPir);
Serial.println(datos);
return datos;
}

/* float obtenerValorUltrasonico(){
  int duracion;
  float distancia;

  
  #define trigPin 5
  #define echoPin 4
  
  pinMode(trigPin, OUTPUT);        // Pin de disparo como salida
  pinMode(echoPin, INPUT);         // Pin de eco como entrada

  digitalWrite(trigPin, LOW);
  delayMicroseconds(2);

  digitalWrite(trigPin, HIGH);
  delayMicroseconds(10);
  digitalWrite(trigPin, LOW);

  duracion = pulseIn(echoPin, HIGH);

  // Calcula la distancia en centímetros
  distancia = duracion * 0.034 / 2;  
  return distancia;
  }

 */


float obtenerValorUltrasonico() {
    #define trigPin 5
  #define echoPin 4
  
  pinMode(trigPin, OUTPUT);    // Pin de disparo como salida
  pinMode(echoPin, INPUT);     // Pin de eco como entrada

  long duracion;
  float distancia_cm, distancia_m, distancia_mm, distancia_pie, distancia_pulg;

  digitalWrite(trigPin, LOW);
  delayMicroseconds(2);

  digitalWrite(trigPin, HIGH);
  delayMicroseconds(10);
  digitalWrite(trigPin, LOW);

  duracion = pulseIn(echoPin, HIGH);

  // Calcula la distancia en centímetros, metros, milímetros, pies y pulgadas...

  distancia_cm = duracion * 0.034 / 2;
  distancia_m = distancia_cm / 100.0;
  distancia_mm = distancia_cm * 10;
  distancia_pie = distancia_m / 0.3048;
  distancia_pulg = distancia_cm / 2.54;

  return distancia_cm;
}


float obtenerTemperatura() {
float h = dht.readHumidity();
float t = dht.readTemperature();

return t;
}
