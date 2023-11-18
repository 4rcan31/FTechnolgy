#include <Stepper.h>
#include <Wire.h>
#include <LiquidCrystal_I2C.h>
#include <HX711.h>

// VARIABLES & PINS
// Stepper Motor
#define STEPS 32
int Steps2Take;
const int X_Speed = 600;
const int In1 = 2, In2 = 4, In3 = 3, In4 = 5;
Stepper small_stepper(STEPS, In1, In2, In3, In4);

// Buttons
const int S_pin = 6;
const int E_pin = 7;
int S_state = 0;
int E_state = 0;

LiquidCrystal_I2C lcd(0x27, 16, 2);

// Load Cell
HX711 scale;
const int DTPin = A0, SCKPin = A1;
const int scale_factor = 420.0983;
float Weight;
int Qty_Weight = 45;
int Cust_Qty_Weight = 0;
int InterV = 5;
int Cust_InterV = 0;
int Sel_Line = 0;
int Delaystart = 0;
unsigned long Start_MTimer = 0;
unsigned long Stop_MTimer = 0;
const int MTimerErr = 30;

void setup() {
  Serial.begin(9600);

  pinMode(S_pin, INPUT_PULLUP);
  pinMode(E_pin, INPUT_PULLUP);

  Wire.begin();

  lcd.init();
  lcd.backlight();

  scale.begin(DTPin, SCKPin);
  scale.set_scale(scale_factor);
  scale.tare();

  lcd.clear();
  lcd.print("Croquette - FTecnology");
  delay(3000);
  lcd.clear();
  delay(500);

//lcd.setCursor(0, 0);
  //lcd.print(" /\\_/\\ ");
  //lcd.setCursor(0, 1);
  //lcd.print("( o.o )");
  
  //delay(3000);

  // Main Menu
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

  do {
    S_state = digitalRead(S_pin);
    E_state = digitalRead(E_pin);
    if (S_state == LOW) {
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

  if (Sel_Line == 0)
    goto Endsetup;
  if (Sel_Line == 1) {
    lcd.clear();
    lcd.setCursor(1, 0);
    lcd.print("Quantity:");
    lcd.setCursor(1, 1);
    lcd.print(Cust_Qty_Weight);
    lcd.print(" g");

    do {
      S_state = digitalRead(S_pin);
      E_state = digitalRead(E_pin);
      if (S_state == LOW) {
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

    lcd.clear();
    lcd.setCursor(1, 0);
    lcd.print("Feed Interval:");
    lcd.setCursor(1, 1);
    lcd.print(Cust_InterV);
    lcd.print(" hr");

    do {
      S_state = digitalRead(S_pin);
      E_state = digitalRead(E_pin);
      if (S_state == LOW) {
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
  lcd.clear();
  lcd.setCursor(0, 0);
  lcd.print("Miam!");
  delay(1000);
  lcd.noBacklight();
  delay(Delaystart * 1000);
}

void loop() {
  Start_MTimer = millis() / 1000;

  FeedLoop:
  for (int x = 0; x < 4; x++) {
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

  FeedError:
  digitalWrite(In1, LOW);
  digitalWrite(In2, LOW);
  digitalWrite(In3, LOW);
  digitalWrite(In4, LOW);
  lcd.backlight();
  lcd.clear();
  lcd.setCursor(5, 0);
  lcd.print("ERROR");

  E_state = digitalRead(E_pin);
  while (E_state == HIGH) {
    for (int light_on = 0; light_on < 501; light_on++) {
      E_state = digitalRead(E_pin);
      if (E_state == LOW)
        break;
      lcd.backlight();
      delay(1);
    }

    for (int light_off = 0; light_off < 501; light_off++) {
      E_state = digitalRead(E_pin);
      if (E_state == LOW)
        break;
      lcd.noBacklight();
      delay(1);
    }
  }
  delay(300);

  lcd.backlight();
  lcd.setCursor(0, 0);
  lcd.print("Feeding error");
  lcd.setCursor(0, 1);
  lcd.print("Refill & Press OK");

  E_state = digitalRead(E_pin);
  while (E_state == HIGH) {
    E_state = digitalRead(E_pin);
  }
  delay(300);

  lcd.noBacklight();
  Start_MTimer = millis() / 1000;
  goto FeedLoop;

  FeedComplete:
  Serial.print("Complete");
  digitalWrite(In1, LOW);
  digitalWrite(In2, LOW);
  digitalWrite(In3, LOW);
  digitalWrite(In4, LOW);

  delay(InterV * 1000);

  // Wait until the next interval (in hours) before the next loop
}