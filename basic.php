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


