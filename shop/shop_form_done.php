<?php
  session_start();
  session_regenerate_id(true);
 ?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>PHPポートフォリオ</title>
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
        <li><a href="top.html">TOP</a></li>
        <li><a href="menu.php">MENU</a></li>
        <li><a href="contact.html">CONTACT</a></li>
        <li><a href="../staff_login/staff_login_branch.ph">スタッフの方はこちら</a></li>
      </ul>
    </nav>
  </div>
  <div class="header-title center">
    <h2 class="title">ご購入手続き</h2>
  </div>

</div>
<div class="menu-content">
  <h2>注文完了</h2>
  <?php
  try {
   require_once('../common/common.php');

   $post=sanitize($_POST);

   $onamae=$post['onamae'];
   $email=$post['email'];
   $postal1=$post['postal1'];
   $postal2=$post['postal2'];
   $address=$post['address'];
   $tel=$post['tel'];

 } catch(Exception $e) {
   print '障害により大変ご迷惑をおかけしています。';
   exit();
 }
   ?>

   <p><?php print $onamae; ?>様</p>
   <p>ご注文ありがとうございました。</p>
   <p><?php print $email; ?>にメールを送りましたのでご確認ください。<br>商品は以下の住所に送らせていただきます。</p>
   <p><?php print $postal1.'-'.$postal2; ?></p>
   <p><?php print $address; ?></p>
   <p><?php print $tel; ?></p>
   <a href="cart_destroy.php" class="btn btn-success">メニューへ戻る</a>

   <?php
   $honbun='';
   $honbun.=$onamae."様\n\nこのたびはご注文ありがとうございました。\n";
   $honbun.="\n";
   $honbun.="ご注文商品\n";
   $honbun.="--------------------\n";

   $cart=$_SESSION['cart'];
   $kazu=$_SESSION['kazu'];
   $max=count($cart);

   $dsn='mysql:dbname=cafe;host=localhost;charset=utf8';
   $user='root';
   $password='root';
   $dbh=new PDO($dsn,$user,$password);
   $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

   for($i=0;$i<$max;$i++)
   {
     $sql='SELECT name,price FROM cafe_product WHERE code=?';
     $stmt=$dbh->prepare($sql);
     $data[0]=$cart[$i];
     $stmt->execute($data);

     $rec=$stmt->fetch(PDO::FETCH_ASSOC);

     $name=$rec['name'];
     $price=$rec['price'];
     $kakaku[]=$price;
     $suryo=$kazu[$i];
     $shokei=$price*$suryo;

     $honbun.=$name.' ';
     $honbun.=$price.'円 x ';
     $honbun.=$suryo.'個 = ';
     $honbun.=$shokei."円\n";
   }

   $sql='LOCK TABLES dat_sales WRITE, dat_sales_product WRITE';
   $stmt=$dbh->prepare($sql);
   $stmt->execute();

   $sql='INSERT INTO dat_sales(code_member,name,email,postal1,postal2,address,tel) VALUES(?,?,?,?,?,?,?)';
   $stmt=$dbh->prepare($sql);
   $data=array();
   $data[] = 0;
   $data[] =$onamae;
   $data[] =$email;
   $data[] =$postal1;
   $data[] =$postal2;
   $data[] =$address;
   $data[] =$tel;
   $stmt->execute($data);

   $sql= 'SELECT LAST_INSERT_ID()';
   $stmt=$dbh->prepare($sql);
   $stmt->execute();
   $rec=$stmt->fetch(PDO::FETCH_ASSOC);
   $lastcode=$rec['LAST_INSERT_ID()'];


   for($i=0;$i<$max;$i++) {
     $sql='INSERT INTO dat_sales_product(code_sales,code_product,price,quantity) VALUES(?,?,?,?)';
     $stmt=$dbh->prepare($sql);
     $data = array();
     $data[]=$lastcode;
     $data[]=$cart[$i];
     $data[]=$kakaku[$i];
     $data[]=$kazu[$i];
     $stmt->execute($data);

   }
   $sql='UNLOCK TABLES';
   $stmt=$dbh->prepare($sql);
   $stmt->execute();


   $dbh=null;

   $honbun.="送料は無料です。\n";
   $honbun.="--------------------\n";
   $honbun.="\n";
   $honbun.="代金は以下の口座にお振込ください。\n";
   $honbun.="ろくまる銀行 やさい支店 普通口座 １２３４５６７\n";
   $honbun.="入金確認が取れ次第、梱包、発送させていただきます。\n";
   $honbun.="\n";
   $honbun.="□□□□□□□□□□□□□□\n";
   $honbun.="　～安心野菜のろくまる農園～\n";
   $honbun.="\n";
   $honbun.="○○県六丸郡六丸村123-4\n";
   $honbun.="電話 090-6060-xxxx\n";
   $honbun.="メール info@rokumarunouen.co.jp\n";
   $honbun.="□□□□□□□□□□□□□□\n";

   // print '<br />';
   // print nl2br($honbun);

   $title='ご注文ありがとうございます。';
   $header='FROM:info@imaginarycafe.co.jp';
   $honbun=html_entity_decode($honbun,ENT_QUOTES,'utf-8');
   mb_language('japanese');
   mb_internal_encoding('utf-8');
   mb_send_mail($email,$title,$honbun,$header);

   $title='お客様からご注文がありました。';
   $header='FROM:'.$email;
   $honbun=html_entity_decode($honbun,ENT_QUOTES,'utf-8');
   mb_language('japanese');
   mb_internal_encoding('utf-8');
   mb_send_mail('info@imaginarycafe.co.jp',$title,$honbun,$header);


    ?>




</div>
</div>



  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>                            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
</body>
</html>
