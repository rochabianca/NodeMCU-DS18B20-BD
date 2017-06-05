#include <OneWire.h>
#include <DallasTemperature.h>]
#include <SPI.h>
#include <ESP8266WiFi.h>

const char* ssid = "IFCE-GDESTE";
const char* password = "(GcEm)2@17W1f1";

byte mac[] = {0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED };
byte ip[] = { 192,168,0,109}; //ip do arduino, no caso o que aparce quando você executa ipAddress
byte servidor[] = {192,168,0,108}; //endereço ipv4

#define ONE_WIRE_BUS 2
OneWire oneWire(ONE_WIRE_BUS);
DallasTemperature sensors(&oneWire);
DeviceAddress insideThermometer = { 0x28, 0x6B, 0xEE, 0xBA, 0x03, 0x00, 0x00, 0x33 };

WiFiClient cliente;

void setup() {
  Serial.begin(115200);
  WiFi.mode(WIFI_STA);
  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
 
  Serial.println("");
  Serial.println("WiFi connected");
  Serial.print("IP: ");
  Serial.println(WiFi.localIP());

  sensors.begin();
  sensors.setResolution(insideThermometer, 10);
}

void loop(void) {
  Serial.print("Lendo temperaturas...\n\r");
  sensors.requestTemperatures();
  delay(1000);
  float temperatura = sensors.getTempC(insideThermometer);

  delay(59000);
    if(cliente.connect(servidor, 80)) {
        Serial.println("conectado");
        cliente.print("GET /nodemcu-ds18b20-bd/salvardados.php?");
        cliente.print("temperatura=");
        cliente.println(temperatura);
        
        Serial.print("temperatura = ");
        Serial.println(temperatura);
        
        cliente.stop();
    }
    else {
        Serial.println("falha na conexão");
    }
}


