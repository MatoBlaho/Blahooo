<?php
session_start();
$error_message = '';
if (isset($_POST['submit']) && !empty($_POST['username']) && !empty($_POST['password'])) {
    $servername = "localhost";
    $username = "userdb";
    $password = "databaza";
    $dbname = "northwind";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        $error_message = "<p class='error-message'>Connection failed: " . $conn->connect_error . "</p>";
    } else {
        $sql = "SELECT * FROM users WHERE username = '" . $_POST['username'] . "'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($_POST['password'], $row["password"])) {
                $_SESSION['valid'] = true;
                $_SESSION['timeout'] = time();
                $_SESSION['username'] = $_POST['username'];
                exit();
            } else {
                $error_message = "<p class='error-message'>Wrong password</p>";
            }
        } else {
            $error_message = "<p class='error-message'>User not found</p>";
        }

        $conn->close();
    }
}
?>
