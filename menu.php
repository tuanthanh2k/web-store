<?php include_once 'xuly.php' ;
?>
<!DOCTYPE html>
<html>
<head>
  <style type="text/css">
    nav{
      background-color: white;
    }
  </style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">	
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
</head>
<body>
  <nav class="navbar navbar-expand-md navbar-light sticky-top">
    <div class="container p-0">
      <div class="logo">
        <a href="./sanpham.php"><img src="img/logo.png" alt=""></a>
      </div>
      <div class="collapse navbar-collapse text-center" id="collapsibleNavbar">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link text-center " href="sanpham.php">Trang Chủ</a>
          </li>
                  <div class="dropdown text-center">
                    <li class="nav-item">
                      <a class="nav-link text-center" href="#" id="dropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Sản Phẩm</a>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuLink2">
                        <a class="dropdown-item" href="danhmucsanpham.php?iddm=1">Áo Thể Thao</a>
                        <a class="dropdown-item" href="danhmucsanpham.php?iddm=2">Quần Thể Thao</a>
                        <a class="dropdown-item" href="danhmucsanpham.php?iddm=3">Găng Tay Thể Thao</a>
                      </div>
                  </div>
          <li class="nav-item">
            <a class="nav-link text-center" href="search.php">Tìm Kiếm</a>
          </li>
          <?php
          if (isset($_SESSION['user']) && $_SESSION['user'] == 'admin' && $_SESSION['pass'] == '123') {
           ?>
           </li>
           <li class="nav-item">
           	<a class="nav-link text-center" href="add.php">Thêm Sản Phẩm</a></li> 
           <li class="nav-item">
           	<a class="nav-link text-center" href="watch.php">Danh Sách Người Sử Dụng</a></li>
            <li class="nav-item">
              <a class="nav-link text-center" href="editsanpham1.php">Danh Sách Sản Phẩm</a></li>
               <li class="nav-item">
              <a class="nav-link text-center" href="donhang.php">Danh Sách Đơn Hàng</a></li>

        <?php }
    else if(isset($_SESSION['user'])){ ?>
      <li class="nav-item">
      	<a class="nav-link text-center" href="sanphamdamua.php">Sản Phẩm Đã Mua</a></li>
      <li class="nav-item">
        <a href="cart.php" class="nav-link text-center"><i class="fas fa-shopping-bag"></i>
          <sup>
          <?php $ok=1;
if(isset($_SESSION['cart'])) 
{
  foreach ($_SESSION['cart'] as $k=>$v) 
  {
    if(isset($k))
    {
      $ok=2;
    }
  }
}
if($ok!=2)
{
  echo "0";
}
else
{
  $items = $_SESSION['cart'];
  echo count($items);
}
?>
</sup>
        </a>
      </li>
    <?php } ?>
</ul>
<ul class="navbar-nav navbar-light ml-auto" style="background-color: white;">
  <li class="nav-item ">
   <?php
   if (isset($_SESSION['user'])) {?>
     <div class="dropdown text-center ">
      <a class="nav-link text-center" href="#" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <?php echo $_SESSION['user']; ?>
      </a>
      <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
        <?php
         if ($_SESSION['user']!='admin'){?>
         <a class="dropdown-item" href="#" data-toggle="modal" data-target="#exampleModalCenter">Edit Account</a>
       <?php } ?>
       <form action="xuly.php" method="post" accept-charset="utf-8">
        <input class="dropdown-item" type="submit" name="logout" value="Logout">
      </form>
    </div>
  </div>
<?php } else {
 ?>

 <a href="dangnhap.php" class="nav-link text-center">Đăng Nhập</a>
</li>
<li class="nav-item"><a href="dangky.php" class="nav-link text-center">Đăng Ký</a></li>
<?php }?>
</ul>
</div>
</div>
</nav>
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class=" mx-auto mw-100 col-lg-5">
          <h5 class="text-center mb-4 font-weight-bold">Chỉnh Sửa Mật Khẩu</h5>
          <form  action="xuly.php" method="post">  
            <div class="form-group">
              <label class="font-weight-bold">Mật Khẩu Cũ</label>
              <input type="password" class="form-control" name="password">
            </div>
            <div class="form-group">
              <label class="font-weight-bold">Mật Khẩu Mới</label>
              <input type="password" class="form-control" name="mkmoi">
            </div>
            <input class="btn btn-success d-block mt-md-5 ml-auto w-25" type="submit" name="editpw" value="Save">
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="header-info">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <div class="header-item">
                        <img src="img/icons/delivery.png" alt="">
                        <p>Free Shipping Tại Đà Nẵng</p>
                    </div>
                </div>
                <div class="col-md-4 text-left text-lg-center">
                    <div class="header-item">
                        <img src="img/icons/voucher.png" alt="">
                        <p>Nhiều Sản Phẩm Giảm Giá</p>
                    </div>
                </div>
                <div class="col-md-4 text-left text-xl-right">
                    <div class="header-item">
                    <img src="img/icons/sales.png" alt="">
                    <p>Trang Phục Đa Dạng</p>
                </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>