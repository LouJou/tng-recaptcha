<?php
// First part of original code
// Check whether Recaptcha V2 was succesful by adding session variable from TNG_captcha.php
if($_SESSION['passedcaptcha']) {
$success = tng_sendmail($yourname, $emailtouse, $owner, $sendemail, $subject, $body, $emailaddr, $youremail);
}
// Rest of original code
?>
