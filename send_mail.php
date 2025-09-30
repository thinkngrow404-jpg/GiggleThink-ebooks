<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars(strip_tags(trim($_POST["name"])));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars(strip_tags(trim($_POST["message"])));

    if (empty($name) || !filter_var($email, FILTER_VALIDATE_EMAIL) || empty($message)) {
        // Invalid input, redirect back or show error
        header("Location: contact.html?error=invalidinput");
        exit;
    }

    $to = "thinkngrow404@gmail.com";  // Apna email yahan daalein
    $subject = "New Contact Message from $name";
    $body = "Name: $name\nEmail: $email\n\nMessage:\n$message";
    $headers = "From: $email\r\nReply-To: $email\r\n";

    if (mail($to, $subject, $body, $headers)) {
        header("Location: contact.html?success=1");
        exit;
    } else {
        header("Location: contact.html?error=mailfail");
        exit;
    }
} else {
    // Direct access to PHP file, redirect to form
    header("Location: contact.html");
    exit;
}
?>
