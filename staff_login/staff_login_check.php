
<?php
   try {
     $staff_code=$_POST['code'];
     $staff_pass=$_POST['pass'];

     $staff_code=htmlspecialchars($staff_code,ENT_QUOTES,'utf-8');
     $staff_pass=htmlspecialchars($staff_pass,ENT_QUOTES,'utf-8');
     $staff_pass=md5($staff_pass);

     $dbn = 'mysql:dbname=cafe;host=localhost;charset=utf8';
     $user='root';
     $password='root';
     $dbh = new PDO($dbn,$user,$password);
     $dbh ->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

     $sql = 'SELECT name FROM cafe_staff WHERE code=? AND password=?';
     $stmt = $dbh->prepare($sql);
     $data[] = $staff_code;
     $data[] = $staff_pass;
     $stmt->execute($data);

     $dbh = null;

     $rec=$stmt->fetch(PDO::FETCH_ASSOC);

     if($rec == false) {
       header('Location:false.php');
       exit();

     } else {
       session_start();
       $_SESSION['login']=1;
       $_SESSION['staff_code']=$staff_code;
       $_SESSION['staff_name']=$rec['name'];
       header('Location:staff_top.php');
       exit();
     }

   } catch(Exception $e) {
     print 'ただいま障害によりご迷惑をおかけしています。';
     exit();
   }
 ?>
