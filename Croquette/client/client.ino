// CAT FEEDER
// v0.1

// LIBRARY
#include <Stepper.h>
#include <LiquidCrystal.h>
#include <HX711.h>

// VARIABLES & PINS

// Stepper Motor
#define STEPS 32                              // Number of steps per revolution of Internal shaft
int Steps2Take;                               // 2048 = 1 Revolution
const int X_Speed = 600;                      // Max 1100
const int In1 = 2, In2 = 4, In3 = 3, In4 = 5; // In1, In2, In3, In4 in the sequence 1-3-2-4
Stepper small_stepper(STEPS, In1, In2, In3, In4);

// Buttons
const int S_pin = 6; // SCROLL digital pin connected to switch output
const int E_pin = 7; // ENTER digital pin connected to switch output
int S_state = 0;
int E_state = 0;

// LCD Display
const int rs = 12, en = 13, d4 = 8, d5 = 9, d6 = 10, d7 = 11;
const int backlightPin = A5; // Output to control backlight with pin 15 of the display.
LiquidCrystal lcd(rs, en, d4, d5, d6, d7);

// Load Cell
HX711 scale;
const int DTPin = A0, SCKPin = A1;
const int scale_factor = 420.0983; // Scale factor following calibration with a known weight.
float Weight;                      // Weight measurement. Compared to value in grams.

// Parameters
int Qty_Weight = 45;            // Default value for food to be delivered. In grams.
int Cust_Qty_Weight = 0;        // Minimum custom value.
int InterV = 5;                 // Default value for interval between deliveries. In hours.
int Cust_InterV = 0;            // Minimum custom value.
int Sel_Line = 0;               // Menu line selection.
int Delaystart = 0;             // Default value for delayed start. In hours.
unsigned long Start_MTimer = 0; // Motor timer. Store time last time motor was started.
unsigned long Stop_MTimer = 0;  // Motor timer. Store time last time motor was stoped.
const int MTimerErr = 30;       // Motor timout. In seconds.

// CODE

void setup()
{
  Serial.begin(9600);

  pinMode(S_pin, INPUT_PULLUP);
  pinMode(E_pin, INPUT_PULLUP);
  pinMode(backlightPin, OUTPUT);
  pinMode(DTPin, INPUT);
  pinMode(SCKPin, INPUT);

  scale.begin(DTPin, SCKPin);
  scale.set_scale(scale_factor);
  scale.tare();

  lcd.begin(16, 2);
  digitalWrite(backlightPin, HIGH);
  lcd.print("Croquette - FTecnology");
  delay(1000);
  lcd.clear();
  delay(500);

/* 
  Esto es un menu, es para definir que modo se va a eligir
  existen dos modos: Default y Custom

  

 */
Mainmenu:
  lcd.setCursor(0, 0);
  lcd.print(">");
  lcd.setCursor(1, 0);
  lcd.print("Default:");
  lcd.print(Qty_Weight);
  lcd.print("g,");
  lcd.print(InterV);
  lcd.print("hr");
  lcd.setCursor(1, 1);
  lcd.print("Custom:");

  do // Loop to select Default or Custom values
  {
    S_state = digitalRead(S_pin);
    E_state = digitalRead(E_pin);
    if (S_state == LOW)
    {
      lcd.setCursor(0, Sel_Line);
      lcd.print(" ");
      if (Sel_Line == 0)
        Sel_Line = Sel_Line + 1;
      else
        Sel_Line = Sel_Line - 1;
      lcd.setCursor(0, Sel_Line);
      lcd.print(">");
      delay(300);
    }
  } while (E_state == HIGH);
  delay(300);


  if (Sel_Line == 0) //Esto si se define el deafult
    goto Endsetup;
  if (Sel_Line == 1){  //Esto pasa solamente si se define Custom
    lcd.clear(); // Loop to define Custom weight
    lcd.setCursor(1, 0);
    lcd.print("Cantidad:");
    lcd.setCursor(1, 1);
    lcd.print(Cust_Qty_Weight);
    lcd.print(" g");

    do
    {
      S_state = digitalRead(S_pin);
      E_state = digitalRead(E_pin);
      if (S_state == LOW)
      {
        if (Cust_Qty_Weight < 95)
          Cust_Qty_Weight = Cust_Qty_Weight + 5;
        else
          Cust_Qty_Weight = 5;
        lcd.setCursor(1, 1);
        lcd.print("  ");
        lcd.setCursor(1, 1);
        lcd.print(Cust_Qty_Weight);
        Qty_Weight = Cust_Qty_Weight;
        delay(300);
      }
    } while (E_state == HIGH);
    delay(300);

    lcd.clear(); // Loop to define Custom interval
    lcd.setCursor(1, 0);
    lcd.print("Feed Interval:");
    lcd.setCursor(1, 1);
    lcd.print(Cust_InterV);
    lcd.print(" hr");

    do
    {
      S_state = digitalRead(S_pin);
      E_state = digitalRead(E_pin);
      if (S_state == LOW)
      {
        if (Cust_InterV < 23)
          Cust_InterV = Cust_InterV + 1;
        else
          Cust_InterV = 1;
        lcd.setCursor(1, 1);
        lcd.print("  ");
        lcd.setCursor(1, 1);
        lcd.print(Cust_InterV);
        InterV = Cust_InterV;
        delay(300);
      }
    } while (E_state == HIGH);
    delay(300);

    Sel_Line = 0;
    goto Mainmenu;
  }

Endsetup:
  lcd.clear(); // Loop to define delayed start value
  lcd.setCursor(0, 0);
  lcd.print("Delay to start:");
  lcd.setCursor(1, 1);
  lcd.print(Delaystart);
  lcd.print(" hr");

  do
  {
    S_state = digitalRead(S_pin);
    E_state = digitalRead(E_pin);
    if (S_state == LOW)
    {
      if (Delaystart < 24)
        Delaystart = Delaystart + 1;
      else
        Delaystart = 0;
      lcd.setCursor(1, 1);
      lcd.print("  ");
      lcd.setCursor(1, 1);
      lcd.print(Delaystart);
      delay(300);
    }
  } while (E_state == HIGH);
  delay(300);

  lcd.clear();
  lcd.setCursor(0, 0);
  lcd.print("Miam!");
  delay(1000);
  lcd.noDisplay();
  digitalWrite(backlightPin, LOW);
  delay(Delaystart * 1000); // Convert delay start from Hours to Millis

} // END SETUP

