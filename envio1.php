<!DOCTYPE HTML>
<html>
<head>
    <title>Grupo03 - Envio</title>
</head>
<body>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["nombre"];
    $surname = $_POST["apellido"];
    $email = $_POST["correo"];
    $message = $_POST["mensaje"];

    // Validate input
    $errors = [];

    if (empty($name) || empty($surname) || empty($email) || empty($message)) {
        $errors[] = "Por favor completa todos los campos.";
    }

    if (!preg_match("/^[a-zA-Z ]*$/", $surname)) {
        $errors[] = "El apellido solo debe contener letras y espacios en blanco.";
    }

    if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
        $errors[] = "El nombre solo debe contener letras y espacios en blanco.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "El correo electrónico no es válido.";
    }

    if (strlen($message) < 10) {
        $errors[] = "El mensaje debe tener al menos 10 caracteres.";
    }

    if (empty($errors)) {
        // Send email to the provided email address
        $to = $email; // Use the provided email address
        $subject = "Nuevo mensaje de $name";
        $body = "Name: $name $surname\nEmail: $email\n\n$message";
        $headers = "From: $email";

        if (mail($to, $subject, $body, $headers)) {
            echo "<h3><p align='center'> Su e-mail se ha enviado correctamente </h3>";
        } else {
            echo "Error enviando el mensaje.";
        }
    } else {
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
    }
}
?>

</body>
</html>
