<?php
require('dbConnect.php'); 
$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
$username = htmlspecialchars($username);

if(checkExistingUsername($username) > 0) {
    header("location: sign_up.php");
    die();
}

$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
$hashed_pass = password_hash($password, PASSWORD_DEFAULT);


//check if passwords match
$passwordVerify = filter_input(INPUT_POST, 'passwordVerify', FILTER_SANITIZE_STRING);
if($password != $passwordVerifY) {
    $warning = "<p style='color:red'>The passwords do not match</p>";
    header("sign_up.php");
}

if(addUser($username, $hashed_pass) > 0 ) {
    $_SESSION['userId'] = getUserId($username);
    $_SESSIOn['username'] = $username;
    header("location: welcome.php");
    die();
}
else {
    header("location: sign_up.php");
}

//check existing username and returns 1 if username is used
function checkExistingUsername($username){
    $db = get_db();
    $query = "SELECT username FROM users_team WHERE username = (:username)";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':username', $username, PDO::PARAM_STR);  
    $stmt->exectue();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
}

//returns 1 if successful
function addUser($username, $password) {
    $db = get_db();
    $query = "INSERT INTO users_team (username, password) VALUES (:username, :password)";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':username', $username, PDO::PARAM_STR);
    $stmt->bindValue(':password', $password, PDO::PARAM_STR);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
}

function getUserId($username) {
    $db = get_db();
    $query = "SELECT user_id FROM users_team WHERE username = (:username)";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':username', $username, PDO::PARAM_STR);
    $stmt->execute();
    $stmt->closeCursor();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $userId = $row['userId'];
    }
    return $userId;
}

?>

