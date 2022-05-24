<?php
require(dirname(__FILE__) . "/dbconnect.php");
session_start();
if (isset($_GET['btn_logout'])) {

    unset($_SESSION['user_id']);
    unset($_SESSION['time']);
    // header("Location: " . $_SERVER['PHP_SELF']);

    unset($_SESSION['user_id']);
    unset($_SESSION['time']);
    // header("Location: " . $_SERVER['PHP_SELF']);

    unset($_SESSION['user_id']);
    unset($_SESSION['time']);
    // header("Location: " . $_SERVER['PHP_SELF']);
}
if (isset($_SESSION['user_id']) && $_SESSION['time'] + 60 * 60 * 24 > time()) {
    $_SESSION['time'] = time();

} else {
    header('Location: http://' . $_SERVER['HTTP_HOST'] . '/admin/login.php');
    exit();
}
$delete = $_POST['delete'];
$deleteUser = $_POST['deleteUser'];
$stmt = $db->prepare("select id from agent where agent_name ='$delete'");
$stmt->execute();
$id = $stmt->fetch();
$agentId = $id['id']; 

$stmt_delete = $db->prepare("delete from agent_user where agent_id = '$agentId' and user_id='$deleteUser'");
$stmt_delete->execute();
?>

<!DOCTYPE html>
<html lang="ja">

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
            <h1>管理者画面</h1>
            <form method="get" action="">
                <img src="../img/iconmonstr-log-out-16-240 (1).png" alt="">
                <input type="submit" name="btn_logout" value="ログアウト">
            </form>
        </div>
        <div class="header_bottom">
            <ul>
                <li><a href="../top.php">トップ</a></li>
                <li><a href="../admin_student/index.php">お申込履歴</a></li>
                <li><a href="../admin_company/index.php" class="page_focus">企業管理</a></li>
                <li><a href="../admin_submit/index.php">新規エージェンシー</a></li>
            </ul>
        </div>
    </header>
    <section class="delete">
        <p>本当に削除しますか？</p>
        <form action="index.php" method="get">
            <input type="hidden" value="<?= $delete; ?>" name="agent">
            <input type="submit" value="はい" class="yes">
        </form>
        <input type="submit" value="いいえ" class="no" onclick="history.back()">
    </section>
</body>

</html>