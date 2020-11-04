
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
  <h2 class="title staff-title">商品詳細情報</h2>
  <?php
     try {

       $pro_code=$_GET['procode'];

       $dbn = 'mysql:dbname=cafe;host=localhost;charset=utf8';
       $user='root';
       $password='root';
       $dbh = new PDO($dbn,$user,$password);
       $dbh ->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

       $sql = 'SELECT name,price,gazou FROM cafe_product WHERE code=?';
       $stmt = $dbh->prepare($sql);
       $data[]=$pro_code;
       $stmt->execute($data);

       $rec=$stmt->fetch(PDO::FETCH_ASSOC);
       $pro_name=$rec['name'];
       $pro_price=$rec['price'];
       $pro_gazou_name=$rec['gazou'];

       $dbh = null;
       if($pro_gazou_name==''){
         $disp_gazou='';
       } else {
         $disp_gazou='<img src="../product/gazou/'.$pro_gazou_name.'" class="pro-image2 mt-4">';
       }

     } catch(Exception $e) {
       print 'ただいま障害によりご迷惑をおかけしています。';
       exit();
     }
   ?>

   <?php print $disp_gazou.'<br />'; ?>
   <h5 class="mt-3 center"><?php print $pro_name.'  .... '.$pro_price.'円'; ?></h5><br />
   <?php print '<a href="shop_cartin.php?procode='.$pro_code.'" class="btn btn-primary">カートに入れる</a>'; ?>
   <form method="post" class="form-group">
     <input type="button" onclick="history.back()" value="戻る" class="btn btn-success">
   </form>



</div>
</div>
</div>



  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>                            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
</body>
</html>
