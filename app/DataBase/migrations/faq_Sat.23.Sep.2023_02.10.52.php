<?php
class faq extends Migration {
        
    public function up() {
        $this->create("faq", function($table) {
            $this->prepare();
            $this->query('CREATE TABLE faq (
                id INT AUTO_INCREMENT PRIMARY KEY,
                question TEXT NOT NULL,
                answer TEXT NOT NULL,
                create_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )');


            $this->prepare();
            $this->insert('faq')->values([
                'question' => '¿Tengo algún tipo de garantía en la reparación del producto?',
                'answer' => 'Sí, tu reparación tiene una garantía de 6 meses siempre y cuando la falla que se presente sea de fabrica.'
            ]);
            $this->execute();

            $this->prepare();
            $this->insert('faq')->values([
                'question' => '¿Qué tipo de comida se puede poner en el dispensador?',
                'answer' => 'Este dispensador está hecho para comida seca o croquetas para animal.'
            ]);
            $this->execute();

            $this->prepare();
            $this->insert('faq')->values([
                'question' => '¿Qué hacer si el dispensador falla? ',
                'answer' => 'Lo primero es revisar el manual de instrucciones, dónde podrás encontrar el problema y la posible solución, alguna de las causas puede ser que se atasco la comida, polvo en el mecanismo interno, etc. Si el problema persiste o no encuentras la solución llama al soporte técnico, al vendedor para una revisión y un posible cambio.'
            ]);
            $this->execute();

            $this->prepare();
            $this->insert('faq')->values([
                'question' => '¿El dispensador de comida se puede utilizar con cualquier mascota?',
                'answer' => 'Por el momento solo es disponible y recomendable utilizarlos solo en perros y gatos.'
            ]);
            $this->execute();

            $this->prepare();
            $this->insert('faq')->values([
                'question' => '¿De qué material esta hecho el dispensador?',
                'answer' => 'El dispensador esta compuesto por la carcaza que viene siendo de plastico resistente eco-amigable y el interior del plato es conformado por aluminio, para facilitar su limpieza.'
            ]);
            $this->execute();
        });
    }
        
    public function down() {
        $this->dropIfExist("faq");
    }
        
}