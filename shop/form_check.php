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
  <h2>個人情報チェック</h2>
  <?php
   require_once('../common/common.php');

   $post=sanitize($_POST);

   $onamae=$post['onamae'];
   $email=$post['email'];
   $postal1=$post['postal1'];
   $postal2=$post['postal2'];
   $address=$post['address'];
   $tel=$post['tel'];

   $okflg=true;

   if($onamae=='')
   {
   	print 'お名前が入力されていません。<br /><br />';
     $okflg=false;
   } else {
     print 'お名前<br />';
     print $onamae;
     print '<br /><br />';
   }

   if(preg_match('/\A[\w\-\.]+\@[\w\-\.]+\.([a-z]+)\z/',$email)==0)
   {
   	print 'メールアドレスを正確に入力してください。<br /><br />';
     $okflg=false;
   } else {
     print 'メールアドレス<br />';
     print $email;
     print '<br /><br />';
   }

   if(preg_match('/\A[0-9]+\z/',$postal1)==0)
   {
   	print '郵便番号は半角数字で入力してください。<br /><br />';
     $okflg=false;
   } else {
     print '郵便番号<br />';
     print $postal1;
     print '-';
     print $postal2;
     print '<br /><br />';
   }

   if(preg_match('/\A[0-9]+\z/',$postal2)==0)
   {
   	print '郵便番号は半角数字で入力してください。<br /><br />';
     $okflg=false;
   }

   if($address=='')
   {
   	print '住所が入力されていません。<br /><br />';
     $okflg=false;
   } else {
     print 'お住所<br />';
     print $address;
     print '<br /><br />';
   }

   if(preg_match('/\A\d{2,5}-?\d{2,5}-?\d{4,5}\z/',$tel)==0)
   {
   	print '電話番号を正確に入力してください。<br /><br />';
     $okflg=false;
   } else {
     print '電話番号<br />';
     print $tel;
     print '<br /><br />';
   }
 if($okflg==true) {
   print '<form method="post" action="shop_form_done.php">';
   print '<input type="hidden" name="onamae" value="'.$onamae.'">';
   print '<input type="hidden" name="email" value="'.$email.'">';
   print '<input type="hidden" name="postal1" value="'.$postal1.'">';
   print '<input type="hidden" name="postal2" value="'.$postal2.'">';
   print '<input type="hidden" name="address" value="'.$address.'">';
   print '<input type="hidden" name="tel" value="'.$tel.'">';
   print '<input type="button" onclick="history.back()" value="修正する" class="btn btn-primary"><br />';
   print '<input type="submit" value="ＯＫ" class="btn btn-success">';
   print '</form>';
 } else {
   print '<form>';
   print '<input type="button" onclick="history.back()" value="戻る" class="btn btn-primary">';
   print '</form>';
 }
   ?>


</div>
</div>



  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>                            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
</body>
</html>
