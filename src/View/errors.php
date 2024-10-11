<?php
use Youssef\ScandiwebTask\Classes\Session;

$session = new Session();
$errors = $session->get("errors");

if ($errors) {
    foreach ($errors as $error) {
        echo "<div class='alert alert-danger'>$error</div>";
    }
    $session->remove("errors");
}