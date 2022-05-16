<?php
session_start();
// require('../dbconnect.php');
if(isset($_GET['btn_logout']) ) {
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

    <div class="section_top">
        <div>
            <h3><form action="">
                <select id="choice" class="cp_sl02" onchange="inputChange()" required>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                </select>
                </form>月の請求情報</h3>
        </div>
        <section class="invoice_info">
            <h2>お申し込み学生数</h2>
            <h2 class="number">30人</h2>
            <h2>請求金額</h2>
            <h2 class="number">19800円</h2>
        </section>
    </div>
    
    <div class="section_content">
        <section class="section_side">
            <div>
                <button>ダウンロード</button>
                <h3>請求日:<br> 2022/10/10</h3>
                <h3>支払期日:<br>2022/10/10</h3>
            </div>
            <div>
                <div>
                    <a href="../cliant_inquiry/index.html">いたづら、重複など見つけた場合</a>
                </div><br>
                <span>⚠　迷惑ユーザー、重複の対応については、月末の翌日まで受け付けます</span>
            </div>
        </section>
    
        <div class="main_box">
            <div class="student_search">
                <h1>学生情報</h1>
            <form method="get" action="#" class="search_container">
                <input type="text" size="25" placeholder="学生氏名">
                <input type="text" size="25" placeholder="年/月/日">
                <input type="submit" value="検索">
            </form>
            </div>
                <div class="wrap">
                    <table>
                        <thead>
                            <tr>
                                <th scope="col" class="middle">お名前</th>
                                <th scope="col" class="wide">メールアドレス</th>
                                <th scope="col">電話番号</th>
                                <th scope="col">大学名</th>
                                <th scope="col">学部学科</th>
                                <th scope="col" class="narrow">卒業年</th>
                                <th scope="col" class="wide">住所</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>あああああああ</th>
                                <td class="price">naoki1010nissy@gmail.com</td>
                                <td class="price">090-2066-9112</td>
                                <td class="price">慶應義塾大学</td>
                                <td class="price">経済学部</td>
                                <td class="price">25卒</td>
                                <td class="price">神奈川県川崎市中原区上丸子山王町2-1324-1-201</td>
                            </tr>
                            <tr>
                                <th>西山直輝</th>
                                <td class="price">naoki1010nissy@gmail.com</td>
                                <td class="price">090-2066-9112</td>
                                <td class="price">慶應義塾大学</td>
                                <td class="price">経済学部</td>
                                <td class="price">25卒</td>
                                <td class="price">神奈川県川崎市中原区上丸子山王町2-1324-1-201</td>
                            </tr>
                            <tr>
                                <th>西山直輝</th>
                                <td class="price">naoki1010nissy@gmail.com</td>
                                <td class="price">090-2066-9112</td>
                                <td class="price">慶應義塾大学</td>
                                <td class="price">経済学部</td>
                                <td class="price">25卒</td>
                                <td class="price">神奈川県川崎市中原区上丸子山王町2-1324-1-201</td>
                            <tr>
                                <th>西山直輝</th>
                                <td class="price">naoki1010nissy@gmail.com</td>
                                <td class="price">090-2066-9112</td>
                                <td class="price">慶應義塾大学</td>
                                <td class="price">経済学部</td>
                                <td class="price">25卒</td>
                                <td class="price">神奈川県川崎市中原区上丸子山王町2-1324-1-201</td>
                            </tr>
                            <tr>
                                <th>西山直輝</th>
                                <td class="price">naoki1010nissy@gmail.com</td>
                                <td class="price">090-2066-9112</td>
                                <td class="price">慶應義塾大学</td>
                                <td class="price">経済学部</td>
                                <td class="price">25卒</td>
                                <td class="price">神奈川県川崎市中原区上丸子山王町2-1324-1-201</td>
                            </tr>
                            <tr>
                                <th>西山直輝</th>
                                <td class="price">naoki1010nissy@gmail.com</td>
                                <td class="price">090-2066-9112</td>
                                <td class="price">慶應義塾大学</td>
                                <td class="price">経済学部</td>
                                <td class="price">25卒</td>
                                <td class="price">神奈川県川崎市中原区上丸子山王町2-1324-1-201</td>
                            </tr>
                            <tr>
                                <th>西山直輝</th>
                                <td class="price">naoki1010nissy@gmail.com</td>
                                <td class="price">090-2066-9112</td>
                                <td class="price">慶應義塾大学</td>
                                <td class="price">経済学部</td>
                                <td class="price">25卒</td>
                                <td class="price">神奈川県川崎市中原区上丸子山王町2-1324-1-201</td>
                            </tr>
                            <tr>
                                <th>西山直輝</th>
                                <td class="price">naoki1010nissy@gmail.com</td>
                                <td class="price">090-2066-9112</td>
                                <td class="price">慶應義塾大学</td>
                                <td class="price">経済学部</td>
                                <td class="price">25卒</td>
                                <td class="price">神奈川県川崎市中原区上丸子山王町2-1324-1-201</td>
                            </tr>
                            <tr>
                                <th>西山直輝</th>
                                <td class="price">naoki1010nissy@gmail.com</td>
                                <td class="price">090-2066-9112</td>
                                <td class="price">慶應義塾大学</td>
                                <td class="price">経済学部</td>
                                <td class="price">25卒</td>
                                <td class="price">神奈川県川崎市中原区上丸子山王町2-1324-1-201</td>
                            </tr>
                            <tr>
                                <th>西山直輝</th>
                                <td class="price">naoki1010nissy@gmail.com</td>
                                <td class="price">090-2066-9112</td>
                                <td class="price">慶應義塾大学</td>
                                <td class="price">経済学部</td>
                                <td class="price">25卒</td>
                                <td class="price">神奈川県川崎市中原区上丸子山王町2-1324-1-201</td>
                            </tr>
                            <tr>
                                <th>西山直輝</th>
                                <td class="price">naoki1010nissy@gmail.com</td>
                                <td class="price">090-2066-9112</td>
                                <td class="price">慶應義塾大学</td>
                                <td class="price">経済学部</td>
                                <td class="price">25卒</td>
                                <td class="price">神奈川県川崎市中原区上丸子山王町2-1324-1-201</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
        </div>
    </div>

<script src="script.js"></script>
</body>
</html>