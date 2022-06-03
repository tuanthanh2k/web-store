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
	<h1>Danh Sách Sản Phẩm <?php echo $_GET['loaidanhmuc'] ?></h1>
<div class="container">
<table>
	<tr>
		<th>Tên Sản Phẩm</th>
		<th>Size</th>
		<th>Giới Thiệu Sản Phẩm</th>
		<th>Người Bán</th>
		<th>Đơn Giá</th>
		<th>Sale</th>
		<th>Chức Năng</th>
	</tr>
<?php
$conn=mysqli_connect("localhost","root","","sanpham") or die("Can not connect database");
if (mysqli_connect_error())
  {
      echo "No Active DB Connection Please check: " . mysqli_connect_error();
  }
mysqli_set_charset($conn, 'UTF8');
$sqll="SELECT * FROM mathang WHERE iddm='".$_GET['iddm']."' order by id desc";
$query=mysqli_query($conn,$sqll);
if($query)
{
	while($row=mysqli_fetch_array($query))
	{
		?>
			<tr align="center">
				<td><?php echo $row['title'] ?></td>
				<td><?php echo $row['size'] ?></td>
				<td><?php echo $row['about'] ?></td>
				<td><?php echo $row['author'] ?></td>
				<td><?php echo number_format("$row[price]",3)." VNĐ" ?></td>
				<td><?php echo $row['sale']."%" ?></td>				
				<td>
					<a href="#" class="btn btn-primary pl-lg-4 pr-lg-4 pt-1 pb-1" style="background-color: purple;" data-toggle="modal" data-target="#exampleModalCenter<?php echo $row['id'];?>">Edit</a>
					<a class="btn btn-danger pl-lg-3 pr-lg-3 pt-1 pb-1" style="background-color: orange;" href="xuly.php?idssp=<?php echo $row['id'] ?>">Delete</a>
				</td>
			</tr>
				<div class="modal fade" id="exampleModalCenter<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header text-center">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<div class=" mx-auto mw-100 col-lg-5">
									<h5 class="text-center mb-4 font-weight-bold">Chỉnh Sửa Thông Tin Sản Phẩm</h5>
									<form  action="xuly.php" method="post">
										<div class="form-group">
											<label class="font-weight-bold">Tên Sản Phẩm</label>
											<input type="text" class="form-control" name="title" value="<?php echo $row['title']; ?>" >
										</div>
										<div class="form-group">
											<label class="font-weight-bold">Size</label>
											<input type="text" class="form-control" name="size" value="<?php echo $row['size']; ?>">
										</div>
										<div class="form-group">
											<label class="font-weight-bold">Giới Thiệu Sản Phẩm</label>
											<input type="text" class="form-control" name="about"  value="<?php echo $row['about']; ?>">
										</div>
										<div class="form-group">
											<label class="font-weight-bold">Người Bán</label>
											<input type="text" class="form-control" name="author"  value="<?php echo $row['author']; ?>">
										</div>
										<div class="form-group">
											<label class="font-weight-bold">Đơn Giá</label>
											<input type="text" class="form-control" name="price"  value="<?php echo $row['price']; ?>">
										</div>
										<div class="form-group">
											<label class="font-weight-bold">Sale</label>
											<input type="text" class="form-control" name="sale"  value="<?php echo $row['sale']; ?>">
										</div>
										<button type="submit" class="btn btn-success d-block mt-md-5 ml-auto w-25"  name="editsp" value="<?php echo $row['id']; ?>">Save</button>
										
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
<div class="mt-md-5"></div>
</body>
</html>