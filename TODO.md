# Tareas Pendientes

- **Circuito**: Completar la implementación del circuito de Croquette.

- **Soporte para Múltiples Croquettes**: Permite que un usuario pueda tener más de un croquette conectado a la app.

- **Edición de Perfil de la Mascota**: Implementa la funcionalidad que permita a los usuarios editar los perfiles de sus mascotas.

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

  Esta vulnerabilidad tiene un alcance limitado, ya que solo permite editar el nombre y el avatar de un usuario. Sin embargo, no implica un riesgo de robo de datos. También es posible editar los datos de las mascotas.

  Creo que la mejor manera de solucionar esta vulnerabilidad es evitar la inclusión del ID del usuario en la URL. En lugar de depender del ID del usuario en la URL, puedo aprovechar el token de autenticación, que se transmite automáticamente a través de una cookie. Al hacer clic en el botón y realizar la siguiente solicitud, puedo recuperar de manera segura el ID del usuario del token de autenticación.
