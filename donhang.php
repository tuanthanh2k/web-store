<?php 
	include 'menu.php';
	$conn=mysqli_connect("localhost","root","","sanpham") or die("Can not connect database");
if (mysqli_connect_error())
  {
      echo "No Active DB Connection Please check: " . mysqli_connect_error();
  }
mysqli_set_charset($conn, 'UTF8');
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
<form method="post" action="donhang.php">
	<div class="form-group row in-line text-center">
		<div class="col-xs-3 ml-lg-5">
			    <label>Year</label>
    			<select class="form-control" name="year">
    				<option value="0">0</option>
    				<?php for($i=2000;$i<=2020;$i++)
    					{
    						echo "<option value='$i'>Năm $i</option>";
    					}
    				?>
    			</select>
    		</div>
    		<div class="col-xs-3 ml-lg-1">
    			<label>Month</label>
    			<select class="form-control" name="month">
    				<option value="0">0</option>
    				<?php for($i=1;$i<=12;$i++)
    					{
    						echo "<option value='$i'>Tháng $i</option>";
    					}
    				?>
    			</select>
    		</div>
    		<div class="col-xs-3 ml-lg-1">
    			<label>Day</label>
    			<select class="form-control" name="day">
    				<option value="0">0</option>
    				<?php for($i=1;$i<=31;$i++)
    					{
    						echo "<option value='$i'>Ngày $i</option>";
    					}
    				?>
    			</select>
    		</div>
    		<<div class="col-xs-3 ml-lg-1">
    			<label>Sản Phẩm</label>
    			<select class="form-control" name="title">
    				<option value="0">0</option>
    				<?php $sqli="SELECT * FROM mathang";
    					  $query=mysqli_query($conn,$sqli);
    					  if($query)
    					  {
    					  	while($row=mysqli_fetch_array($query))
    					  	{
    					  		echo "<option value='".$row['id']."'>".$row['title']."</option>";
    					  	}
    					  }
    				  ?>
    			</select>
    		</div>
    			<input class="btn btn-success ml-md-1" type="submit" name="search" value="Tìm">
		</div>
  	</div>
</form>
<div class="container">
<table>
	<tr>
		<th>IDHD</th>
		<th>Tên Khách Hàng</th>
		<th>Địa Chỉ</th>
		<th>Tổng Tiền</th>
		<th>Thời Điểm Mua</th>
		<th>Trạng Thái</th>
		<th>Chức Năng</th>
	</tr>
