・SELECTの実行

<?php

$pdo = new PDO(
  // DSN
  'mysql:host=db;dbname=myapp;charset=utf8mb4',
  // user
  'dbuser',
  // pass
  'dbpass',
  [
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,  
  ]
);

$stmt = $pdo->query("SELECT 5 + 3"); // ["5 + 3"]=>"8"
$result = $stmt->fetch();
var_dump($result);
?>


・エラーを例外でキャッチ

<?php
try {
  $pdo = new PDO(
    'mysql:host=db;dbname=myapp;charset=utf8mb4',
    'dbuser',
    'dbpass',
    [
      // SQLのエラーを表示させるオプション
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]
  );
  
  $stmt = $pdo->query("SELCT 5 + 3");
  $result = $stmt->fetch();
  var_dump($result);
  // 例外処理
} catch (PDOException $e) {
  echo $e->getMessage() . PHP_EOL;
  exit;
}
?>


・テーブルの作成
<?php
  // postsテーブルが既にある場合削除する
  $pdo->query("DROP TABLE IF EXISTS posts");

  // postsテーブルの作成
  $pdo->query(
    "CREATE TABLE posts (
      id INT NOT NULL AUTO_INCREMENT,
      message VARCHAR(140), 
      likes INT,
      PRIMARY KEY (id)
    )"
  );

  // レコードの登録
  $pdo->query(
    "INSERT INTO posts (message, likes) VALUES
      ('Thanks', 12),
      ('thanks', 4),
      ('arigato', 15)"
  );
  
  $stmt = $pdo->query("SELECT * FROM posts");
  $results = $stmt->fetchall();
  var_dump($results);
?>


・結果をわかりやすく表示

<?php

try {
  $pdo = new PDO(
    'mysql:host=db;dbname=myapp;charset=utf8mb4',
    'dbuser',
    'dbpass',
    [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
      // デフォルトでは、stringで表示されるのをやめる
      PDO::ATTR_EMULATE_PREPARES => false,
    ]
  );

..............

  $stmt = $pdo->query("SELECT * FROM posts");
  $posts = $stmt->fetchAll();

  // 表示部
  foreach ($posts as $post) {
    printf(
      '%s %d' . PHP_EOL,
      $post['message'],
      $post['likes']
    );
  }
  // ここまで

} catch (PDOException $e) {
  echo $e->getMessage() . PHP_EOL;
  exit;
}
?>


・SQLインジェクションを防ぐ

<?php

  // $n = 10;
  $n = '10 OR 1=1';
  
  // $pdo->query("DELETE FROM posts WHERE likes < $n");　だめ

  // ?の部分→プレースホルダー
  // SQLに値を埋め込む時は、? からの execute([$n]);
  $stmt = $pdo->prepare("DELETE FROM posts WHERE likes < ?");
  $stmt->execute([$n]);

  // DELETE FROM posts WHERE likes < 10 (OR 1=1)ここは無視される

  $stmt = $pdo->query("SELECT * FROM posts");
  $posts = $stmt->fetchAll();
  foreach ($posts as $post) {
    printf(
      '%s (%d)' . PHP_EOL, 
      $post['message'], 
      $post['likes']
    );
  }
} catch (PDOException $e) {
  echo $e->getMessage() . PHP_EOL;
  exit;
}
?>


・複数の値を埋め込む

<?php
  
  $label = '[Good]';
  $n = 10;
  
  $stmt = $pdo->prepare(
    "UPDATE
      posts
    SET
      message = CONCAT(?, message)
    WHERE
      likes > ?"
  );

  // 配列の順番で、?に代入される
  $stmt->execute([$label, $n]);
  // $stmtのカウント
  echo $stmt->rowCount() . ' records update' . PHP_EOL;
?>

プレースホルダーを、:〇〇〇〇 で命名できる
<?php

  $label = '[Good!] ';
  $n = 10;

  $stmt = $pdo->prepare(
    "UPDATE
       posts 
    SET 
      message = CONCAT(:label, message) 
    WHERE 
      likes > :n"
  );

  // : はつけなくてもよい
  $stmt->execute([':label' => $label, ':n' => $n]);

?>


・likesによる検索

<?php
  // ワイルドカードは、入力する文字列に設置
  $search = 't%';

  $stmt = $pdo->prepare(
    "SELECT * FROM posts WHERE message LIKE :search"
  );
  $stmt->execute(['search' => $search]);
?>


・型を指定しつつプレースホルダに値を紐付ける

executeは、string型になる

<?php
  $message = 'Merci';
  $likes = 8;

  $stmt = $pdo->prepare(
    "INSERT INTO
      posts (message, likes)
    VALUES
      (:message, :likes)"
  );

  // 型指定→bindValue()
  $stmt->bindValue('message', $message, PDO::PARAM_STR);
  $stmt->bindValue('likes', $likes, PDO::PARAM_INT);
  // executeの中には、書かない
  $stmt->execute();
?>
