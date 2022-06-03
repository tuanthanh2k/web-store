<?php 
include 'menu.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Tìm Kiếm</title>
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
<div class="container align-content-center mt-md-5">
<div class="d-flex justify-content-center h-100">
<form class="form-inline" method="post">
	<div class="form-group">
		<select class="form-control mr-md-2" name="timkiem2">
			<option value="title">Tên Sản Phẩm</option>
			<option value="price">Giá Cả</option>			
		</select>
		<input class="form-control" type="text" name="search" placeholder="Nhập Từ Khóa Tìm Kiếm">
		<input class="btn btn-success ml-md-3" type="submit" name="timkiem" value="Tìm Kiếm">
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
		if($_POST['timkiem2']=='title')
		{
		$sql="SELECT * FROM mathang WHERE (LOWER(title) LIKE '%$key%')";
		$query=mysqli_query($conn,$sql);
		echo "Kết Quả Tìm Kiếm Với ".$key;
		echo "<div class='container'>";
		echo "<div class='row'>";
		if($query)
		{
			while($row=mysqli_fetch_array($query))
			{
 echo "<div class='col-lg-3 col-sm-6'>";
 	echo "<div class='single-product-item'>";
 	echo "<figure>";
 	echo "<a href='#'><img src='upload/".$row['image']."' alt=''></a>";
    if($row['sale']==0){
 	echo "<div class='p-status'>New</div>";
    }
    else{
        echo "<div class='p-status sale'>Sale</div>";
    }
 	echo "</figure>";
 	echo "<div class='product-text'>";
 	echo "<h6>".$row['title']."</h6>";
    if($row['sale']==0){
        echo "<p>".number_format("$row[price]",3)." VNĐ</p>";
    }
    else{
        echo "<p><sup><strike>".number_format("$row[price]",3)."</strike></sup> ".number_format("$row[price]"-"$row[price]"*"$row[sale]"/100,3)." VNĐ</p>";
    }
 	if(isset($_SESSION['user']))
{
	 echo "<p align='right'><a href='addcart.php?item=$row[id]'>Thêm Vào Giỏ Hàng</a></p>";
}
else
{
	echo "<p align='right'><a href='dangnhap.php'>Đăng Nhập</a></p>";
}
?>
<p align="left"><a href="#" data-toggle="modal" data-target="#exampleModalCenter<?php echo $row['id'];?>">Chi Tiết</a></p>
<?php
 	echo "</div>";
 	echo "</div>";
 	echo "</div>";
 	?>
 	<div class="modal fade modal-lg" style="margin-left: 350px;" id="exampleModalCenter<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header text-center">
                                <h5 class="text-center"><?php echo $row['title'] ?></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                    <div class=" mx-auto mw-100 col-lg-6 col-sm-6">
                                        <div class="row in-line">
                                        <div class="col-lg-6">
                                            <?php   echo "<a href='#'><img src='upload/".$row['image']."' alt=''></a>"; ?>
                                        </div>
                                        <div class="col-lg-6">
                                            <?php if($row['sale']==0){ ?>
                                            <label class="font-weight-bold"><?php echo number_format("$row[price]",3)." VNĐ" ?></label><br>
                                            <?php }else { ?>
                                            <label class="font-weight-bold"><sup><strike><?php echo number_format("$row[price]",3) ?></strike></sup><?php echo " ".number_format("$row[price]"-"$row[price]"*"$row[sale]"/100,3)." VNĐ" ?></label><br>
                                        <?php } ?>
                                        <?php echo $row['about'] ?>
                                            <?php   if(isset($_SESSION['user']))
                                            {
                                                echo "<p align='center'><a href='addcart.php?item=$row[id]'>Thêm Vào Giỏ Hàng</a></p>";
                                            }
                                            else
                                            {
                                                echo "<p align='center'><a href='dangnhap.php'>Đăng Nhập</a></p>";
                                            } ?>
                                        </div>
                                        
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
 	<?php
			}
		}
echo "</div>";
		}
		else if($_POST['timkiem2']=='price')
		{
		$sql="SELECT * FROM mathang WHERE (LOWER(price) LIKE '%$key%')";
		$query=mysqli_query($conn,$sql);
		echo "Kết Quả Tìm Kiếm Với ".number_format("$key",3)." VNĐ";
		echo "<div class='container'>";
		echo "<div class='row'>";
		if($query)
		{
			while($row=mysqli_fetch_array($query))
			{
 echo "<div class='col-lg-3 col-sm-6'>";
 	echo "<div class='single-product-item'>";
 	echo "<figure>";
 	echo "<a href='#'><img src='upload/".$row['image']."' alt=''></a>";
    if($row['sale']==0){
 	echo "<div class='p-status'>New</div>";
    }
    else{
        echo "<div class='p-status sale'>Sale</div>";
    }
 	echo "</figure>";
 	echo "<div class='product-text'>";
 	echo "<h6>".$row['title']."</h6>";
    if($row['sale']==0){
 	    echo "<p>".number_format("$row[price]",3)." VNĐ</p>";
    }
    else{
        echo "<p>".number_format("$row[price]"-"$row[price]"*"$row[sale]"/100,3)." VNĐ</p>";
    }
 	if(isset($_SESSION['user']))
{
	 echo "<p align='right'><a href='addcart.php?item=$row[id]'>Thêm Vào Giỏ Hàng</a></p>";
}
else
{
	echo "<p align='right'><a href='dangnhap.php'>Đăng Nhập</a></p>";
}
?>
<p align="left"><a href="#" data-toggle="modal" data-target="#exampleModalCenter<?php echo $row['id'];?>">Chi Tiết</a></p>
<?php
 	echo "</div>";
 	echo "</div>";
 	echo "</div>";
 	?>
 	<div class="modal fade modal-lg" style="margin-left: 350px;" id="exampleModalCenter<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header text-center">
                                <h5 class="text-center"><?php echo $row['title'] ?></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                    <div class=" mx-auto mw-100 col-lg-6 col-sm-6">
                                        <div class="row in-line">
                                        <div class="col-lg-6">
                                            <?php   echo "<a href='#'><img src='upload/".$row['image']."' alt=''></a>"; ?>
                                        </div>
                                        <div class="col-lg-6">
                                            <?php if($row['sale']==0){ ?>
                                            <label class="font-weight-bold"><?php echo number_format("$row[price]",3)." VNĐ" ?></label><br>
                                            <?php }else { ?>
                                            <label class="font-weight-bold"><sup><strike><?php echo number_format("$row[price]",3) ?></strike></sup><?php echo number_format("$row[price]"-"$row[price]"*"$row[sale]"/100,3)." VNĐ" ?></label><br>
                                        <?php } ?>
                                        <?php echo $row['about'] ?>
                                            <?php   if(isset($_SESSION['user']))
                                            {
                                                echo "<p align='center'><a href='addcart.php?item=$row[id]'>Thêm Vào Giỏ Hàng</a></p>";
                                            }
                                            else
                                            {
                                                echo "<p align='center'><a href='dangnhap.php'>Đăng Nhập</a></p>";
                                            } ?>
                                        </div>
                                        
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
 	<?php
			}
		}
echo "</div>";
		}
		echo "</div>";
	}
?>

</body>
</html>