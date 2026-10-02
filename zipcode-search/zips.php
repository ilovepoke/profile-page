<?php

require_once "config.php";

// ------------------------------
// 1. URLから郵便番号を受け取る
// ------------------------------
$zipcode = $_GET["zipcode"] ?? "";

// 郵便番号からハイフンを削除
$zipcode = str_replace("-", "", $zipcode);


// ------------------------------
// 2. 郵便番号が入力されている場合だけ検索
// ------------------------------
$result = null;

if ($zipcode !== "") {

    // MariaDB接続情報
    $dsn = "mysql:host=localhost;dbname=sampledb;charset=utf8mb4";

    try {
        // MariaDBに接続
        $pdo = new PDO(
            $dsn,
            $dbUsername,
            $dbPassword
        );

        // SQLでエラーが発生したら例外にする
        $pdo->setAttribute(
            PDO::ATTR_ERRMODE,
            PDO::ERRMODE_EXCEPTION
        );

        // ------------------------------
        // 3. 郵便番号を検索
        // ------------------------------
        $sql = "
            SELECT
                code,
                address1,
                address2,
                address3
            FROM zip
            WHERE code = ?
        ";

        // SQLを準備
        $stmt = $pdo->prepare($sql);

        // ? に郵便番号を入れて実行
        $stmt->execute([$zipcode]);

        // 検索結果を1件取得
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {

        echo "<h1>データベースエラー</h1>";
        echo "<pre>";
        echo htmlspecialchars(
            $e->getMessage(),
            ENT_QUOTES,
            "UTF-8"
        );
        echo "</pre>";
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>郵便番号検索</title>
</head>

<body>

<h1>郵便番号検索</h1>

<form action="zips.php" method="get">

    <label>
        郵便番号：
        <input
            type="text"
            name="zipcode"
            value="<?php echo htmlspecialchars(
                $zipcode,
                ENT_QUOTES,
                "UTF-8"
            ); ?>"
        >
    </label>

    <button type="submit">検索</button>

</form>


<?php if ($zipcode !== ""): ?>

    <hr>

    <?php if ($result !== false && $result !== null): ?>

        <h2>検索結果</h2>

        <p>
            郵便番号：
            <?php echo htmlspecialchars(
                $result["code"],
                ENT_QUOTES,
                "UTF-8"
            ); ?>
        </p>

        <?php

        // 住所を1つの文字列にする
        $address =
            $result["address1"] .
            $result["address2"] .
            $result["address3"];

        ?>

        <p>
            住所：
            <?php echo htmlspecialchars(
                $address,
                ENT_QUOTES,
                "UTF-8"
            ); ?>
        </p>

        <h2>地図</h2>

        <?php

        // Google Maps用に住所をURLエンコード
        $mapAddress = urlencode($address);

        ?>

        <iframe
            width="600"
            height="450"
            style="border:0"
            loading="lazy"
            allowfullscreen
            referrerpolicy="strict-origin-when-cross-origin"
            src="https://www.google.com/maps/embed/v1/place?key=<?php echo urlencode($googleMapsApiKey); ?>&q=<?php echo $mapAddress; ?>"
        >
        </iframe>

    <?php else: ?>

        <p>該当する郵便番号が見つかりませんでした。</p>

    <?php endif; ?>

<?php endif; ?>

</body>
</html>