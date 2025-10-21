<?php
include 'connection.php';

if (isset($_POST['submit-btn'])) {

    $filter_name = filter_var($_POST['name'], FILTER_SANITIZE_SPECIAL_CHARS);
    $name = mysqli_real_escape_string($conn, $filter_name);

    $filter_email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $email = mysqli_real_escape_string($conn, $filter_email);

    $filter_password = filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS);
    $password = mysqli_real_escape_string($conn, $filter_password);

    $filter_Cpassword = filter_var($_POST['Cpassword'], FILTER_SANITIZE_SPECIAL_CHARS);
    $Cpassword = mysqli_real_escape_string($conn, $filter_Cpassword);

    $select_user = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'") or die('query failed');

    if (mysqli_num_rows($select_user) > 0) {
        $message[] = 'User already exists';
    } else {
        if ($password != $Cpassword) {
            $message[] = 'Password confirmation does not match';
        } else {
            mysqli_query($conn, "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')") or die('query failed');
            $message[] = 'Registered successfully';
            header('location: login.php');
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <!-- Boxicons CDN Link --> 
     <link href="http://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">

    <title>Register page</title>
</head>
<body>
    <section class = "form-container">
    <?php
    if(isset($message)) {
        foreach ($message as $message){
            echo '
                <div class = "message">
                    <span>'.$message.'</span>
                    <i class = "bi bi-x-circle" onclick = "this.parentElement.remove()"></i>
                </div>'
            ;}
        }
    ?>
        <form method ="post">
            <h1>register now</h1>
            <input type="text" name="name" placeholder="enter your name" required> 
            <input type="email" name="email" placeholder="enter your Email" required> 
            <input type="password" name="password" placeholder="password" required> 
            <input type="password" name="Cpassword" placeholder="confirm password" required> 
            <input type="submit" name="submit-btn" value="register now" class="btn"> 
            <p>already have an account ? <a href="login.php">Login</a></p>
        </form>
    </section>
</body>
</html>


<!--Ecommarce-shop-website-->