<?php
    require "lib/config.php";
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    
    $user = $_COOKIE['username'];
    $search = $_GET['search'];

    // get products
    $sql = "SELECT idsp, tensp
            FROM sanpham as sp JOIN thanhvien as tv 
            WHERE sp.idtv = tv.id AND tv.tendangnhap = '$user' AND tensp LIKE '%$search%'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo '<option value="' . $row['tensp'] . '">';
        }
    } else {
        echo "0 results";
    }

    
    $conn->close();
?>