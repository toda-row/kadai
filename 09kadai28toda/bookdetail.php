<?php
session_start();


//2. DB接続します
include("functions.php");
//1.POSTでParamを取得
$id = $_GET["id"];

//2.DB接続など
$pdo = db_con();


//３．データ登録SQL変更
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table WHERE id=:id");
$stmt->bindValue(':id', $id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //executeは実行

//データ表示
$view="";
if($status==false){
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);
}else{
    $row = $stmt->fetch();

}


?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>書籍詳細編集</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
        <a class="navbar-brand" href="index.php">トップ</a>
        <a class="navbar-brand" href="selectuser.php">ユーザーの一覧</a>
        <a class="navbar-brand" href="selectbook.php">書籍の一覧</a>

        <?php
            if(
                !isset($_SESSION["chk_ssid"]) || $_SESSION["chk_ssid"]!=session_id()
            ) {
        ?>
            <a class="navbar-brand" href="registration.php">新規ユーザー登録</a>
            <a class="navbar-brand" href="login.php">ログイン</a>
        <?php } else { ?>
            <a class="navbar-brand" href="logout.php">ログアウト</a>
        <?php } ?>
        </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="post" action="updatebook.php" enctype="multipart/form-data">
 <input type="hidden" name="id" value="<?=$id?>">
  <div class="container jumbotron">
   <fieldset>
    <legend>本をブックマークする</legend>
     <label>書籍名：<input type="text" name="bookname" value="<?=$row["bookname"]?>"></label><br>
     <label>書籍URL：<input type="text" name="bookurl" value="<?=$row["bookurl"]?>"></label><br>
     <label><textArea name="comment" rows="4" cols="40"><?=$row["comment"]?></textArea></label><br>
     <label>投稿日時：<input type="text" name="date" value="<?=$row["date"]?>"></label><br>
     <img src="<?=$row["img"]?>" width="100">
     
     <input type="file" name="filename"><br>
     <input type="submit" value="送信">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>



