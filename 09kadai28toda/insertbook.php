<?php
session_start();

include("functions.php");
//入力チェック(受信確認処理追加)
if(
  !isset($_POST["bookname"]) || $_POST["bookname"]=="" ||
  !isset($_POST["bookurl"]) || $_POST["bookurl"]=="" ||
  !isset($_POST["comment"]) || $_POST["comment"]==""
){
  exit('ParamError');
}

//1. POSTデータ取得

$bookname   = $_POST["bookname"];
$bookurl  = $_POST["bookurl"];
$comment = $_POST["comment"];
$userid = $_SESSION["anything"];


//***FileUpload
if(isset($_FILES['filename']) && $_FILES['filename']['error']==0){
    $upload_file = "./upload/".$_FILES["filename"]["name"];
    if (move_uploaded_file($_FILES["filename"]['tmp_name'],$upload_file)){
        chmod($upload_file,0644);
    }else{
        echo "fileuploadOK...Failed";
    }
}else{
    echo "fileupload失敗";
}


//2. DB接続します
try { //エラー入ったときに
  $pdo = new PDO('mysql:dbname=gs_db28;charset=utf8;host=localhost','root','');
} catch (PDOException $e) { //受信します
  exit('DbConnectError:'.$e->getMessage()); //エラー表示
}


//３．データ登録SQL作成
$sql = "INSERT
          INTO gs_bm_table
               (id,
                bookname,
                bookurl,
                comment,
                date,
                img,
                userid)
        VALUES (NULL,
                :bookname,
                :bookurl,
                :comment,
                sysdate(),
                :img,
                :userid)";
    
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':bookname', $bookname, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':bookurl', $bookurl, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':comment', $comment, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)

$stmt->bindValue(':img',$upload_file, PDO::PARAM_STR);
$stmt->bindValue(':userid',$userid, PDO::PARAM_INT);


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
