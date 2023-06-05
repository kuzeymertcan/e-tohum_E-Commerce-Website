<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};

if(isset($_POST['submit'])){

   $username = mysqli_real_escape_string($conn, $_POST['username']);
   $filter_email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
   $email = mysqli_real_escape_string($conn, $filter_email);
   $filter_pass = filter_var($_POST['pass'], FILTER_SANITIZE_STRING);
   $pass = mysqli_real_escape_string($conn, md5($filter_pass));
   $user_type = mysqli_real_escape_string($conn, $_POST['user_type']);

   mysqli_query($conn, "INSERT INTO `users` (name, email, password, user_type) VALUES ('$username', '$email', '$pass', '$user_type')") or die('query failed');

   header('location:admin_users.php');
}

?>

<!DOCTYPE html>
<html lang="tr">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Kullanıcı Oluştur</title>

   <style>
      body {
         font-family: Arial, sans-serif;
         background-color: #f8f8f8;
         color: #333;
      }

      h1 {
         text-align: center;
         color: #333;
      }

      .form-container {
         font-size: 1rem;
         max-width: 50rem;
         width: 90%;
         margin: 3.5rem auto;
         padding: 2rem;
         background-color: #f5f5f5;
         border-radius: 0.5rem;
         box-shadow: 0rem 0rem 1rem 0rem rgba(0,0,0,0.1);
      }

      .form-container .box {
         width: 100%;
         padding: 1rem;
         margin-bottom: 1.5rem;
         border: 0.1rem solid #ddd;
         border-radius: 0.5rem;
      }

      .form-container div {
         display: flex;
         justify-content: space-between;
         margin-bottom: 1.5rem;
      }

      .form-container .radio-container {
         display: flex;
         justify-content: space-between;
         width: 100%;
      }

      .form-container .radio-container div {
         display: flex;
         align-items: center;
      }

      .form-container label {
         color: #666;
      }

      .form-container div label {
         margin-left: 1rem;
         margin-right: 1rem;
      }

      .form-container .btn {
         margin-top: -1rem;
         width: 100%;
         padding: 1rem;
         background-color: rgb(0, 144, 0);
         color: white;
         border: none;
         border-radius: 0.5rem;
         cursor: pointer;
      }

      #admin-user-label{

        margin-right: 0.4rem;

      }

      .form-container input[type="radio"] {
         appearance: none;
         -webkit-appearance: none;
         -moz-appearance: none;
         width: 1.5rem;
         height: 1.5rem;
         border: 0.1rem solid #ddd;
         border-radius: 50%;
         outline: none;
         cursor: pointer;
         margin-right: 0.5rem;
      }

      .form-container input[type="radio"]:checked {
         background-color: rgb(0, 144, 0);
         border-color: rgb(0, 144, 0);
      }

      @media screen and (min-width: 76.8rem) {
         .form-container {
            font-size: 1.5rem;
         }
         
         .form-container div label {
            margin-left: 1.5rem;
            margin-right: 1.5rem;
         }
      }

      @media screen and (max-width: 48rem) {
         .form-container .radio-container div label {
            font-size: 1.5rem;
         }

         .form-container input[type="radio"] {
            width: 1.5rem;
            height: 1.5rem;
         }

         .form-container {
            max-width: 35rem;
         }
      }
   </style>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>

<?php @include 'admin_header.php'; ?>

<section class="messages">

   <h1 class="title">Kullanıcı Oluştur</h1>

   <div class="form-container">
      <form action="" method="post">
         <input type="text" name="username" class="box" placeholder="Kullanıcı adı" required>
         <input type="email" name="email" class="box" placeholder="E-posta adresi" required>
         <input type="password" name="pass" class="box" placeholder="Şifre" required>
         <div class="radio-container">
            <div>
               <input type="radio" id="standard-user" name="user_type" value="user" checked>
               <label for="standard-user">Normal Kullanıcı</label>
            </div>
            <div>
               <input type="radio" id="admin-user" name="user_type" value="admin">
               <label id="admin-user-label" for="admin-user">Admin Kullanıcı</label>
            </div>
         </div>
         <input type="submit" class="btn" name="submit" value="Kullanıcı Oluştur">
      </form>
   </div>

</section>

<script src="js/admin_script.js"></script>

</body>
</html>
