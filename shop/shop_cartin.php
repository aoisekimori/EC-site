<?php
session_start();
 ?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>PHPポートフォリオ</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="../style.css">
</head>
<body>
  <div class="wrap">
  <div class="menu-wrapper">
  <div class="header">
    <h1 class="title">IMAGINARY<br />CAFE</h1>
    <nav>
      <ul class="header-menu">
        <li><a href="../top.html">TOP</a></li>
        <li><a href="menu.php">MENU</a></li>
        <li><a href="../contact.html">CONTACT</a></li>
        <li><a href="../staff_login/staff_login_branch.ph">スタッフページ</a></li>
      </ul>
    </nav>
  </div>
  <div class="staff-wrapper">
  <h2 class="title staff-title">カートへ追加</h2>
  <?php
     try {

       $pro_code=$_GET['procode'];








     } catch(Exception $e) {
       print 'ただいま障害によりご迷惑をおかけしています。';
       exit();
     }
   ?>

   <?php if(isset($_SESSION['cart'])==true): ?>
     <?php $cart=$_SESSION['cart']; ?>
     <?php $kazu=$_SESSION['kazu']; ?>
     <?php if(in_array($pro_code,$cart)==true): ?>
       <p>その商品は既にカートに入っています。</p>
       <a href="menu.php" class="btn btn-primary">メニューへ戻る</a>
       <?php exit(); ?>
     <?php endif; ?>
   <?php endif; ?>
   <?php $cart[]=$pro_code; ?>
   <?php $kazu[]=1; ?>
   <?php $_SESSION['cart']=$cart; ?>
   <?php $_SESSION['kazu']=$kazu; ?>
  <p>カートに追加しました。</p>
  <a href="menu.php" class="btn btn-success">商品一覧へ戻る</a>



</div>
</div>
</div>



  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>                            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
</body>
</html>
