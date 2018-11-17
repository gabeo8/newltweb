<?php
  header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
  if(!isset($_COOKIE['username'])) {
    header("Location: login.php");
    exit;
  }
  
?>
<!DOCTYPE html>
<html>
<head> 
	<title> Lập trình web (CT428) </title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<!-- <link rel="stylesheet" type="text/css" href="style.css" media="screen" /> -->



</head>	
<body>
<div id="wrap">
	<div id="title">
		<h1>Bài 4 - Buổi 4</h1>
	</div> <!--end div title-->
	<div id="menu">
		<!-- chèn menu của sinh viên vào-->
	</div> <!--end div menu-->
	<div id="content">
		<!--Nội dung trang web-->
		<h1>Slide show image</h1>
	
		<form>
			<img id="laptopImg"  height="300" width="300" />
			<br/>
			<input type="button" name="previous" value="Previous" onclick="changeSlide(-1)">
			<input type="button" name="next" value="Next" onclick="changeSlide(1)">
			<br/>
			<select name="productImgs" id="productImgShow" onchange="chooseSlide(this)">
				<?php
				require "lib/config.php";
				// Create connection
				$conn = new mysqli($servername, $username, $password, $dbname);
				// Check connection
				if ($conn->connect_error) {
					die("Connection failed: " . $conn->connect_error);
				} 
			
				$user = $_COOKIE['username'];
			
				// get products
				$sql = "SELECT idsp, hinhanhsp, tensp
						FROM sanpham as sp JOIN thanhvien as tv 
						WHERE sp.idtv = tv.id AND tv.tendangnhap = '$user'";
				$result = $conn->query($sql);
				if ($result->num_rows > 0) {
					$i = 0;
					while($row = $result->fetch_assoc()) {
						echo '<option id="' . $i . '" value="' . $row['hinhanhsp'] . '" >' . $row['tensp'] . '</option>';
						$i = $i + 1;
					}
				} else {
					echo "0 results";
				}
			
			
				$conn->close();
				?>
			</select> 
		</form>
	
	</div> <!--end div content-->
	
</div> <!--end div wrap-->

<script>
		var IMAGE_PATHS = [];
		var productImgShow = document.getElementById('productImgShow')
		for (let i = 0; i < productImgShow.options.length; i++) {
			IMAGE_PATHS.push(productImgShow.item(i).value)
		}
		var posCurrent = 0;
		var imgOpt = document.getElementById('laptopImg')
		imgOpt.src = IMAGE_PATHS[posCurrent]

		function changeSlide(pos) {
			var imgOpt = document.getElementById('laptopImg')
			posCurrent += pos	

			if (posCurrent < 0) {
				posCurrent = IMAGE_PATHS.length-1;
			} else if (posCurrent > IMAGE_PATHS.length-1) {
				posCurrent = 0
			}

			var indexImg = posCurrent % IMAGE_PATHS.length
			imgOpt.src = IMAGE_PATHS[indexImg]

			// update box select
			var mySelect = document.getElementsByName('productImgs')
			mySelect.value = posCurrent % IMAGE_PATHS.length
			var getOption = document.getElementById(String(mySelect.value))
			getOption.selected = 'true'
		}

		function chooseSlide(pos) {
			var id = pos[pos.selectedIndex].id
			console.log(id)
			imgOpt.src = IMAGE_PATHS[id]
		}
</script>
</body>
</html>