<?php
if(isset($_POST['search'])){
	$_SESSION['year']=$_POST['year'];
	$_SESSION['month']=$_POST['month'];
	$_SESSION['day']=$_POST['day'];
		if($_POST['year']!=0 && $_POST['month']==0 && $_POST['day']==0&&$_POST['title']==0)
		{
		$sqll="SELECT khachhang.ten AS ten,hoadon.idhd AS idhd,khachhang.diachi AS diachi,hoadon.trangthai AS trangthai,hoadon.tongtien AS tongtien,hoadon.created_at AS created_at FROM khachhang,hoadon WHERE khachhang.idkh=hoadon.idkh AND YEAR(hoadon.created_at)='".$_POST['year']."'";
			$_SESSION['year']=$_POST['year'];
			unset($_SESSION['month']);
			unset($_SESSION['day']);
		}
		else if($_POST['year']!=0 && $_POST['month']!=0 && $_POST['day']==0&&$_POST['title']==0)
		{
		$sqll="SELECT khachhang.ten AS ten,hoadon.idhd AS idhd,khachhang.diachi AS diachi,hoadon.trangthai AS trangthai,hoadon.tongtien AS tongtien,hoadon.created_at AS created_at FROM khachhang,hoadon WHERE khachhang.idkh=hoadon.idkh AND YEAR(hoadon.created_at)='".$_POST['year']."' AND MONTH(hoadon.created_at)='".$_POST['month']."'";
			$_SESSION['year']=$_POST['year'];
			$_SESSION['month']=$_POST['month'];
			unset($_SESSION['day']);
		}
		else if($_POST['year']!=0 && $_POST['month']!=0 && $_POST['day']!=0&&$_POST['title']==0)
		{
		$sqll="SELECT khachhang.ten AS ten,hoadon.idhd AS idhd,khachhang.diachi AS diachi,hoadon.trangthai AS trangthai,hoadon.tongtien AS tongtien,hoadon.created_at AS created_at FROM khachhang,hoadon WHERE khachhang.idkh=hoadon.idkh AND YEAR(hoadon.created_at)='".$_POST['year']."' AND MONTH(hoadon.created_at)='".$_POST['month']."' AND DAY(hoadon.created_at)='".$_POST['day']."'";
			$_SESSION['year']=$_POST['year'];
			$_SESSION['month']=$_POST['month'];
			$_SESSION['day']=$_POST['day'];
		}
		else if($_POST['year']==0 && $_POST['month']==0 && $_POST['day']==0&&$_POST['title']!=0){
			$sqll="SELECT DISTINCT khachhang.ten AS ten,hoadon.idhd AS idhd,khachhang.diachi AS diachi,hoadon.trangthai AS trangthai,hoadon.tongtien AS tongtien,hoadon.created_at AS created_at FROM khachhang,hoadon,cthoadon WHERE khachhang.idkh=hoadon.idkh AND hoadon.idhd=cthoadon.idhd AND cthoadon.idsp='".$_POST['title']."'";
					unset($_SESSION['year']);
					unset($_SESSION['month']);
					unset($_SESSION['day']);

		}
		else if($_POST['year']!=0&&$_POST['month']==0&&$_POST['day']==0&&$_POST['title']!=0){
			$sqll="SELECT DISTINCT khachhang.ten AS ten,hoadon.idhd AS idhd,khachhang.diachi AS diachi,hoadon.trangthai AS trangthai,hoadon.tongtien AS tongtien,hoadon.created_at AS created_at FROM khachhang,hoadon,cthoadon WHERE khachhang.idkh=hoadon.idkh AND hoadon.idhd=cthoadon.idhd AND YEAR(hoadon.created_at)='".$_POST['year']."' AND cthoadon.idsp='".$_POST['title']."'";
					$_SESSION['year']=$_POST['year'];
					unset($_SESSION['month']);
					unset($_SESSION['day']);
		}
		else if($_POST['year']!=0&&$_POST['month']!=0&&$_POST['day']==0&&$_POST['title']!=0){
			$sqll="SELECT DISTINCT khachhang.ten AS ten,hoadon.idhd AS idhd,khachhang.diachi AS diachi,hoadon.trangthai AS trangthai,hoadon.tongtien AS tongtien,hoadon.created_at AS created_at FROM khachhang,hoadon,cthoadon WHERE khachhang.idkh=hoadon.idkh AND hoadon.idhd=cthoadon.idhd AND YEAR(hoadon.created_at)='".$_POST['year']."' AND MONTH(hoadon.created_at)='".$_POST['month']."' AND cthoadon.idsp='".$_POST['title']."'";
					$_SESSION['year']=$_POST['year'];
					$_SESSION['month']=$_POST['month'];
					unset($_SESSION['day']);
		}
		else if($_POST['year']!=0&&$_POST['month']!=0&&$_POST['day']!=0&&$_POST['title']!=0){
			$sqll="SELECT DISTINCT khachhang.ten AS ten,hoadon.idhd AS idhd,khachhang.diachi AS diachi,hoadon.trangthai AS trangthai,hoadon.tongtien AS tongtien,hoadon.created_at AS created_at FROM khachhang,hoadon,cthoadon WHERE khachhang.idkh=hoadon.idkh AND hoadon.idhd=cthoadon.idhd AND YEAR(hoadon.created_at)='".$_POST['year']."' AND MONTH(hoadon.created_at)='".$_POST['month']."' AND DAY(hoadon.created_at)='".$_POST['day']."' AND cthoadon.idsp='".$_POST['title']."'";
					$_SESSION['year']=$_POST['year'];
					$_SESSION['month']=$_POST['month'];
					$_SESSION['day']=$_POST['day'];
		}
		else{
		$sqll="SELECT khachhang.ten AS ten,hoadon.idhd AS idhd,khachhang.diachi AS diachi,hoadon.trangthai AS trangthai,hoadon.tongtien AS tongtien,hoadon.created_at AS created_at FROM khachhang,hoadon WHERE khachhang.idkh=hoadon.idkh";	
		unset($_SESSION['year']);
		unset($_SESSION['month']);
		unset($_SESSION['day']);
		}
}
else{
$sqll="SELECT khachhang.ten AS ten,hoadon.idhd AS idhd,khachhang.diachi AS diachi,hoadon.trangthai AS trangthai,hoadon.tongtien AS tongtien,hoadon.created_at AS created_at FROM khachhang,hoadon WHERE khachhang.idkh=hoadon.idkh";
		unset($_SESSION['year']);
		unset($_SESSION['month']);
		unset($_SESSION['day']);
}
$query=mysqli_query($conn,$sqll);
$total=0;
$soluong=0;
if($query)
{
	while($row=mysqli_fetch_array($query))
	{
		$total+=$row['tongtien'];
		?>
			<tr align="center">
				<td><a href="donhang1.php?iddonhang=<?php echo $row['idhd'] ?>"><?php echo $row['idhd'] ?></a></td>
				<td><?php echo $row['ten'] ?></td>
				<td><?php echo $row['diachi'] ?></td>
				<td><?php echo number_format("$row[tongtien]",3)." VNĐ" ?></td>
				<td><?php echo $row['created_at'] ?></td>
				<td><?php echo $row['trangthai'] ?></td>				
				<td>
					<a href="#" class="btn btn-primary pl-lg-4 pr-lg-4 pt-1 pb-1" style="background-color: purple;" data-toggle="modal" data-target="#exampleModalCenter<?php echo $row['idhd'];?>">Edit</a>
					<a class="btn btn-danger pl-lg-3 pr-lg-3 pt-1 pb-1" style="background-color: orange;" href="xuly.php?idhd=<?php echo $row['idhd'] ?>">Delete</a>
				</td>
			</tr>
							<div class="modal fade" id="exampleModalCenter<?php echo $row['idhd']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header text-center">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<div class=" mx-auto mw-100 col-lg-5">
									<h5 class="text-center mb-4 font-weight-bold">Chỉnh Sửa Trạng Thái Đơn Hàng</h5>
									<form  action="xuly.php" method="post">
										<div class="form-group">
											<label class="font-weight-bold">Trạng Thái</label>
											<select class="form-control" name="trangthai">
												<option value="Đang Trên Đường Giao Hàng">Đang Trên Đường Giao Hàng</option>
												<option value="Đã Giao Hàng">Đã Giao Hàng</option>
											</select>
										</div>
										<button type="submit" class="btn btn-success d-block mt-md-5 ml-auto w-25"  name="edithd" value="<?php echo $row['idhd']; ?>">Save</button>
										
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
		<?php
if(isset($_SESSION['year'])&&isset($_SESSION['month'])&&isset($_SESSION['day']))
{
	$result=mysqli_query($conn,"SELECT DISTINCT SUM(cthoadon.soluong) AS soluong FROM cthoadon,hoadon WHERE cthoadon.idhd=hoadon.idhd AND cthoadon.idsp='".$_POST['title']."' AND YEAR(hoadon.created_at)='".$_POST['year']."' AND MONTH(hoadon.created_at)='".$_POST['month']."' AND DAY(hoadon.created_at)='".$_POST['day']."' ");
}
else if(isset($_SESSION['year'])&&isset($_SESSION['month']))
{
	$result=mysqli_query($conn,"SELECT DISTINCT SUM(cthoadon.soluong) AS soluong FROM cthoadon,hoadon WHERE cthoadon.idhd=hoadon.idhd AND cthoadon.idsp='".$_POST['title']."' AND YEAR(hoadon.created_at)='".$_POST['year']."' AND MONTH(hoadon.created_at)='".$_POST['month']."'");
}
else if(isset($_SESSION['year']))
{
	$result=mysqli_query($conn,"SELECT DISTINCT SUM(cthoadon.soluong) AS soluong FROM cthoadon,hoadon WHERE cthoadon.idhd=hoadon.idhd AND cthoadon.idsp='".$_POST['title']."' AND YEAR(hoadon.created_at)='".$_POST['year']."'");
}
else
{
	$result=mysqli_query($conn,"SELECT DISTINCT SUM(cthoadon.soluong) AS soluong FROM cthoadon,hoadon WHERE cthoadon.idhd=hoadon.idhd AND cthoadon.idsp='".$_POST['title']."'");
}
			$rowa=mysqli_fetch_array($result);
			$soluong=$rowa['soluong'];
	}
}
if(isset($_SESSION['year'])&&isset($_SESSION['month'])&&isset($_SESSION['day']))
{
echo "Tổng Doanh Thu Của ".$_SESSION['year']."-".$_SESSION['month']."-".$_SESSION['day']." là : ".number_format($total,3)." VNĐ<br>";
echo "Số Lượng Là : ".$soluong;
}
else if(isset($_SESSION['year'])&&isset($_SESSION['month']))
{
echo "Tổng Doanh Thu Của ".$_SESSION['year']."-".$_SESSION['month']." là : ".number_format($total,3)." VNĐ<br>";
echo "Số Lượng Là : ".$soluong;
}
else if(isset($_SESSION['year']))
{
echo "Tổng Doanh Thu Của ".$_SESSION['year']." là : ".number_format($total,3)." VNĐ<br>";
echo "Số Lượng Là : ".$soluong;
}
else
{
echo "Tổng Doanh Thu là : ".number_format($total,3)." VNĐ<br>";
echo "Số Lượng Là : ".$soluong;
}
?>
</table>
</div>