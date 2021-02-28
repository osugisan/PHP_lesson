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

$text = <<<EOT
wow! $name
  fantastic!
yeah!
EOT;

echo $text;

