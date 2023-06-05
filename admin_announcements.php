<!DOCTYPE html>
<html lang="tr">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Duyuru Yayınla</title>

   <style>
      body {
         font-family: Roboto, sans-serif;
         background-color: #f8f8f8;
         color: #333;
         
      }

      h1 {
         text-align: center;
         color: #333;
      }

      table {
         width: 100%;
         margin-top: 5rem;
         border-collapse: collapse;
      }

      th,
      td {
         padding: 1.5rem;
         text-align: left;
         border-bottom: 0.1rem solid #ddd;
      }

      th {
         background-color: #4CAF50;
         color: white;
      }

      tr:hover {
         background-color: #f5f5f5;
      }

      .message-success,
      .message-error {
         position: relative;
         padding: 1.5rem;
         margin-bottom: 2rem;
         border: 0.1rem solid transparent;
         border-radius: 0.4rem;
         width: 90%;
         max-width: 50rem;
         text-align: center;
         margin-left: auto;
         margin-right: auto;
         font-size: 1.5rem;
      }

      .message-success {
         color: #3c763d;
         background-color: #dff0d8;
         border-color: #d6e9c6;
      }

      .message-error {
         color: #a94442;
         background-color: #f2dede;
         border-color: #ebccd1;
      }

      .message-close {
         position: absolute;
         top: 0;
         right: 1rem;
         cursor: pointer;
         font-size: 2rem;
      }

      .form-container {
         display: flex;
         justify-content: center;
         align-items: center;
         flex-direction: column;
      }

      textarea {
         resize: none;
      }

      .announcements-table {
         font-size: 2rem;
         margin-top: 2rem;
      }

      .form-container form {
         display: flex;
         flex-direction: column;
         align-items: center;
         max-width: 60rem;
         width: 100%;
         background-color: #fff;
         padding: 2rem 3rem 2rem 3rem;
         border-radius: 0.8rem;
         box-shadow: 0 0.2rem 0.4rem rgba(0, 0, 0, 0.1);
         margin-top: 1.5rem;
      }

      .form-container label {
         font-weight: bold;
         margin-bottom: 1rem;
         font-size: 1.8rem;
      }

      .form-container input[type="text"],
      .form-container textarea {
         width: 100%;
         padding: 1.2rem;
         border: 0.1rem solid #ccc;
         border-radius: 0.6rem;
         margin-bottom: 1.5rem;
         box-sizing: border-box;
         font-size: 1.6rem;
      }

      .form-container input[type="submit"] {
         background-color: rgb(0, 144, 0);
         color: white;
         border: none;
         padding: 1.2rem 2.4rem;
         border-radius: 0.6rem;
         cursor: pointer;
         font-size: 1.6rem;
      }

      .form-container input[type="submit"]:hover {
         background-color: #333;
      }
   </style>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <link rel="stylesheet" href="css/admin_style.css">

</head>

<body>

   <?php
   session_start();

   if (!isset($_SESSION['admin_id'])) {
      header('location:login.php');
      exit();
   }

   $servername = "localhost";
   $username = "root";
   $password = "";
   $dbname = "shop_db";

   $message = '';

   if (isset($_POST['submit'])) {
      $baslik = $_POST['baslik'];
      $icerik = $_POST['icerik'];

      $conn = new mysqli($servername, $username, $password, $dbname);
      if ($conn->connect_error) {
         die("Veritabanı bağlantısı başarısız: " . $conn->connect_error);
      }

      $sql = "INSERT INTO duyurular (baslik, icerik) VALUES ('$baslik', '$icerik')";
      if ($conn->query($sql) === TRUE) {
         $message = "<div class='message-success'>Duyuru başarıyla yayınlandı! <span class='message-close' onclick='closeMessage(this)'>&times;</span></div>";
      } else {
         $message = "<div class='message-error'>Duyuru yayınlama hatası: " . $conn->error . " <span class='message-close' onclick='closeMessage(this)'>&times;</span></div>";
      }

      $conn->close();
   }
   ?>

   <?php @include 'admin_header.php'; ?>

   <section class="messages">

      <h1 class="title">DUYURU YAYINLA</h1>

      <?php echo $message; ?>

      <div class="form-container">
         <form action="" method="POST">
            <label for="baslik">Başlık:</label>
            <input type="text" name="baslik" id="baslik" required>

            <label for="icerik">İçerik:</label>
            <textarea name="icerik" id="icerik" rows="5" required></textarea>

            <input type="submit" name="submit" value="Duyuru Yayınla">
         </form>
      </div>

   </section>

   <script src="js/admin_script.js"></script>
   <script>
      function closeMessage(element) {
         element.parentElement.style.display = 'none';
      }

      var textarea = document.getElementById('icerik');
      textarea.addEventListener('keydown', autosize);

      function autosize() {
         var el = this;
         setTimeout(function () {
            el.style.cssText = 'height:auto; padding:0';
            el.style.cssText = 'height:' + el.scrollHeight + 'px';
         }, 0);
      }
   </script>

</body>

</html>
