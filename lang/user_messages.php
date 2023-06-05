<?php
@include 'config.php';

session_start();

if (!isset($_SESSION['user_email'])) {
   header('location:login.php');
   exit;
}

$user_email = $_SESSION['user_email'];

$select_messages = mysqli_query($conn, "SELECT * FROM `message` WHERE email = '$user_email'") or die('query failed');
?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mesajlar</title>

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

        .message-item {
            background-color: #fff;
            padding: 2rem;
            border-radius: 0.5rem;
            margin-bottom: 1.5rem;
            border: 0.1rem solid #ddd;
            border-radius: 0.4rem;
        }

        .message-item h4 {
            margin-top: 1rem;
            margin-bottom: 1rem;
        }

        .message-item p {
            margin-bottom: 0.5rem;
        }

        .message-item hr {
            margin-top: 1.5rem;
            margin-bottom: 1.5rem;
            border: none;
            border-top: 1px solid #ccc;
        }

        .empty-message {
            text-align: center;
            padding: 2.0rem;
            border-radius: 0.5rem;
            color: #a94442;
            background-color: #ebccd1;
        }

        @media (max-width: 600px) {
            .message-item {
                display: flex;
                flex-direction: column;
            }

            .message-item div {
                margin-bottom: 1rem;
            }

            .message-item div:last-child {
                margin-bottom: 0;
            }
        }
    </style>

</head>

<body>
    <?php @include 'header.php'; ?>

    <section class="heading">
        <h3>Mesajlarınız</h3>
        <p><a href="home.php">Ana Sayfa</a> / Mesajlar</p>
    </section>

    <section class="messages-container">

        <?php
        if (mysqli_num_rows($select_messages) > 0) {
            while ($message = mysqli_fetch_assoc($select_messages)) {
                echo '<div class="message-item">';
                echo '<h4 style="font-size: 2rem; font-weight: bold;">Mesajınız</h4>';
                echo '<p style="font-size: 1.8rem;">' . $message['message'] . '</p>';
                echo '<h4 style="font-size: 2rem; font-weight: bold;">Admin Yanıtı</h4>';
                echo '<p style="font-size: 1.8rem;">' . $message['response'] . '</p>';
                echo '<div>';
                echo '<h4 style="font-size: 1.8rem;">Gönderim Tarihi</h4>';
                echo '<p style="font-size: 1.6rem;">' . $message['sent_at'] . '</p>';
                echo '</div>';
                echo '<div>';
                echo '<h4 style="font-size: 1.8rem;">Yanıtlanma Tarihi</h4>';
                echo '<p style="font-size: 1.6rem;">' . $message['response_sent_at'] . '</p>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo '<div style="margin-bottom: 25rem;" class="empty-message">Hiç mesajınız yok!</div>';
        }
        ?>
    </section>

    <?php @include 'footer.php'; ?>

    <script src="js/script.js"></script>

</body>

</html>
