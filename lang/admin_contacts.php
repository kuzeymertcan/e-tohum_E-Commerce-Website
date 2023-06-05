<?php
@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:login.php');
}

if (isset($_GET['delete'])) {
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `message` WHERE id = '$delete_id'") or die('query failed');
   header('location:admin_contacts.php');
}

if (isset($_POST['response'])) {
   $message_id = $_POST['message_id'];
   $response = $_POST['response'];
   $response_sent_at = date('Y-m-d H:i:s');
   
   mysqli_query($conn, "UPDATE `message` SET response = '$response', response_sent_at = '$response_sent_at' WHERE id = '$message_id'") or die('query failed');
   header('location:admin_contacts.php');
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Mesajlar</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <link rel="stylesheet" href="css/admin_style.css">

   <style>
      textarea {
         resize: none;
      }

      .response-box{
         width: 29rem;
      }

      .response-btn{
         display: inline-block;
         border-radius: .5rem;
         margin-top: 1rem;
         font-size: 1.5rem;
         color: var(--white);
         cursor: pointer;
         padding: 1.2rem 1rem 1.2rem 1rem;
         text-transform: capitalize;
         float: left;
         width: 15rem;
         background-color: green;
      }

      .delete-btn{
         float: right;
      }

   </style>
</head>
<body>
   
<?php @include 'admin_header.php'; ?>

<section class="messages">

   <h1 class="title">MESAJLAR</h1>

   <div class="box-container">

      <?php
       $select_message = mysqli_query($conn, "SELECT * FROM `message`") or die('query failed');
       if(mysqli_num_rows($select_message) > 0){
          while($fetch_message = mysqli_fetch_assoc($select_message)){
      ?>
      <div class="box">
         <p>Kullanıcı ID: <span><?php echo $fetch_message['user_id']; ?></span> </p>
         <p>İsim: <span><?php echo $fetch_message['name']; ?></span> </p>
         <p>Telefon: <span><?php echo $fetch_message['number']; ?></span> </p>
         <p>E-posta: <span><?php echo $fetch_message['email']; ?></span> </p>
         <p>Mesaj: <span><?php echo $fetch_message['message']; ?></span> </p>
         <p>Mesaj Tarihi: <span><?php echo $fetch_message['sent_at']; ?></span> </p>
         <?php
         if (empty($fetch_message['response'])) {
            ?>
            <form action="" method="POST">
               <input type="hidden" name="message_id" value="<?php echo $fetch_message['id']; ?>">
               <textarea name="response" class="response-box" placeholder="Yanıtınızı girin" required oninput="autoResize(this)"></textarea>
               <button type="submit" class="response-btn">Yanıt Gönder</button>
            </form>
            <?php
         } else {
            ?>
            <p>Yanıt: <span><?php echo $fetch_message['response']; ?></span></p>
            <p>Yanıt Tarihi: <span><?php echo $fetch_message['response_sent_at']; ?></span></p>
            <?php
         }
         ?>
         <a href="admin_contacts.php?delete=<?php echo $fetch_message['id']; ?>" onclick="return confirm('Bu mesajı silmek istiyor musunuz?');" class="delete-btn">Sil</a>
      </div>
      <?php
         }
      } else {
         echo '<p class="empty">Hiç mesajınız yok!</p>';
      }
      ?>
   </div>

</section>

<script src="js/admin_script.js"></script>
<script>
   function autoResize(textarea) {
      textarea.style.height = 'auto';
      textarea.style.height = textarea.scrollHeight + 'px';
   }
</script>

</body>
</html>
