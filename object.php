クラスの定義
<?php
// classの変数は大文字から
// クラス
calss Post
{
  // プロパティ
  public $text;
  public $likes;
  // メソッド
  public function show()
  {
    // -> の後は、$ いらない
    printf('%s (%d)' . PHP_EOL, $this->text, $this->likes);
  }
}
?>

・インスタンス作成
<?php
// クラス
class Post
{
  // プロパティ
  public $text;
  public $likes;
  
  // メソッド
  public function show()
  {
    printf('%s (%d)' . PHP_EOL, $this->text, $this->likes);
  }
}

$posts = [];

$posts[0] = new Post(); //インスタンス
$posts[0]->text = 'hello';
$posts[0]->likes = 0;

$posts[1] = new Post(); //インスタンス
$posts[1]->text = 'hello again';
$posts[1]->likes = 0;

$posts[0]->show();
$posts[1]->show();
?>


・コンストラクタ
<?php

class Post
{
  public $text;
  public $likes;
  // コンストラクタ
  public function __construct($text, $likes)
  {
    $this->text = $text;
    $this->likes = $likes;
  }
  
  public function show()
  {
    printf('%s (%d)' . PHP_EOL, $this->text, $this->likes);
  }
}

$posts = [];
// コンストラクタ
$posts[0] = new Post('hello', 0);

$posts[1] = new Post('hello again', 0);


$posts[0]->show();
$posts[1]->show();
?>


・アクセス修飾子
public
private

<?php

class Post
{
  public $text;
  // クラスの外からの操作はできなくなる
  // クラスの中のみ操作可能
  private $likes = 0;

  public function __construct($text)
  {
    $this->text = $text;
  }

  public function show()
  {
    printf('%s (%d)' . PHP_EOL, $this->text, $this->likes);
  }
}

$posts = [];
$posts[0] = new Post('hello');
$posts[1] = new Post('hello again');

// publicだと変えられる
$posts[0]->likes = -100;

$posts[0]->show();
$posts[1]->show();
?>
