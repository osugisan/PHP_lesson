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


・文字列を検索、置換

<?php
$input = 'Call us at 03-3001-1256 or 03-3015-3222';
// 正規表現で指定
$pattern = '/\d{2}-\d{4}-\d{4}/';

// ①正規表現指定　②ソース　③処理結果
// ※最初の結果のみ
preg_match($pattern, $input, $matches);

// すべての結果の返却
preg_match_all($pattern, $input, $matches);
print_r($matches);

// 指定部分の置換　①正規表現指定　②置換文字列　③ソース
$input = preg_replace($pattern, '**-****-**', $input);
echo $input . PHP_EOL;

'※ echoとprint_rの違い
echo　→　文字列のみ
print_r　→　配列などいろいろ'
?>

・文字列と配列を相互に変換

<?php
// 配列　→　文字列に変換
$d = [2020, 11, 15];
echo implode('-', $d) . PHP_EOL; //2020-11-15

// 文字列　→　配列に変換
$t = '17:35:24';
print_r(explode(':', $t)); //[17, 35, 24]
?>


・数学系の関数

<?php
$n = 5.6283;

// 切り上げ
echo ceil($n) . PHP_EOL;
// 切り捨て
echo floor($n) . PHP_EOL;
// 四捨五入
echo round($n, 2) . PHP_EOL;
// 1から6をランダム表示
echo mt_rand(1, 6) . PHP_EOL;
// 最大数表示
echo max(1, 9, 4) . PHP_EOL;
// 最小数表示
echo min(1, 9, 4) . PHP_EOL;
// 円周率
echo M_PI . PHP_EOL;
// 2の平方根
echo M_SQRT2 . PHP_EOL;
?>


・配列の要素の変更

<?php
$scores = [30, 40, 50];

// 最初に要素追加（いくつでも）
array_unshift($scores, 10, 20);
// 末尾に要素追加（いくつでも）
array_push($scores, 60, 70);
// 末尾に要素追加
$scores[] = 80;
// 最初の要素削除
array_shift($scores);
// 最後の要素削除
array_pop($scores);

print_r($scores);
?>


・配列の要素切り出し

<?php
$scores = [30, 40, 50, 60, 70];

// ①対象配列　②n番目の要素から　③n番目の要素まで
$partial = array_slice($scores, 2, 3); //[50, 60, 70]
// ③末尾までなら省略可
$partial = array_slice($scores, 2); //[50, 60, 70]
// 末尾から２要素分
$partial = array_slice($scores, -2); //[60, 70]

print_r($scores);
print_r($partial);
?>


・配列の要素削除

<?php
$scores = [30, 40, 50, 60, 70, 80];
// ①対象配列　②2番目　③個数　→　②③を削除
array_splice($scores, 2, 3);
// ④削除した位置に、100を挿入
array_splice($scores, 2, 3, 100);
// ③0にすることで、削除しない　④複数挿入は、配列型にする
array_splice($scores, 2, 0, [100,200]);

print_r($scores);
?>

