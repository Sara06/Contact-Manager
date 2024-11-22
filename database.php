<?php
    $dsn = 'mysql:host=localhost;dbname=contact_manager';
    $username = 'cs602_user';
    $password = 'cs602_secret';

    try {
        $db = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include('database_error.php');
        exit();
    }
?>