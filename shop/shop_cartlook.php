<?php
 session_start();
 ?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>PHPポートフォリオ-MENU</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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
        <li><a href="../staff_login/staff_login.php">スタッフページ</a></li>
      </ul>
    </nav>
  </div>
  <div class="header-title center">
    <h2 class="title">CART</h2>
  </div>
</div>

<?php
   try {

       $cart=$_SESSION['cart'];
       $kazu=$_SESSION['kazu'];
       $max=count($cart);

     $dbn = 'mysql:dbname=cafe;host=localhost;charset=utf8';
     $user='root';
     $password='root';
     $dbh = new PDO($dbn,$user,$password);
     $dbh ->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

     foreach($cart as $key => $val) {
       $sql = 'SELECT code,name,price,gazou FROM cafe_product WHERE code=?';
       $stmt = $dbh->prepare($sql);
       $data[0] = $val;
       $stmt->execute($data);



       $rec = $stmt->fetch(PDO::FETCH_ASSOC);

       $pro_name[] = $rec['name'];
       $pro_price[] = $rec['price'];
       if($rec['gazou']=='') {
         $pro_gazou[]='';
       } else {
         $pro_gazou[]='<img src="../product/gazou/'.$rec['gazou'].'" class="item-image">';
       }
     }
       $dbh=null;




   } catch(Exception $e) {
     print 'ただいま障害によりご迷惑をおかけしています。';
     exit();
   }
 ?>


<div class="menu-content">
  <div class="cart-wrapper">
    <?php if($max==0): ?>
      <p>カートに商品は入っていません。</p><br>
      <a href="menu.php" class="btn btn-primary">メニューに戻る</a>
      <?php exit(); ?>
    <?php endif; ?>

    <a href="shop_form.html" class="btn btn-danger mb-2"><i class="fas fa-cart-plus"></i> ご購入手続きへ進む</a><br>
    <form method="post" action="kazu_change.php" class="form-group row">
    <?php for($i=0;$i<$max;$i++): ?>
    <div class="cart-item border-top pt-4 pb-4 d-flex d-row">
     <?php print $pro_gazou[$i]; ?>
      <div class="ex-cart ml-4 mt-5">
        <h5><?php print $pro_name[$i]; ?></h5>
        <div class="product-detail d-flex d-row justify-content-around">
          <h6 class="mt-4 price mb-4"><?php print $pro_price[$i].'円×'; ?></h6>
          <input type="text" name="kazu<?php print $i; ?>" value="<?php print $kazu[$i]; ?>" class="form-control ml-4 mt-3">
        </div>
        <h6>小計:<?php print $pro_price[$i] * $kazu[$i]; ?>円</h6>
        <input type="checkbox" name="sakujyo<?php print $i;?>">
        カートから削除する
      </div>
    </div>
  <?php endfor; ?>
  </div>
  <input type="hidden" name="max" value="<?php print $max; ?>" class="form-control">
  <p class="alert alert-success">数量を変更したい場合は、数字を変更してから「数量を変更する」ボタンをクリックしてください。</p>
  <p class="alert alert-success">カートから商品を削除したい場合は、チェックを入れて「数量を変更する」ボタンをクリックしてください。</p>
  <input type="submit" value="数量を変更する" class="btn btn-danger"><br>
</form>
  <a href="menu.php" class="btn btn-primary text-center mt-3">メニューに戻る</a>


</div>

<footer>
  <p class="copyright">©︎ 2020 IMAGINARY CAFE</p>
</footer>
</div>


  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>                            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
</body>
</html>
