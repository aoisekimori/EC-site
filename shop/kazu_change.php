<?php
  session_start();
  session_regenerate_id(true);

  require_once('../common/common.php');

  $post=sanitize($_POST);

  $max=$post['max'];
  $cart=$_SESSION['cart'];

  for($i=0;$i<$max;$i++) {

    if(preg_match("/\A[0-9]+\z/", $post['kazu'.$i])==0) {
      print '数量に誤りがあります。';
      print '<a href="shop_cartlook.php" class="btn btn-primary">カートに戻る</a>';
      exit();
    }

    if(isset($_POST['sakujyo'.$i])==true) {
      array_splice($cart,$i,1);
      array_splice($kazu,$i,1);
    }

    $kazu[]=$post['kazu'.$i];
  }

  $_SESSION['kazu']=$kazu;
  $_SESSION['cart']=$cart;

  header('Location:shop_cartlook.php');
  exit();
 ?>
