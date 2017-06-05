#include <SPI.h>
#include <ESP8266WiFi.h>

const char* ssid = "CAECOMP";
const char* password = "fazomuro!";
 
byte mac[] = {0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED };
byte ip[] = { 192,168,0,109}; //ip do arduino, no caso o que aparce quando você executa ipAddress
byte servidor[] = {192,168,0,108}; //endereço ipv4

//char server[] = "www.google.com"

//IPAddress ip(192,168,0,177);

WiFiClient cliente;

float temperatura = 0, sensor2 = 0, sensor3 = 0;

void setup() {
    Serial.begin(115200);
    WiFi.begin(ssid, password);
    while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
 
  Serial.println("");
  Serial.println("WiFi connected");
  Serial.print("IP: ");
  Serial.println(WiFi.localIP());
}

void loop() {
    char comando = Serial.read();
    delay(30000);
    if(cliente.connect(servidor, 80)) {

        temperatura = sensor3 + 5;
        sensor2 = temperatura + 5;
        sensor3 = sensor2 + 5;
        
        Serial.println("conectado");
        cliente.print("GET /arduino/salvardados.php?");
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
