・改行入れる
PHP_EOL;

echo 'hello, world' . PHP_EOL;


・変数
$name = 'hoge';

echo 'hello, ' . $name . PHP_EOL;


・文字列の扱い
""内に変数を埋め込める
echo "It's Sunday. Hello $name" . PHP_EOL;

””内に、""を使う。tabを入れる
echo "It's \"Sunday\".\t Hello $name" . PHP_EOL;


・ヒアドキュメント、ナウドキュメント

改行を活かす方法
$name = 'taguchi';

$text = <<<'EOT'
wow! $name
  fantastic!
yeah!
EOT;

echo $text;


・変数を使った演算

$price = 500;

<!-- 同じこと -->
// $price = $price + 100;
$price += 100; // 600
$price *= 100; // 60000
<!-- 1だけ足し引き -->
$price++; // 60001
$price--; // 60000


・定数
define('NAME', 'hoge');

const NAME = 'hoge';


・データ型
データ型を調べる
var_dump($〇〇)

型を変換
$a = (float)5;
$d = (string)3.2;


・条件分岐

こんな感じ
if ($score >= 80) {
  echo 'Great' . PHP_EOL;
} elseif ($score >= 60) {
  echo 'Good' . PHP_EOL;
} else {
  echo 'OK' . PHP_EOL;
}


・比較演算子

同じ、同じじゃない
===, !==

$x = 4 → true
$x = 0 → false

※falseになる条件
false, 0, null, ""（空文字）, []（空配列）


・論理演算子
&&　なおかつ
||　もしくは

<?php
$name = 'ega';
$score = 50;

// if ($score >= 40) {
//   if ($name === 'ega') {
//     echo 'good' . PHP_EOL;
//   }
// }

if ($score >= 40 && $name === 'ega') {
  echo 'good' . PHP_EOL;
}
?>


・switch

===が続くような処理
<?php

$signal = 'blue';

// if ($signal === 'red') {
//   echo 'Stop!' . PHP_EOL;
// } elseif ($signal === 'yellow') {
//   echo 'Caution!' . PHP_EOL;
// } elseif ($signal === 'blue'){
//   echo 'Go!' . PHP_EOL;
// }

// 上と同じ処理
switch ($signal) {
  case 'red':
    echo 'Stop!' . PHP_EOL;
    break;
  case 'ywllow':
    echo 'Caution!' . PHP_EOL;
    break;
  case 'blue':
    echo 'Go!' . PHP_EOL;
    break;
}
?>

・switch2

<?php

// $signal = 'red';
$signal = 'hoge';

switch ($signal) {
  case 'red':
    echo 'Stop!' . PHP_EOL;
    break;
  case 'yellow':
    echo 'Caution!' . PHP_EOL;
    break;
  case 'blue':
  case 'green':
    echo 'Go!' . PHP_EOL;
    break;
  // どれにも当てはまらない場合
  default:
    echo 'wrong signal!' . PHP_EOL;
    break;
}
?>

※break;　を忘れると次の処理まで実行されてしまう


・for文
for (式１; 式２; 式３) {
  処理文
}

処理を５回繰り返し
<?php
for ($i = 1; $i <= 5; $i++) {
  echo "$i - Hello" . PHP_EOL;
}
?>

・while文

<?php
$hp = 100;

while ($hp >0) {
  echo "your HP: $hp" . PHP_EOL;
  $hp -= 15;　//ここを書き忘れるとループする
}
?>

条件を満たさなくても一回は実行する場合
<?php
$hp = -50;

do {
  echo "your HP: $hp" . PHP_EOL;
  $hp -= 15;
} while ($hp > 0); //;つける
?>


・continue, break
処理をスキップ　→　continue
処理を中断　→　break

<?php
for ($i = 1; $i <= 10; $i++) {
  if ($i % 3) { //３の倍数
    continue;
  }
  echo $i . PHP_EOL;
}
?>

<?php
for ($i = 1; $i <= 10; $i++) {
  if ($i === 3) {
    break;
  }
  echo $i . PHP_EOL;
}
?>


・関数
function 関数名() {
  処理式
}

<?php
function showAd() {
  echo '----------' . PHP_EOL;
  echo '----Ad----' . PHP_EOL;
  echo '----------' . PHP_EOL;
}

showAd();
?>


・引数
function 関数名($a) {
  --- ' . $a . ' ---
}

