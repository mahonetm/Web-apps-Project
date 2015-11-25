<?php

if(!isset($_POST['submit'])){
    echo "error; you need to submit the form!";

}
$name = "tim";
$message =$_POST['emailBody'];

$email_from= 'tim.mahoneym@gmail.com';
$email_subject = 'New form submission from BM Custom Woodwork';
$email_body = "new message from $name." . "<br>" . $message;

$to = "tim.mahoneym@gmail.com";

mail($to, $email_subject, $email_body);