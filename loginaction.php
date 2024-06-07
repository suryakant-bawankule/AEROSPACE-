<?php
require_once 'config.php';

if(isset($_POST['submit'])){

$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

$sql = "SELECT * FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    if (password_verify($password, $user['password'])) {
        session_start();
        $_SESSION['user'] = $user['username'];
        header('Location: index.html');
    } else {
        echo "Incorrect password.";
    }
} else {
    echo  "User not found.";
    
}


// if(isset($_POST['submit'])){

//     $email = mysqli_real_escape_string($conn, $_POST['email']);
//     $password = mysqli_real_escape_string($conn, $_POST['password']);

//     $sql = "select * from users where username = '$username' or email = '$username' ";
//     $result = mysqli_query($conn, $sql);
//     $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

//     if($row){
//         if(password_verify($password,$row["password"])){
//             $sql = "select username from users where username ='$username' or email='$username'";
//             $r = mysqli_fetch_array(mysqli_query($conn, $sql));
//             session_start();
//             $_SESSION['name'] = $r['username'];
//             header('location:index.php');
//         }
//     }
//     else{
//         echo '<script>
//         alert("Invalid Username or Password!!!");
//         windows.location.href = "login.html";
//         </script>';
//     }
// }

$conn->close();
}
?>