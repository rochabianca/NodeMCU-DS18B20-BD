#include <SPI.h>
#include <String.h>
#include <ESP8266WiFi.h>

const char* ssid = "GVT-5BF9";
const char* password = "5403000544";

byte mac[] = { 0x90, 0xA2, 0xDA, 0x00, 0x9B, 0x36 };
byte ip[] = { 192,168, 25, 101 }; //ip do arduino
byte servidor[] = {192,168,25,60}; //endereço ipv4

WiFiServer server(80);
WiFiClient cliente;

String readString = String(30);

unsigned long previousMillis = 0;
const long interval = 5000;

void setup() {
  Serial.begin(115200);
  WiFi.begin(ssid, password);
  
  while (WiFi.status() != WL_CONNECTED) {
  delay(500);
  Serial.print(".");
  }
  Serial.println("");
  Serial.println("WiFi connected");
}

void loop() {
  float temperatura = 0, sensor2 = 0, sensor3 = 0;
  WiFiClient client = server.available();
  unsigned long currentMillis = millis();

  if(currentMillis - previousMillis >= interval) {
      previousMillis = currentMillis;

      if(cliente.connect(servidor, 80)) {

            temperatura = sensor3 + 5;
            sensor2 = temperatura + 5;
            sensor3 = sensor2 + 5;
            
            Serial.println("conectado");
            cliente.print("GET /arduino/salvardados.php?");
            cliente.print("temperatura=");
            cliente.println(temperatura);

            
            Serial.print("Temperatura = ");
            Serial.println(temperatura);
   
            cliente.stop();
        }
        else {
            Serial.println("falha na conexão");
            cliente.stop();
        }
    }
  
  if(client) 
  {
    while(client.connected())
    {
      if(client.available()) 
      {
        char c = client.read();
        
        if(readString.length() < 30) {
          readString += (c);
        }
        
        if(c == '\n')
        {
          // cabeçalho http padrão
          client.println("HTTP/1.1 200 OK");
          client.println("Content-Type: text/html");
          client.println();
         
          client.println("<!doctype html>");
          client.println("<html>");
          client.println("<head>");
          client.println("<title>Tutorial</title>");
          client.println("<meta name=\"viewport\" content=\"width=320\">");
          client.println("<meta name=\"viewport\" content=\"width=device-width\">");
          client.println("<meta charset=\"utf-8\">");
          client.println("<meta name=\"viewport\" content=\"initial-scale=1.0, user-scalable=no\">");
          client.println("<meta http-equiv=\"refresh\" content=\"3; URL=http://192.168.25.101:80\">");
          client.println("</head>");
          client.println("<body>");
          client.println("<center>");
          
          client.println("<font size=\"5\" face=\"verdana\" color=\"green\">Android</font>");
          client.println("<font size=\"3\" face=\"verdana\" color=\"red\"> & </font>");
          client.println("<font size=\"5\" face=\"verdana\" color=\"blue\">Arduino</font><br />");

          client.println("<font size=\"5\" face=\"verdana\" color=\"red\">Sensor1 = </font>");
          client.println("<font size=\"5\" face=\"verdana\" color=\"blue\">");
          client.println(temperatura);
          client.println("</font><br>");

          client.println("<p><a href=\"http://localhost:80/arduino/\" target=\"_blank\">Historico</a></p>");
         
          
          client.println("</center>");
          client.println("</body>");
          client.println("</html>");
        
          readString = "";
          
          client.stop();
        }
      }
      
    }
  }
  
}

