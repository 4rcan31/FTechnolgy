# FTecnology
## _Empresa para tus mascotas_

Somos una empresa dedicada a proporcionar soluciones innovadoras para el cuidado y mantenimiento de mascotas. Nuestra primera solución destacada es **Croquette**, un dispensador de comida para mascotas que ofrece una experiencia única y conectada. Este repositorio contiene tanto información sobre el proyecto principal, FTecnology, como los detalles específicos de Croquette.

## FTecnology: Innovación en Cuidado de Mascotas (Croquette)
FTecnology es la empresa detrás de la solución Croquette. Nuestra misión es mejorar la vida de las mascotas y sus dueños a través de soluciones tecnológicas innovadoras. Estamos comprometidos con la excelencia en diseño, funcionalidad y experiencia del usuario.

# Croquette
Croquette es un dispensador de comida para mascotas que va más allá de lo convencional. Su característica principal es la capacidad de conectarse a la aplicación de FTecnology, lo que permite a los dueños de mascotas dispensar comida de manera remota a través de Internet. Esto proporciona flexibilidad y comodidad tanto para los dueños de mascotas como para las propias mascotas.
## Features

- **Conexión Remota:** Croquette se conecta a la aplicación FTecnology, lo que permite a los usuarios dispensar comida de forma remota. Ya no es necesario estar físicamente presente para alimentar a tu mascota.

- **Programación de Alimentación:** Los usuarios pueden establecer horarios de alimentación regulares para sus mascotas a través de la aplicación. Croquette dispensará automáticamente la cantidad programada de comida en los momentos designados.

- **Monitoreo en Tiempo Real:** La aplicación proporciona información en tiempo real sobre cuándo se dispensó comida por última vez, cuánta comida queda en el dispensador y el consumo de comida de tu mascota en general.

## Archivos de Diseño de Croquette
En este repositorio, encontrarás los archivos de diseño de Croquette (El dispensador) en formato .blend y .stl

# Documentación de Croquette
Si deseas ver la documentación de Croquette, haz click [aquí](/Croquette/README.md).

# Instalación

## Requisitos 
- Git.
- El comando `php` debe estar disponible en tu terminal (configura las variables de entorno en caso de usar Windows).
- PHP versión >= 7.
- MySQL debe estar instalado en tu sistema.
- El comando `mysql` debe ser accesible desde tu terminal (configura las variables de entorno en caso de Windows, o simplemente utiliza MySQL desde un gestor de bases de datos como phpMyAdmin o MySQL Workbench).
- Composer debe estar instalado (no es esencial, pero puede ser útil para la actualización de dependencias).
- Node.js es necesario para ejecutar el servidor de comunicación de Croquette.

## Recomendaciones (Solo en caso de que no estés seguro de lo que estás haciendo, o para evitar perder tiempo solucionando problemas de compatibilidad)

Una de las cosas necesarias es tener una versión de PHP igual o superior a 7. Si estás utilizando XAMPP, verifica que la versión sea la correcta, ya que XAMPP suele instalar `php v 5`. Yo recomiendo utilizar Laragon, ya que incluye una versión más actualizada de PHP y también MySQL (recuerda que debes editar la variable PATH para que los comandos `php` y `mysql` sean reconocidos). (Si no quieres hacer tanto tramite y instalar Laragon, primero verifica si tu XAMPP ya tiene una version de php mayor o igual que 7).Yo te recomendaría verificar primero tu versión de PHP antes de instalar Laragon o actualizar la versión de PHP en XAMPP.

Si deseas verificar tu versión de PHP (una vez hayas configurado la variable PATH), ejecuta:
```sh
php -v
```

No es estrictamente necesario configurar `mysql` o `php` en las variables de entorno (PATH) si no te sientes cómodo haciéndolo y si sabes lo que haces. En lugar de eso, puedes seguir estos pasos alternativos:

- **Configuración de MySQL:** Puedes utilizar la interfaz de usuario de tu gestor de bases de datos, ya sea phpMyAdmin o MySQL Workbench, para realizar el paso número 2, que implica crear la base de datos. Esto te permite hacerlo de manera gráfica y sin necesidad de configurar variables de entorno.

- **Configuración de PHP:** No es imprescindible tener PHP configurado en las variables de entorno. La única condición es que debes iniciar el servidor desde la carpeta `/public`. Esto se logra automáticamente con el comando `php jenu serve`, que ejecuta internamente `php -S 127.0.0.1:8080 -t /public`. Esta opción simplifica el proceso y no requiere ajustes complicados.



## Pasos
### 1. Clonar el repositorio
```sh
git clone https://github.com/4rcan31/FTechnology.git
```

### 2. Crear la base de datos
#### 2.1 Ingresar al gestor de base de datos
```sh
mysql -u root -p
```
El parámetro `-u` es para el usuario y `-p` para la contraseña.

#### 2.2 Crear la base de datos
```sql
CREATE DATABASE ftechnology;
```

### 3. Configurar variables de entorno (Archivo `.ENV`)

