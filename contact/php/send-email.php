<?php

// Replace this with your own email address
$to = 'afkirchaimaa36@gmail.com';

function url() {
    return sprintf(
        "%s://%s",
        isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
        $_SERVER['SERVER_NAME']
    );
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = trim(stripslashes($_POST['name']));
    $email = trim(stripslashes($_POST['email']));
    $subject = trim(stripslashes($_POST['subject']));
    $contact_message = trim(stripslashes($_POST['message']));

    // Validate fields
    if ($name == '' || $email == '' || $contact_message == '') {
        echo "Veuillez remplir tous les champs requis.";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Veuillez entrer une adresse e-mail valide.";
        exit;
    }

    if ($subject == '') {
        $subject = "Soumission du Formulaire de Contact";
    }

    // Sanitize inputs
    $name = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
    $email = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
    $subject = htmlspecialchars($subject, ENT_QUOTES, 'UTF-8');
    $contact_message = htmlspecialchars($contact_message, ENT_QUOTES, 'UTF-8');

    // Set Message
    $message = ''; // Initialize the message variable
    $message .= "E-mail de: " . $name . "<br />";
    $message .= "Adresse e-mail: " . $email . "<br />";
    $message .= "Message: <br />";
    $message .= nl2br($contact_message);
    $message .= "<br /> ----- <br /> Cet e-mail a été envoyé depuis votre site " . url() . " contact form. <br />";

    // Set From: header
    $from = $name . " <" . $email . ">";

    // Email Headers
    $headers = "De: " . $from . "\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    ini_set("sendmail_from", $to); 
    $mail = mail($to, $subject, $message, $headers);

    if ($mail) {
        echo "OK";
    } else {
        echo "Quelque chose s'est mal passé. Veuillez réessayer.";
    }
}
?>
