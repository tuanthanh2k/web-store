<?php include 'menu.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Đăng Ký</title>
	<style type="text/css">
		.login100-form-title {
  font-family: Poppins-Regular;
  font-size: 20px;
  color: #555555;
  line-height: 1.2;
  text-transform: uppercase;
  letter-spacing: 2px;
  text-align: center;

  width: 100%;
  display: block;
}
	</style>
</head>
<body>

<div class="container mt-md-2">
	<div class="row">
		 <div class="col-lg-6 col-sm-12">
		 	<div class="single-product-item">
		 		<img src="img/bg-01.jpg" alt="">
		 	</div>
		 </div>	
		 <div class="col-lg-6 col-sm-12" style="margin-top: 100px;">
		 	<div class="single-product-item">
		 		<form method="post" action="xuly.php">
					<label class="login100-form-title"><h4>Account Register</h4></label>
					<div class="col-lg-12">
						<div class="form-group">
						<input class="form-control" placeholder="Username" type="text" name="username">
					</div>
					</div>
					<div class="col-lg-12">
						<div class="form-group">
						<input class="form-control" placeholder="Password" type="password" name="password">
					</div>
					</div>
					<div class="col-lg-12">
						<div class="form-group">
						<input type="password" class="form-control" name="cfmpass" placeholder="Confirm Password">
					</div>
					</div>
					<div class="col-lg-12">
						<div class="form-group">
						<input type="text" class="form-control" name="ten" placeholder="Tên">
					</div>
					</div>
					<div class="col-lg-12">
						<div class="form-group">
						<input type="text" class="form-control" name="diachi" placeholder="Địa Chỉ">
					</div>
					</div>
				</div>
				<input class="btn btn-success login100-form-title py-md-3" type="submit" name="dangky" value="Đăng Ký">
				</form>
				<a class="login100-form-title mt-md-3" href="dangnhap.php"><h5><font color="green">Đăng Nhập</font></h5></a>
		 	</div>
		 </div>
	</div>
</div>
</body>
</html>