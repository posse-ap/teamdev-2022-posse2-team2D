<?php
session_name("client");
session_start();
require('../dbconnect.php');

if (!empty($_POST)) {
    $login = $db->prepare('SELECT * FROM users WHERE email=?');
    $login->execute(array(
        $_POST['mail']
    ));
    $user = $login->fetch();

    if ($user) {
        // echo $user["id"];
        $mail = $_POST['mail'];
        $_SESSION['reset_mail'] = $mail;
        $passResetToken = md5(uniqid(rand(), true));
        date_default_timezone_set('Asia/Tokyo');
        // $now_date = date("Y/m/d H:i:s") . "\n" ; 
        //「2015/03/10 06:00:00」
        $stmt = $db->prepare(
            'INSERT INTO 
            `userpassreset` (
                `token`,
                `mail`
            ) 
        VALUES
            (?,?)
        '
        );
        $stmt->bindValue(1, $passResetToken, PDO::PARAM_STR);
        $stmt->bindValue(2, $mail, PDO::PARAM_STR);
        $stmt->execute();

        // $title = 'パスワード変更について';
        // $content = '本文';
        // $from = 'from@example.com';

        // mb_send_mail($mail, $title, $content, $from);
        $from = 'from@example.com';
        $to = $mail;
        $title = 'パスワード変更について';
        $content = "以下のリンクからパスワードの再設定をよろしくお願いします。\n http://localhost:8080/client/pas_reset.php?token=" . $passResetToken;
        $ret = mb_send_mail($to, $title, $content, "From: {$from} \r\n");
    } else {
        echo 'メールアドレスが正しくありません';
        $error = 'fail';
    }
}


if (isset($_GET['token'])) {
    $token = $_GET['token'];

    $SQL = "SELECT * FROM userpassreset where token = ?";
    $stmt = $db->prepare($SQL);
    $stmt->bindValue(1, $token, PDO::PARAM_STR);
    $stmt->execute();
    $data = $stmt->fetch(PDO::FETCH_ASSOC);

    if (empty($data)) {
        echo $error;
        exit;
    } else {
        $limitTime = date("Y-m-d H:i:s", strtotime("-1 minute"));
    }
    if ((strtotime($data["updated_at"])) >= strtotime($limitTime)) {
        // return array('ture',$data["id"]);
        header('Location: http://' . $_SERVER['HTTP_HOST'] . '/client/reset.php');
    } else {
        // return array('false',$data["id"]);
        echo '失敗';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" href="login.css">
</head>

<body>
    <header>
        <h1>就活の教科書 <span>クライアント画面</span></h1>
    </header>
    <h1 class="reset_sentence2">パスワードの再設定が必要です</h1><br>
    <p class="reset_sentence3">
        恐れ入りますが、登録されたメールアドレスをご入力いただき、<br><br>
        受信されたメールの案内にしたがってパスワードの再設定をお願いします。
    </p>

    <section class="login">
    <form action="../client/pas_reset.php" method="POST" class="login-container">
        <p>登録しているメールアドレス</p>
        <p><input type="mail" name="mail" placeholder="mail" required></p>
        <input type="submit" value="確定">
    </form>
    </section>
    <?php if ($ret) : ?>
    <p class="reset_sentence4">
        記入いただいたメールアドレス宛にメールを送信しました<br><br>
        確認した後、パスワードの再設定をお願いします。
    <?php endif; ?>
    </p>
</body>

</html>