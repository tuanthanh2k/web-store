<?php
include 'menu.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Sản Phẩm</title>
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
    <?php if(isset($_GET['iddm']))
    {
        $danhm = $_GET['iddm'];  
    $conn=mysqli_connect("localhost","root","","sanpham") or die("Can not connect database");

    if (mysqli_connect_error())
    {
         echo "No Active DB Connection Please check: " . mysqli_connect_error();
    }
    mysqli_set_charset($conn, 'UTF8');
    }

    $sqll="SELECT loaidanhmuc FROM danhmuc WHERE iddm='".$danhm."'";
    $fetch=mysqli_query($conn,$sqll);
    $roww=mysqli_fetch_array($fetch);

     ?>
    <section class="latest-products spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="section-title">
                        <h2><?php echo $roww['loaidanhmuc'] ?></h2>
                    </div>
                </div>
            </div>
    <div class="row">
    <?php
    $sql="SELECT COUNT(id) AS total FROM mathang WHERE iddm='".$danhm."' ORDER by id DESC";
        $query = mysqli_query($conn,$sql);
        $row = mysqli_fetch_array($query);
        if($row['total']>0)
        {
        $total_records = $row['total'];
        $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
        $limit = 6;
        $total_page = ceil($total_records / $limit);
        if ($current_page > $total_page){
            $current_page = $total_page;
        }
        else if ($current_page < 1){
            $current_page = 1;
        }
        $start = ($current_page - 1) * $limit;
        $sql="SELECT * FROM mathang WHERE iddm='".$danhm."'  LIMIT $start, $limit";
        $query = mysqli_query($conn, $sql);
if(mysqli_num_rows($query) > 0)
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

  ?>
</div>
</div>
<div class="container">
    <div class="text-center">
           <?php 
            if ($current_page > 1 && $total_page > 1){
            echo '<a href="danhmucsanpham.php?page='.($current_page-1).'&iddm='.$danhm.'">Prev</a> | ';
            }
            for ($i = 1; $i <= $total_page; $i++){
                if ($i == $current_page){
                    echo '<span>'.$i.'</span> | ';
                }
                else{
                    echo '<a href="danhmucsanpham.php?page='.$i.'&iddm='.$danhm.'">'.$i.'</a> | ';
                }
            }
            if ($current_page < $total_page && $total_page > 1){
                echo '<a href="danhmucsanpham.php?page='.($current_page+1).'&iddm='.$danhm.'">Next</a> | ';
            }
        }
           ?>
        </div>
</div>

</section>
</body>
</html>