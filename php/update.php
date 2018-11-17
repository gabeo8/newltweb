<?php
  header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
  if(!isset($_COOKIE['username'])) {
    header("Location: login.php");
    exit;
  }
  
  if (isset($_GET['id']) && $_GET['id'] != '') {
  require "lib/config.php";
  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  } 
  $idsp = $_GET['id'];
  $sql = "SELECT * FROM sanpham WHERE idsp='$idsp'";
  $result = $conn->query($sql);
  
  if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
         $tensp = $row['tensp'];
         $ctsp = $row['chitietsp'];
         $gia =  $row['giasp'];
    }
  } else {
      echo "0 results";
  }

  if((isset($_POST['tensp']) && $_POST['tensp'] != $tensp) 
      || (isset($_POST['chitietsp'])&& $_POST['chitietsp'] != $ctsp)
      || (isset($_POST['giasp'])&& $_POST['giasp'] !=$gia)
    ) {
      $tensp = $_POST['tensp'];
      $ctsp = $_POST['chitietsp'];
      $gsp = $_POST['giasp'];
      $target_dir = 'uploads/';
      $target_file = $target_dir  . uniqid() . '-' . basename($_FILES['hinhdaidien']['name']);
      if (move_uploaded_file($_FILES["hinhdaidien"]["tmp_name"], $target_file)) {
        $urlsp = $target_file;
      }

      $sql2 = "UPDATE TABLE sanpham(tensp, chitietsp, giasp, hinhanhsp)
                SET tensp='$tensp', chitietsp='$ctsp', giasp='$gsp', hinhanhsp='$urlsp'
                WHERE idsp = '$idsp'";

      if ($conn->query($sql2) === TRUE) {
        header("Location: products.php");
        exit;
      } else {
          echo "Error: " . $sql2 . "<br>" . $conn->error;
      }
  }
  $conn->close();
  } else {
    echo "Không tìm thấy sản phẩm hoặc sản phẩm không tồn tại";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Cập nhật sản phẩm</title>
  <link rel="stylesheet" href="./css/main.css">
  <script src="./js/main.js"></script>
</head>
<body>
  <?php include 'lib/header.php'; ?>
  <div class="container">
    <h1 class="text-center">Cập nhật sản phẩm</h1>
    <p class="text-center">Vui lòng điền đầy đủ thông tin bên dưới để cập nhật sản phẩm</p>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
      <table class="addproduct-page">
        <tr>
          <td>Tên sản phẩm</td>
          <td><input type="text" name="tensp" value="<?php echo $tensp; ?>" /></td>
        </tr>
        <tr>
          <td>Chi tiết sản phẩm</td>
          <td><textarea name="chitietsp" cols="30"><?php echo $ctsp; ?></textarea></td>
        </tr>
        <tr>
          <td>Giá sản phẩm</td>
          <td><input type="text" name="giasp"  value="<?php echo $gia; ?>" /><span>(VND)</span></td>
        </tr>
        <tr>
          <td>Hình đại diện</td>
          <td><input type="file" name="hinhdaidien" /></td>
        </tr>
        <tr>
          <td colspan="2">
              <input class="btn btn-submit" type="submit" value="Cập nhật sản phẩm" />
              <input class="btn btn-reset" type="reset" value="Làm lại" />
          </td>
        </tr>
      </table>
    </form>
  </div>

</body>
</html>