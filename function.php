・sprintf()
フォーマットした文字を後で使う場合
※printf()
ログの確認

<?php

$name = 'Apple';
$score = 32.246;

// % + 型の頭文字, - + 15(左詰め+15桁分表示), 0 + 10 + .2(左側を何で埋めるか+10桁分表示+小数点２桁分表示)
$info = sprintf("[%-15s][%010.2f]", $name, $score);
echo $info . PHP_EOL;
?>

・文字列を扱う関数

<?php
$input = ' dot_install  ';

// 余白を取り除く
$input = trim($input);

// 文字列のカウント
echo strlen($input) . PHP_EOL;

// 第2引数が何番目にあるか
echo strpos($input, '_') . PHP_EOL;

// 第一引数を第二引数に変更。第三に変数
$input = str_replace('_', '-', $input);
echo $input . PHP_EOL;
?>


・日本語を扱うとき
mb_strlen, mb_strpos　を使う

<?php
$input = ' こんにちは  ';
$input = trim($input);

echo mb_strlen($input) . PHP_EOL;
echo mb_strpos($input, 'に') . PHP_EOL;
?>


・固定長のデータを扱う

<?php
$input = '20200320Item-A  1200';
// 固定長の修正。①変数, ②変更後文字, ③スタート地点, ④文字の長さ
$input = substr_replace($input, 'Item-B  ', 8, 8);

// ①変数, ③スタート地点, ③文字の長さ
$date = substr($input, 0, 8);
$product = substr($input, 8, 8);
// 最後までは、③省略可
$amount = substr($input, 16);

echo $date .PHP_EOL;
echo $product .PHP_EOL;
// 数字にカンマ入れる
echo number_format($amount) .PHP_EOL;
?>


