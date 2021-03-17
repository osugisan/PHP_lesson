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

・配列をソート、シャッフルする

<?php
$scores = [40, 50, 20, 30];
// 小さい順に並べ替え
sort($scores);
print_r($scores);
// 大きい順に並べ替え
rsort($scores);
print_r($scores);
// ランダムに並び替え
shuffle($scores);
print_r($scores);
// ②の数だけ要素取り出し（戻り値は、要素ではなく「キー」）
$picked = array_rand($scores, 2);
echo $scores[$picked[0]] . PHP_EOL;
echo $scores[$picked[1]] . PHP_EOL;
?>


・配列の要素の集計

<?php
// ①の数から　②の数まで配列生成　③の数で埋める
$scores = array_fill(0, 5, 10);
// 1から10まで、順番に配列生成
$scores = range(1, 10);
// ③要素を、２置きに表示
$scores = range(1, 10, 2);

print_r($scores);

// 配列の合計
echo array_sum($scores) . PHP_EOL;
// 配列の平均
echo array_sum($scores) / count($scores) . PHP_EOL;
// max, minも使える
echo max($scores) . PHP_EOL;
echo min($scores) . PHP_EOL;
?>


・配列の連結、差、共通項の計算

<?php

$a = [3, 4, 8];
$b = [4, 8, 12];

// ①と②の配列結合
$merged = array_marged($a, $b);
$merged = [...$a, ...$b];
print_r($merged);
// 配列から共通項を除外して表示
$uniques = array_unique($merged);
print_r($uniques);

// ②と同じ要素を除外して、①を表示
$diff1 = array_diff($a, $b);
print_r($diff1); //[3]

$diff1 = array_diff($b, $a);
print_r($diff1); //[12]

// ①と②の共通項を表示
$common = array_intersect($a, $b);
print_r($common); //[4, 8]
?>

・array_map()
array_map(関数, 対象配列);
それぞれの要素に、同じ処理を加える

<?php
$prices = [100, 200, 300];

$newPrices = array_map(
  function ($n) { return $n * 1.1; },
  // これでも同じ
  // fn ($n) => $n * 1.1,
  $prices
  );

print_r($newPrices);
?>


・array_filter()
array_filter(対象配列, 関数);
「true」の要素のみ、配列を返す

<?php
$numbers = range(1, 10);

$evenNumbers = array_filter(
  $numbers,
  // function ($n) {
  // パターン①
  //   if ($n % 2 ===0) { //偶数指定
  //     return true;
  //   } else {
  //     return false;
  //   }
  // }
  //　パターン②
  //   return $n % 2 === 0;
  // }
  // パターン③
  fn($n) => $n % 2 === 0
);

print_r($evenNumbers);
?>


・配列のキー、値の操作

<?php
$scores = [
  'taguchi' => 80,
  'hayashi' => 70,
  'kikuchi' => 60,
];
// キーを配列化
$keys = array_keys($scores);
print_r($keys);
// 値を新たに配列化
$values = array_values($scores);
print_r($values);

// キーに①の要素が含まれているか
if (array_key_exists('taguchi', $scores)) {
  echo 'true' . PHP_EOL;
}
// 値に①の要素が含まれているか
if (in_array(80, $scores)) {
  echo 'true' . PHP_EOL;
}

// ①の値に、セットされているキーを表示
echo array_search(70, $scores) . PHP_EOL;
?>


・ソート亜種

<?php
$scores = [
  'taguchi' => 80,
  'hayashi' => 70,
  'kikuchi' => 60,
];
// キーを保持したままソート
asort($scores);
print_r($scores);
arsort($scores);
print_r($scores);

// キーを対象にソート
ksort($scores);
print_r($scores);
krsort($scores);
print_r($scores);
?>


・usort()

<?php
$data = [
  ['name' => 'taguchi', 'score' => 80],
  ['name' => 'kikuchi', 'score' => 60],
  ['name' => 'hayashi', 'score' => 70],
  ['name' => 'tamachi', 'score' => 60],
];

// scoreの小さい順にソートする処理
usort(
  $data,
  function ($a, $b) {
    if ($a['score'] === $b['score']) {
      return 0;
    }
    return $a['score'] > $b['score'] ? 1 : -1;
  }
);

print_r($data);
?>

・array_multisort()

<?php

$data = [
  ['name' => 'taguchi', 'score' => 80],
  ['name' => 'kikuchi', 'score' => 60],
  ['name' => 'hayashi', 'score' => 70],
  ['name' => 'tamachi', 'score' => 60],
];

// 二重配列を、配列に戻す
$scores = array_column($data, 'score');
$names = array_column($data, 'name');

// 上から順に、並べ替え
array_multisort(
  $scores, // SORT_DESC, SORT_NUMERIC,(逆順, 数値宣言)
  $names,
  $data
);

print_r($data);
?>


・ファイルに文字列を入力する
<?php
// names.txt がなければ新規作成('w')
// $fp　に代入される
$fp = fopen('names.txt', 'w');
// ファイル内に、書き込み（\n は改行）
fwrite($fp, "taro\n");
// 処理終了
fclose($fp);
?>

・ファイルに文字列追記
<?php
// 'a' → 追記
$fp = fopen('names.txt', 'a');

fwrite($fp, "taro\n");
fwrite($fp, "jiro\n");

fclose($fp);
?>


・ファイルからデータ読み込み
<?php
$fp = fopen('names.txt', 'r');
// ファイルの中身を一括読み込み
$contents = fread($fp, filesize('names.txt'));
fclose($fp);
echo $contents;


$fp = fopen('names.txt', 'r');
// ファイルの中身を、一行ずつ読み込み
// 読み込む行がなくなると、falseを返す
while (($line = fgets($fp)) !== false) {
  echo $line;
}
fclose($fp);
?>


・上記以外のファイル処理方法
<?php
// ファイル書き込み
$contents = "taro\njiro\nsaburo\n";
file_put_contents('names.txt', $contents);
// ファイルの内容を、変数で表示
$contents = file_get_contents('names.txt');
echo $contents;
// ファイルの内容を配列に入れる
$lines = file('names.txt');
var_dump($lines);
?>


・ディレクトリ操作
<?php
// dataディレクトリ内に作成
file_put_contents('data/taro.txt', "taro\n");
file_put_contents('data/jiro.txt', "jiro\n");

// dataを $dp に格納
$dp = opendir('data');
// falseになるまでループ
// '.', '..'はスルーする
while (($item = readdir($dp)) !== false) {
  if ($item === '.' || $item === '..') {
    continue;
  }
  echo $item . PHP_EOL;
}


別の方法
// data配下の *.txtを配列化
foreach (glob('data/*.txt') as $item) {
  echo $item . PHP_EOL;
  // ファイル名だけ表示
  echo basename($item) . PHP_EOL;
}
?>

