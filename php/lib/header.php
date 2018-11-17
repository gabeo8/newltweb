<ul>
  <li><a class="active" href="index.php">Trang chủ</a></li>
  <?php
    if(isset($_COOKIE['username'])) {
      echo '<li><a href="logout.php">Đăng xuất</a></li>';
    } else {
      echo '<li><a href="register.php">Đăng kí</a></li>
      <li><a href="login.php">Đăng nhập</a></li>';
    }
    
  ?>
  <li><a href="profile.php">Thông tin thành viên</a></li>
  <li><a href="products.php">Danh sách sản phẩm</a></li>
  <li><a href="addproduct.php">Thêm sản phẩm mới</a></li>
  <?php
    if(isset($_COOKIE['username'])) {
      echo '<li><a href="slide-images.php">Buổi 4 - Bài 4</a></li>';
    }
  ?>
  <?php
    if(isset($_COOKIE['username'])) {
      echo '<li class="search">
        <input type="text" list="datalist" placeholder="Tim kiem san pham" onkeyup="searchProduct(this.value)">
        <datalist id="datalist"></datalist>
      </li>';
    }
  ?>
   
  
</ul>
