<?php

session_start();

//DB接続します
include("functions.php");
//1.POSTでParamを取得
$id = $_GET["id"];

//2.DB接続など
$pdo = db_con();



//データ登録SQL削除
$delete = $pdo->prepare("DELETE FROM gs_bm_table WHERE id=:id");
$delete->bindValue(':id', $id, PDO::PARAM_INT);
$status = $delete->execute(); //executeは実行

//データ表示
$view="";
if($status==false){
  //execute（SQL実行時にエラーがある場合）
  $error = $delete->errorInfo();
  exit("ErrorQuery:".$error[2]);
}else{
    header("Location: selectbook.php");
    exit;

}


?>