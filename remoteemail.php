<?php
header("Access-Control-Allow-Origin: *");

$sendTo = htmlspecialchars(trim($_GET["sendto"]));
$name = htmlspecialchars(trim($_GET["name"]));
$email = htmlspecialchars(trim($_GET["email"]));
$message = htmlspecialchars(trim($_GET["message"]));

$errors = array();
$form_data = array();

if (trim($_GET["phone"]) == '') {
  $phone = "Not provided";
} else {
  $phone = htmlspecialchars(trim($_GET["phone"]));
}

$form_data["response"] = '';
// Validate the form on the server side
if (empty($_GET["name"])) {
  $form_data["response"] .= "<p>Name cannot be blank.</p>";
}
if (empty($_GET["name"])) {
  $form_data["response"] .= "<p>Email cannot be blank.</p>";
}
if (empty($_GET["name"])) {
  $form_data["response"] .= "<p>Message cannot be blank.</p>";
}

if (!empty($errors)) {
 $form_data["success"] = false;
 $form_data["errors"]  = $errors;
} else {
  $form_data["success"] = true;
  $txt = "Message: ".$message.
     "\r\n"."Phone: ".$phone;
  $to = $sendTo;
  $subject = "You got mail!";

  $headers = "\r\n"."From: ".$name." <".$email.">".
         "\r\n"."Reply-To: ".$email;

  mail($to, $subject, $txt, $headers);
  $form_data["response"] = "<p>Email sent!</p>";
}

echo json_encode($form_data);