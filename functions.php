<?php
require 'vendor/autoload.php';
function is_authenticate() {
  return isset($_SESSION['user']);
}
function is_email($email) {
  $pattern = '/.+@.+\..+/';
  return preg_match($pattern, $email);
}
function is_email_taken($email) {
  $user = User::where('email', $email)->first();
  return empty($user) ? false : true;
}
