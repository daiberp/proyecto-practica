<?php
session_start();

require 'modelo/database.php';

if (isset($_SESSION['user_id'])) {
    $dato = $conn->prepare('SELECT id, email, password FROM users WHERE id = :id');
    $dato->bindParam(':id', $_SESSION['user_id']);
    $dato->execute();
    $resultado = $dato->fetch(PDO::FETCH_ASSOC);

    $user = null;

    if (count($resultado) > 0) {
        $user = $resultado;
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Proyecto Ingeniería del Software II</title>
    <link href="https://fonts.googleapis.com/css?family=Play" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <?php require 'partials/header.php' ?>

    <?php if(!empty($user)): ?>
      <br> Welcome. <?= $user['email']; ?>
      <br>Tu estás registrado y almacenado en nuestra BBDD 
      <a href="salirSistema.php">Salir del Sistema</a>
    <?php else: ?>
      <h1>Please Login or SignUp</h1>

      <a href="iniciarSistema.php">Login</a> or
      <a href="registroUsuario.php">SignUp</a>
    <?php endif; ?>
  </body>
</html>
