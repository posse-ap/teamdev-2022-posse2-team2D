DROP SCHEMA IF EXISTS db_mydb;

CREATE SCHEMA db_mydb;

USE db_mydb;

DROP TABLE IF EXISTS admin;
CREATE TABLE `admin` (
  `id` INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
  `name` VARCHAR(255) UNIQUE NOT NULL,
  `department_name` VARCHAR(255) NOT NULL,
  `tel` VARCHAR(255) UNIQUE NOT NULL,
  `email` VARCHAR(255) UNIQUE NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
INSERT INTO
  `admin` (
    `name`,
    `department_name`,
    `tel`,
    `email`,
    `password`
  )
VALUES
  (
    '秋元 康',
    '人事部',
    '000-1000-0000',
    'boozer@gmail.com',
    sha1('boozer')
  );

-- DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS users;
CREATE TABLE `users` (
  `id` INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
  `user_img` VARCHAR(255) UNIQUE NOT NULL,
  `agent_id` INT NOT NULL,
  `name` VARCHAR(255) UNIQUE NOT NULL,
  `department_name` VARCHAR(255) NOT NULL,
  `tel` VARCHAR(255) UNIQUE NOT NULL,
  `email` VARCHAR(255) UNIQUE NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
INSERT INTO
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
  (
    '秋元真夏',
    '1',
    '秋元真夏',
    '人事部',
    '000-0000-0000',
    'manatsu@gmail.com',
    sha1('manatsu')
  ),
  (
    '賀喜遥香',
    '1',
    '賀喜遥香',
    '人事部',
    '000-0000-0001',
    'haruka@gmail.com',
    sha1('haruka')
  ),
  (
    '林瑠奈',
    '1',
    '林瑠奈',
    '人事部',
    '000-0000-0003',
    'runa@gmail.com',
    sha1('runa')
  ),
  (
    '齋藤飛鳥',
    '2',
    '齋藤飛鳥',
    '人事部',
    '000-0000-0004',
    'asuka@gmail.com',
    sha1('asuka')
  ),
  (
    '鈴木絢音',
    '2',
    '鈴木絢音',
    '人事部',
    '000-0000-0005',
    'ayane@gmail.com',
    sha1('ayane')
  ),
  (
    '岩本蓮加',
    '2',
    '岩本蓮加',
    '人事部',
    '000-0000-0006',
    'renka@gmail.com',
    sha1('renka')
  ),
  (
    '山下美月',
    '3',
    '山下美月',
    '人事部',
    '000-0000-0007',
    'mizuki@gmail.com',
    sha1('mizuki')
  ),
  (
    '掛橋沙耶香',
    '3',
    '掛橋沙耶香',
    '人事部',
    '000-0000-0008',
    'sayaka@gmail.com',
    sha1('sayaka')
  ),
  (
    '柴田柚菜',
    '3',
    '柴田柚菜',
    '人事部',
    '000-0000-0009',
    'yuna@gmail.com',
    sha1('yuna')
  ),
  (
    '梅澤美波',
    '4',
    '梅澤美波',
    '人事部',
    '000-0000-0010',
    'minami@gmail.com',
    sha1('minami')
  ),
  (
    '金川紗耶',
    '4',
    '金川紗耶',
    '人事部',
    '000-0000-0011',
    'saya@gmail.com',
    sha1('saya')
  ),
  (
    '田村真佑',
    '4',
    '田村真佑',
    '人事部',
    '000-0000-0012',
    'mayu@gmail.com',
    sha1('mayu')
  ),
  (
    '与田祐希',
    '5',
    '与田祐希',
    '人事部',
    '000-0000-0013',
    'yuki@gmail.com',
    sha1('yuki')
  ),
  (
    '佐藤楓',
    '5',
    '佐藤楓',
    '人事部',
    '000-0000-0014',
    'kaede@gmail.com',
    sha1('kaede')
  ),
  (
    '阪口珠美',
    '5',
    '阪口珠美',
    '人事部',
    '000-0000-0015',
    'tamtami@gmail.com',
    sha1('tamami')
  ),
  (
    '遠藤さくら',
    '6',
    '遠藤さくら',
    '人事部',
    '000-0000-0016',
    'sakura@gmail.com',
    sha1('sakura')
  ),
  (
    '清宮レイ',
    '6',
    '清宮レイ',
    '人事部',
    '000-0000-0017',
    'rei@gmail.com',
    sha1('rei')
  ),
  (
    '菅原咲月',
    '6',
    '菅原咲月',
    '人事部',
    '000-0000-0018',
    'satsuki@gmail.com',
    sha1('satsuki')
  ),
  (
    '久保史緒里',
    '7',
    '久保史緒里',
    '人事部',
    '000-0000-0019',
    'shiori@gmail.com',
    sha1('shiori')
  ),
  (
    '筒井あやめ',
    '7',
    '筒井あやめ',
    '人事部',
    '000-0000-0020',
    'ayame@gmail.com',
    sha1('ayame')
  ),
  (
    '早川聖来',
    '7',
    '早川聖来',
    '人事部',
    '000-0000-0021',
    'seira@gmail.com',
    sha1('seira')
  ),
  (
    '井上和',
    '8',
    '井上和',
    '人事部',
    '000-0000-0022',
    'nagi@gmail.com',
    sha1('nagi')
  ),
  (
    '五百城茉央',
    '9',
    '五百城茉央',
    '人事部',
    '000-0000-0023',
    'mao@gmail.com',
    sha1('mao')
  );

DROP TABLE IF EXISTS apply_info;
CREATE TABLE `apply_info` (
  `id` INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
  `name` VARCHAR(225) NOT NULL,
  `kana` VARCHAR(225) NOT NULL,
  `tel` VARCHAR(225) NOT NULL,
  `email` VARCHAR(225) NOT NULL,
  `college` VARCHAR(225) NOT NULL,
  `faculty` VARCHAR(225) NOT NULL,
  `graduate_year` VARCHAR(225) NOT NULL,
  `adress` VARCHAR(225) NOT NULL,
  `free` VARCHAR(225) NOT NULL,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
INSERT INTO
  `apply_info` (
    `name`,
    `kana`,
    `tel`,
    `email`,
    `college`,
    `faculty`,
    `graduate_year`,
    `adress`,
    `free`
  )
VALUES
  (
    '大野智',
    'オオノサトシ',
    '000-0001-0000',
    'satoshioono@gmail.com',
    '慶應義塾大学',
    '理工学部',
    '23卒',
    '東京都港区',
    ''
  ),
  (
    '櫻井翔',
    'サクライショウ',
    '000-0002-0000',
    'shousakurai@gmail.com',
    '慶應義塾大学',
    '経済学部',
    '24卒',
    '群馬県前橋市',
    ''
  ),
  (
    '松本潤',
    'マツモトジュン',
    '000-0003-0000',
    'jyunmatumoto@gmail.com',
    '早稲田大学',
    '法学部',
    '23卒',
    '東京都葛飾区',
    ''
  ),
  (
    '二宮和也',
    'ニノミヤカズナリ',
    '000-0004-0000',
    'kazunarininomiya@gmail.com',
    '早稲田大学',
    '商学部',
    '25卒',
    '東京都新宿区',
    ''
  ),
  (
    '相葉雅紀',
    'アイバマサキ',
    '000-0005-0000',
    'masakiaiba@gmail.com',
    '千葉大学',
    '経済学部',
    '25卒',
    '千葉県千葉市',
    ''
  ),
  (
    '中居正広',
    'ナカイマサヒロ',
    '000-0006-0000',
    'masahironakai@gmail.com',
    '青山学院大学',
    '法学部',
    '24卒',
    '神奈川県横浜市',
    ''
  ),
  (
    '木村拓哉',
    'キムラタクヤ',
    '000-0007-0000',
    'takuyakimura@gmail.com',
    '上智大学',
    '商学部',
    '23卒',
    '東京都渋谷区',
    ''
  ),
  (
    '香取慎吾',
    'カトリシンゴ',
    '000-0008-0000',
    'singokatori@gmai.com',
    '法政大学',
    '理工学部',
    '23卒',
    '神奈川県川崎市',
    ''
  ),
  (
    '稲垣吾郎',
    'イナガキゴロウ',
    '000-0009-0000',
    'gorouinagaki@gmail.com',
    '立教大学',
    '文学部',
    '25卒',
    '東京都板橋区',
    ''
  ),
  (
    '草彅剛',
    'クサナギツヨシ',
    '000-0010-0000',
    'tuyoshikusanagi@gmail.com',
    '中央大学',
    '医学部',
    '23卒',
    '北海道札幌市',
    ''
  );

DROP TABLE IF EXISTS userpassreset;

CREATE TABLE `userpassreset` (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `token` TEXT NOT NULL,
  `mail` TEXT NOT NULL,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

DROP TABLE IF EXISTS agent;

CREATE TABLE `agent` (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `agent_name` TEXT NOT NULL,
  `link` TEXT NOT NULL,
  `image` TEXT NOT NULL,
  `publisher_five` INT NOT NULL,
  `decision_five` INT NOT NULL,
  `speed_five` INT NOT NULL,
  `registstrant_five` INT NOT NULL,
  `place_five` INT NOT NULL,
  `publisher` INT NOT NULL,
  `decision` INT NOT NULL,
  `speed` INT NOT NULL,
  `registstrant` INT NOT NULL,
  `place` INT NOT NULL,
  `main` TEXT NOT NULL,
  `sub` TEXT NOT NULL,
  `step1` TEXT NOT NULL,
  `step2` TEXT NOT NULL,
  `step3` TEXT NOT NULL,
  `mail` TEXT NOT NULL,
  `tel` TEXT NOT NULL,
  `apeal1` TEXT NOT NULL,
  `apeal1_content` TEXT NOT NULL,
  `apeal2` TEXT NOT NULL,
  `apeal2_content` TEXT NOT NULL,
  `deadline` TEXT NOT NULL
);

INSERT INTO
  `agent` (
    `agent_name`,
    `link`,
    `image`,
    `publisher_five`,
    `decision_five`,
    `speed_five`,
    `registstrant_five`,
    `place_five`,
    `publisher`,
    `decision`,
    `speed`,
    `registstrant`,
    `place`,
    `main`,
    `sub`,
    `step1`,
    `step2`,
    `step3`,
    `mail`,
    `tel`,
    `apeal1`,
    `apeal1_content`,
    `apeal2`,
    `apeal2_content`,
    `deadline`
  )
VALUES
  (
    'マイナビ',
    'https://shinsotsu.mynavi-agent.jp/',
    'マイナビ',
    2,
    3,
    4,
    5,
    1,
    30000,
    50000,
    2,
    100000,
    8,
    '就活はひとりじゃない、ともに進む就活',
    '就活サイトでは掲載されてない求人',
    '一歩目',
    '二歩目',
    '三歩目',
    'mynabi@co.jp',
    '0120-500-500',
    'キャリアアドバイザーと二人三脚で就活に勝つ',
    '膨大な情報量の中から、自分に必要な情報だけを ピックアップするのは難しいもの。 それぞれ専門知識のあるキャリアアドバイザーが、 効率的な就活を皆さまに合わせたサポートをさせて いただきます。',
    'キャリアアドバイザーと二人三脚で就活に勝つ',
    'マイナビ新卒紹介では、マイナビなど就職情報 サイトには公開されていない、非公開求人を中心に ご紹介します。 マイナビ新卒紹介からしか受けられない求人も 多数ありますので、積極的に活用してください。',
    '2030-04-30'
  ),
  (
    'ミーツカンパニー',
    'https://discussion.meetscompany.jp/344/?_rt_ck=2656.220505141599&fpc=20.4.365.c0559287e943106n.1685368793000',
    'ミーツカンパニー',
    5,
    4,
    3,
    4,
    2,
    30000,
    50000,
    2,
    100000,
    8,
    '就活はひとりじゃない、ともに進む就活',
    '就活サイトでは掲載されてない求人',
    '会員登録',
    '面談',
    '選考支援',
    'meetscompany@meet.com',
    '000-0000-0000',
    'Meets Company限定の特別選考もあり',
    '求人企業の採用担当や社長と直接交渉ができるから、通常とは異なるルートで選考に進めます！なんと一次面接から社長と面接ができるフローなどもございます。',
    '二人三脚で内定までサポート',
    '希望条件や、就職に対する不安など、どんなことでもお話ください。プロのエージェントによる企業紹介や個別面談などを通じ、企業との最適なマッチングを目指します。',
    '2030-04-30'
  ),
  (
    'キャリアチケット',
    'https://careerticket.jp/lp/340aa/00/00/00/?a=TY1AL5RE20LA0&affnmsid=294c0a924d785f8a02a11ea215e5d6568c82743f&trflg=1',
    'キャリアチケット',
    5,
    5,
    3,
    5,
    3,
    80000,
    60000,
    3,
    200000,
    10,
    '6月中に 内定が欲しいあなたへ',
    '受けるのは、 自分に合う数社だけ。',
    '初回面接',
    '資料送付',
    '選考支援',
    'careerticket@career.com',
    '000-1111-2222',
    '話すだけで、 あなたに合う企業がわかる',
    '合う企業を見つけるため、まずはあなたにヒアリング。 年間1万人以上をサポートするアドバイザーだから、 あなたの良さをしっかり理解してくれます。',
    'あなたの魅力が 伝わるようになる',
    '専任アドバイザーが、あなたの強み、選考先に合わせて 1社ずつ選考対策。人事に刺さる"伝え方"をアドバイザーが しっかりと教えてくれます。 対策後の内定率は39%もUP！',
    '2030-04-30'
  ),
  (
    'イロダスサロン',
    'https://irodas.com/lp/irodassalon/202301test/?_rt_ck=6545.220505142108',
    'イロダスサロン',
    2,
    3,
    1,
    5,
    4,
    20000,
    15000,
    11,
    90000,
    15,
    'いい会社じゃなく、いい人生に出逢える場所',
    'コミュニティ型就活支援サービス',
    '簡単登録',
    '面談',
    '就活支援',
    'irodas@irodas.com',
    '000-1111-0000',
    'キャリア講座・面談の満足度95%',
    'irodasSALON(イロダスサロン)では、10種以上のキャリア講座・メンター面談を就活生へ提供しています。その講座・面談が高く評価され、95%以上の満足度をいただいております。さらに、利用ユーザーの75%が「友人に紹介したい」と答えています。',
    'プロのアドバイザーによる就活サポート',
    'irodasSALONでは、キャリアメンターが就活生の自己分析や選考対策のサポート、一人ひとりに合った企業のご紹介を行っています。',
    '2030-04-30'
  ),
  (
    'キャリセン就活',
    'https://careecen-shukatsu-agent.com/lp/mendan/?utm_campaign=af_rentracks&_rt_ck=2696.220505142258',
    'キャリセン就活',
    2,
    5,
    1,
    5,
    1,
    20000,
    60000,
    9,
    300000,
    3,
    '「プロの視点」で始める就活支援サービス',
    '実績があるからあなたに合った企業をご紹介',
    '無料相談予約',
    'web面談',
    '応募・選考',
    'careecen@careecen.com',
    '000-3333-5555',
    '自己PR、強みがわからない',
    'あなたの経験を元に客観性も交えながら答えに導きます',
    '自分に合った企業が分からない',
    '企業のホンネを熟知しているので、あなたの適性にあった企業を紹介できます',
    '2030-04-30'
  ),
  (
    'doda',
    'https://doda-student.jp/',
    'doda',
    4,
    4,
    3,
    5,
    2,
    40000,
    50000,
    3,
    150000,
    7,
    '見つけた！私にとっての「No.1企業」',
    '丁寧なカウンセリングであなたの強みや適性を明確に！',
    'カウンセリング',
    '企業紹介',
    '面談対策',
    'doda@doda.com',
    '000-2222-9999',
    '強み・志向性などを明確にする内定支援カウンセリング！',
    'あなたに一番合った企業を紹介できるよう専任のキャリアアドバイザーが丁寧にヒアリング。入社したい企業を決めるうえで一番大切な「就職の軸」を明らかにします。',
    'プロが厳選した優良企業・成長企業が5500社以上！',
    'doda新卒エージェントがプロの視点で見極めた優良・成長企業が5500社以上も。あなたに一番合った就職先がきっと見つかります！',
    '2030-04-30'
  ),
  (
    'リクナビ',
    'http://job.rikunabi.com/agent/',
    'リクナビ',
    4,
    2,
    1,
    5,
    5,
    50000,
    20000,
    5,
    500000,
    20,
    '就活は専任アドバイザーと。',
    '一緒に見つけよう、働きたい会社を',
    '登録',
    '面談',
    '業界研究',
    'rikunabi@rikunabi.com',
    '000-2222-2222',
    'リクナビとの違い',
    'あなたが受けるべき求人を専任のアドバイザーが直接ご紹介するのがリクナビ就職エージェントです。',
    'リクナビ就職エージェントに登録すると・・・',
    'あなたの志向・価値観に合った企業を直接ご紹介。面接アドバイスや履歴書添削が何度でも可能。履歴書１枚で複数の企業にエントリーが可能。',
    '2030-04-30'
  ),
  (
    'Jobspring',
    'https://jobspring.jp/lp/05/180?a8=XBn2FB_Js5v7ycfw0bvYLcHKzJVEo5oN_bvBMwSw8ITJs5nBp5vYv5vXp5V8H8PoLIZwf1nKLBn2is00000019112001',
    'Jobspring',
    2,
    4,
    1,
    5,
    3,
    10000,
    40000,
    9,
    90000,
    12,
    '就活に跳躍を。',
    'イマドキ就活を飛び越える「バネ」が、あなたには必要だ。',
    '申し込み',
    '初回面談',
    '選考支援',
    'jobsprings@co.jp',
    '000-3333-3333',
    '自己理解を深める徹底的なカウンセリング',
    'これまでを振り返り、個々の志向・価値観の明確化を行います。今のあなたの根源とも言える原体験から、将来の活躍を見据えたビジョンの具体化等、ご自身の本質を言語化できるまで、徹底的に向き合います。',
    'エントリーから入社まで包括サポート',
    '当社のサポート領域は、エントリー～入社までの全ての期間に適応します。初回カウンセリングの結果を経て、まずは会社説明会のご案内をさせていただきます。',
    '2030-04-30'
  ),
  (
    'DigUpCarrer',
    'https://nas-inc.co.jp/lp/digupcareer/syukatuman.html',
    'DigUpCarrer',
    2,
    2,
    4,
    5,
    4,
    10000,
    20000,
    2,
    800000,
    18,
    'あなたらしく働ける企業を幅広くご紹介',
    '寄り添い型で支援が手厚い就活エージェント',
    '申し込み',
    '初回面談',
    '内定支援',
    'digupcarrer@co.jp',
    '000-3333-4445',
    '選考対策＆面談後フォロー',
    '万全の体制で選考に臨めるように、ES添削や面接練習までフルサポート。面接後は企業からのフィードバックも知ることが出来るため、今後の選考にも活かせます。',
    'オンライン面談',
    '当日の面談は担当のアドバイザーとZoomにてオンライン面談を実施します。面談予約から面談後のフォローもLINEにてやり取りさせていただきます。ご相談などお気軽にお申し付けください。',
    '2030-04-30'
  );

DROP TABLE IF EXISTS `tag`;

CREATE TABLE `tag` (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `tag_name` TEXT NOT NULL
);

INSERT INTO
  `tag` (`tag_name`)
VALUES
  ('オンライン'),
  ('対面'),
  ('対面・オンライン'),
  ('面接対策'),
  ('非公開求人'),
  ('1on1'),
  ('ES添削'),
  ('IT'),
  ('マスコミ'),
  ('商社'),
  ('金融'),
  ('外資'),
  ('総合'),
  ('スタートアップ'),
  ('ベンチャー'),
  ('大手');

CREATE TABLE `agent_tag` (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `agent_id` INT NOT NULL,
  `tag_id` INT NOT NULL
);
INSERT INTO
  `agent_tag` (`agent_id`, `tag_id`)
VALUES
  ('1', '1'),
  ('1', '4'),
  ('1', '9'),
  ('1', '15'),
  ('2', '2'),
  ('2', '4'),
  ('2', '12'),
  ('2', '14'),
  ('3', '3'),
  ('3', '6'),
  ('3', '10'),
  ('3', '11'),
  ('3', '12'),
  ('4', '3'),
  ('4', '5'),
  ('4', '8'),
  ('4', '14'),
  ('5', '2'),
  ('5', '7'),
  ('5', '10'),
  ('5', '15'),
  ('6', '1'),
  ('6', '4'),
  ('6', '10'),
  ('6', '13'),
  ('6', '15'),
  ('7', '2'),
  ('7', '5'),
  ('7', '10'),
  ('7', '11'),
  ('7', '12'),
  ('8', '2'),
  ('8', '0'),
  ('8', '15'),
  ('9', '3'),
  ('9', '5'),
  ('9', '12'),
  ('9', '14');

CREATE TABLE `agent_user` (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `agent_id` INT NOT NULL,
  `user_id` INT NOT NULL
);
INSERT INTO
  `agent_user` (`agent_id`, `user_id`)
VALUES
  ('2', '1'),
  ('1', '1'),
  ('3', '2'),
  ('4', '2'),
  ('5', '3'),
  ('6', '3'),
  ('7', '4'),
  ('8', '4'),
  ('9', '4'),
  ('1', '5'),
  ('3', '5'),
  ('5', '5'),
  ('7', '5'),
  ('9', '5'),
  ('2', '6'),
  ('4', '6'),
  ('6', '6'),
  ('8', '6'),
  ('3', '7'),
  ('6', '7'),
  ('9', '7'),
  ('1', '8'),
  ('4', '8'),
  ('7', '8'),
  ('2', '9'),
  ('5', '9'),
  ('8', '9'),
  ('7', '10'),
  ('2', '10'),
  ('1', '10'),
  ('5', '10'),
  ('3', '10'),
  ('4', '10'),
  ('8', '10'),
  ('6', '10'),
  ('9', '10');

  DROP TABLE IF EXISTS edit_agent;

CREATE TABLE `edit_agent` (
  `edit_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `id` INT NOT NULL,
  `agent_name` TEXT NOT NULL,
  `link` TEXT NOT NULL,
  `image` TEXT NOT NULL,
  `publisher_five` INT NOT NULL,
  `decision_five` INT NOT NULL,
  `speed_five` INT NOT NULL,
  `registstrant_five` INT NOT NULL,
  `place_five` INT NOT NULL,
  `publisher` INT NOT NULL,
  `decision` INT NOT NULL,
  `speed` INT NOT NULL,
  `registstrant` INT NOT NULL,
  `place` INT NOT NULL,
  `main` TEXT NOT NULL,
  `sub` TEXT NOT NULL,
  `step1` TEXT NOT NULL,
  `step2` TEXT NOT NULL,
  `step3` TEXT NOT NULL,
  `mail` TEXT NOT NULL,
  `tel` TEXT NOT NULL,
  `apeal1` TEXT NOT NULL,
  `apeal1_content` TEXT NOT NULL,
  `apeal2` TEXT NOT NULL,
  `apeal2_content` TEXT NOT NULL,
  `deadline` TEXT NOT NULL
);

DROP TABLE IF EXISTS `edit_tag`;

CREATE TABLE `edit_tag` (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `tag_name` TEXT NOT NULL
);

DROP TABLE IF EXISTS `edit_agent_tag`;

CREATE TABLE `edit_agent_tag` (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `agent_id` INT NOT NULL,
  `tag_id` INT NOT NULL
);