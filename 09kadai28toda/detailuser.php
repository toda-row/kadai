<?php
session_start();


//2. DB接続します
include("functions.php");
//1.POSTでParamを取得
$id = $_GET["id"];

//2.DB接続など
$pdo = db_con();


//３．データ登録SQL変更
$stmt = $pdo->prepare("SELECT * FROM gs_user_table WHERE id=:id");
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
  <title>ユーザーデータ編集</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="selectuser.php">ユーザーの一覧</a></div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="post" action="updateuser.php">
 <input type="hidden" name="id" value="<?=$id?>">
  <div class="jumbotron">
   <fieldset>
    <legend>ユーザーの編集をする</legend>
     <label>ユーザー名：<input type="text" name="name" value="<?=$row["name"]?>"></label><br>
     <label>ユーザーID：<input type="text" name="lid" value="<?=$row["lid"]?>"></label><br>
     <label>ユーザーPASS：<input type="text" name="lpw" value="<?=$row["lpw"]?>"></label><br>
     <input type="submit" value="送信">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>



