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
	<h1>Danh Sách Sản Phẩm</h1>
<div class="container">
<table>
	<tr>
		<th>ID Danh Mục</th>
		<th>Loại Danh Mục</th>
		<th>Chức Năng</th>
	</tr>
<?php
$conn=mysqli_connect("localhost","root","","sanpham") or die("Can not connect database");
if (mysqli_connect_error())
  {
      echo "No Active DB Connection Please check: " . mysqli_connect_error();
  }
mysqli_set_charset($conn, 'UTF8');
$sqll="SELECT * FROM danhmuc order by iddm desc";
$query=mysqli_query($conn,$sqll);
if($query)
{
	while($row=mysqli_fetch_array($query))
	{
		?>
			<tr align="center">
				<td><?php echo $row['iddm'] ?></td>
				<td><?php echo $row['loaidanhmuc'] ?></td>			
				<td>
					<a href="editsanpham.php?iddm=<?php echo $row['iddm']?>&loaidanhmuc=<?php echo $row['loaidanhmuc']; ?>">XEM</a>
				</td>
			</tr>
		<?php
	}
}
?>
</table>
</div>
<div class="mt-md-5"></div>
</body>
</html>