```env
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=ftechnology
DB_USERNAME=root
DB_PASSWORD=
```

##### Valores por defecto (generalmente no cambian)
- `DB_CONNECTION`: Gestor al que se conectará.
- `DB_HOST`: Host al que se conectará.
- `DB_PORT`: Puerto del host al que se conectará.

##### Valores que generalmente cambian
- `DB_DATABASE`: Nombre de la base de datos a la que se conectará.
- `DB_USERNAME`: Nombre de usuario para acceder al gestor de base de datos.
- `DB_PASSWORD`: Contraseña para acceder al gestor de base de datos (por defecto es vacía).

### 4. Verificar si la configuración de la base de datos fue exitosa

```sh
php jenu comprobate:connection:mysql
```

### 5. Ejecutar las migraciones (crear tablas)

```sh
php jenu execute:migrations
```

### 6. Instalar las dependencias ejecutando
```sh
composer install
```
Este comando no es necesario (solamente para una posible actualizacion de las dependencias)

### 7. Ejecutar el servidor web
```sh
php jenu serve
```

El programa debería estar en funcionamiento en:
```sh
http://localhost:8080
```

# Instalación del Servidor Croquette

El servidor Croquette es una parte opcional de la aplicación que permite la comunicación en tiempo real con clientes de socket TCP (Croquettes). Para habilitar esta función, es necesario contar con Node.js, ya que el servidor utiliza un socket TCP implementado con la biblioteca "net" de Node.js. Este protocolo permite la comunicación bidireccional entre los clientes de socket TCP y la aplicación HTTP. A continuación, se describe el flujo de comunicación:

## Comunicación desde el Cliente de Socket TCP al Servidor Croquette (SocketServerCroquette) y la Aplicación HTTP (AppHttp)
### Cliente Socket TCP -> Socket Server Croquette -> Aplicación HTTP

1. Un cliente de socket TCP se conecta al servidor de Croquette (SocketServerCroquette).

2. El servidor de Croquette identifica la conexión como un cliente de socket TCP mediante una cabecera especial.

3. El servidor de Croquette guarda la conexión en un mapa de JavaScript asociándola con un token proporcionado por el cliente de socket TCP. El mapa se estructura de la siguiente manera:

   ```
   token -> socket
   ```

4. El servidor de Croquette realiza una solicitud HTTP (usando Axios) a la aplicación HTTP, incluyendo el token de identificación del cliente de socket TCP. Este token sirve como identificador del socket del cliente TCP para permitir la comunicación en tiempo real, ya que el socket del cliente TCP permanece activo en el mapa de conexiones.

## Comunicación desde la Aplicación HTTP (AppHttp) al Servidor de Croquette (SocketServerCroquette) y el Cliente de Socket TCP
### Aplicación HTTP -> Server Croquette -> Cliente Socket TCP

Cuando la aplicación HTTP desea enviar un mensaje al cliente de socket TCP, sigue el siguiente proceso:

1. La aplicación HTTP se conecta al servidor de Croquette TCP (SocketServerCroquette).

2. El servidor de Croquette (SocketServerCroquette) identifica si la entidad que se está conectando es la propia aplicación HTTP o un cliente de socket TCP mediante una cabecera especial.

3. Durante la misma conexión, la aplicación HTTP proporciona el token al servidor de Croquette (SocketServerCroquette) para indicar a quién se debe dirigir el mensaje.

4. El servidor de Croquette (SocketServerCroquette) verifica si el token está presente en su mapa de conexiones. Si se encuentra, se utiliza para enviar el mensaje a través del socket asociado a ese token.

Este flujo permite la comunicación en tiempo real entre la aplicación HTTP y los clientes de socket TCP a través del servidor de Croquette.

No necesitas realizar una instalación adicional, ya que las dependencias se descargaron automáticamente junto con el repositorio. Sin embargo, si deseas actualizarlas, puedes ejecutar alguno de los siguientes comandos:

Para instalar las dependencias:
```sh
npm install
```
Para actualizarlas:
```
npm update
```
Ambas opciones están disponibles para mantener tus dependencias al día.
## Ejecución del Servidor Croquette

Para iniciar el servidor Croquette, utiliza el siguiente comando:

```sh
node Server/Croquette.js
```

El servidor estará disponible en la siguiente dirección:

```sh
127.0.0.1:8081
```

Si deseas realizar pruebas, se proporciona una simulación de conexión de un Croquette que está asociado al primer Croquette Auth en la base de datos. Para iniciar la simulación de conexión, ejecuta el siguiente comando:

```sh
node Server/clienteSimulation.js 127.0.0.1 8081
```

La simulación de conexión para pruebas debería estar funcionando correctamente.


# Comandos FTecnology
FTecnology aún no cuenta con una interfaz gráfica para un panel de administración del CEO, pero sí cuenta con un CLI para ello, y hay algunos comandos que me han resultado útiles. Para ver los comandos de FTecnology, simplemente ejecuta:
```sh
php jenu help
```