<?php include 'menu.php' ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<div class="container align-content-center mt-md-5">
<div class="d-flex justify-content-center h-100">
<form class="form-inline" method="post">
	<div class="form-group">
		<select class="form-control mr-md-2" name="timkiem2">
			<option value="year">Năm</option>
			<option value="month">Tháng</option>
			<option value="day">Ngày</option>			
		</select>
		<input class="form-control" type="text" name="search" placeholder="Nhập Thời Gian Tìm Kiếm">
		<input class="btn btn-success ml-md-3" type="submit" name="timkiem" value="search">
	</div>
</form>
</div>
</div>
<?php 
$conn=mysqli_connect("localhost","root","","sanpham") or die(mysqli_error($conn));
	mysqli_set_charset($conn,"UTF8");
	if(isset($_POST['timkiem']))
	{
		$key=addslashes($_POST['search']);
		if($_POST['timkiem2']=='year')
		{
		$sql="SELECT * FROM hoadon WHERE YEAR(created_at) = '$key'";
		$query=mysqli_query($conn,$sql);
		echo "Kết Quả Tìm Kiếm Với Năm ".$key;
		}
		else if($_POST['timkiem2']=='month')
		{
			$sql="SELECT * FROM hoadon WHERE YEAR MONTH(created_at) = '$key'";
			$query=mysqli_query($conn,$sql);
			echo "Kết Quả Tìm Kiếm Với Tháng ".$key;
		}
	}
?>
</body>
</html>