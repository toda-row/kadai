<?php

session_start();


//1.  DB接続します
include("functions.php");
//1.POSTでParamを取得

//2.DB接続など
$pdo = db_con();

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_user_table");

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
    $view .='<a href="detailuser.php?id='.$result["id"].'">';
    $view .= ' '; 
    $view .= $result["id"];
    $view .= ' ';
    $view .= $result["name"];
    $view .= ' ';
    $view .= $result["lid"];
    $view .= ' ';
    $view .= $result["lpw"];
    $view .= ' ';
    $view .= $result["date"];
    $view .='</a>';
    $view .= '<a href="deleteuser.php?id='.$result["id"].'">'; 
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
<title>09ユーザーの一覧</title>
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
<table>
    <div class="container jumbotron"><?=$view?></div>
</table>
<!-- Main[End] -->

</body>
</html>
