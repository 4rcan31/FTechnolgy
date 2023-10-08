# Tareas Pendientes

1. **Terminar de programar el protocolo de comunicación de Croquette**: Finalizar la implementación del protocolo de comunicación para garantizar la interacción correcta entre el dispositivo Croquette y la aplicación. **(LISTO)** *7 de octubre 2023*

2. **Programar el código para el Arduino (funcionamiento con la app, internet)**: Desarrollar el código que permitirá a Croquette funcionar en conjunto con la aplicación para la dispensación de alimentos a través de Internet.

3. **Soporte para Múltiples Croquettes**: Habilitar la capacidad para que los usuarios conecten varios dispositivos Croquette a la aplicación, mejorando la experiencia del usuario.  **(LISTO)** *6 de octubre 2023*

4. **Flujo de Compra de Croquette desde la Tienda**: Implementar la funcionalidad que permitirá a los usuarios realizar compras de productos Croquette directamente desde la aplicación, facilitando la adquisición de nuevos dispositivos. **(LISTO)** *5 de octubre 2023*

5. **Acceso a la Tienda desde el Panel**: Agregar una sección que permita a los usuarios acceder a la tienda de productos Croquette desde el panel de control, brindándoles una experiencia completa. **(LISTO)** *5 de octubre 2023*

6. **Acceso a las Preguntas Frecuentes (FAQ) desde el Panel**: Incorporar un enlace que proporcione acceso rápido a las preguntas frecuentes (FAQ) desde el panel de control, mejorando la disponibilidad de información útil para los usuarios.

7. **Guía de Instalación**: Crear una sección que permita a los usuarios consultar una guía de instalación desde el panel de control, asegurando una configuración exitosa de Croquette.

8. **Crear una simulación de Croquette para pruebas**: Desarrollar una simulación de Croquette en Node.js para realizar pruebas exhaustivas y garantizar su correcto funcionamiento. **(LISTO)** *7 de octubre 2023*

9. **Soldar el circuito**: Completar el ensamblaje del circuito de Croquette mediante el proceso de soldadura, asegurando una conexión sólida y confiable.

10. **Programar el código para el Arduino (funcionamiento sin app, localhost)**: Desarrollar el código que permitirá que Croquette funcione de forma independiente sin necesidad de la aplicación, brindando opciones de uso flexibles.

11. **Armar las piezas impresas de Croquette**: Ensamblar las partes impresas de Croquette para construir el dispositivo físico.

12. **Instalar el circuito de Croquette en las piezas**: Colocar el circuito de Croquette en las piezas impresas para completar la construcción del dispositivo.

13. **Edición de Perfil de la Mascota**: Implementar la funcionalidad que permita a los usuarios editar los perfiles de sus mascotas para proporcionar una experiencia personalizada. **(LISTO)**


# Problemas de Seguridad

- **Vulnerabilidad en la Edición del Perfil**:
  Descubrí una vulnerabilidad en la página de edición de perfiles en la fecha 2 de octubre de 2023. El problema radica en cómo se construyen las rutas para la edición de perfiles. Actualmente, se utiliza un formulario como el siguiente:

  ```html
  <form action="' . route('api/v1/auth/edit/profile/' . $profile->id . '/' . "name", false) . '" method="POST">
      <div class="form-group">
          '.TokenCsrf::getInput().'
          <label for="newName">Nuevo nombre</label>
          <input type="text" class="form-control" name="name">
      </div>
  </form>
  ```

  El problema principal es que el ID del usuario se transmite en texto plano en la URL del atributo action. Esto significa que cualquier persona podría editar y cambiar este ID, lo que permitiría hacerse pasar por otro usuario y modificar su nombre y los datos de su mascota.

  Esta vulnerabilidad tiene un alcance limitado, ya que solo permite editar el nombre y el avatar de un usuario, también es posible editar los datos de las mascotas. Por lo tanto, no implica un riesgo de robo de datos.

  Para solucionar este problema de seguridad, es mejor no enviar el ID del usuario a través de la URL. En lugar de depender del ID del usuario en la URL, se podría utilizar el token de autenticación. Este token se envía automáticamente a través de una cookie. Cuando el usuario hace clic en el botón y realiza la siguiente solicitud, se podría recuperar de manera segura el ID del usuario desde el token de autenticación. Esta forma es más segura y evita exponer información confidencial en la URL.
