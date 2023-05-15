<?php
require_once("./database.php");

if (!empty($_POST)) {
    $input = $_POST;
    $input["id"] = $_GET["id"];

    if (empty($input["date"])) {
        exit("日付を入力して下さい");
    }
    if (empty($input["title"])) {
        exit("タイトルを入力して下さい");
    }
    if (empty($input["amount"])) {
        exit("金額を入力して下さい");
    }
    if (empty($input["type"])) {
        exit("収支を選択して下さい");
    }


    $database = new Database();
    $database->update($input);

    header("Location: ./2.php");
}

$database = new Database();
$money = $database->find((int)$_GET["id"]);

if (empty($money)) {
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
    <title>編集</title>
</head>

<body>
    <main>
        <div>
            <div>
                <a href="./2.php">一覧に戻る</a>
            </div>
        </div>
            <form method="POST" action="">
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
                        <tr>
                            <td><?php echo $money[0]["id"]; ?></td>
                            <td><input type="date" name="date" value="<?php echo $money[0]["date"]; ?>"></td>
                            <td><input type="text" name="title" value="<?php echo $money[0]["title"]; ?>"></td>
                            <td><input type="number" name="amount" value="<?php echo $money[0]["amount"]; ?>"></td>
                            <td>
                                <input type="radio" name="type" value=2 <?php if($money[0]["type"] == 2) {echo "checked";}; ?>>
                                <label for=2>収入</label>
                                <input type="radio" name="type" value=1 <?php if($money[0]["type"] == 1) {echo "checked";}; ?>>
                                <label for=1>支出</label>
                            </td>
                            <td><button type="submit" class="btn btn-success btn-sm">更新</button></td>
                        </tr>
                    </tbody>
                </table>
            </form>
    </main>
</body>

</html>

