<?php
require_once "config.php";
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>郵便番号検索</title>

    <style>
        #map {
            width: 600px;
            height: 450px;
            border: 0;
            margin-top: 20px;
        }

        #result {
            margin-top: 20px;
        }
    </style>
</head>

<body>

<h1>郵便番号検索</h1>

<label>
    郵便番号：
    <input
        type="text"
        id="zipcode"
        maxlength="7"
        placeholder="9900023"
    >
</label>

<div id="result"></div>

<div id="map-container"></div>


<script>

    // 郵便番号入力欄
    const zipcodeInput =
        document.getElementById("zipcode");

    // 検索結果を表示する場所
    const resultElement =
        document.getElementById("result");

    // Google Mapsを表示する場所
    const mapContainer =
        document.getElementById("map-container");


    // 郵便番号が入力されるたびに実行
    zipcodeInput.addEventListener(
        "input",
        function () {

            // 現在入力されている郵便番号
            const zipcode =
                zipcodeInput.value;


            console.log(
                "入力された郵便番号：",
                zipcode
            );


            // 何も入力されていない場合
            if (zipcode.length === 0) {

                resultElement.innerHTML =
                    "<p>郵便番号を入力してください。</p>";

                mapContainer.innerHTML = "";

                return;
            }


            // 7桁を超えた場合
            if (zipcode.length > 7) {

                resultElement.innerHTML =
                    "<p>郵便番号は7桁までです。</p>";

                mapContainer.innerHTML = "";

                return;
            }


            // search.phpに問い合わせる
            fetch(
                "search.php?zipcode="
                + encodeURIComponent(zipcode)
            )

                // JSONに変換
                .then(function (response) {

                    return response.json();

                })


                // JSONを受け取った後
                .then(function (data) {

                    console.log(
                        "PHPから受け取ったデータ：",
                        data
                    );


                    // 検索結果がない場合
                    if (
                        !data.success ||
                        data.results.length === 0
                    ) {

                        resultElement.innerHTML =
                            "<p>候補が見つかりません。</p>";

                        mapContainer.innerHTML = "";

                        return;
                    }


                    // 候補を表示
                    let html =
                        "<h2>検索候補</h2>";


                    data.results.forEach(
                        function (item) {

                            html +=

                                "<div>" +

                                "<p>" +
                                "<strong>" +
                                item.code +
                                "</strong>" +
                                "<br>" +
                                item.address +
                                "</p>" +

                                "</div>";

                        }
                    );


                    resultElement.innerHTML =
                        html;


                    // 7桁入力された場合だけ
                    // Google Mapsを表示
                    if (zipcode.length === 7) {

                        const address =
                            data.results[0].address;


                        const googleMapsApiKey = <?php echo json_encode($googleMapsApiKey); ?>;

                        const mapUrl =

                            "https://www.google.com/maps/embed/v1/place" +

                            "?key=" +

                            encodeURIComponent(googleMapsApiKey) + 

                            "&q=" +

                            encodeURIComponent(
                                address
                            );


                        mapContainer.innerHTML =

                            '<iframe ' +
                            'id="map" ' +
                            'loading="lazy" ' +
                            'allowfullscreen ' +
                            'src="' +
                            mapUrl +
                            '">' +
                            '</iframe>';

                    } else {

                        // 7桁未満なら地図は消す
                        mapContainer.innerHTML = "";

                    }

                })


                // エラーが発生した場合
                .catch(function (error) {

                    console.error(error);

                    resultElement.innerHTML =
                        "<p>" +
                        "検索中にエラーが発生しました。" +
                        "</p>";

                    mapContainer.innerHTML = "";

                });

        }
    );

</script>

</body>
</html>