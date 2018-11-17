<?php

// mysql
  require "lib/config.php";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  } 
  if((isset($_POST['username']) && $_POST['username'] !='') 
    && (isset($_POST['password'])&& $_POST['password'] !='')) {

      $dn = $_POST['username'];
      $mk = $_POST['password'];
      $sql = "SELECT tendangnhap, matkhau FROM thanhvien WHERE  tendangnhap = '$dn'";
    
      $result = $conn->query($sql);
        
      if ($result->num_rows == 1) {
          $row = $result->fetch_assoc();
          if (password_verify($mk, $row['matkhau'])) {
            // echo "Dnag nhap thanh cong";
            setcookie('username', $dn, time() + (86400 * 30), "/"); // 86400 = 1 day
            header("Location: profile.php");
          } else {
            $msg_error = "Sai mat khau";
          }
    
      } else {
        $msg_error = "Tai khoan khong ton tai";
      }
  } 
  

  $conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Đăng kí thành viên</title>
  <link rel="stylesheet" href="./css/main.css">
  <script src="./js/main.js"></script>
</head>
<body>
  <?php include 'lib/header.php'; ?>
  <div class="container">
    <h1>Đăng nhập</h1>
    <div style="color: red"><?php if (isset($msg_error)) {echo $msg_error;} ?></div>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
      <table>
        <tr>
          <td>Tên đăng nhập</td>
          <td><input type="text" name="username" /></td>
        </tr>
        <tr>
          <td>Mật khẩu</td>
          <td><input type="password" name="password" /></td>
        </tr>
        <tr>
          <td>
              <input type="submit" value="Đăng nhập" />
          </td>
        </tr>
      </table>
      <p>Bạn chưa có tài khoản? Đăng kí tại đây!</p>
    </form>
  </div>

</body>
</html>