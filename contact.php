<?php
  $ownerEmail = "";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_SERVER["HTTP_X_REQUESTED_WITH"]) AND strtolower($_SERVER["HTTP_X_REQUESTED_WITH"]) != "xmlhttprequest") {
      $output = json_encode(array(
        "error" => true,
        "response" => "This request was not made via the website"
      ));

      die($output);
    }

    if (!isset($_POST["name"]) || !isset($_POST["email"]) || !isset($_POST["phone"]) || !isset($_POST["query"])) {
      $output = json_encode(array(
        "error" => true,
        "response" => "You did not fill in all fields"
      ));

      die($output);
    }

    $name = filter_var(trim($_POST["name"]), FILTER_SANITIZE_STRING);
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $phone = filter_var(trim($_POST["phone"]), FILTER_SANITIZE_STRING);
    $query = filter_var(trim($_POST["query"]), FILTER_SANITIZE_STRING);

    if (strlen($name) < 3 || strlen($name) > 35) {
      $output = json_encode(array(
        "error" => true,
        "response" => "Your name should be between 3 and 35 characters"
      ));

      die($output);
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $output = json_encode(array(
        "error" => true,
        "response" => "You entered an invalid email address"
      ));

      die($output);
    }

    if (strlen($phone) < 10) {
      $output = json_encode(array(
        "error" => true,
        "response" => "Your phone number should be at least 10 digits long"
      ));

      die($output);
    }

    if (strlen($query) < 20 || strlen($query) > 1000) {
      $output = json_encode(array(
        "error" => true,
        "response" => "Your question should be between 20 and 2000 characters"
      ));

      die($output);
    } 

    $emailHeaders = "From " . $email . "" . "\r\n" . "Reply-To " . $email . "" . "\r\n" . "X-Mailer: PHP/" . phpversion();

    $emailSent = @mail($ownerEmail, "Contact Form Submission", $query . " - " . $email . " - " . $phone, $emailHeaders);

    if (!$emailSent) {
      $output = json_encode(array(
        "error" => true,
        "response" => "A server error occured, try again soon"
      ));

      die($output);
    } else {
      $output = json_encode(array(
        "error" => false,
        "response" => "Your query was successfully sent"
      ));

      die($output);
    }
  }
?>