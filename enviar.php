<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 1. Configura a dónde quieres que llegue el correo
    $destinatario = "karanguren12@gmail.com";
    $asunto = "Nuevo mensaje de contacto - Eunoia Agency";

    // 2. Recogemos y validamos los datos del formulario
    $nombre = isset($_POST['nombre']) ? strip_tags(trim($_POST['nombre'])) : '';
    $email = isset($_POST['email']) ? filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL) : '';
    $tipo_proyecto = isset($_POST['tipo_proyecto']) ? strip_tags(trim($_POST['tipo_proyecto'])) : '';
    $mensaje = isset($_POST['mensaje']) ? strip_tags(trim($_POST['mensaje'])) : '';

    // 3. Validación básica
    if (empty($nombre) || empty($email) || empty($mensaje)) {
        header("Location: contact.html?error=campos_vacios");
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: contact.html?error=email_invalido");
        exit;
    }

    // 4. Formateamos el cuerpo del mensaje
    $cuerpo = "Has recibido un nuevo mensaje desde la web:\n\n";
    $cuerpo .= "Nombre: " . $nombre . "\n";
    $cuerpo .= "Email: " . $email . "\n";
    $cuerpo .= "Tipo de Proyecto: " . $tipo_proyecto . "\n\n";
    $cuerpo .= "Mensaje:\n" . $mensaje . "\n";

    // 5. Cabeceras del correo
    $headers = "From: noreply@eunoia-agency.com" . "\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();
    $headers .= "Content-Type: text/plain; charset=UTF-8" . "\r\n";

    // 6. Envío del correo
    if (mail($destinatario, $asunto, $cuerpo, $headers)) {
        header("Location: contact.html?success=1");
    } else {
        header("Location: contact.html?error=envio_fallido");
    }
    exit;
}
?>