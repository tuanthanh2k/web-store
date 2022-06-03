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
<h2 class="text-center">Danh Sách Đơn Hàng</h2>
<div class="container">
<table>
	<tr>
		<th>IDHD</th>
		<th>Tên Khách Hàng</th>
		<th>Địa Chỉ</th>
		<th>Tổng Tiền</th>
		<th>Thời Điểm Mua</th>
		<th>Trạng Thái</th>
	</tr>
<?php
$conn=mysqli_connect("localhost","root","","sanpham") or die("Can not connect database");
if (mysqli_connect_error())
  {
      echo "No Active DB Connection Please check: " . mysqli_connect_error();
  }
mysqli_set_charset($conn, 'UTF8');
$sqll="SELECT khachhang.ten AS ten,hoadon.idhd AS idhd,khachhang.diachi AS diachi,hoadon.trangthai AS trangthai,hoadon.tongtien AS tongtien,hoadon.created_at AS created_at FROM khachhang,hoadon WHERE khachhang.idkh=hoadon.idkh AND khachhang.idkh='".$_SESSION['id']."'";
$query=mysqli_query($conn,$sqll);
$total=0;
if($query)
{
	while($row=mysqli_fetch_array($query))
	{
		$total+=$row['tongtien'];
		?>
			<tr align="center">
				<td><a href="donhangkh.php?iddonhang=<?php echo $row['idhd'] ?>"><?php echo $row['idhd'] ?></a></td>
				<td><?php echo $row['ten'] ?></td>
				<td><?php echo $row['diachi'] ?></td>
				<td><?php echo number_format("$row[tongtien]",3)." VNĐ" ?></td>
				<td><?php echo $row['created_at'] ?></td>
				<td><?php echo $row['trangthai'] ?></td>				
			</tr>
		<?php
	}
}
?>
</table>
</div>