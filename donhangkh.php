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
	<a href="sanphamdamua.php"><i class="fas fa-arrow-left">Quay Lại</i></a>
	<h1>Danh Sách Đơn Hàng</h1>
<div class="container">
<table>
	<tr>
		<th>IDHD</th>
		<th>Tên Khách Hàng</th>
		<th>Địa Chỉ</th>
		<th>Tên Sản Phẩm</th>
		<th>Đơn Giá</th>
		<th>Số Lượng</th>
	</tr>
<?php
$iddonhang=$_GET['iddonhang'];
$conn=mysqli_connect("localhost","root","","sanpham") or die("Can not connect database");
if (mysqli_connect_error())
  {
      echo "No Active DB Connection Please check: " . mysqli_connect_error();
  }
mysqli_set_charset($conn, 'UTF8');
$sqll="SELECT khachhang.ten AS ten,cthoadon.idhd AS idhd,mathang.title AS title,khachhang.diachi AS diachi,cthoadon.soluong AS soluong,cthoadon.price as price FROM khachhang,hoadon,cthoadon,mathang WHERE khachhang.idkh=hoadon.idkh AND mathang.id=cthoadon.idsp AND cthoadon.idhd=hoadon.idhd AND cthoadon.idhd='".$iddonhang."'";
$query=mysqli_query($conn,$sqll);
if($query)
{
	while($row=mysqli_fetch_array($query))
	{
		?>
			<tr align="center">
				<td><?php echo $row['idhd'] ?></td>
				<td><?php echo $row['ten'] ?></td>
				<td><?php echo $row['diachi']; ?></td>
				<td><?php echo $row['title'] ?></td>
				<td><?php echo number_format($row['price'],3)." VNĐ"; ?></td>
				<td><?php echo $row['soluong'] ?></td>				
			</tr>
		<?php
	}
}
?>
</table>
</div>