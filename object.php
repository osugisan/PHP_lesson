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
// プロパティに代入は、アロー関数
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
  // 73行目の書き方したら、コンストラクタの関数定義する
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

$posts[0]->like(); // (1)
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
                           // 変数の前に、型宣言
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
    // staticプロパティは、self:: でアクセス
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
  // constの変数は大文字
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
    // 定数の処理　　　　　　　　　　　　　定数も self:: で
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


・子クラスの実装

<?php

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

class SponsoredPost extends Post
{
  private $sponsor;
  
  public function __construct($text, $sponsor)
  {
    // 親コンストラクタの継承
    parent::__construct($text);
    $this->sponsor = $sponsor;
  }
  
  public function showSponsor()
  {
    printf('%s' . PHP_EOL, $this->sponsor);
  }
}

$posts = [];
$posts[0] = new Post('hello');
$posts[1] = new Post('hello again');
$posts[2] = new SponsoredPost('hello hello', 'dotinstall');

$posts[0]->show();
$posts[1]->show();
$posts[2]->show();
$posts[2]->showSponsor();
?>


・メソッドをoverride

同名のメッソドを子クラスで上書きすること

<?php

class Post
{
  // protected　に変更すると、子クラスでもプロパティが使える
  protected $text;

  public function __construct($text)
  {
    $this->text = $text;
  }
  // final　をつけるとオーバーライドできなくなる
  final public function show()
  {
    printf('%s' . PHP_EOL, $this->text);
  }
}

class SponsoredPost extends Post
{
  private $sponsor;
  
  public function __construct($text, $sponsor)
  {
    parent::__construct($text);
    $this->sponsor = $sponsor;
  }
  
  // オーバーライド
  public function show()
  {
    printf('%s by %s' . PHP_EOL, $this->text, $this->sponsor);
  }
}

$posts = [];
$posts[0] = new Post('hello');
$posts[1] = new Post('hello again');
$posts[2] = new SponsoredPost('hello hello', 'dotinstall');

$posts[0]->show();
$posts[1]->show();
$posts[2]->show();
?>


・型の継承

<?php
class Post
{
  protected $text;

  public function __construct($text)
  {
    $this->text = $text;
  }
  
  public function show()
  {
    printf('%s' . PHP_EOL, $this->text);
  }
}

// Post型として扱える（Postクラスを継承しているため）
class SponsoredPost extends Post
{
  private $sponsor;
  
  public function __construct($text, $sponsor)
  {
    parent::__construct($text);
    $this->sponsor = $sponsor;
  }
  
  public function show()
  {
    printf('%s by %s' . PHP_EOL, $this->text, $this->sponsor);
  }
}

$posts = [];
$posts[0] = new Post('hello');
$posts[1] = new Post('hello again');
$posts[2] = new SponsoredPost('hello hello', 'dotinstall');

// クラスを型付けして、選択できる
function processPost(Post $post)
{
  $post->show();
}

// Post, processPostの　show()　を実行する
foreach ($posts as $post) {
  processPost($post);
}
?>


・抽象クラス

子クラスで定義の強制をする
子クラスでオーバーライドメソッドを削除　→　エラーは出ない
上記をエラーが出るように変更

<?php

abstract class BasePost
{
  // Postクラスから移植
  protected $text;

  public function __construct($text)
  {
    $this->text = $text;
  }
  // ここまで

  // abstract以降が各クラスで定義されないとエラー
  abstract public function show();
}

// BasePostにネスト
class Post extends BasePost
{
  public function show()
  {
    printf('%s' . PHP_EOL, $this->text);
  }
}

// BasePostにネスト
class SponsoredPost extends BasePost
{
  private $sponsor;

  public function __construct($text, $sponsor)
  {
    parent::__construct($text);
    $this->sponsor = $sponsor;
  }

  // abstract追加でえらーがでるようになる
  // public function show()
  // {
  //     printf('%s by %s' . PHP_EOL, $this->text, $this->sponsor);
  // }
}

$posts = [];
$posts[0] = new Post('hello');
$posts[1] = new Post('hello again');
$posts[2] = new SponsoredPost('hello hello', 'dotinstall');

// 型付けをBasePostに変更
function processPost(BasePost $post)
{
  $post->show();
}

foreach ($posts as $post) {
  processPost($post);
}
?>


・クラスの追加


<?php

abstract class BasePost
{
  protected $text;

  public function __construct($text)
  {
    $this->text = $text;
  }

  abstract public function show();
}

class Post extends BasePost
{
  public function show()
  {
    printf('%s' . PHP_EOL, $this->text);
  }
}

class SponsoredPost extends BasePost
{
  private $sponsor;

  public function __construct($text, $sponsor)
  {
    parent::__construct($text);
    $this->sponsor = $sponsor;
  }

  public function show()
  {
    printf('%s by %s' . PHP_EOL, $this->text, $this->sponsor);
  }
}

// クラスの追加
class PremiumPost extends BasePost
{
  private $price;

  public function __construct($text, $price)
  {
    parent::__construct($text);
    $this->price = $price;
  }

  public function show()
  {
    printf('%s [%d JPY]' . PHP_EOL, $this->text, $this->price);
  }
}

$posts = [];
$posts[0] = new Post('hello');
$posts[1] = new Post('hello again');
$posts[2] = new SponsoredPost('hello hello', 'dotinstall');
// インスタンス忘れずに
$posts[3] = new PremiumPost('pay!', 300);

function processPost(BasePost $post)
{
  $post->show();
}

foreach ($posts as $post) {
  processPost($post);
}
?>


