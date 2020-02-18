<?php
require("dbConnect.php");
$db = get_db();

$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

$stmt = $db->prepare("SELECT password FROM users_team WHERE username=:username LIMIT 1");
$stmt->bindValue(":username", $username, PDO::PARAM_STR);
$stmt->execute();

$password_hash = $stmt->fetch(PDO::FETCH_ASSOC);

if(password_verify($password, $password_hash)) {
    $_SESSION['loggedin'] = TRUE;
    header('welcome.php');
    die();
}
else {
    echo("Invalid credentials.");
}

?>

