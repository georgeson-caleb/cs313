<?php
session_start();
require("dbConnect.php");
$db = get_db();

$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

$stmt = $db->prepare("SELECT id, password FROM users_team WHERE username=:username LIMIT 1");
$stmt->bindValue(":username", $username, PDO::PARAM_STR);
$stmt->execute();

$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
$id = $row[0]["user_id"];
$password_hash = $row[0]["password"];

if(password_verify($password, $password_hash)) {
    $_SESSION['loggedin'] = TRUE;
    $_SESSION['user_id'] = $id;
    header('welcome.php');
    die();
}
else {
    echo("Invalid credentials.");
}

?>

