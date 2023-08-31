Esto es una puta vista protegida desde index
<?php 
    csrf();
?>

<form method="post" action="<?php echo route('api/v1/auth/logout'); ?>">
    <button type="submit" style="border: none; background: none; color: blue; text-decoration: underline; cursor: pointer;">
        Logout
    </button>
    <?php TokenCsrf::input(); ?>
    <!-- Puedes agregar un campo oculto con el token CSRF si es necesario -->
    <!-- <input type="hidden" name="csrf_token" value="tu_valor_del_token_csrf"> -->
</form>


