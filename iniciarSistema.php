<?php

session_start();


if (isset($_SESSION['user_id'])) {
    header('Location: /proyecto practica');
}

require 'modelo/database.php';

if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $dato = $conn->prepare('SELECT id, email, password FROM users WHERE email = :email');
    $dato->bindParam(':email', $_POST['email']);
    $dato->execute();
    $resultado = $dato->fetch(PDO::FETCH_ASSOC);

    $message = '';

    if (count($resultado) > 0 && password_verify($_POST['password'], $resultado['password'])) {
        $_SESSION['user_id'] = $results['id'];
        header("Location: /proyecto practica");
    } else {
        $message = 'Datos incorrectos o inexistentes, intentalo nuevamente';
    }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Iniciar Sesion</title>
    <link href="https://fonts.googleapis.com/css?family=Play" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">

</head>

<body>

    <?php require 'partials/header.php' ?>

    <h1>Login</h1>
    <span>or <a href="registroUsuario.php">SignUp</a></span>

    <?php if (!empty($message)) : ?>
        <p> <?= $message ?></p>
    <?php endif; ?>


    <form action="iniciarSistema.php" method="post">
        <input type="text" name="email" placeholder="Ingresa tu email">
        <input type="password" name="password" placeholder="Ingresa tu contraseña" require>
        <input type="submit" value="Iniciar">
    </form>


</body>

</html>