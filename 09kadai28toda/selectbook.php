<?php

session_start();
$hensu = $_SESSION["anything"];

//1.  DB接続します
include("functions.php");
//1.POSTでParamを取得

//2.DB接続など
$pdo = db_con();

//２．データ登録SQL作成
$sql = "SELECT *
          FROM gs_bm_table
         WHERE userid = :userid";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':userid', $hensu);
//baintvalue で検索

$status = $stmt->execute();

//３．データ表示
$view="";
if($status==false){
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);

}else{
  //Selectデータの数だけ自動でループしてくれる
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){

    $view .='<p>';//.=は追加処理＋＝と一緒
    $view .= '<img src="'.$result["img"].'" width="100">';
    $view .='<a href="bookdetail.php?id='.$result["id"].'">';
    $view .= ' '; 
    $view .= $result["id"];
    $view .= ' ';
    $view .= $result["bookname"];
    $view .= ' ';
    $view .= $result["bookurl"];
    $view .= ' ';
    $view .= $result["comment"];
    $view .= ' ';
    $view .= $result["date"];
    $view .='</a>';
    $view .= '<a href="deletebook.php?id='.$result["id"].'">'; 
    $view .= ' [削除] '; 
    $view .= '</a>'; 
    $view .='</p>';
  }

}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>09書籍一覧表示</title>
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">


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
            <a class="navbar-brand" href="login.php">ログイン</a>
        <?php } else { ?>
            <a class="navbar-brand" href="logout.php">ログアウト</a>
        <?php } ?>
        
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="post" action="insertbook.php" enctype="multipart/form-data">
  <div class="container jumbotron">
   <fieldset>
    <legend>本をブックマークする</legend>
     <label>書籍名：<input type="text" name="bookname"></label><br>
     <label>書籍URL：<input type="text" name="bookurl"></label><br>
     <label><textArea name="comment" rows="4" cols="40"></textArea></label><br>
     <input type="file" name="filename"><br>
     <input type="submit" value="送信">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->

<!-- Main[Start] -->
<table>

    <div class="container jumbotron">
        <p>登録書籍一覧</p><?=$view?>
    </div>
</table>
<!-- Main[End] -->





</body>
</html>
