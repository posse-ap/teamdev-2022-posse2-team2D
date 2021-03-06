<?php
ini_set('display_errors', 1);
require(dirname(__FILE__) . "/dbconnect.php");
session_name("admin");
session_start();
if (isset($_GET['btn_logout'])) {
    unset($_SESSION['user_id']);
    unset($_SESSION['time']);
}

$error = [];

if (isset($_SESSION['user_id']) && $_SESSION['time'] + 60 * 60 * 24 > time()) {
    $_SESSION['time'] = time();

    if (!empty($_POST)) {
        if (isset($_POST['agency_name'])) {
            $path = '../../client/img/';
            $agent_name = $_POST['agent_name'];
            $agency_name = $_POST['agency_name'];
            $agency_Tel = $_POST['agency_Tel'];
            $agency_mail = $_POST['agency_mail'];
            $department_name = $_POST['department_name'];
            $pas = $_POST['password'];
            $pas_check = $_POST['password_check'];
            $stmt = $db->prepare('SELECT count(*) from users where password=?');
            $stmt->bindValue(1, sha1($pas), PDO::PARAM_STR);
            $stmt->execute();
            $exist = $stmt->fetch(PDO::FETCH_ASSOC);

            $stmt = $db->prepare(
                "SELECT 
                    *
                FROM 
                    agent
                WHERE
                    agent_name=?"
            );
            $stmt->bindValue(1, $_POST['agent_name'], PDO::PARAM_STR);
            $stmt->execute();
            $agent_info = $stmt->fetch();
            // var_dump($agent_info);

            // ファイルがアップロードされているかと、POST通信でアップロードされたかを確認
            if (!empty($_FILES['img']['tmp_name']) && is_uploaded_file($_FILES['img']['tmp_name'])) {

                // ファイルを指定したパスへ保存する
                move_uploaded_file($_FILES['img']['tmp_name'], $path . $agency_name . '.png');

                if (intval($exist['count(*)'] == 0)) {
                    if ($pas == $pas_check) {
                        $stmt = $db->prepare(
                            'INSERT INTO 
                                    `users` (
                                    `user_img`,
                                    `agent_id`,
                                    `name`,
                                    `department_name`,
                                    `tel`,
                                    `email`,
                                    `password`
                                ) 
                            VALUES
                                (?,?,?,?,?,?,?)
                            '
                        );
                        $stmt->bindValue(1, $agency_name, PDO::PARAM_STR);
                        $stmt->bindValue(2, $agent_info['id'], PDO::PARAM_STR);
                        $stmt->bindValue(3, $agency_name, PDO::PARAM_STR);
                        $stmt->bindValue(4, $department_name, PDO::PARAM_STR);
                        $stmt->bindValue(5, $agency_Tel, PDO::PARAM_STR);
                        $stmt->bindValue(6, $agency_mail, PDO::PARAM_STR);
                        $stmt->bindValue(7, sha1($pas), PDO::PARAM_STR);
                        $stmt->execute();
                        header('Location: http://' . $_SERVER['HTTP_HOST'] . '/admin/admin_submit/index.php');
                        exit();
                    } else {
                        echo '確認用と一致しませんでした、もう一度担当者情報をご記入ください';
                        $error['change'] = 'no_check'; ?>
<?php
                    }
                } else {
                    echo 'このパスワードはすでに使われております。もう一度担当者情報をご記入ください';
                    $error['change'] = 'no_one';
                }
            } else {
                exit();
            }
        }

        // header('Location: http://' . $_SERVER['HTTP_HOST'] . '/admin/admin_submit/index.php');
        // exit();
    } else {
        $_SESSION['tags'] = [];
    }
} else {
    header('Location: http://' . $_SERVER['HTTP_HOST'] . '/admin/login.php');
    exit();
}

$cnt_tag = $db->prepare('select * from tag');
$cnt_tag->execute();
$alltags = $cnt_tag->fetchAll();

