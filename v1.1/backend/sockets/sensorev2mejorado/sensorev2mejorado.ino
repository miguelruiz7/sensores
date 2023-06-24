#include <ArduinoJson.h>
#include <ESP8266WiFi.h>
#include <WiFiClient.h>
#include <WiFiClient.h>


#include <DHT.h>
#include <Adafruit_Sensor.h>
#define DHTPIN 4
#define DHTTYPE DHT22
DHT dht(DHTPIN, DHTTYPE);

const char* ssid = "EmprendimientoCYT";
const char* password = "3mpr3nd1m13nt0";
const char* server = "10.10.100.210";
const int port = 1234;

WiFiClient client;

void setup() {
  Serial.begin(115200);
  
  // Conéctate a la red Wi-Fi
  WiFi.begin(ssid, password);
  
  while (WiFi.status() != WL_CONNECTED) {
    Serial.println("Conectando a la red Wi-Fi...");
  }
    Serial.println("Conexión establecida");
  
  }

void loop() {
 
  //Sensor de Luz
  
  objectoSensor("24",String(obtenerValorSensorLuz()));
  objectoSensor("25",String(obtenerValorSensorMov()));


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
    // Convertir el documento JSON en una cadena
    String jsonString;
    serializeJson(jsonDoc, jsonString);
  
    // Enviar los datos al servidor
    client.print(jsonString);
    
    // Cerrar la conexión con el servidor
    // client.stop();
  } else {
    Serial.println("Error al conectar con el servidor");
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
  #define sensorMic 5
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


//FUNCIONES HUMEDAD Y TEMPERATURA
float temperaturaHumedad(){
      // Esperamos 5 segundos entre medidas
  // Leemos la humedad relativa
  //float h = dht.readHumidity();
  // Leemos la temperatura en grados centígrados (por defecto)
  float t = dht.readTemperature();
  // Leemos la temperatura en grados Fahrenheit
  //float f = dht.readTemperature(true);
    Serial.println(t);
    return t;
  }
