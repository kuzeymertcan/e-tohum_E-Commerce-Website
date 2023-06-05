<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:login.php');
};

if (isset($_POST['update_order'])) {
    $order_id = $_POST['order_id'];
    $update_payment = $_POST['update_payment'];
    mysqli_query($conn, "UPDATE `orders` SET payment_status = '$update_payment' WHERE id = '$order_id'") or die('query failed');
    $message[] = 'Sipariş durumu güncellendi!';
}

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `orders` WHERE id = '$delete_id'") or die('query failed');
    header('location:admin_orders.php');
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

    <link rel="stylesheet" href="css/admin_style.css">

</head>

<body>

    <?php @include 'admin_header.php'; ?>

    <section class="placed-orders">

        <h1 class="title">VERİLEN SİPARİŞLER</h1>

        <div class="box-container">

            <?php

            $select_orders = mysqli_query($conn, "SELECT * FROM `orders`") or die('query failed');
            if (mysqli_num_rows($select_orders) > 0) {
                while ($fetch_orders = mysqli_fetch_assoc($select_orders)) {
                    $total_price = number_format($fetch_orders['total_price'], 0, ',', '.') . ' ₺';
                    $product_list = ltrim($fetch_orders['total_products'], ', ');
                    $englishDate = $fetch_orders['placed_on'];
                    $months = ['Jun' => 'Haz', 'Jul' => 'Tem', 'Aug' => 'Ağu', 'Sep' => 'Eyl', 'Oct' => 'Eki', 'Nov' => 'Kas', 'Dec' => 'Ara', 'Jan' => 'Oca', 'Feb' => 'Şub', 'Mar' => 'Mar', 'Apr' => 'Nis', 'May' => 'May'];
                    $turkishDate = str_replace(array_keys($months), $months, $englishDate);
            ?>
                    <div class="box">
                        <p> Kullanıcı ID: <span><?php echo $fetch_orders['user_id']; ?></span> </p>
                        <p> Sipariş Tarihi: <span><?php echo $turkishDate; ?></span> </p>
                        <p> İsim: <span><?php echo $fetch_orders['name']; ?></span> </p>
                        <p> Telefon: <span><?php echo $fetch_orders['number']; ?></span> </p>
                        <p> E-posta: <span><?php echo $fetch_orders['email']; ?></span> </p>
                        <p> Adres: <span><?php echo trim(str_replace('flat no.', '', $fetch_orders['address'])); ?></span> </p>
                        <p> Ürünler: <span><?php echo $product_list; ?></span> </p>
                        <p> Toplam Ödeme: <span><?php echo $total_price; ?></span> </p>
                        <p> Ödeme Yöntemi: <span><?php echo str_replace(
                                                            array('cash on delivery', 'credit card', 'paypal', 'paytm'),
                                                            array('Kapıda ödeme', 'Kredi kartı', 'Papara', 'Mobil ödeme'),
                                                            $fetch_orders['method']
                                                        ); ?></span> </p>
                        <form action="" method="post">
                            <input type="hidden" name="order_id" value="<?php echo $fetch_orders['id']; ?>">
                            <select name="update_payment">
                                <option disabled selected><?php echo str_replace(
                                                                    array('pending', 'completed'),
                                                                    array('Hazırlanıyor', 'Tamamlandı'),
                                                                    $fetch_orders['payment_status']
                                                                ); ?></option>
                                <option value="pending">Hazırlanıyor</option>
                                <option value="completed">Tamamlandı</option>
                            </select>
                            <input type="submit" name="update_order" value="Güncelle" class="option-btn">
                            <a href="admin_orders.php?delete=<?php echo $fetch_orders['id']; ?>" class="delete-btn" onclick="return confirm('Bu siparişi silmek istiyor musun?');">Sil</a>
                        </form>
                    </div>
            <?php
                }
            } else {
                echo '<p class="empty">Henüz sipariş verilmedi!</p>';
            }
            ?>
        </div>

    </section>

    <script src="js/admin_script.js"></script>

</body>

</html>
