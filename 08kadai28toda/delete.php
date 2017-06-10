<?php

 //GET値取得
$id = $_GET["id"];


//DB接続します
try { //エラー入ったときに
  $pdo = new PDO('mysql:dbname=gs_db28;charset=utf8;host=localhost','root','');
} catch (PDOException $e) { //受信します
  exit('DbConnectError:'.$e->getMessage()); //エラー表示
}


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
    header("Location: select.php");
    exit;

}


?>