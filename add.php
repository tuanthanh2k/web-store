<?php 
	include 'menu.php';
		$conn=mysqli_connect("localhost","root","","sanpham") or die(mysqli_error($conn));
	mysqli_set_charset($conn,"UTF8");
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Thêm Sản Phẩm</title>
	<link rel="stylesheet" type="text/css" href="style/style.css" media="all">
	<meta http-equiv="Content-Type" content="text/html" charset="utf-8">
	<script src="//cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
</head>
<body>
<div class="container align-content-center h-100 mt-md-5">
<div class="d-flex justify-content-center h-100">
<form class="form-group" method="post" enctype="multipart/form-data" action="xuly.php">
	<label><h1 style="">Thêm Sản Phẩm</h1></label>
<div class="form-group">
	<label class="font-weight-bold">Người Bán</label>
<input class="form-control" type="text" name="author" placeholder="Write on it">
</div>
<div class="form-group">
	<label class="font-weight-bold">Tên Sản Phẩm</label>
	<input class="form-control" type="text" name="title" placeholder="Write on it">
</div>
<div class="form-group">
	<label class="font-weight-bold">Size</label>
	<input class="form-control" type="text" name="size" placeholder="Write on it">
</div>
<div class="form-group">
	<label class="font-weight-bold">Ảnh</label>
	<input class="form-control" type="file" name="image">
</div>
<div class="form-group">
	<label class="font-weight-bold">Giới Thiệu Sản Phẩm</label>
	<textarea class="form-control" id="about" name="about" rows="10" cols="43"></textarea>
</div>
<div class="form-group">
	<label class="font-weight-bold">Loại</label>
	<select class="form-control" name="danhmuc">
		<?php 
		$sql="SELECT * FROM danhmuc";
		$query=mysqli_query($conn,$sql);
		if(mysqli_num_rows($query) > 0)
		{
 		while($row=mysqli_fetch_array($query))
 		{
		echo "<option value='".$row['iddm']."'>".$row['loaidanhmuc']."</option>"; } }?>
	</select>
</div>
<div class="form-group">
	<label class="font-weight-bold">Giá</label>
	<input class="form-control" type="text" name="price" placeholder="Write on it">
</div>
	<input class="btn btn-success mb-lg-3" type="submit" name="add" value="Thêm">
</form>
<script type="text/javascript">
	CKEDITOR.replace( 'about' );
</script>
</div>
</div>
</body>
</html>