<?php

require 'modelo/database.php';

$message;

if (isset($_POST["email"]) && isset($_POST["password"])) {
    if ($_POST["password"] == $_POST["confirm_password"]) {
        $sql = "INSERT INTO users (email, password) VALUES (:email, :password)";
        $aux = $conn->prepare($sql);
        $aux->bindParam(':email', $_POST['email']);
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $aux->bindParam(':password', $password);

        if ($aux->execute()) {
            $message = 'Usuario creado y almacenado correctamente en la base de datos!';
        } else {
            $message = 'Ha ocurrido un error al realizar el registro, por favor verifica e intentalo de nuevo!';
        }
    } else {
        $message = "Las contraseñas no coinciden";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SignUp</title>
    <link href="https://fonts.googleapis.com/css?family=Play" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">

</head>

<body>

    <?php require 'partials/header.php' ?>

<!--     <?php if (!empty($message)) : ?>
        <p> <?= $message ?></p>
    <?php endif; ?> -->

    <!-- Muestra en Pop-Up -->
    <?php
    if (isset($message)) {
        echo '<script>
          alert("' . $message . '");
        </script>';
    }
    ?>

    <h1>SignUp</h1>
    <span>or <a href="iniciarSistema.php">Login</a></span>

    <form action="registroUsuario.php" method="POST">
        <input name="email" type="text" placeholder="Escribe tu email" required>
        <input name="password" type="password" placeholder="Escribe tu contraseña" required>
        <input name="confirm_password" type="password" placeholder="Confirma tu contraseña" required>
        <input type="submit" value="Registrarse">
    </form>

</body>

</html>