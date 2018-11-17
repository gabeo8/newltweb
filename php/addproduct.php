<?php
  // header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
  if(!isset($_COOKIE['username'])) {
    header("Location: login.php");
    exit;
  }
  
  if((isset($_POST['tensp']) && $_POST['tensp'] !='') 
      && (isset($_POST['chitietsp'])&& $_POST['chitietsp'] !='')
      && (isset($_POST['giasp'])&& $_POST['giasp'] !='')
      && (isset($_FILES['hinhdaidien']['name']) && $_FILES['hinhdaidien']['name'] !='')
    ) {

    $user = $_COOKIE['username'];
    
    require "lib/config.php";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 

    $sql = "SELECT id FROM thanhvien WHERE tendangnhap = '$user'";
    $result = $conn->query($sql);

      
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $id = $row['id'];
    }
    // echo $id;
    $tensp = $_POST['tensp'];
    $ctsp = $_POST['chitietsp'];
    $gsp = $_POST['giasp'];
    $target_dir = 'uploads/';
    $target_file = $target_dir  . uniqid() . '-' . basename($_FILES['hinhdaidien']['name']);
    if (move_uploaded_file($_FILES["hinhdaidien"]["tmp_name"], $target_file)) {
      $urlsp = $target_file;
    }

    $sql2 = "INSERT INTO sanpham(tensp, chitietsp, giasp, hinhanhsp, idtv)
                        VALUES ('$tensp', '$ctsp', '$gsp', '$urlsp', '$id')";

    if ($conn->query($sql2) === TRUE) {
      header("Location: products.php");
      exit;
    } else {
        echo "Error: " . $sql2 . "<br>" . $conn->error;
    }
    $conn->close();
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Them san pham moi</title>
  <link rel="stylesheet" href="./css/main.css">
  <script src="./js/main.js"></script>
</head>
<body>
  <?php include 'lib/header.php'; ?>
  <div class="container">
    <h1 class="text-center">Thêm sản phẩm mới</h1>
    <p class="text-center">Vui lòng điền đầy đủ thông tin bên dưới để thêm sản phẩm mới</p>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
      <table class="addproduct-page">
        <tr>
          <td>Tên sản phẩm</td>
          <td><input type="text" name="tensp" /></td>
        </tr>
        <tr>
          <td>Chi tiết sản phẩm</td>
          <td><textarea name="chitietsp" cols="30"></textarea></td>
        </tr>
        <tr>
          <td>Giá sản phẩm</td>
          <td><input type="text" name="giasp" /><span>(VND)</span></td>
        </tr>
        <tr>
          <td>Hình đại diện</td>
          <td><input type="file" name="hinhdaidien" /></td>
        </tr>
        <tr>
          <td colspan="2">
              <input class="btn btn-submit" type="submit" value="Thêm sản phẩm" />
              <input class="btn btn-reset" type="reset" value="Làm lại" />
          </td>
        </tr>
      </table>
    </form>
  </div>

</body>
</html>