<?php
function showAd($message = 'Ad') //引数がない場合、デフォルト値適用
{
  echo '----------' . PHP_EOL;
  echo '--- ' . $message . ' ---' . PHP_EOL;
  echo '----------' . PHP_EOL;
}

showAd('Header Ad');
echo 'Tom is great!' . PHP_EOL;
echo 'Bob is great!' . PHP_EOL;
showAd();
echo 'Steve is great!' . PHP_EOL;
echo 'Bob is great!' . PHP_EOL;
showAd('Footer AD');
?>


・return
return　→　関数から値を返す

<?php
function sum($a, $b, $c) {
  return $a + $b + $c;
}

echo sum(100, 200, 300) + sum(400, 500,600) . PHP_EOL;
?>


・変数のスコープ
関数外で指定された変数は、関数の中で使えない
<?php
$rate = 1.1; //グローバルスコープ

function sum($a, $b, $c){
  $rate = 1.08; //ローカルスコープ
  return ($a + $b + $c) * $rate;
}

echo sum(100, 200, 300) + sum(300, 400, 500) . PHP_EOL;
?>


・無名関数
関数を、変数に代入できる
<?php
$sum = function ($a, $b, $c) {
  return $a + $b + $c;
}; //;必要

echo $sum(100, 200, 300) . PHP_EOL;
?>


・条件演算子

<?php
if ($total < 0) {
    return 0;
  } else {
    return $total;
  }

//上と同じ
return $total < 0 ? 0 : $total;
?>


・引数の型付
予期しない型での受け取りを防止

<?php
declare(strict_types=1); //'4'の場合でも、弾く

function showInfo(string $name, int $score): void //引数の前に型を指定　返り値がない場合、最後に: void
{
  echo $name . ': ' . $score . PHP_EOL;
}

showInfo('hoge', '4');
?>


・nullを渡す
型の前に、? をつける
<?php
declare(strict_types=1);

function getAward(int $score): ?string
{
  return $score >= 100 ? 'Gold medal' : null;
}

echo getAward(150) . PHP_EOL;
echo getAward(40) . PHP_EOL;
?>


・配列
<?php
$scores = [30, 60, 90];

$scores[1] = 40; //2番目を、40に書き換え
echo $scores[1] . PHP_EOL; //配列の2番目を表示
?>


・配列のキー指定
<?php
$scores = [
  'first' => 90,
  'second' => 40,
  'third' => 100,
];
echo $scores['first']; //呼び出すキーを変えれる

var_dump($scores);　→　型、値、キー、要素数
print_r($scores);　→　値、キー
?>


・foreach
foreach ($arr as $value)
foreach ($arr as $key => $value)　→　キーを表示させる場合

<?php

$scores = [
  'first'  => 90, 
  'second' => 40, 
  'third'  => 100,
];

foreach ($scores as $key => $score) {
  echo $key . ' - ' . $score . PHP_EOL;
}
?>


・配列の要素を展開
<?php
$more_score = [55, 75, [1, 2]]; //配列の中に配列入れれる

$scores = [
  90,
  40,
  ...$more_score, //「...」を入れないと、入れ子扱いになる
  100,
];

echo $scores[4][1] . PHP_EOL; //入れ子のキーを取り出す
?>

上の中身
print_r($scores);
Array
(
    [0] => 90
    [1] => 40
    [2] => 55
    [3] => 75
    [4] => Array
        (
            [0] => 1
            [1] => 2
        )

    [5] => 100
)


・可変長引数
好きな数だけ、引数を渡せる

<?php
function sum(...$numbers) //「...引数」で設定
{
  $total = 0;
  foreach ($numbers as $number) {
    $total += $number;
  }
  return $total;
}

echo sum(10, 20, 30) . PHP_EOL;
echo sum(10, 20, 30, 50, 60) . PHP_EOL;
?>


・返り値を、配列で返す

<?php

function get_stats(...$numbers)
{
  $total = 0;
  foreach ($numbers as $number) {
    $total += $number;
  }
  return [$total, $total / count($numbers)];
}

// print_r(get_stats(1, 3, 5));　→　[9,3]で帰ってくる

[$sum, $ave] = get_stats(1, 3, 5); //返り値の配列をそのまま、変数に代入

echo $sum . PHP_EOL;
echo $ave . PHP_EOL;
?>


