<?php
ini_set('display_errors', 1);
require(dirname(__FILE__) . "/dbconnect.php");
session_name("client");
session_start();
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
        header('Location: http://' . $_SERVER['HTTP_HOST'] . '/client_application/index.php');
        exit();
    }
} else {
    header('Location: http://' . $_SERVER['HTTP_HOST'] . '/client/login.php');
    exit();
}
$agent = $_SESSION['agent_name'];
// $cnt_stmt = $db->prepare("select * from agent where agent_name = '$agent' ");
$cnt_stmt = $db->prepare("select * from agent where agent_name = '$agent'");
$cnt_stmt->execute();
$cnts = $cnt_stmt->fetch();
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="../reset.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Noto+Serif:ital,wght@1,700&family=Sawarabi+Mincho&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.js"></script>
</head>

<body>
    <header>
        <div class="header_top">
            <h1>就活の教科書 <span>クライアント画面</span></h1>
            <nav>
                <a href="../top.php" class="top">トップ</a>
                <a href="../client_agent/index.php" class="page_focus agent">掲載情報</a>
                <a href="../client_student/index.php" class="student">学生情報</a>
                <a href="../client_agency/index.php" class="manage">担当者管理</a>
                <a href="../client_add/index.php" class="agency">担当者追加</a>
                <a href="../client_application/index.php" class="editer">編集申請</a>
                <a href="../client_inquiry/index.php" class="call">お問い合わせ</a>
            </nav>
        </div>
        <div class="header_bottom">
            <form method="get" action="">

                <input type="submit" name="btn_logout" value="ログアウト">
            </form>
        </div>
    </header>

    <div class="cp_ipselect">
        <select id="choice" class="cp_sl02" onchange="inputChange()" required>
            <!-- <option value="" hidden disabled selected></option> -->
            <option value="1">トップページ画面</option>
            <option value="2">詳細ページ画面</option>
            <option value="3">契約情報</option>
        </select>
        <span class="cp_sl02_highlight"></span>
        <span class="cp_sl02_selectbar"></span>
        <label class="cp_sl02_selectlabel">閲覧するページを選ぶ</label>
    </div>

    <section id="top">
        <div class="main">
            <!-- <button onclick="page_changes()" class="pages_button"><img src="../img/iconmonstr-arrow-25-240.png" alt=""><h1>トップページ画面</h1></button> -->
            <section class="agentlist">
                <div class="agentlist-item">
                    <div class="agentlist-item_box">
                        <!-- <img src="./img/リクナビ.png" alt=""> -->
                        <div class="imgContainer">
                            <img src="/src/user/img/<?= $cnts['agent_name'] ;?>.png" alt="" class="logo" >
                            <h2><?= $cnts['agent_name']; ?></h2>
                        </div>
                        <!-- 変更箇所 -->
                        <a target="_blank" href="#">公式サイトはこちら</a>
                    </div>
                    <div class="agentlist-item_lead">
                        <h3><?= $cnts['main']; ?></h3>
                        <h6><?= $cnts['sub']; ?></h6>
                    </div>
                    <div class="agentlist-item_category">
                        <ul>
                            <?php
                            // require(dirname(__FILE__) . "/dbconnect.php");
                            $stmt = $db->prepare('SELECT * FROM agent_tag JOIN agent ON agent.id = agent_tag.agent_id RIGHT JOIN tag ON tag.id = agent_tag.tag_id where agent_name=:name');
                            $stmt->bindValue('name', $cnts['agent_name'], PDO::PARAM_STR);
                            $stmt->execute();
                            $tags = $stmt->fetchAll(); ?>
                            <?php foreach ($tags as $tag) : ?>
                                <li><?= $tag["tag_name"]; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="agentlist-item_img">
                        <div class="rader">
                            <canvas class="myRadarChart_<?= $cnts['agent_name']; ?> chart">
                            </canvas>
                        </div>
                        <div class="button">
                            <?php if (!isset($_GET['narrow'])) :
                                $id = $cnts['id'];
                            else :
                                $id = $cnts['agent_id'];
                            endif
                            ?>
                            <button class="js_cart_btn cart btn" data-name="<?= $cnts['agent_name']; ?>" data-id="<?= $id; ?>">カートに入れる</button>
                            <div>
                                <input type="hidden" value="<?= $cnts['agent_name']; ?>" name="detail">
                                <input class="detail btn" type="submit" value="詳細はこちら">
                                </divaction=>
                            </div>
                        </div>
                    </div>
                    <script>
                        var ctx = document.querySelector(".myRadarChart_<?= $cnts['agent_name']; ?>");
                        var myRadarChart = new Chart(ctx, {
                            //グラフの種類
                            type: "radar",
                            //データの設定
                            data: {
                                //データ項目のラベル
                                labels: ["掲載社数", "内定実績", "スピード", "登録者数", "拠点数"],
                                //データセット
                                datasets: [{
                                    label: "エージェント五段階評価",
                                    //背景色
                                    backgroundColor: "rgba(45, 205, 98,.4)",
                                    //枠線の色
                                    borderColor: "rgba(45, 205, 98,1)",
                                    //結合点の背景色
                                    pointBackgroundColor: "rgba(45, 205, 98,1)",
                                    //結合点の枠線の色
                                    pointBorderColor: "#fff",
                                    //結合点の背景色（ホバ時）
                                    pointHoverBackgroundColor: "#fff",
                                    //結合点の枠線の色（ホバー時）
                                    pointHoverBorderColor: "rgba(200,112,126,1)",
                                    //結合点より外でマウスホバーを認識する範囲（ピクセル単位）
                                    hitRadius: 5,
                                    //グラフのデータ
                                    data: [<?php $stmt_shuffle = $db->prepare('select publisher_five from agent where agent_name=:name ');
                                            $stmt_shuffle->bindValue('name', $cnts["agent_name"], PDO::PARAM_STR);
                                            $stmt_shuffle->execute();
                                            $shuffles = $stmt_shuffle->fetchAll();
                                            foreach ($shuffles as $shuffle) :
                                                echo $shuffle['publisher_five'];
                                            endforeach;
                                            ?>, <?php $stmt_decison = $db->prepare('select decision_five from agent where agent_name=:name ');
                                                $stmt_decison->bindValue('name', $cnts["agent_name"], PDO::PARAM_STR);
                                                $stmt_decison->execute();
                                                $decisions = $stmt_decison->fetchAll();
                                                foreach ($decisions as $decision) :
                                                    echo $decision['decision_five'];
                                                endforeach;
                                                ?>, <?php $stmt_speed = $db->prepare('select speed_five from agent where agent_name=:name ');
                                                    $stmt_speed->bindValue('name', $cnts["agent_name"], PDO::PARAM_STR);
                                                    $stmt_speed->execute();
                                                    $speeds = $stmt_speed->fetchAll();
                                                    foreach ($speeds as $speed) :
                                                        echo $speed['speed_five'];
                                                    endforeach;
                                                    ?>, <?php $stmt_regist = $db->prepare('select registstrant_five from agent where agent_name=:name ');
                                                        $stmt_regist->bindValue('name', $cnts["agent_name"], PDO::PARAM_STR);
                                                        $stmt_regist->execute();
                                                        $regists = $stmt_regist->fetchAll();
                                                        foreach ($regists as $regist) :
                                                            echo $regist['registstrant_five'];
                                                        endforeach;
                                                        ?>, <?php $stmt_place = $db->prepare('select place_five from agent where agent_name=:name ');
                                                            $stmt_place->bindValue('name', $cnts["agent_name"], PDO::PARAM_STR);
                                                            $stmt_place->execute();
                                                            $places = $stmt_place->fetchAll();
                                                            foreach ($places as $place) :
                                                                echo $place['place_five'];
                                                            endforeach;
                                                            ?>],
                                }, ],
                            },
                            options: {
                                legend: {
                                    labels: {
                                        // このフォント設定はグローバルプロパティを上書きします。
                                        fontColor: "black",
                                    },
                                },
                                // レスポンシブ指定
                                responsive: true,
                                scale: {
                                    r: {
                                        pointLabels: {
                                            display: true,
                                            centerPointLabels: true,
                                        },
                                    },
                                    ticks: {
                                        // 最小値の値を0指定
                                        beginAtZero: true,
                                        min: 0,
                                        // 最大値を指定
                                        max: 5,
                                    },
                                },
                            },
                        });
                    </script>
            </section>
        </div>
        <!-- <div class="agentlist-item_return">
        <a href="../admin_company/index.html"><button>一覧に戻る</button></a>
    </div> -->
    </section>

    <section id="detail">
        <div class="main">
            <div class="agentlist-item">
                <div class="agentlist-item_box">
                    <h2><?= $cnts['agent_name']; ?></h2>
                    <a href="#">公式サイトはこちら</a>
                </div>
                <div class="agentlist-item_category">
                    <ul>
                        <?php foreach ($tags as $tag) : ?>
                            <li><?= $tag["tag_name"]; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="agentlist-item_img">
                    <img src="../../user/img/<?= $cnts['agent_name']; ?>.png?<?= uniqid() ?>" class="site">
                    <div class="rader">
                        <canvas class="myRadarChart-uno_<?= $cnts['agent_name']; ?>">
                        </canvas>
                    </div>
                </div>
                <div class="agentlist-item_table">
                    <table border="1">
                        <tr>
                            <th>掲載社数</th>
                            <th>内定実績</th>
                            <th>スピード</th>
                            <th>登録者数</th>
                            <th>拠点数</th>
                        </tr>
                        <tr>
                            <td><?= $cnts['publisher']; ?>社</td>
                            <td><?= $cnts['decision']; ?>人</td>
                            <td><?= $cnts['speed']; ?>週間</td>
                            <td><?= $cnts['registstrant']; ?>人</td>
                            <td><?= $cnts['place']; ?>箇所</td>
                        </tr>
                    </table>
                </div>
                <div class="agentlist-item_service">
                    <h2>サービスの流れ</h2>
                    <div class="service-step">
                        <p><span>step1</span><?= $cnts['step1']; ?></p>
                    </div>
                    <div class="service-step">
                        <p><span>step2</span><?= $cnts['step2']; ?></p>
                    </div>
                    <div class="service-step">
                        <p><span>step3</span><?= $cnts['step3']; ?></p>
                    </div>
                </div>
                <div class="agentlist-item_apeal">
                    <h2>アピールポイント</h2>
                    <h4><?= $cnts['apeal1']; ?></h4>
                    <p><?= $cnts['apeal1_content']; ?></p>
                    <h4><?= $cnts['apeal2']; ?></h4>
                    <p><?= $cnts['apeal2_content']; ?></p>
                </div>
                <div class="company-info">
                    <h2>企業へのお問い合わせ<img src="img/iconmonstr-phone-1-240.png" alt=""></h2>
                    <h5><span>mail:</span><?= $cnts['mail']; ?></h5>
                    <h5><span>tel:</span><?= $cnts['tel']; ?></h5>
                </div>
            </div>
        </div>
    </section>

    <section id="info">
        <div class="main">
            <!-- <button onclick="page_changes()" class="pages_button"><img src="../img/iconmonstr-arrow-25-240.png" alt=""><h1>契約情報</h1></button> -->
            <table class="contact-table">
                <tr>
                    <th class="contact-item">企業名</th>
                    <td class="contact-body">
                        <h3><?= $cnts['agent_name']; ?></h3>
                    </td>
                </tr>
                <tr>
                    <th class="contact-item">企業画像ファイル</th>
                    <td class="contact-body">
                        <img src="<?= "../../user/img/" . $cnts['agent_name'] . ".png?" .  uniqid() ?>" alt="">
                    </td>
                </tr>
                <tr>
                    <th class="contact-item">公式サイトurl</th>
                    <td class="contact-body">
                        <h3><?= $cnts['link']; ?></h3>
                    </td>
                </tr>
                <tr>
                    <th class="contact-item">見出し</th>
                    <td class="contact-body">
                        <h3><?= $cnts['main']; ?></h3>
                    </td>
                </tr>
                <tr>
                    <th class="contact-item">小見出し</th>
                    <td class="contact-body">
                        <h3><?= $cnts['sub']; ?></h3>
                    </td>
                </tr>
                <tr>
                    <th class="contact-item">アピールポイント</th>
                    <td class="contact-body">
                        <h3>マイナビ</h3>
                    </td>
                </tr>
                <tr>
                    <th class="contact-item">内定実績</th>
                    <td class="contact-body">
                        <h3><?= $cnts['decision']; ?></h3>
                    </td>
                </tr>
                <tr>
                    <th class="contact-item">掲載者数</th>
                    <td class="contact-body">
                        <h3><?= $cnts['publisher']; ?></h3>
                    </td>
                </tr>
                <tr>
                    <th class="contact-item">内定最短</th>
                    <td class="contact-body">
                        <h3><?= $cnts['speed']; ?></h3>
                    </td>
                </tr>
                <tr>
                    <th class="contact-item">登録者数</th>
                    <td class="contact-body">
                        <h3><?= $cnts['registstrant']; ?></h3>
                    </td>
                </tr>
                <tr>
                    <th class="contact-item">拠点数</th>
                    <td class="contact-body">
                        <h3><?= $cnts['place']; ?></h3>
                    </td>
                </tr>
                <tr>
                    <th class="contact-item">グラフ</th>
                    <td class="contact-body">
                        <label class="contact-sex">
                            <span class="contact-sex-txt">掲載者数</span>
                            <h2><?= $cnts['publisher_five']; ?></h2>
                        </label>
                        <label class="contact-sex">
                            <span class="contact-sex-txt">内定実績</span>
                            <h2><?= $cnts['decision_five']; ?></h2>
                        </label>
                        <label class="contact-sex">
                            <span class="contact-sex-txt">スピード</span>
                            <h2><?= $cnts['speed_five']; ?></h2>
                        </label>
                        <label class="contact-sex">
                            <span class="contact-sex-txt">登録者数</span>
                            <h2><?= $cnts['registstrant_five']; ?></h2>
                        </label>
                        <label class="contact-sex">
                            <span class="contact-sex-txt">拠点数</span>
                            <h2><?= $cnts['place_five']; ?></h2>
                        </label>
                    </td>
                </tr>
                <tr>
                    <th class="contact-item">タグ</th>
                    <td id="input_pluralBox">
                        <div class="agentlist-item_category">
                            <ul>
                                <?php
                                // require(dirname(__FILE__) . "/dbconnect.php");
                                $stmt = $db->prepare('SELECT * FROM agent_tag JOIN agent ON agent.id = agent_tag.agent_id RIGHT JOIN tag ON tag.id = agent_tag.tag_id where agent_name=:name');
                                $stmt->bindValue('name', $cnts['agent_name'], PDO::PARAM_STR);
                                $stmt->execute();
                                $tags = $stmt->fetchAll(); ?>
                                <?php foreach ($tags as $tag) : ?>
                                    <li><?= $tag["tag_name"]; ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th class="contact-item">サービスの手順1</th>
                    <td class="contact-body">
                        <h3><?= $cnts['step1']; ?></h3>
                    </td>
                </tr>
                <tr>
                    <th class="contact-item">サービスの手順2</th>
                    <td class="contact-body">
                        <h3><?= $cnts['step2']; ?></h3>
                    </td>
                </tr>
                <tr>
                    <th class="contact-item">サービスの手順3</th>
                    <td class="contact-body">
                        <h3><?= $cnts['step3']; ?></h3>
                    </td>
                </tr>
                <tr>
                    <th class="contact-item">掲載期限</th>
                    <td class="contact-body">
                        <h3><?= $cnts['deadline']; ?></h3>
                    </td>
                </tr>
            </table>
        </div>
        <!-- <div class="agentlist-item_return">
        <a href="../admin_company/index.html"><button>一覧に戻る</button></a>
    </div>    -->
        </form>
    </section>

    <form action="../client_application/index.php" method="get" class="edit">
        <input type="submit" value="編集" class="submit">
        <input type="hidden" name="agent" value="<?= $agent; ?>">
    </form>
    <script src="script.js"></script>
    <script>
        var ctx2 = document.querySelector(".myRadarChart-uno_<?= $cnts['agent_name']; ?>");
        var myRadarChart = new Chart(ctx2, {
            //グラフの種類
            type: "radar",
            //データの設定
            data: {
                //データ項目のラベル
                labels: ["掲載社数", "内定実績", "スピード", "登録者数", "拠点数"],
                //データセット
                datasets: [{
                    label: "エージェント五段階評価",
                    //背景色
                    backgroundColor: "rgba(45, 205, 98,.4)",
                    //枠線の色
                    borderColor: "rgba(45, 205, 98,1)",
                    //結合点の背景色
                    pointBackgroundColor: "rgba(45, 205, 98,1)",
                    //結合点の枠線の色
                    pointBorderColor: "#fff",
                    //結合点の背景色（ホバ時）
                    pointHoverBackgroundColor: "#fff",
                    //結合点の枠線の色（ホバー時）
                    pointHoverBorderColor: "rgba(200,112,126,1)",
                    //結合点より外でマウスホバーを認識する範囲（ピクセル単位）
                    hitRadius: 5,
                    //グラフのデータ
                    data: [<?php $stmt_shuffle = $db->prepare('select publisher_five from agent where agent_name=:name ');
                            $stmt_shuffle->bindValue('name', $cnts["agent_name"], PDO::PARAM_STR);
                            $stmt_shuffle->execute();
                            $shuffles = $stmt_shuffle->fetchAll();
                            foreach ($shuffles as $shuffle) :
                                echo $shuffle['publisher_five'];
                            endforeach;
                            ?>, <?php $stmt_decison = $db->prepare('select decision_five from agent where agent_name=:name ');
                                $stmt_decison->bindValue('name', $cnts["agent_name"], PDO::PARAM_STR);
                                $stmt_decison->execute();
                                $decisions = $stmt_decison->fetchAll();
                                foreach ($decisions as $decision) :
                                    echo $decision['decision_five'];
                                endforeach;
                                ?>, <?php $stmt_speed = $db->prepare('select speed_five from agent where agent_name=:name ');
                                    $stmt_speed->bindValue('name', $cnts["agent_name"], PDO::PARAM_STR);
                                    $stmt_speed->execute();
                                    $speeds = $stmt_speed->fetchAll();
                                    foreach ($speeds as $speed) :
                                        echo $speed['speed_five'];
                                    endforeach;
                                    ?>, <?php $stmt_regist = $db->prepare('select registstrant_five from agent where agent_name=:name ');
                                        $stmt_regist->bindValue('name', $cnts["agent_name"], PDO::PARAM_STR);
                                        $stmt_regist->execute();
                                        $regists = $stmt_regist->fetchAll();
                                        foreach ($regists as $regist) :
                                            echo $regist['registstrant_five'];
                                        endforeach;
                                        ?>, <?php $stmt_place = $db->prepare('select place_five from agent where agent_name=:name ');
                                            $stmt_place->bindValue('name', $cnts["agent_name"], PDO::PARAM_STR);
                                            $stmt_place->execute();
                                            $places = $stmt_place->fetchAll();
                                            foreach ($places as $place) :
                                                echo $place['place_five'];
                                            endforeach;
                                            ?>],
                }, ],
            },
            options: {
                legend: {
                    labels: {
                        // このフォント設定はグローバルプロパティを上書きします。
                        fontColor: "black",
                    },
                },
                // レスポンシブ指定
                responsive: true,
                scale: {
                    r: {
                        pointLabels: {
                            display: true,
                            centerPointLabels: true,
                        },
                    },
                    ticks: {
                        // 最小値の値を0指定
                        beginAtZero: true,
                        min: 0,
                        // 最大値を指定
                        max: 5,
                    },
                },
            },
        });
    </script>
</body>

</html>