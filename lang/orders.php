<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="tr">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Siparişler</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php @include 'header.php'; ?>

<section class="heading">
    <h3>SİPARİŞLERİNİZ</h3>
    <p> <a href="home.php">Ana Sayfa</a> / Siparişler </p>
</section>

<section class="placed-orders">

    <h1 class="title">VERİLMİŞ SİPARİŞLER</h1>

    <div class="box-container">

    <?php
        $select_orders = mysqli_query($conn, "SELECT * FROM `orders` WHERE user_id = '$user_id'") or die('query failed');
        if(mysqli_num_rows($select_orders) > 0){
            while($fetch_orders = mysqli_fetch_assoc($select_orders)){
                $products = explode(',', $fetch_orders['total_products']);
                $products_formatted = array_map('trim', $products);
                $products_list = implode(', ', $products_formatted);
                $products_list = trim($products_list, ', ');

                $englishDate = $fetch_orders['placed_on'];
                $months = ['Jun' => 'Haziran', 'Jul' => 'Temmuz', 'Aug' => 'Ağustos', 'Sep' => 'Eylül', 'Oct' => 'Ekim', 'Nov' => 'Kasım', 'Dec' => 'Aralık', 'Jan' => 'Ocak', 'Feb' => 'Şubat', 'Mar' => 'Mart', 'Apr' => 'Nisan', 'May' => 'Mayıs'];
                $turkishDate = str_replace(array_keys($months), $months, $englishDate);
    ?>
    <div class="box">
        <p> Sipariş tarihi: <span><?php echo $turkishDate; ?></span> </p>
        <p> İsim: <span><?php echo $fetch_orders['name']; ?></span> </p>
        <p> Telefon numarası: <span><?php echo $fetch_orders['number']; ?></span> </p>
        <p> E-posta adresi: <span><?php echo $fetch_orders['email']; ?></span> </p>
        <p> Adres: <span><?php echo str_replace('flat no.', '', $fetch_orders['address']); ?></span> </p>
        <p> Ödeme yöntemi: <span><?php echo str_replace(
            array('cash on delivery', 'credit card', 'paypal', 'paytm'),
            array('Kapıda ödeme', 'Kredi kartı', 'Papara', 'Mobil ödeme'),
            $fetch_orders['method']
        ); ?></span> </p>
        <p> Ürünler: <span><?php echo $products_list; ?></span> </p>
        <p> Toplam ödeme: <span><?php echo $fetch_orders['total_price']; ?> ₺</span> </p>
        <p> Sipariş durumu: <span style="color:<?php if($fetch_orders['payment_status'] == 'pending'){echo 'tomato'; }else{echo 'green';} ?>"><?php echo str_replace(
            array('pending', 'completed'),
            array('Hazırlanıyor', 'Tamamlandı'),
            $fetch_orders['payment_status']
        ); ?></span> </p>
    </div>
    <?php
        }
    }else{
        echo '<p style="margin: auto; margin-bottom: 25rem;" class="empty">Henüz sipariş verilmedi!</p>';
    }
    ?>
    </div>

</section>

<?php @include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>
