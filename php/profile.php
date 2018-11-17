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
  <title>Thông tin thành viên</title>
  <link rel="stylesheet" href="./css/main.css">
  <script src="./js/main.js"></script>
</head>
<body>
  <?php include 'lib/header.php'; ?>
 
  <div class="container">
  <?php
    require "lib/config.php";
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    $user = $_COOKIE['username'];
    $sql = "SELECT * FROM thanhvien WHERE tendangnhap='$user'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          echo '<table>
          <tr>
            <td>Chào bạn <strong>' . $row['tendangnhap'] . '</strong></td>
          </tr>
          <tr>
            <td>
              <img class="avatar" src="' . $row['hinhanh'] . '" alt="avatar" >
            </td>
            <td>
              <p>Nickname: ' . $row['tendangnhap'] . '</p>
              <p>Giới tính: ' . $row['gioitinh'] . '</p>
              <p>Nghề nghiệp: ' . $row['nghenghiep'] . '</p>
              <p>Sơ thích: ' . $row['sothich'] . '</p>
            </td>
          </tr>
        </table>';
      }
    } else {
        echo "0 results";
    }

    $conn->close();
  ?>
  </div>
  
</body>
</html>