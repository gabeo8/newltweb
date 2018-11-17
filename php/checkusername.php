<?php
    // import config
    require "lib/config.php";

    // create connect
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    // query
    if (isset($_GET['username']) && $_GET['username'] !='') {
        $dn = htmlspecialchars($_GET['username']);
    }
    $sql_username = "SELECT tendangnhap FROM thanhvien WHERE tendangnhap = '$dn'";
    $result = $conn->query($sql_username);
    if ($result->num_rows > 0) {
        echo "<span style='color: red'>Username đã tồn tại</span>";
    } else {
        echo "<span style='color: green'>Ban co the su dung username nay</span>";
    }

    // colse connection
    $conn->close();
?>
