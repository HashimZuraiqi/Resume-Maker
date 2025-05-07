<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <title>signup</title>
</head>
<body class="signup-page">
    <div class="container-fluid">
        <div class="row">
            <!-- <div class="col-lg-12"> -->
                <div id="signupbox">
                    <h3>SIGN UP</h3>
                    <form action="signup.php" method="post">
                        <label for="username">EMAIL ADDRESS</label><br>
                        <input type="email" name="username" id="username" placeholder="example@gmail.com"><br>
                        <label for="password">PASSWORD</label><br>
                        <input type="password" name="password" id="password" placeholder="************">
                        <div class="row-fields">
                            <div class="half-field">
                                <label for="date">BIRTH DATE</label>
                                <input type="date" name="date" id="date" value="2005-10-12">
                            </div>
                            <div class="half-field">
                                <label for="phonenumber">PHONE NUMBER</label>
                                <input type="tel" name="phonenumber" id="phonenumber" placeholder="079 2023 8536">
                            </div>
                            
                        </div>
                    </form>
                    <button type="submit">SIGN UP</button>
                    <a href="login.html">already have an account?</a>
                </div>
        <!-- </div> -->
    </div>
</div>
</body>
</html>

<?php
$host = 'localhost';
$db = 'resume-builder';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$username = $_POST['username'];
$password = $_POST['password'];
$birthdate = $_POST['date'];
$phone = $_POST["phonenumber"];

$hashedpassword = password_hash($password, PASSWORD_DEFAULT);
$sql = "INSERT INTO users (username, password, birthdate, phone)
        VALUES ('$username', '$hashedPassword', '$birthdate', '$phone')";

if($conn->query($sql) === TRUE) {
    echo "New record created";
    header("Location: login.php");
}
else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?>