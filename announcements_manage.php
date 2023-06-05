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

if (isset($_GET['delete_id'])) {
   $duyuru_id = $_GET['delete_id'];

   $conn = new mysqli($servername, $username, $password, $dbname);
   if ($conn->connect_error) {
      die("Veritabanı bağlantısı başarısız: " . $conn->connect_error);
   }

   $sql = "DELETE FROM duyurular WHERE id = '$duyuru_id'";
   if ($conn->query($sql) === TRUE) {
      $message = "<div class='message-success'>Duyuru başarıyla silindi! <span class='message-close' onclick='closeMessage(this)'>&times;</span></div>";
   } else {
      $message = "<div class='message-error'>Duyuru silme hatası: " . $conn->error . " <span class='message-close' onclick='closeMessage(this)'>&times;</span></div>";
   }

   $conn->close();
}

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
   die("Veritabanı bağlantısı başarısız: " . $conn->connect_error);
}

$sql = "SELECT * FROM duyurular";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="tr">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Duyuru Yönetimi</title>

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

      .container {
         max-width: 120rem;
         margin: 0 auto;
         padding: 2rem;
      }

      .message-success,
      .message-error {
         position: relative;
         padding: 1.5rem;
         margin-bottom: 2rem;
         border: 0.1rem solid transparent;
         border-radius: 0.4rem;
         text-align: center;
         width: 90%;
         max-width: 50rem;
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

      .announcement {
         margin-bottom: 2rem;
         padding: 2rem;
         background-color: #fff;
         border: 0.1rem solid #ddd;
         border-radius: 0.4rem;
         overflow-wrap: break-word;
         word-wrap: break-word;
         hyphens: auto;
      }

      .announcement-title {
         font-size: 2.4rem;
         margin-bottom: 1rem;
      }

      .announcement-content {
         font-size: 1.8rem;
         margin-bottom: 1rem;
      }

      .announcement-date {
         font-size: 1.6rem;
         color: #777;
      }

      .delete-button {
         display: inline-block;
         padding: 0.5rem 1rem;
         border-radius: 0.4rem;
         background-color: #ff5c5c;
         color: #fff;
         text-decoration: none;
         transition: background-color 0.3s ease;
         margin-top: 2rem;
         width: 5rem;
         text-align: center;
         font-size: 1.5rem;
      }

      .delete-button:hover {
         background-color: #ff3333;
      }

      .no-announcement {
         text-align: center;
         font-size: 2rem;
         color: #a94442;
         border: 0.2rem solid #ebccd1;
         border-radius: 1rem;
         padding: 2rem;
         margin: 1rem auto;
         width: 80%;
         background-color: #ebccd1;
      }

      @media screen and (max-width: 60rem) {
         .message-success,
         .message-error {
            width: 100%;
            margin-left: 0;
            margin-right: 0;
         }

         .message-close {
            right: 0.5rem;
         }

         .announcement {
            padding: 1rem;
         }

         .announcement-title {
            font-size: 2rem;
         }

         .announcement-content {
            font-size: 1.6rem;
         }

         .announcement-date {
            font-size: 1.4rem;
         }

         .no-announcement {
            font-size: 1.5rem;
            padding: 1rem;
            width: 90%;
         }
      }
   </style>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <link rel="stylesheet" href="css/admin_style.css">

</head>

<body>

   <?php @include 'admin_header.php'; ?>

   <div class="container">
      <h1 class="title">DUYURU YÖNETİMİ</h1>

      <?php echo $message; ?>

      <?php
      if ($result->num_rows > 0) {
         while ($row = $result->fetch_assoc()) {
            echo "<div class='announcement'>";
            echo "<h2 class='announcement-title'>" . $row['baslik'] . "</h2>";
            echo "<p class='announcement-content'>" . $row['icerik'] . "</p>";
            echo "<p class='announcement-date'>" . $row['tarih'] . "</p>";
            echo "<a href='?delete_id=" . $row['id'] . "' class='delete-button'>Sil</a>";
            echo "</div>";
         }
      } else {
         echo "<p class='no-announcement'>Henüz bir duyuru yok</p>";
      }
      ?>

   </div>

   <script src="js/admin_script.js"></script>
   <script>
      function closeMessage(element) {
         element.parentElement.style.display = 'none';
      }
   </script>

</body>

</html>
