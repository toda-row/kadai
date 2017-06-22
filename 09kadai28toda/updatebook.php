<?php
//1. POSTデータ取得
$id = $_POST["id"];
$bookname = $_POST["bookname"];
$bookurl = $_POST["bookurl"];
$comment = $_POST["comment"];
//var_dump($_POST);

//2. DB接続します
try { //エラー入ったときに
  $pdo = new PDO('mysql:dbname=gs_db28;charset=utf8;host=localhost','root','');
} catch (PDOException $e) { //受信します
  exit('DbConnectError:'.$e->getMessage()); //エラー表示
}


//３．データ登録SQL作成
$update = $pdo->prepare("UPDATE gs_bm_table SET bookname=:bookname,bookurl=:bookurl,comment=:comment WHERE id=:id");
$update->bindValue(':id', $id, PDO::PARAM_INT);
$update->bindValue(':bookname', $bookname, PDO::PARAM_STR);
$update->bindValue(':bookurl', $bookurl, PDO::PARAM_STR);
$update->bindValue(':comment', $comment, PDO::PARAM_STR);
$status = $update->execute(); //executeは実行

//データ表示
$view="";
if($status==false){
  //execute（SQL実行時にエラーがある場合）
  $error = $update->errorInfo();
  exit("ErrorQuery:".$error[2]);
}else{
    header("Location: selectbook.php");
    exit;

}




?>