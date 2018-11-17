<?php
  header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
  if(!isset($_COOKIE['username'])) {
    header("Location: login.php");
    exit;
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Danh sach san pham</title>
  <link rel="stylesheet" href="./css/main.css">
  <script src="./js/main.js"></script>
</head>
<body>
  <?php include 'lib/header.php'; ?>
  
  <div class="container">
    <h3 class="text-center">Chào bạn <?php echo $_COOKIE['username']; ?></h3>
    <p class="text-center">Danh sách sản phẩm của bạn</p> 
    
    <table class="product">
    <tr>
              <th>STT</th>
              <th>Tên sản phẩm</th>
              <th>Giá sản phẩm</th>
              <th colspan="3">Lựa chọn</th>
            </tr>
    <?php
      require "lib/config.php";
      // Create connection
      $conn = new mysqli($servername, $username, $password, $dbname);
      // Check connection
      if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      } 
      
      $user = $_COOKIE['username'];

      // acction on product
      if ($_GET['id'] != '' && $_GET['view'] == 'delete') {
        $idsp = $_GET['id'];
        $sql = "DELETE FROM sanpham
                WHERE idsp = '$idsp'";
        $result = $conn->query($sql);
      }

      // get products
      $sql = "SELECT id, idsp, tensp, chitietsp, giasp, hinhanhsp 
              FROM sanpham as sp JOIN thanhvien as tv 
              WHERE sp.idtv = tv.id AND tv.tendangnhap = '$user'";
      $result = $conn->query($sql);
      
      if ($result->num_rows > 0) {
          $i = 1;
          while($row = $result->fetch_assoc()) {
            echo '
            
            <tr>
              <td>' . $i . '</td>
              <td class="show-img">
                <span onmouseover="showImg('. $row['idsp'] . ')" onmouseout="removeImg('. $row['idsp'] . ')">' . $row['tensp'] . '</span>
                <div class="overlay" id="showImg'.  $row['idsp'] .'"></div>  
              </td>
              
              <td>' . $row['giasp'] . ' (VND)</td>
              <td><a href="#" onclick="showDetail('. $row['idsp'] . ')">Xem chi tiết</a></td>
              <td><a href="update.php?id='. $row['idsp'] . '"><img width="20" src="./icon/edit.png"></a></td>
              <td><a href="?id='. $row['idsp'] . '&view=delete"><img width="20" src="./icon/delete.png"></a></td>
            </tr>

         ';
            $i = $i + 1;
        }
      } else {
          echo "0 results";
      }

      
      $conn->close();
    ?>
     </table>

    <div id="showsp"></div>
    
    
  </div>
</body>
</html>