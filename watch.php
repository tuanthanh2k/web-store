<?php 
	include 'menu.php';
 ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		table{
			width: 800px;
			margin: auto;
			text-align: center;
			table-layout: fixed;
		}
		table, tr, th, td{
			padding: 20px;
			color: #fff;
			border:1px solid #080808;
			border-collapse: collapse;
			font-size: 18px;
			font-family: Arial;
			background: linear-gradient(top, #3c3c3c 0%, #222222 100%);
			background: -webkit-linear-gradient(top, #3c3c3c 0%, #222222 100%);
		}
		td:hover{
			background: purple;
		}
		h1{
			text-align: center;
		}
	</style>
</head>
<body>
	<h1>Danh Sách Khách Hàng</h1>
<div class="container">
<table>
	<tr>
		<th>Username</th>
		<th>password</th>
		<th>Tên Khách Hàng</th>
		<th>Địa Chỉ</th>
		<th>Chức Năng</th>
	</tr>
<?php
$conn=mysqli_connect("localhost","root","","sanpham") or die("Can not connect database");
if (mysqli_connect_error())
  {
      echo "No Active DB Connection Please check: " . mysqli_connect_error();
  }
mysqli_set_charset($conn, 'UTF8');
$sqll="SELECT * FROM khachhang order by idkh desc";
$query=mysqli_query($conn,$sqll);
if($query)
{
	while($row=mysqli_fetch_array($query))
	{
		?>
			<tr align="center">
				<td><?php echo $row['username'] ?></td>
				<td><?php echo $row['password'] ?></td>
				<td><?php echo $row['ten'] ?></td>
				<td><?php echo $row['diachi'] ?></td>				
				<td>
					<a href="#" class="btn btn-primary pl-lg-4 pr-lg-4 pt-1 pb-1" style="background-color: purple;" data-toggle="modal" data-target="#exampleModalCenter<?php echo $row['idkh'];?>">Edit</a>
					<a class="btn btn-danger pl-lg-3 pr-lg-3 pt-1 pb-1" style="background-color: orange;" href="xuly.php?idkh=<?php echo $row['idkh'] ?>">Delete</a>
				</td>
			</tr>
							<div class="modal fade" id="exampleModalCenter<?php echo $row['idkh']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header text-center">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<div class=" mx-auto mw-100 col-lg-5">
									<h5 class="text-center mb-4 font-weight-bold">Chỉnh Sửa Thông Tin Khách Hàng</h5>
									<form  action="xuly.php" method="post">
										<div class="form-group">
											<label class="font-weight-bold">username</label>
											<input type="text" class="form-control" name="username" value="<?php echo $row['username']; ?>" >
										</div>
										<div class="form-group">
											<label class="font-weight-bold">password</label>
											<input type="text" class="form-control" name="password" value="<?php echo $row['password']; ?>">
										</div>
										<div class="form-group">
											<label class="font-weight-bold">Tên Khách Hàng</label>
											<input type="text" class="form-control" name="ten"  value="<?php echo $row['ten']; ?>">
										</div>
										<div class="form-group">
											<label class="font-weight-bold">Địa Chỉ</label>
											<input type="text" class="form-control" name="diachi"  value="<?php echo $row['diachi']; ?>">
										</div>
										<button type="submit" class="btn btn-success d-block mt-md-5 ml-auto w-25"  name="editkh" value="<?php echo $row['idkh']; ?>">Save</button>
										
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
		<?php
	}
}
?>
</table>
</div>