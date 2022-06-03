<?php include 'menu.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<script type="text/javascript">
function post()
{
  var comment = document.getElementById("comment").value;
  var name = document.getElementById("username").value;
  if(comment && name)
  {
    $.ajax
    ({
      type: 'post',
      url: 'post_comments.php',
      data: 
      {
         user_comm:comment,
	     user_name:name
      },
      success: function (response) 
      {
	    document.getElementById("all_comments").innerHTML=response+document.getElementById("all_comments").innerHTML;
	    document.getElementById("comment").value="";
        document.getElementById("username").value="";
  
      }
    });
  }
  
  return false;
}
</script>
</head>
<body>
<?php 
if(isset($_GET['idsp']))
{
	$_SESSION['idsp'] = $_GET['idsp'];	
	$conn=mysqli_connect("localhost","root","","sanpham") or die("Can not connect database");
	if (mysqli_connect_error())
  	{
   	  	 echo "No Active DB Connection Please check: " . mysqli_connect_error();
  	}
mysqli_set_charset($conn, 'UTF8');
echo "	<a href='sanpham.php'><i class='fas fa-arrow-left'>Quay lại</i></a>";
$sql="select * from mathang WHERE id='".$_GET['idsp']."'";
$query=mysqli_query($conn,$sql);
if($query)
{
	while($row=mysqli_fetch_array($query))
	{		 echo "<div class='pro'>";
echo "<div class='row'>";
echo "<div class='col-md-6 mt-md-5'>";
echo "<div id='img_div'>";
echo "<img src='upload/".$row['image']."' alt='Ảnh Chống Trôi' width='700' height='500'>";
echo "</div>";
echo "</div>";
echo "<div class='col-md-6 mt-md-5'";
echo "<h3>$row[title]</h3><br>";
echo "Người Bán: $row[author] - Giá: ".number_format("$row[price]",3)."
VND<br />";
echo "Mô tả:<br> $row[about]";
if(isset($_SESSION['user']))
{
	 echo "<p align='right'><a href='addcart.php?item=$row[id]'>Thêm Vào Giỏ Hàng</a></p>";
}
else
{
	echo "<p align='right'><a href='dangnhap.php'>Yêu Cầu Đăng Nhập</a></p>";
}
 echo "<p align='left'><a href='chitiet.php?idsp=$row[id]'>Chi Tiết</a></p>";
echo "</div>";
echo "</div>";
echo "</div>";
}
}
}
?>
<div class="container mt-md-5">
	<form method="post" id="comment-form">
		<div class="form-group">
			<input class="form-control bg-info col-md-1" type="text" id="username" placeholder="Your Name" autocomplete="off"></input>
		</div>
		<div class="form-group">
			<textarea type="text" name="comment_content" id="comment_content" class="form-control" placeholder="Viết Bình Luận" rows="5"></textarea>
		</div>
		<div class="form-group">
			<input class="btn btn-info" type="submit" name="comment" id="submit" value="Đăng Bình Luận" />
		</div>
	</form>
	<div id="all_comments">
  <?php
    $host="localhost";
    $username="root";
    $password="";
    $databasename="sample";

    $connect=mysqli_connect($host,$username,$password);
    $db=mysqli_select_db($connect,$databasename);
  
    $comm = mysqli_query($connect,"select name,comment,post_time from comments order by id desc");
    while($row=mysqli_fetch_array($comm))
    {
	  $name=$row['name'];
	  $comment=$row['comment'];
      $time=$row['post_time'];
    ?>
	
<div class="comment_div"> 
 <p class="name"><strong>Posted By:</strong> <?php echo $name;?> <span style="float:right"><?php echo date("j-M-Y g:ia", strtotime($time)) ?></span></p>
 <p class="comments"><?php echo $comment;?></p>	
</div>
  
    <?php
    }
    ?>
  </div>
</div>
</body>
</html>