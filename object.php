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


・メッソドを介して、プロパティを操作

カプセル化
<?php

class Post
{
  public $text;
  private $likes = 0;

  public function __construct($text)
  {
    $this->text = $text;
  }

  public function show()
  {
    printf('%s (%d)' . PHP_EOL, $this->text, $this->likes);
  }
  // privateのプロパティをメソッドで操作
  public function like()
  {
    $this->likes++;
    
    if ($this->likes > 100) {
      $this->likes = 100;
    }
  }
}

$posts = [];
$posts[0] = new Post('hello');
$posts[1] = new Post('hello again');

$posts[0]->like();
$posts[0]->show();
$posts[1]->show();
?>


・プロパティで型宣言

<?php
// これがないとstringに変換してしまう
declare(strict_types=1);

class Post
{
  // 変数の前に、型宣言
  private string $text;

  public function __construct(string $text)
  {
    $this->text = $text;
  }

  public function show()
  {
    printf('%s' . PHP_EOL, $this->text);
  }
}

$posts = [];
// intを送信
$posts[0] = new Post(5);
$posts[1] = new Post('hello again');

$posts[0]->show();
$posts[1]->show();
?>


・staticキーワード

クラスが持つプロパティ、メソッド
インスタンス化の影響を受けず、変更を加えたい場合は、::を用いてアクセスしていく

<?php
class Post
{
  private $text;
  // クラスプロパティ
  private static $count = 0;
  
  public function __construct($text)
  {
    $this->text = $text;
    self::$count++;
  }

  public function show()
  {
    printf('%s' . PHP_EOL, $this->text);
  }

  // クラスメソッド
  // クラスプロパティの実行には、クラスメソッドを定義
  public static function showInfo()
  {
    printf('Count: %d' . PHP_EOL, self::$count);
  }
}

$posts = [];
$posts[0] = new Post('hello');
$posts[1] = new Post('hello again');

$posts[0]->show();
$posts[1]->show();

// クラスメソッドの実行
Post::showInfo();　// count: 2
?>


・オブジェクト定数

constで定義

<?php
class Post
{
  private $text;
  private static $count = 0;
  // 定数の場合は、publicでも良し
  public const VERSION = 0.1;

  public function __construct($text)
  {
    $this->text = $text;
    self::$count++;
  }

  public function show()
  {
    printf('%s' . PHP_EOL, $this->text);
  }
  
  public static function showInfo()
  {
    printf('Count: %d' . PHP_EOL, self::$count);
    // 定数の処理
    printf('Version: %.1f' . PHP_EOL, self::VERSION);
  }
}

$posts = [];
$posts[0] = new Post('hello');
$posts[1] = new Post('hello again');

$posts[0]->show();
$posts[1]->show();

Post::showInfo();

// 直接呼び出せる
echo Post::VERSION . PHP_EOL;
?>


・クラスの継承

class XX extends XX;

<?php

// 親クラス　superクラス
class Post
{
  private $text;

  public function __construct($text)
  {
    $this->text = $text;
  }

  public function show()
  {
    printf('%s' . PHP_EOL, $this->text);
  }
}

// Postクラスの継承
class SponsoredPost extends Post　// 子クラス subクラス
{
  
}
$posts = [];
$posts[0] = new Post('hello');
$posts[1] = new Post('hello again');
// インスタンス作成
$posts[2] = new SponsoredPost('hello hello');

$posts[0]->show();
$posts[1]->show();
// 実行
$posts[2]->show();
?>
