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

Tu guía de instalación se ve bien ahora, con la adición de las instrucciones para instalar las dependencias utilizando Composer. Aquí tienes el texto actualizado:


# Instalación

## Cosas necesarias
- Git.
- Tener el comando `php` en la terminal (configurarlo desde las variables de entorno en caso de Windows).
- PHP versión >= 7.
- Tener MySQL instalado.
- Tener el comando `mysql` en la terminal (configurarlo desde las variables de entorno en caso de Windows).
- Tener Composer instalado.

## Recomendaciones (Solo en caso de que no estés seguro de lo que estás haciendo, o para evitar perder tiempo solucionando problemas de compatibilidad)

Una de las cosas necesarias es tener una versión de PHP igual o superior a 7. Si estás utilizando XAMPP, verifica que la versión sea la correcta, ya que XAMPP suele instalar `php v 5`. Yo recomiendo utilizar Laragon, ya que incluye una versión más actualizada de PHP y también MySQL (recuerda que debes editar la variable PATH para que los comandos `php` y `mysql` sean reconocidos).

Si deseas verificar tu versión de PHP (una vez hayas configurado la variable PATH), ejecuta:
```sh
php -v
```

No es estrictamente necesario configurar `mysql` o `php` en las variables de entorno (PATH) si no te sientes cómodo haciéndolo y si sabes lo que haces. En lugar de eso, puedes seguir estos pasos alternativos:

- **Configuración de MySQL:** Puedes utilizar la interfaz de usuario de tu gestor de bases de datos, ya sea phpMyAdmin o MySQL Workbench, para realizar el paso número 2, que implica crear la base de datos. Esto te permite hacerlo de manera gráfica y sin necesidad de configurar variables de entorno.

- **Configuración de PHP:** No es imprescindible tener PHP configurado en las variables de entorno. La única condición es que debes iniciar el servidor desde la carpeta `/public`. Esto se logra automáticamente con el comando `php jenu serve`, que ejecuta internamente `php -S localhost:8080 -t /public`. Esta opción simplifica el proceso y no requiere ajustes complicados.



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

### 7. Ejecutar el servidor web
```sh
php jenu serve
```

El programa debería estar en funcionamiento en:
```sh
http://localhost:8080
```

## Otros comandos

Si deseas reiniciar la base de datos ejecutando nuevamente las migraciones, esto dará un error, ya que no puedes ejecutar `php jenu execute:migrations` dos veces, ya que intentaría duplicar las tablas. Para solucionar este error, ejecuta:

```sh
php jenu migrations:fresh
```

Este comando eliminará todas las tablas de la base de datos y las reinstalará.






