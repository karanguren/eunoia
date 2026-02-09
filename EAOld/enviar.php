<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 1. Configura a dónde quieres que llegue el correo
    $destinatario = "hola@tu-dominio.com"; // Reemplaza con tu mail de cPanel
    $asunto = "Nuevo mensaje de contacto - Eunoia Agency";

    // 2. Recogemos los datos del formulario
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $mensaje = $_POST['mensaje'];

    // 3. Formateamos el cuerpo del mensaje
    $cuerpo = "Has recibido un nuevo mensaje desde la web:\n\n";
    $cuerpo .= "Nombre: " . $nombre . "\n";
    $cuerpo .= "Email: " . $email . "\n";
    $cuerpo .= "Mensaje: " . $mensaje . "\n";

    // 4. Cabeceras del correo (Para que el servidor lo acepte y no sea Spam)
    $headers = "From: web@tu-dominio.com" . "\r\n"; // Usa un mail de tu dominio
    $headers .= "Reply-To: " . $email . "\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();

    // 5. Envío del correo
    if (mail($destinatario, $asunto, $cuerpo, $headers)) {
        // Redirige a una página de éxito (puedes crear gracias.html)
        header("Location: gracias.html");
    } else {
        echo "Error al enviar el mensaje. Inténtalo de nuevo.";
    }
}
?>