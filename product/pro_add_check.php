<?php
session_start();
session_regenerate_id(true);
if(isset($_SESSION['login'])==false) {
  print 'ログインされていません。<br />';
  print '<a href="../staff_login/staff_login.php">ログイン画面へ</a>';
  exit();
}
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
        <li><a href="../shop/menu.php">MENU</a></li>
        <li><a href="../contact.html">CONTACT</a></li>
        <li><a href="staff_login_branch.php">スタッフページ</a></li>
      </ul>
    </nav>
  </div>
  <div class="staff-wrapper">
  <h2 class="title staff-title">確認</h2>
  <?php
  require_once('../common/common.php');
  $post=sanitize($_POST);
    $pro_name=$post['name'];
    $pro_price=$post['price'];
    $pro_gazou=$_FILES['gazou'];



    ?>


   <?php if($pro_name==''): ?>
     <p>商品名が入力されていません。</p>
   <?php else: ?>
     <p>商品名:<?php echo $pro_name; ?></p>
   <?php endif; ?>

   <?php if(preg_match('/\A[0-9]+\z/',$pro_price)==0): ?>
     <p>価格をきちんと入力してください。</p>
   <?php else: ?>
     <p>価格:<?php echo $pro_price; ?>円</p>
   <?php endif; ?>

   <?php if($pro_gazou['size'] = 0): ?>
     <p>画像が選択されていません。</p>
   <?php else: ?>
     <?php move_uploaded_file($pro_gazou['tmp_name'],'./gazou/'.$pro_gazou['name']); ?>
     <?php print '<img src="./gazou/'.$pro_gazou['name'].'" class="pro-image">'; ?>
     <?php print '<br />'; ?>
   <?php endif; ?>

   <?php if($pro_name=='' || preg_match('/\A[0-9]+\z/',$pro_price)==0 || $pro_gazou['size'] = 0): ?>
     <form>
       <input type="button" onclick="history.back()" value="戻る" class="btn btn-success">
     </form>
   <?php else: ?>
     <p>上記の商品を追加します。</p>
     <form method="post" action="pro_add_done.php">
       <?php print '<input type="hidden" name="name" value="'.$pro_name.'">'; ?>
       <?php print '<input type="hidden" name="price" value="'.$pro_price.'">'; ?>
       <?php print '<input type="hidden" name="gazou_name" value="'.$pro_gazou['name'].'">'; ?>
       <input type="button" onclick="history.back()" value="戻る" class="btn btn-success">
       <input type="submit" value="OK" class="btn btn-success">
     </form>
  <?php endif; ?>

 </div>
</div>
</div>



  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>                            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
</body>
</html>
