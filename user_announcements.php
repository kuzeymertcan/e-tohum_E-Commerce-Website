<?php
@include 'config.php';

session_start();

if (!isset($_SESSION['user_email'])) {
   header('location:login.php');
   exit;
}

$user_email = $_SESSION['user_email'];

$select_duyurular = mysqli_query($conn, "SELECT * FROM duyurular") or die('Duyuruları getirme işlemi başarısız oldu');
?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Duyurular</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <link rel="stylesheet" href="css/style.css">
    
    <style>
        .messages-container-announcements {
            font-size: 2.5rem;
            border: 1rem;
            border-color: #f5f4f4;
            border-style: solid;
            padding: 1rem;
        }
        
        .duyurular-list {
            list-style-type: none;
        }

        .duyurular-list li {
            background-color: #fff;
            border: 0.1rem solid #ddd;
            border-radius: 0.4rem;
            padding: 2rem;
            margin-bottom: 2rem;
            overflow-wrap: break-word;
            word-wrap: break-word;
            hyphens: auto;
        }

        .duyuru-baslik {
            font-size: 2.4rem;
            font-weight: bold;
            margin-bottom: 1rem;
        }

        .duyuru-icerik {
            font-size: 1.8rem;
            margin-bottom: 1rem;
        }

        .duyuru-tarih {
            font-size: 1.6rem;
            color: #777;
        }
    </style>
</head>

<body>
<?php @include 'header.php'; ?>

<section class="heading">
    <h3>Duyurular</h3>
    <p><a href="home.php">Ana Sayfa</a> / Duyurular</p>
</section>

<section class="messages-container-announcements">
   <ul class="duyurular-list">
      <?php
         if(mysqli_num_rows($select_duyurular) > 0){
            while($duyuru = mysqli_fetch_assoc($select_duyurular)){
               echo "<li>";
               echo "<h3 class='duyuru-baslik'>".$duyuru['baslik']."</h3>";
               echo "<p class='duyuru-icerik'>".$duyuru['icerik']."</p>";
               echo "<p class='duyuru-tarih'>Tarih: ".$duyuru['tarih']."</p>";
               echo "</li>";
            }
         } else {
            echo '<li style="text-align: center; color: #a94442; background-color: #ebccd1; margin: auto; margin-bottom: 22rem; width: 80%;">Henüz bir duyuru yok!</li>';
         }
      ?>
   </ul>
</section>

<?php @include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>

</html>
