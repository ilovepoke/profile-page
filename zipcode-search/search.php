<?php

// JavaScriptにJSONを返す
header("Content-Type: application/json; charset=UTF-8");

require_once "config.php";

// URLから郵便番号を受け取る
$zipcode = $_GET["zipcode"] ?? "";

// ハイフンを削除
$zipcode = str_replace("-", "", $zipcode);


// 1〜7桁の数字か確認
if (!preg_match("/^[0-9]{1,7}$/", $zipcode)) {

    echo json_encode([
        "success" => false,
        "results" => []
    ], JSON_UNESCAPED_UNICODE);

    exit;
}


// MariaDBに接続
$dsn =
    "mysql:host=localhost;dbname=sampledb;charset=utf8mb4";



try {

    $pdo = new PDO(
        $dsn,
        $dbUsername,
        $dbPassword
    );

    $pdo->setAttribute(
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION
    );


    // 入力された郵便番号で始まるデータを検索
    $sql = "
        SELECT
            code,
            address1,
            address2,
            address3
        FROM zip
        WHERE code LIKE ?
        ORDER BY code
        LIMIT 10
    ";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        $zipcode . "%"
    ]);


    // 検索結果をすべて取得
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);


    $results = [];


    foreach ($rows as $row) {

        $address =
            $row["address1"]
            . $row["address2"]
            . $row["address3"];


        $results[] = [

            "code" =>
                $row["code"],

            "address" =>
                $address
        ];
    }


    // JavaScriptへJSONを返す
    echo json_encode([

        "success" => true,

        "results" =>
            $results

    ], JSON_UNESCAPED_UNICODE);


} catch (PDOException $e) {

    echo json_encode([

        "success" => false,

        "results" => [],

        "error" =>
            $e->getMessage()

    ], JSON_UNESCAPED_UNICODE);

}




