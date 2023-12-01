<?php
require_once './database.php';
$message = "";

if ($_POST) {
    $user = $database->select("tb_users", "*", ["usr" => $_POST["username"]]);

    if (count($user) > 0) {
        // Actualiza la contraseña del usuario
        $new_password = password_hash($_POST["new_password"], PASSWORD_DEFAULT, ['cost' => 12]);
    
        $database->update("tb_users", ["pwd" => $new_password], ["usr" => $_POST["username"]]);
    
        $message = "Contraseña cambiada exitosamente.";
        header("location: forms.php");
        exit(); // Asegúrate de salir después de la redirección para evitar la ejecución continua del script.
    } else {
        $message = "Usuario no encontrado.";
    }
}



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar Contraseña</title>
    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Archivo:wght@900&family=Roboto:wght@400;500&display=swap"
        rel="stylesheet">
    <!-- google fonts -->

    <link rel="stylesheet" href="./css/mainRecipes.css">
</head>
<body>

<?php 
        include './parts/header.php';
?>

<main>
    
   
    <section class='resset-container'>
        <div class='form-text'>
            <section class='login'>
                <h3 class='title-login'>Cambiar Contraseña</h3>
                
                <form method="post" action="reset_password.php">
                    <div class='login-text'>
                        <label for='username'>Nombre de Usuario:</label>
                        <input id='username' type='text' name='username' required>
                    </div>
                    <div class='login-text'>
                        <label for='new_password'>Nueva Contraseña:</label>
                        <input id='new_password' type='password' name='new_password' required>
                    </div>
                    <div class='login-text'>
                        <input class='btn nav-list' type='submit' value="CHANGE PASSWORD">
                    </div>
                    
                </form>
            </section>
        </div>
    </section> 
       
</main>

<?php 
        include './parts/footer.php';
?>

</body>
</html>

