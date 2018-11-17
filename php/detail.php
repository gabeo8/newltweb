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
  <title>Chi tiết sản phẩm</title>
  <link rel="stylesheet" href="./css/main.css">
  <script src="./js/main.js"></script>
</head>
<body>
  <?php include 'lib/header.php'; ?>
 
  <div class="container">
  <?php
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
          echo '<table>
          <tr>
            <td>
              <img src="' . $row['hinhanhsp'] . '" alt="hinh" >
            </td>
            <td>
              <p>Tên sản phẩm: ' . $row['tensp'] . '</p>
              <p>Chi tiết sản phẩm: ' . $row['chitietsp'] . '</p>
              <p>Giá: ' . $row['giasp'] . '</p>
            </td>
          </tr>
        </table>';
      }
    } else {
        echo "0 results";
    }

    $conn->close();
  } else {
    echo "Không tìm thấy sản phẩm hoặc sản phẩm không tồn tại";
  }
  ?>
  </div>
  
</body>
</html>