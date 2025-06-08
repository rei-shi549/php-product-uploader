<?php
// 入力値取得
$n = $_POST["name"];
$p = $_POST["price"];
$fname = $_FILES["f"]["name"];

// 入力チェック
if ($n === "" || $p === "" || $fname === "") {
    print("商品名・単価・画像はすべて入力してください。");
    exit;
}

// 画像ファイルを保存（imagesフォルダに）
$uploadPath = "images/" . $fname;
$check = move_uploaded_file($_FILES["f"]["tmp_name"], $uploadPath);

// 画像保存結果を確認
if (!$check) {
    print("画像アップロード失敗");
    exit;
}

// XMLファイル読み込み
$xml = simplexml_load_file("products.xml");

// XMLに商品情報追加
$product = $xml->addChild("product");
$product->addChild("name", htmlspecialchars($n, ENT_QUOTES, "UTF-8"));
$product->addChild("price", htmlspecialchars($p, ENT_QUOTES, "UTF-8"));
$product->addChild("image", $uploadPath);

// 保存
$xml->asXML("products.xml");

// 完了メッセージ
print("データ登録完了\n");
print("画像アップロード完了");
?>
