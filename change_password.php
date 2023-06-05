<?php
@include 'config.php';

session_start();

$message = '';

if(isset($_POST['submit'])){
    $filter_email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
    $email = mysqli_real_escape_string($conn, $filter_email);
    $filter_current_pass = filter_var($_POST['current_password'], FILTER_SANITIZE_STRING);
    $currentPassword = mysqli_real_escape_string($conn, md5($filter_current_pass));
    $filter_new_pass = filter_var($_POST['new_password'], FILTER_SANITIZE_STRING);
    $newPassword = mysqli_real_escape_string($conn, md5($filter_new_pass));
    $filter_new_pass_repeat = filter_var($_POST['new_password_repeat'], FILTER_SANITIZE_STRING);
    $newPasswordRepeat = mysqli_real_escape_string($conn, md5($filter_new_pass_repeat));

    $select_user = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$currentPassword'") or die('query failed');
    
    if(mysqli_num_rows($select_user) > 0){
        $row = mysqli_fetch_assoc($select_user);
        $user_id = $row['id'];
        
        if($newPassword === $newPasswordRepeat){
            $update_query = mysqli_query($conn, "UPDATE `users` SET password = '$newPassword' WHERE id = '$user_id'") or die('update query failed');
            if($update_query){
                $message = 'Şifreniz başarıyla değiştirildi.';
            } else {
                $message = 'Şifre değiştirme işlemi sırasında bir hata oluştu.';
            }
        } else {
            $message = 'Yeni şifreler birbiriyle eşleşmiyor.';
        }
    } else {
        $message = 'Geçerli e-posta adresi ve mevcut şifre kombinasyonu hatalı.';
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
   <title>Şifreni Değiştir</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <link rel="stylesheet" href="css/style.css">

   <style>
    .messages-container {
        font-size: 2.5rem;
        border: 1rem;
        border-color: #f5f4f4;
        border-style: solid;
        padding: 1rem;
    }

    .form-container {

        margin-top: -15rem !important;
    }
    
    .message-item {
        background-color: #f5f4f4;
        padding: 2rem;
        border-radius: 0.5rem;
    }
    
    .message-item-warning {
        text-align: center;
        font-size: 2rem;
        width: 60rem;
        padding: 1rem;
        background-color: white;
        border: 0.1rem;
        border-color: grey;
        border-radius: 0.5rem;
        border-style: solid;
        color: black;
        margin: auto;
        position: relative;
    }

    .close-btn {
        position: absolute;
        top: 0.5rem;
        right: 1rem;
        cursor: pointer;
        font-size: 1.5rem;
        color: #888;
    }

    @media only screen and (max-width: 600px) {
        .message-item-warning {
            width: 80%;
            padding: 1rem;
        }
    }
    
    .message-item p {
        color: #777;
    }
    
    .message-item hr {
        border: none;
        border-top: 0.1rem solid #ccc;
    }
    
    .empty-message {
        text-align: center;
        padding: 2.0rem;
        background-color: #f9f9f9;
        border-radius: 0.5rem;
        color: #888;
    }

    li {

    }

    .heading{

        margin-bottom: 10px;

    }

    </style>

</head>
<body>

<?php @include 'header.php'; ?>

<section class="heading">
    <h3>ŞİFRENİZİ DEĞİŞTİRİN</h3>
    <p><a href="home.php">Ana Sayfa</a> / Şifreni Değiştir</p>
</section>

<?php if(!empty($message)): ?>
      <div class="message-item-warning">
         <h4>Bilgilendirme<span class="close-btn" onclick="closeMessage()">&#10005;</span></h4>
         <p><?php echo $message; ?></p>
      </div>
<?php endif; ?>
   
<section class="form-container">

   <form action="" method="post">
   <h3>ŞİFRENİZİ DEĞİŞTİRİN</h3>
      <input type="email" name="email" class="box" placeholder="E-posta adresinizi girin" required>
      <input type="password" name="current_password" class="box" placeholder="Mevcut şifrenizi girin" required>
      <input type="password" name="new_password" class="box" placeholder="Yeni şifrenizi girin" required>
      <input type="password" name="new_password_repeat" class="box" placeholder="Yeni şifrenizi tekrar girin" required>
      <input type="submit" class="btn" name="submit" value="Şifreni Değiştir">
   </form>

</section>

<?php @include 'footer.php'; ?>

<script>
function closeMessage() {
   var messageItem = document.querySelector('.message-item-warning');
   messageItem.style.display = 'none';
}
</script>

</body>
</html>