void loop()
{
  Start_MTimer = millis() / 1000;

FeedLoop: // Motor actuation at specified intervals. Stops when specified weight reached. Move forward and backward to prevent jamming

  for (int x = 0; x < 4; x++)
  {
    Steps2Take = 500;
    small_stepper.setSpeed(X_Speed);
    small_stepper.step(Steps2Take);
    Weight = scale.get_units();
    Stop_MTimer = millis() / 1000;
    Serial.print("Measure: ");
    Serial.println(Weight);
    Serial.print("Motor Time: ");
    Serial.println(Stop_MTimer - Start_MTimer);
    if (Weight > Qty_Weight)
      goto FeedComplete;
    if (Stop_MTimer - Start_MTimer > MTimerErr)
      goto FeedError;
  }

  delay(500);

  Steps2Take = -500;
  small_stepper.setSpeed(X_Speed);
  small_stepper.step(Steps2Take);

  delay(500);

  goto FeedLoop;

FeedError:                // Routine when the motor time-out. Call for user
  digitalWrite(In1, LOW); // Shutting off stepper motor
  digitalWrite(In2, LOW);
  digitalWrite(In3, LOW);
  digitalWrite(In4, LOW);
  lcd.display();
  lcd.clear();
  lcd.setCursor(5, 0);
  lcd.print("ERROR");

  E_state = digitalRead(E_pin); // Flash backlight until press OK button
  while (E_state == HIGH)
  {
    for (int light_on = 0; light_on < 501; light_on++)
    {
      E_state = digitalRead(E_pin);
      if (E_state == LOW)
        break;
      digitalWrite(backlightPin, HIGH);
      delay(1);
    }

    for (int light_off = 0; light_off < 501; light_off++)
    {
      E_state = digitalRead(E_pin);
      if (E_state == LOW)
        break;
      digitalWrite(backlightPin, LOW);
      delay(1);
    }
  }
  delay(300);

  lcd.clear();
  digitalWrite(backlightPin, HIGH);
  lcd.setCursor(0, 0);
  lcd.print("Feeding error");
  lcd.setCursor(0, 1);
  lcd.print("Refill&Press OK");

  E_state = digitalRead(E_pin); // Second user acknowledgement to resume the feed
  while (E_state == HIGH)
  {
    E_state = digitalRead(E_pin);
  }
  delay(300);

  lcd.clear();
  lcd.noDisplay();
  digitalWrite(backlightPin, LOW);
  Start_MTimer = millis() / 1000; // Reset motor timer
  goto FeedLoop;

FeedComplete:
  Serial.print("Complete");
  digitalWrite(In1, LOW); // Shutting off stepper motor
  digitalWrite(In2, LOW);
  digitalWrite(In3, LOW);
  digitalWrite(In4, LOW);

  delay(InterV * 1000); // Wait until next interval (in hour) until next loop

} // END LOOP