・インターフェース

BasePost　→　show()　小クラス全部に強制
Post          →　show()
sponsoredPost →　show()
PremiumPost   →　show()


Post, SponsoredPostのみ、like()　適用したい
インターフェースを適用する


<?php
// インターフェース設定（具体的な実装はできない）
interface LikeInterface
{
  // like()　の強制
  public function like();
}


abstract class BasePost
{
  protected $text;

  public function __construct($text)
  {
    $this->text = $text;
  }

  abstract public function show();
}

// implements　で指定
class Post extends BasePost implements LikeInterface
{
  // 追加
  private $likes = 0;
  
  public function like()
  {
    $this->likes++;
  }
  // ここまで

  public function show()
  {
    printf('%s (%d)' . PHP_EOL, $this->text, $this->likes);
  }
}

class SponsoredPost extends BasePost
{
  private $sponsor;

  public function __construct($text, $sponsor)
  {
    parent::__construct($text);
    $this->sponsor = $sponsor;
  }

  public function show()
  {
    printf('%s by %s' . PHP_EOL, $this->text, $this->sponsor);
  }
}

// implements　で指定
class PremiumPost extends BasePost implements LikeInterface
{
  private $price;

  // 追加
  private $likes = 0;
  
  public function like()
  {
    $this->likes++;
  }
  // ここまで

  public function __construct($text, $price)
  {
    parent::__construct($text);
    $this->price = $price;
  }

  public function show()
  {
    printf('%s [%d JPY]' . PHP_EOL, $this->text, $this->price);
  }
}

$posts = [];
$posts[0] = new Post('hello');
$posts[1] = new Post('hello again');
$posts[2] = new SponsoredPost('hello hello', 'dotinstall');
$posts[3] = new PremiumPost('hello there', 300);

$posts[0]->like();
$posts[3]->like();

function processPost(BasePost $post) 
{
  $post->show();
}

foreach ($posts as $post) {
  processPost($post);
}
?>


・インターフェースの型付け

インターフェースでも、クラス同様型付けできる

<?php

interface LikeInterface
{
  public function like();
}

abstract class BasePost
{
  protected $text;

  public function __construct($text)
  {
    $this->text = $text;
  }

  abstract public function show();
}

class Post extends BasePost implements LikeInterface
{
  private $likes = 0;
  
  public function like()
  {
    $this->likes++;
  }

  public function show()
  {
    printf('%s (%d)' . PHP_EOL, $this->text, $this->likes);
  }
}

class SponsoredPost extends BasePost
{
  private $sponsor;

  public function __construct($text, $sponsor)
  {
    parent::__construct($text);
    $this->sponsor = $sponsor;
  }

  public function show()
  {
    printf('%s by %s' . PHP_EOL, $this->text, $this->sponsor);
  }
}

class PremiumPost extends BasePost implements LikeInterface
{
  private $price;
  private $likes = 0;
  
  public function like()
  {
    $this->likes++;
  }
  
  public function __construct($text, $price)
  {
    parent::__construct($text);
    $this->price = $price;
  }

  public function show()
  {
    printf('%s (%d) [%d JPY]' . PHP_EOL, $this->text, $this->likes, $this->price);
  }
}

$posts = [];
$posts[0] = new Post('hello');
$posts[1] = new Post('hello again');
$posts[2] = new SponsoredPost('hello hello', 'dotinstall');
$posts[3] = new PremiumPost('hello there', 300);

// 追加
function processLikable(LikeInterface $likable)
{
  $likable->like();
}

processLikable($posts[0]);
processLikable($posts[3]);
// ここまで

function processPost(BasePost $post)
{
  $post->show();
}

foreach ($posts as $post) {
  processPost($post);
}
?>


・トレイト（レンダー）

<?php
trait LikeTrait
{
  処理;
}

.....

use LikeTrait;

?>


・外部ファイルの読み込み
main.phpと、Post.phpに分ける
Post.phpにクラスを移動する


require('Post.php');// ファイルが読み込めないと処理が止まる
include('Post.php');// ファイルが読み込めないと処理が止まらない

<!-- 一度だけ読み込む指示 -->
require_once('Post.php');
include_once('Post.php');


・クラスを自動的に読み込む
インスタンスが new されたら発火

<?php
// $classに、Post が格納
spl_autoload_register(function ($class) {
  require($class . '.php');
});

$posts[0] = new Post('hello');
?>


・名前空間
クラス名のダブリ回避

Post.php
<?php
// namespaceの定義
namespace Dotinstall\MyPHPApp;

?>

main.php
<?php
// クラス指定に MyPHPApp を使用
use Dotinstall\MyPHPApp;

require('Post.php');

// クラス名が MyPHPApp\Post になる
$posts[0] = new MyPHPApp\Post('hello');
$posts[1] = new MyPHPApp\Post('hello again');
?>


・例外処理

Post.php
<?php
class Post
{
  private $text;

  function __construct($text)
  {
    if (strlen($text) <= 3) {
      // 例外を投げる
      throw new Exception('short!');
    }
    $this->text = $text;
  }

  function show()
  {
    printf('%s' . PHP_EOL, $this->text);
  }
}
?>

main.php
<?php
require('Post.php');

// tryで処理を囲む
try {
  $posts[0] = new Post('!');
  $posts[1] = new Post('hello again');
  
  foreach ($posts as $post) {
    $post->show();
  }
  // throw を carch する
} catch (Exception $e) {
  // getMessage()メソッドで、メッセージ表示
  echo $e->getMessage() . PHP_EOL;
}
?>
