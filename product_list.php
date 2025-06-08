<?php
    $xmlFile = "products.xml";
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>商品一覧</title>
<style>
body {
    font-family: sans-serif;
    background-color: #f4f8fc;
    padding: 2em;
}
h2 {
    text-align: center;
    color: #333;
}
table {
    border-collapse: collapse;
    width: 90%;
    max-width: 800px;
    margin: 20px auto;
    background: #fff;
    border: 1px solid #ccc;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}
th, td {
    border: 1px solid #ddd;
    padding: 1em;
    text-align: center;
}
th {
    background-color: #e3f2fd;
    color: #1976D2;
}
img {
    width: 100px;
}
.no-data {
    text-align: center;
    margin-top: 50px;
    color: #888;
}
a {
    display: block;
    text-align: center;
    margin-top: 1.5em;
    color: #2196F3;
    text-decoration: none;
}
a:hover {
    text-decoration: underline;
}
</style>
</head>
<body>

<h2 style="text-align:center;">登録済み商品一覧</h2>
<p style="text-align:center;"><a href="product_register.html">← 商品登録フォームへ戻る</a></p>

<?php
if (!file_exists($xmlFile)) {
    print('<div class="no-data">まだ商品が登録されていません。</div>');
    exit;
}

$xml = simplexml_load_file($xmlFile);
if (count($xml->product) === 0) {
    print('<div class="no-data">商品データがありません。</div>');
    exit;
}
?>

<table>
<tr><th style="width:200px;">商品画像</th><th>商品名</th><th>単価（円）</th></tr>

<?php
foreach ($xml->product as $product){
    print('<tr><td><img src="'.htmlspecialchars($product->image).'" alt="画像"></td>');
    print('<td>'.htmlspecialchars($product->name, ENT_QUOTES, "UTF-8").'</td>');
    print('<td>'.number_format((float)$product->price).'</td></tr>');
}
?>
</table>
</body>
</html>