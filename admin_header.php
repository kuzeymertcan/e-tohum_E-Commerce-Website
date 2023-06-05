<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<style>

.dropdown {
    position: relative;
    display: inline-block;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 16rem;
    box-shadow: 0rem 0.8rem 1.6rem 0rem rgba(0,0,0,0.2);
    padding: 1.2rem 1.6rem;
    z-index: 1;
}

.dropdown-content a {
    color: black;
    padding: 1.2rem 1.6rem;
    text-decoration: none;
    display: block;
    font-size: 1.6rem;
}

.dropdown-content a:hover {
    background-color: #f1f1f1;
}

.dropdown:hover .dropdown-content {
    display: block;
}

</style>

<header class="header">

   <div class="flex">

      <a href="admin_page.php" class="logo">Admin<span style="margin-left: 0.5rem;">Paneli</span></a>

      <nav class="navbar">
         <a href="admin_page.php">Ana Sayfa</a>
         <a href="admin_products.php">Ürünler</a>
         <a href="admin_orders.php">Siparişler</a>

         <a href="admin_contacts.php">Mesajlar</a>

         <div class="dropdown">
            <a href="#">Duyurular +</a>
            <div class="dropdown-content">
               <a href="admin_announcements.php">Duyuru Yayınla</a>
               <a href="announcements_manage.php">Duyuruları Yönet</a>
            </div>
         </div>

         <div class="dropdown">
            <a href="#">Kullanıcılar +</a>
            <div class="dropdown-content">
               <a href="admin_users.php">Kullanıcıları Gör</a>
               <a href="admin_user_create.php">Kullanıcı Oluştur</a>
            </div>
         </div>

      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="account-box">
         <p>Kullanıcı: <span><?php echo $_SESSION['admin_name']; ?></span></p>
         <p>E-posta: <span><?php echo $_SESSION['admin_email']; ?></span></p>
         <a href="logout.php" class="delete-btn">Çıkış Yap</a>
      </div>

   </div>

</header>
