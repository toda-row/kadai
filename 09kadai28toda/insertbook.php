<?php
//1. POSTデータ取得

$bookname   = $_POST["bookname"];
$bookurl  = $_POST["bookurl"];
$comment = $_POST["comment"];

//2. DB接続します
try { //エラー入ったときに
  $pdo = new PDO('mysql:dbname=gs_db28;charset=utf8;host=localhost','root','');
} catch (PDOException $e) { //受信します
  exit('DbConnectError:'.$e->getMessage()); //エラー表示
}


//３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO gs_bm_table(id, bookname, bookurl, comment, date )VALUES(NULL, :bookname, :bookurl, :comment, sysdate())");
$stmt->bindValue(':bookname', $bookname, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':bookurl', $bookurl, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':comment', $comment, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //executeは実行

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("QueryError（SQLのエラー）:".$error[2]);
}else{
  //５．index.phpへリダイレクト
  header("Location: selectbook.php"); //Location:　のあとに必ずスペースが必要
  exit;

}
?>
