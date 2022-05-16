<?php
session_start();
$dsn = 'mysql:host=db;dbname=db_mydb;charset=utf8;';
$user = 'db_user';
$password = 'password';

try {
    $db = new PDO($dsn, $user, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo '接続失敗: ' . $e->getMessage();
    exit();
}

if (isset($_POST['name'])) {
    // ファイルへのパス
    $path = '../img/';
    $name = $_POST['name'];
    $Tel = $_POST['Tel'];
    $mail = $_POST['mail'];
    $department = $_POST['department'];
    $pas = $_POST['password'];
    $pas_check = $_POST['password_check'];
    $stmt = $db->prepare('SELECT count(*) from users where password=?');
    $stmt->bindValue(1, sha1($pas), PDO::PARAM_STR);
    $stmt->execute();
    $exist = $stmt->fetch(PDO::FETCH_ASSOC);
    echo 'POSTあったよ';
    if(intval($exist['count(*)'] == 0)){
    if ($pas == $pas_check) {
        $stmt = $db->prepare(
        'INSERT INTO 
        `users` (
        `user_img`,
        `company_id`,
        `name`,
        `department_name`,
        `tel`,
        `email`,
        `password`
    ) 
VALUES
    (?,?,?,?,?,?,?)
');

        $stmt->bindValue(1, $name, PDO::PARAM_STR);
        $stmt->bindValue(2, $_SESSION['company_id'], PDO::PARAM_STR);
        $stmt->bindValue(3, $name, PDO::PARAM_STR);
        $stmt->bindValue(4, $department, PDO::PARAM_STR);
        $stmt->bindValue(5, $Tel, PDO::PARAM_STR);
        $stmt->bindValue(6, $mail, PDO::PARAM_STR);
        $stmt->bindValue(7, sha1($pas), PDO::PARAM_STR);
        $stmt->execute();

        // ファイルがアップロードされているかと、POST通信でアップロードされたかを確認
    if( !empty($_FILES['img']['tmp_name']) && is_uploaded_file($_FILES['img']['tmp_name']) ) {
    
        // ファイルを指定したパスへ保存する
        if( move_uploaded_file( $_FILES['img']['tmp_name'], $path.$name . '.png') ) {
            echo 'アップロードされたファイルを保存しました。';
        } else {
            echo 'アップロードされたファイルの保存に失敗しました。';
        }
    }
    } else {
        echo 'パス不一致';
    }
}else{
    echo 'このパスワードはすでに使われております';
}
}

// if(isset($_POST['name'])){
//     // ファイルへのパス
//     $path = './img/';
//         $name = $_POST['name'];
//         $Tel = $_POST['Tel'];
//         $mail = $_POST['mail'];
//         $department = $_POST['department'];
//         $img = $_POST['img'];
//         $stmt = $db->prepare('UPDATE `users` SET name=?, `department_name`=?, `tel`=?, `email`=?,`user_img`=? WHERE password=?');
//         $stmt->bindValue(1, $name, PDO::PARAM_STR);
//         $stmt->bindValue(2, $department, PDO::PARAM_STR);
//         $stmt->bindValue(3, $Tel, PDO::PARAM_STR);
//         $stmt->bindValue(4, $mail, PDO::PARAM_STR);
//         $stmt->bindValue(5, $name, PDO::PARAM_STR);
//         $stmt->bindValue(6, $_SESSION['password'], PDO::PARAM_STR);
//         $stmt->execute();
    
//         // ファイルがアップロードされているかと、POST通信でアップロードされたかを確認
//     if( !empty($_FILES['img']['tmp_name']) && is_uploaded_file($_FILES['img']['tmp_name']) ) {
    
//         // ファイルを指定したパスへ保存する
//         if( move_uploaded_file( $_FILES['img']['tmp_name'], $path.$name . '.png') ) {
//             echo 'アップロードされたファイルを保存しました。';
//         } else {
//             echo 'アップロードされたファイルの保存に失敗しました。';
//         }
//     }
//     }

// require('../dbconnect.php');
if (isset($_GET['btn_logout'])) {
    unset($_SESSION['user_id']);
    unset($_SESSION['time']);
    unset($_SESSION['password']);
    // header("Location: " . $_SERVER['PHP_SELF']);
}
if (isset($_SESSION['user_id']) && $_SESSION['time'] + 60 * 60 * 24 > time()) {
    $_SESSION['time'] = time();

    if (!empty($_POST)) {
        // $stmt = $db->prepare('INSERT INTO events SET title=?');
        // $stmt->execute(array(
        //     $_POST['title']
        // ));

        header('Location: http://' . $_SERVER['HTTP_HOST'] . '/client/top.php');
        exit();
    }
} else {
    header('Location: http://' . $_SERVER['HTTP_HOST'] . '/client/login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../reset.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <div class="header_top">
            <h1>就活の教科書 <span>クライアント画面</span></h1>
            <nav>
                <a href="../top.php">トップ</a>
                <a href="../cliant_agent/index.php" class="page_focus">掲載情報</a>
                <a href="../cliant_student/index.php">個人情報</a>
                <a href="../client_agency/index.php">担当者管理</a>
                <a href="../client_add/index.php">担当者追加</a>
                <a href="../client_application/index.php">編集申請</a>
                <a href="../cliant_inquiry/index.php">お問い合わせ</a>
            </nav>
        </div>
        <div class="header_bottom">
            <form method="get" action="">
                <img src="../img/iconmonstr-log-out-16-240 (1).png" alt="">
                <input type="submit" name="btn_logout" value="ログアウト">
            </form>
        </div>
    </header>

    <section>
        <h2>新規エージェンシー登録</h2>
        <form action="../client_add/index.php" method="POST" enctype="multipart/form-data">
            <table class="contact-table">
                <tr>
                    <th class="contact-item">担当者氏名</th>
                    <td class="contact-body">
                        <input type="text" name="name" class="form-text" required />
                    </td>
                </tr>
                <tr>
                    <th class="contact-item">部署名</th>
                    <td class="contact-body">
                        <input type="text" name="department" class="form-text" required />
                    </td>
                </tr>
                <tr>
                    <th class="contact-item">担当者Tel</th>
                    <td class="contact-body">
                        <input type="tel" name="Tel" class="form-text" required />
                    </td>
                </tr>
                <tr>
                    <th class="contact-item">担当者mail</th>
                    <td class="contact-body">
                        <input type="email" name="mail" class="form-text" required />
                    </td>
                </tr>
                <tr>
                    <th class="contact-item">画像ファイル</th>
                    <td class="contact-body">
                    <!-- <img id="preview1" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="> -->
                    <input id="inputFile" name="img" type="file" accept="image/jpeg, image/png" onchange="previewImage(this);" required />
                    </td>
                </tr>
                <tr>
                    <th class="contact-item">パスワード</th>
                    <td class="contact-body">
                        <input type="password" name="password" class="form-text" required />
                    </td>
                </tr>
                <tr>
                    <th class="contact-item">パスワード<br>(確認用)</th>
                    <td class="contact-body">
                        <input type="password" name="password_check" class="form-text" required />
                    </td>
                </tr>
            </table>
            <input class="contact-submit" type="submit" value="送信" />
        </form>
    </section>
    <!-- <script>
                    function previewImage(obj)
                    {
                    var fileReader = new FileReader();
                    ileReader.onload = (function() {
                    document.getElementById('preview1').src = fileReader.result;
                    });
                    fileReader.readAsDataURL(obj.files[0]);
                    }
                    </script> -->

</body>

</html>