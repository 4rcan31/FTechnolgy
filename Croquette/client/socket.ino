#include &lt;ESP8266WiFi.h&gt;
#include &lt;WiFiClient.h&gt;



const char* ssid = "SSID";
const char* password = "CLAVE";
//protocolo TCP
WiFiServer servidorTCP(8266);
WiFiClient clienteTCP;
void setup() {
Serial.begin(115200);
delay(100);
Serial.print("Conectandose a: ");
Serial.println(ssid);
WiFi.begin(ssid, password); //Intentamos conectarnos a la red Wifi
while (WiFi.status() != WL_CONNECTED) { //Esperamos hasta que se conecte.
 
//Prendemos y apagamos el LED (parpadeo del led)
digitalWrite(LED,LOW);
delay(100);
digitalWrite(LED,HIGH);
delay(50);
digitalWrite(LED,LOW);
delay(100);
digitalWrite(LED,HIGH);
delay(50);
digitalWrite(LED,LOW);
delay(100);
digitalWrite(LED,HIGH);
 
}
//prendemos el led del nodemcu, quiere decir que si hizo conexion
digitalWrite(LED,LOW);
Serial.print ("Conectado, IP: ");
Serial.println (WiFi.localIP());
servidorTCP.begin();
}
 
void loop() {
// Si el cliente TCP no esta conectado
if (!clienteTCP.connected()) {
// try to connect to a new client
//Serial.print("ESPERANDO CONECTAR NUEVO CLIENTE");
//Aqui esta esperando a que un cliente se conecte
// Mientras no haya cliente disponible, prendemos y apagamos el led
//Prendemos y apagamos el LED (parpadeo del led)
digitalWrite(LED,LOW);
delay(100);
digitalWrite(LED,HIGH);
delay(50);
digitalWrite(LED,LOW);
delay(100);
digitalWrite(LED,HIGH);
delay(50);
digitalWrite(LED,LOW);
delay(100);
digitalWrite(LED,HIGH);
 
clienteTCP = servidorTCP.available();
 
} else { // Cliente TCP conectado
// Apagamos el LED, esto quiere decier que se conecto a un cliente
digitalWrite(LED,HIGH);
// leyendo data del cliente conectado
if (clienteTCP.available() &gt; 0)
{
}</pre>
<h3></h3>
<h3>Como recibir un dato por medio de sockets</h3>
Como dice el titulo, de esta forma podemos recibir un dato tipo char, un caracter.
<pre>char dato = clienteTCP.read();