$agent_stmt = $db->prepare("SELECT * FROM agent ");
$agent_stmt->execute();
$agents = $agent_stmt->fetchAll();


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
<bod>
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
                <li><a href="../admin_company/index.php">企業管理</a></li>
                <li><a class="page_focus" href="../admin_submit/index.php">新規エージェンシー</a></li>
            </ul>
        </div>
    </header>

    <div class="page to-cart">
        <p>
            <a href="../top.php">トップ</a>
            <span>></span>
            <span class="page_current">企業情報登録</span>
        </p>
    </div>

    <div class="page_change">
        <button onclick="change_agent()">企業情報を登録</button>
        <button onclick="change_agency()">担当者情報を登録</button>
    </div>

    <section>
        <form action="insert.php" method="post" enctype="multipart/form-data">
            <div id="agent">
                <h2>企業情報登録</h2>
                <form action="">
                    <table class="contact-table">
                        <tr>
                            <th class="contact-item">企業名</th>
                            <td class="contact-body">
                                <input placeholder="企業名(正式名称)" type="text" name="names" class="form-text" />
                            </td>
                        </tr>
                        <tr>
                            <th class="contact-item">企業画像ファイル</th>
                            <td class="contact-body">
                                <input id="inputFile2" name="img" type="file" accept="image/jpeg, image/png" required />
                                <!-- <input type="text" name="image" class="form-text" /> -->
                            </td>
                        </tr>
                        <tr>
                            <th class="contact-item">公式サイトurl</th>
                            <td class="contact-body">
                                <input placeholder="http://" type="text" name="link" class="form-text" />
                            </td>
                        </tr>
                        <tr>
                            <th class="contact-item">内定実績（○○社）</th>
                            <td class="contact-body">
                                <input placeholder="0" type="text" name="decision" class="form-text" />
                            </td>
                        </tr>
                        <tr>
                            <th class="contact-item">掲載社数（○○社）</th>
                            <td class="contact-body">
                                <input placeholder="0" type="text" name="publisher" class="form-text" />
                            </td>
                        </tr>
                        <tr>
                            <th class="contact-item">内定最短（○○週間）</th>
                            <td class="contact-body">
                                <input placeholder="0" type="text" name="speed" class="form-text" />
                            </td>
                        </tr>
                        <tr>
                            <th class="contact-item">登録者数（○○人）</th>
                            <td class="contact-body">
                                <input placeholder="0" type="text" name="registstrant" class="form-text" />
                            </td>
                        </tr>
                        <tr>
                            <th class="contact-item">拠点数（○○個）</th>
                            <td class="contact-body">
                                <input placeholder="0" type="text" name="place" class="form-text" />
                            </td>
                        </tr>
                        <tr>
                            <th class="contact-item">見出し</th>
                            <td class="contact-body">
                                <input type="text" name="main" class="form-text" />
                            </td>
                        </tr>
                        <tr>
                            <th class="contact-item">小見出し</th>
                            <td class="contact-body">
                                <input type="text" name="sub" class="form-text" />
                            </td>
                        </tr>
                        <tr>
                            <th class="contact-item">サービスの手順1</th>
                            <td class="contact-body">
                                <input type="text" name="step1" class="form-text" />
                            </td>
                        </tr>
                        <tr>
                            <th class="contact-item">サービスの手順2</th>
                            <td class="contact-body">
                                <input type="text" name="step2" class="form-text" />
                            </td>
                        </tr>
                        <tr>
                            <th class="contact-item">サービスの手順3</th>
                            <td class="contact-body">
                                <input type="text" name="step3" class="form-text" />
                            </td>
                        </tr>
                        <tr>
                            <th class="contact-item">掲載期限</th>
                            <td class="contact-body">
                                <input placeholder="2000-10-10" type="text" name="deadline" class="form-text" />
                            </td>
                        </tr>
                        <tr>
                            <th class="contact-item">メールアドレス</th>
                            <td class="contact-body">
                                <input placeholder="sample@sample.com" type="text" name="mail" class="form-text" />
                            </td>
                        </tr>
                        <tr>
                            <th class="contact-item">電話番号</th>
                            <td class="contact-body">
                                <input placeholder="090-0123-4567" type="text" name="tel" class="form-text" />
                            </td>
                        </tr>
                        <tr>
                            <th class="contact-item">アピールポイント1（タイトル）</th>
                            <td class="contact-body">
                                <input type="text" name="apeal1" class="form-text" />
                            </td>
                        </tr>
                        <tr>
                            <th class="contact-item">アピールポイント1</th>
                            <td class="contact-body">
                                <input type="text" name="apeal1_content" class="form-text" />
                            </td>
                        </tr>
                        <tr>
                            <th class="contact-item">アピールポイント2（タイトル）</th>
                            <td class="contact-body">
                                <input type="text" name="apeal2" class="form-text" />
                            </td>
                        </tr>
                        <tr>
                            <th class="contact-item">アピールポイント2</th>
                            <td class="contact-body">
                                <input type="text" name="apeal2_content" class="form-text" />
                            </td>
                        </tr>
                        <tr>
                            <th class="contact-item">タグ</th>
                            <td class="contact-body">
                                <div>
                                    <button onclick="modal_open()" type="button">+</button>
                                    <ul id="tagList"></ul>
                                    <!-- <ul>
                                        <?php foreach ($_SESSION['tags'] as $tag) : ?>
                                            <li><?= $tag ?></li>
                                            <input type="hidden" name="selected_tag[]" value="<?= $tag ?>" class="form-text" />
                                        <?php endforeach; ?>
                                    </ul> -->
                                </div>
                            </td>
                        </tr>
                        <!-- <tr>
                            <th class="contact-item">タグ</th>
                            <td id="input_pluralBox">
                                <div id="input_plural">
                                    <div class="cp_ipselect form-control">
                                        <select name="tag[]" id="tag">
                                            <?php foreach ($alltags as $alltag) :
                                                $alltag['tag_name'] == $tag['tag_name'] ?
                                                    $select = 'selected' : $select = '';
                                            ?>
                                                <option value="<?= $alltag['tag_name']; ?>" <?= $select; ?>><?= $alltag['tag_name']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <span class="cp_sl02_highlight"></span>
                                    <span class="cp_sl02_selectbar"></span>
                                    <input type="button" value="＋" class="add pluralBtn">
                                    <input type="button" value="－" class="del pluralBtn">
                                    <p class="error">※カテゴリは5個までです</p>
                                </div>
                            </td>
                        </tr> -->
                    </table>
                    <div class="submit_section">
                        <input class="contact-submit" type="submit" value="送信" />
                    </div>
                </form>
            </div>
            <form id="modal" class="modal" onSubmit="return false;">
                <button id="cancel_btn" class="cancel" type="button" onclick="cancel()">×</button>
                <div class="modal_content">
                    <section class="modal_left">
                        <h2>タグを選択してください</h2>
                        <div class="submit__form__item">
                            <dt class="modal_title">サービス内容</dt>
                            <dd class="check_flex">
                                <?php for ($i = 0; $i <= 5; $i++) { ?>
                                    <input type="checkbox" name="tag[]" value="<?= $alltags[$i]['tag_name'] ?>" id="check<?= $i ?>" class="check" <?=
                                                                                                                                                    in_array($alltags[$i]['tag_name'], $_SESSION['tags']) ? 'checked' : ''

                                                                                                                                                    ?>>
                                    <label for="check<?= $i ?>" class="check_2"></label>
                                    <label for="check<?= $i ?>" class="check_1"><?= $alltags[$i]['tag_name'] ?></label>
                                <?php } ?>
                            </dd>
                        </div>
                        <div class="submit__form__item">
                            <dt class="modal_title">得意分野</dt>
                            <dd class="check_flex">
                                <?php for ($i = 6; $i <= 11; $i++) { ?>
                                    <input type="checkbox" name="tag[]" value="<?= $alltags[$i]['tag_name'] ?>" id="check<?= $i ?>" class="check" <?= in_array($alltags[$i]['tag_name'], $_SESSION['tags']) ? 'checked' : '' ?>>
                                    <label for="check<?= $i ?>" class="check_2"></label>
                                    <label for="check<?= $i ?>" class="check_1"><?= $alltags[$i]['tag_name'] ?></label>
                                <?php } ?>
                                <br>
                                <?php for ($i = 12; $i <= 14; $i++) { ?>
                                    <input type="checkbox" name="tag[]" value="<?= $alltags[$i]['tag_name'] ?>" id="check<?= $i ?>" class="check" <?= in_array($alltags[$i]['tag_name'], $_SESSION['tags']) ? 'checked' : '' ?>>
                                    <label for="check<?= $i ?>" class="check_2"></label>
                                    <label for="check<?= $i ?>" class="check_1"><?= $alltags[$i]['tag_name'] ?></label>
                                <?php } ?>
                            </dd>
                        </div>
                    </section>
                </div>

                <div class="submit__form__footer">
                    <button id="button1" class="submit__form__button">確定</button>
                </div>

            </form>





            <div id="agency">
                <h2>担当者情報登録</h2>
                <form method="POST" action="../admin_submit/index.php" enctype="multipart/form-data">
                    <?php if (isset($error['change']) && $error['change'] == 'no_one') : ?>
                        <h1>このパスワードはすでに使われております</h1>
                    <?php endif; ?>
                    <?php if (isset($error['change']) && $error['change'] == 'no_check') : ?>
                        <h1>確認用と一致しませんでした</h1>
                    <?php endif; ?>
                    <table class="contact-table">
                        <tr>
                            <th class="contact-item">企業名</th>
                            <td class="contact-body">
                                <select class="select-text" name="agent_name" size="1">
                                    <option class="option_c" label="企業名を選択" selected></option>
                                    <?php foreach ($agents as $key => $agent) { ?>
                                        <option><span><?php echo $agent["agent_name"] ?></span></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th class="contact-item">担当者氏名</th>
                            <td class="contact-body">
                                <!-- 変更 -->
                                <input placeholder="漢字フルネーム（スペースなし）" type="text" name="agency_name" class="form-text" required />
                            </td>
                        </tr>
                        <tr>
                            <th class="contact-item">部署名</th>
                            <td class="contact-body">
                                <input placeholder="○○部" type="text" name="department_name" class="form-text" required />
                            </td>
                        </tr>
                        <tr>
                            <th class="contact-item">担当者Tel</th>
                            <td class="contact-body">
                                <input placeholder="090-0123-4567" type="tel" name="agency_Tel" class="form-text" required />
                            </td>
                        </tr>
                        <tr>
                            <th class="contact-item">担当者mail</th>
                            <td class="contact-body">
                                <input placeholder="sample@sample.com" type="mail" name="agency_mail" class="form-text" required />
                            </td>
                        </tr>
                        <tr>
                            <th class="contact-item">画像ファイル</th>
                            <td class="contact-body">
                                <!-- <img id="preview1" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="> -->
                                <input id="inputFile" name="img" type="file" accept="image/jpeg, image/png" required />
                            </td>
                        </tr>
                        <tr>
                            <th class="contact-item">パスワード</th>
                            <td class="contact-body">
                                <input placeholder="password" type="password" name="password" class="form-text" required />
                            </td>
                        </tr>
                        <tr>
                            <th class="contact-item">パスワード<br>(確認用)</th>
                            <td class="contact-body">
                                <input placeholder="password(確認用)" type="password" name="password_check" class="form-text" required />
                            </td>
                        </tr>
                    </table>
                    <input class="contact-submit" type="submit" value="送信" />
                </form>
            </div>
    </section>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="script.js"></script>
    <script>
        $(function() {
            $("#button1").click(function() {
                $.ajax({
                        url: "testform.php",
                        type: "POST",
                        data: $("#modal").serialize(),
                        dataType: "json",
                        timespan: 1000,
                    })
                    .done(function(data1, textStatus, jqXHR) {
                        $("#tagList").empty();
                        console.log(data1); // 登録しました

                        $.each(data1, function(index, value) {
                            $("#tagList").append('<li>' + value + '</li>' + '<input type="hidden" name="selected_tag[]" value="' + value + '"/>');
                        })
                    })
                    .fail(function(jqXHR, textStatus, errorThrown) {
                        console.log(jqXHR.status); //例：404
                        console.log(textStatus); //例：error
                        console.log(errorThrown); //例：NOT FOUND
                    })
                    .always(function() {
                        // console.log("complete");
                    });
                // event.preventDefault();
                modal.style.display = 'none';
            });
        });
    </script>
    </body>

</html>