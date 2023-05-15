<?php
require_once("./database.php");
// POST送信されてきた場合のみ
if(!empty($_POST)) {
    if(empty($_POST["date"])) {
        exit("日付を入力して下さい");
    }
    if(empty($_POST["title"])) {
        exit("タイトルを入力して下さい");
    }
    if(empty($_POST["amount"])) {
      exit("金額を入力して下さい");
  }
  if(empty($_POST["type"])) {
      exit("収支を選択して下さい");
  }

    $database = new Database();
    $database->store($_POST);

    header("Location: ./2.php");
    exit;
}
?>





<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>家計簿</title>
</head>

<body>
  <h1>家計簿</h1>
  <h2>新規追加フォーム</h2>
  <form action="" method="post">
    <div class="date">
      日付
      <input type="date" name="date">
    </div>
    <div class="title">
      タイトル
      <input type="text" name="title">
    </div>
    <div class="amount">
      金額
      <input type="number" name="amount">
    </div>
    <div class="type">
      <input type="radio" name="type" value=2>
      <label for=2>収入</label>
      <input type="radio" name="type" value=1>
      <label for=1>支出</label>
    </div>
    <button type="submit">送信</button>
     <a href="./2.php">一覧</a>
  </form>
</body>

</html>