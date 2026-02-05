<?php
// Simple mail sender (basic)
// Change destination email here:
$to = "lawandbillemd@gmail.com";

$name = trim($_POST["name"] ?? "");
$email = trim($_POST["email"] ?? "");
$message = trim($_POST["message"] ?? "");

// Basic validation
if ($name === "" || $email === "" || $message === "") {
  http_response_code(400);
  echo "Missing fields.";
  exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  http_response_code(400);
  echo "Invalid email.";
  exit;
}

// Prevent header injection
$name = str_replace(["\r","\n"], " ", $name);
$email = str_replace(["\r","\n"], " ", $email);

$subject = "Cyberpkk Contact Form";
$body =
  "Name: $name\n".
  "Email: $email\n\n".
  "Message:\n$message\n";

$headers = "From: $name <$email>\r\n";
$headers .= "Reply-To: $email\r\n";

@mail($to, $subject, $body, $headers);

echo "Message sent. Thank you!";
?>
