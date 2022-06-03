<?php
if(isset($_SESSION))
{
session_start();
}
 include 'menu.php';
if(isset($_POST['change']))
{
	foreach($_POST['qty'] as $key => $value)
	{
		if(($value == 0) and (is_numeric($value)))
		{
			unset($_SESSION['cart'][$key]);
		}
		else if(($value > 0) and (is_numeric($value)))
		{
			$_SESSION['cart'][$key] = $value;
		}
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Giỏ Hàng</title>
    <link href="https://fonts.googleapis.com/css?family=Amatic+SC:400,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900&display=swap"
        rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
	<style type="text/css">
	body{
	background: white;
	font-family: sans-serif;
	overflow-x: hidden;
	}
	a{
	color:#666666;
	text-decoration:none;
	font-weight:900;
	}
	</style>
</head>
<body>
<section class="page-add cart-page-add">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="page-breadcrumb">
                        <h2>Giỏ Hàng<span>.</span></h2>
                    </div>
                </div>
                <div class="col-lg-8">
                    <img src="img/add.jpg" alt="">
                </div>
            </div>
        </div>
    </section>
<div class="cart-page">
        <div class="container">
            <div class="cart-table">
                <table>
                    <thead>
                        <tr>
                            <th class="product-h">Sản Phẩm</th>
                            <th>Giá</th>
                            <th class="quan">Số Lượng</th>
                            <th>Tổng Tiền</th>
                            <th></th>
                        </tr>
                    </thead>
                    <?php
                    $ok=1;
if(isset($_SESSION['cart']))
{
	foreach($_SESSION['cart'] as $k=>$v)
	{
		if(isset($k))
		{
			$ok=2;
		}
	}
}
if($ok==2)
{
echo "<form action='cart.php' method='post'>";
foreach($_SESSION['cart'] as $key=>$value)
{
	$item[] = $key;
}
$str=implode(",",$item);
$conn=mysqli_connect("localhost","root","","sanpham") or die("Can not connect database");
mysqli_set_charset($conn,'UTF8');
$sql="select * from mathang where id in ($str)";
$query=mysqli_query($conn,$sql);
$total=0;
while($row=mysqli_fetch_array($query))
{
?>
                    <tbody>
                        <tr>
                            <td class="product-col">
                                <?php echo "<img src='upload/".$row['image']."' alt='".$row['image']."'>"; ?>
                                <div class="p-title">
                                    <?php echo "<h5>$row[title]</h5>"; ?>
                                </div>
                            </td>
                            <td class="price-col"><?php 
                            if($row['sale']==0){
                                echo number_format("$row[price]",3)." VNĐ";
                            }
                            else{
                                echo number_format("$row[price]"-"$row[price]"*"$row[sale]"/100,3)." VNĐ";
                            } ?></td>
                            <td class="quantity-col">
                                <div class="pro-qty">
                                    <?php echo "<input type='text' name='qty[$row[id]]' value='{$_SESSION['cart']["$row[id]"]}'>" ?>
                                </div>
                            </td>
                            <td class="total">
                                <?php 
                            if($row['sale']==0){
                                echo number_format($_SESSION['cart']["$row[id]"]*"$row[price]",3)." VNĐ";
                            }
                            else{
                                echo number_format($_SESSION['cart']["$row[id]"]*("$row[price]"-"$row[price]"*"$row[sale]"/100),3)." VNĐ";
                            } ?>
                            </td>
                            <td class="product-close"><a href="delcart.php?productid=<?php echo $row['id'] ?>">x</a></td>
                        </tr>
                    </tbody>
                <?php 	
                        if($row['sale']==0){
                                $total+=$_SESSION['cart']["$row[id]"]*"$row[price]";
                            }
                            else{
                                $total+=$_SESSION['cart']["$row[id]"]*("$row[price]"-"$row[price]"*"$row[sale]"/100);
                            }
            } ?>
                </table>
            </div>
            <div class="cart-btn">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="coupon-input">
                            <input type="text" placeholder="Enter cupone code">
                        </div>
                    </div>
                    <div class="col-lg-5 offset-lg-1 text-left text-lg-right">
                    	<a type='submit' class="primary-btn chechout-btn" name='order_click'>Xác Nhận Mua</a>
                    	<input type="submit" class="site-btn update-btn" name="change" value="Cập Nhật">
                    </div>
                </div>
            </div>
        </div>
        <div class="shopping-method">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="total-info">
                            <div class="total-table">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Giá Trị Giỏ Hàng</th>
                                            <th>Shipping</th>
                                            <th class="total-cart">Tổng Tiền</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="total"><?php echo number_format($total,3)." VNĐ" ?></td>
                                            <td class="shipping">Free</td>
                                            <td class="total-cart-p"><?php echo number_format($total,3)." VNĐ" ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 text-right">
                                	<input type='submit' class="primary-btn chechout-btn" name='order_click' value='Xác Nhận Mua'/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php 
    echo "</form>";
	}
	?>
    </div>
    <?php 
	if(isset($_POST['muahang']))
{
	$con=mysqli_connect("localhost","root","","sanpham");
	mysqli_set_charset($con,'UTF8');
	$sql="SELECT idhd FROM hoadon WHERE idhd=(select MAX(idhd) FROM hoadon)";
	$query=mysqli_query($con,$sql);
	$row=mysqli_fetch_array($query);
	$idmh=$row['idhd']+1;
	$result=mysqli_query($conn,"SELECT * FROM `mathang` where id in ($str)" or die($conn->error));
		if (mysqli_num_rows($result)>0) 
		{
			while($rowa=mysqli_fetch_array($result))
			{
				$sqll="INSERT INTO cthoadon(idhd,idsp,soluong,price) VALUES ('".$idmh."','".$rowa['id']."','".$_SESSION['cart']["$rowa[id]"]."','".$rowa['price']."') ";
			if ($con->query($sqll) or die($con->error)) {	}
			}
	$sqlll="INSERT INTO hoadon(idhd,idkh,tongtien,trangthai) VALUES ('".$idmh."','".$_SESSION['id']."','".$total."','Đang Trên Đường Giao Hàng') ";
	if ($con->query($sqlll) or die($con->error)) {
				$_SESSION['thongbao'] = 'Đã Thanh Toán';
				unset($_SESSION['cart']);
			}
		}
}
?>
</body>
</html>