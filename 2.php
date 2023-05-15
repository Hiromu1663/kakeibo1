<?php
require_once("./database.php");

// 削除処理
if (!empty($_GET) && isset($_GET["id"])) {
    $database = new Database();
    $database->destroy((int)$_GET["id"]);
}


// アクセスの度に実行する
$database = new Database();
$moneys = $database->all();



?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>入力確認</title>
</head>

<body>
    <div>
        <div>
            <div>
                <a href="./1.php">新規登録</a>
            </div>
        </div>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>日付</th>
                    <th>タイトル</th>
                    <th>金額</th>
                    <th>収支</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($moneys as $money) : ?>
                    <tr>
                        <td><?php echo $money["id"]; ?></td>
                        <td><?php echo $money["date"]; ?></td>
                        <td><?php echo $money["title"]; ?></td>
                        <td>¥<?php echo $money["amount"]; ?></td>
                        <td>
                            <?php if ($money["type"] === 2) {
                                echo "収入";
                            } else {
                                echo "支出";
                            } ?>
                        </td>

                        <td><a href="./3.php?id=<?php echo $money["id"]; ?>">編集</a></td>
                        <td><a href="./2.php?id=<?php echo $money["id"]; ?>">削除</a></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
        <?php
        $total1 = 0;
        $total2 = 0;
        foreach ($moneys as $money) {
            if ($money["type"] === 1) {
                $total1 += $money["amount"];
            } else {
                $total2 += $money["amount"];
            }
        }
        echo "支出合計：¥" . $total1;
        echo "<br>";
        echo "収入合計：¥" . $total2;
        ?>
    </div>
</body>

</html>