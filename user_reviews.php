<?php
@include 'config.php';
?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Müşteri Yorumları</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <link rel="stylesheet" href="css/style.css">
    
</head>

<body>
<?php @include 'header.php'; ?>

<section class="heading">
    <h3>Müşteri Yorumları</h3>
    <p><a href="home.php">Ana Sayfa</a> / Müşteri Yorumları</p>
</section>

<section class="reviews" id="reviews">

    <h1 class="title">Müşteri Yorumları</h1>

    <div class="box-container">

        <div class="box">
            <img src="images/pic-1.png" alt="">
            <p>Harika bir tohum seçimi, hızlı teslimat ve mükemmel müşteri hizmeti! Bu siteye güvenebilirsiniz, kesinlikle tavsiye ederim. Bahçem şimdi renklendi, teşekkürler!</p>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
            </div>
            <h3>Mehmet Şahin</h3>
        </div>

        <div class="box">
            <img src="images/pic-2.png" alt="">
            <p>Tüm siparişlerim eksiksiz ve zamanında geldi. Ürünler kaliteli, ancak bazı çeşitlerin stoklarının güncellenmesi gerekiyor. Genel olarak memnun kaldım, öneririm.</p>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="far fa-star"></i>
            </div>
            <h3>Ayşe Yılmaz</h3>
        </div>

        <div class="box">
            <img src="images/pic-3.png" alt="">
            <p>Hızlı kargo, kaliteli tohumlar ve güvenilir bir müşteri destek ekibi. Biraz daha geniş ürün yelpazesi olsa harika olurdu. Yine de memnun kaldım, teşekkürler!</p>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Ali Demir</h3>
        </div>

        <div class="box">
            <img src="images/pic-4.png" alt="">
            <p>Tohum kalitesi iyiydi ancak teslimat biraz gecikti. Müşteri hizmetleri ilgiliydi ve sorunları çözdüler. Daha iyi teslimat süreciyle harika olurdu. Teşekkürler!</p>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="far fa-star"></i>
            </div>
            <h3>Fatma Kaya</h3>
        </div>

        <div class="box">
            <img src="images/pic-5.png" alt="">
            <p>Tohumlar gayet kaliteli. Hızlı teslimat ve iyi müşteri hizmetinden de memnun kaldım. Küçük iyileştirmeler yapılabilir ancak genel olarak oldukça başarılı. Teşekkür ederim.</p>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Mustafa Aydın</h3>
        </div>

        <div class="box">
            <img src="images/pic-6.png" alt="">
            <p>Harika tohumlar, hızlı teslimat ve mükemmel müşteri hizmeti! Bitkilerim güzel gelişiyor, bu siteye güvenebilirsiniz. Tavsiye ederim, teşekkürler!</p>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
            </div>
            <h3>Emine Öztürk</h3>
        </div>

    </div>

</section>

<?php @include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>

</html>
