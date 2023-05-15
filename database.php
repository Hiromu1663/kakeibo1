<?php
class Database
{

  function connect()
  {
    $dsn = "mysql:dbname=kakeibo;host=localhost";
    $user = "root";
    $password = "";

    try {
      $dbh = new \PDO($dsn, $user, $password);
      $dbh->query("SET NAMES UTF8MB4");
      return $dbh;
    } catch (Exception $e) {
      exit($e->getMessage());
    }
  }

  // データベースに保存
  function store($input)
  {
    $dbh = $this->connect();
    $stmt = $dbh->prepare("INSERT INTO records SET date = ?, title = ?, amount = ?, type = ? ");
    $stmt->execute([$input["date"], $input["title"], $input["amount"], $input["type"]]);
  }

  // データ全て取得
  function all()
  {
    $dbh = $this->connect();
    $stmt = $dbh->prepare("SELECT*FROM records");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  // record１つを取得
function find($id) {
  $dbh = $this->connect();
  $stmt = $dbh->prepare("SELECT*FROM records WHERE id = ?");
  $stmt->execute([$id]);
  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// record情報更新処理
function update($input) {
  $dbh = $this->connect();
  $stmt = $dbh->prepare("UPDATE records SET date = ?, title = ?, amount = ?, type = ? WHERE id = ?");
  $stmt->execute([$input["date"], $input["title"], $input["amount"], $input["type"], $input["id"]]);
}

function destroy($id) {
  $dbh = $this->connect();
  $stmt = $dbh->prepare("DELETE FROM records WHERE id = ?");
  $stmt->execute([$id]);
}
}
