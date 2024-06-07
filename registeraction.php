<?php
// Configuration
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'test';

// //Try and connect using the info above.
// $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
// if (mysqli_connect_errno()) {
//     // If there is an error with the connection, stop the script and display the error.
//     exit('Failed to connect to MySQL: '. mysqli_connect_error());
// }

// // Check for empty variables
// if (isset($_POST['username'], $_POST['email'], $_POST['password'])) {
//     // Validate email
//     if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
//         exit('Email is not valid!');
//     }

//     // Validate username
//     if (preg_match('/^[a-zA-Z0-9]+$/', $_POST['username']) == 0) {
//         exit('Username is not valid!');
//     }

//     // Validate password length
//     if (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 5) {
//         exit('Password must be between 5 and 20 characters long!');
//     }

//     // Insert into database
//     if ($stmt = $con->prepare('INSERT INTO users (username, password, email) VALUES (?,?,?)')) {
//         $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
//         $stmt->bind_param('sss', $_POST['username'], $password, $_POST['email']);
//         $stmt->execute();
//         $stmt->close();
//         //echo "Account created successfully!";
//         header('location:login.html');
        
//     } else {
//         echo 'Error creating account!';
//     }
// }

 include("config.php");

if(isset($_POST['submit'])){
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $Confirm_password = mysqli_real_escape_string($conn, $_POST['Confirm_password']);

    $sql = "select * from users where username ='$username'";
    $result = mysqli_query($conn, $sql);
    $count_username = mysqli_num_rows($result);

    $sql = "select * from users where email ='$email'";
    $result = mysqli_query($conn, $sql);
    $count_email = mysqli_num_rows($result);

    if($count_username==0 || $count_email==0){
        if($password==$Confirm_password){
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "insert into users(username, email, password) values('$username','$email','$hash')";
        $result = mysqli_query($conn, $sql);
        header('location:login.html');
        }else{
            echo '<script>
            alert("Password Does Not Match!!!");
            windows.location.href = "login.html";
            </script>';
        }

    }else{
        echo '<script>
        alert("User Already Exits!!!");
        windows.location.href = "login.html"
        </script>';
    }
}

?>
