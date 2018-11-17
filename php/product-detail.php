<?php
    echo "<div class='container'>";
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
    echo "</div>";
?>
