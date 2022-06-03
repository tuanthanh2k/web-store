<?php 
	session_start();
	$conn=mysqli_connect("localhost","root","","sanpham") or die(mysqli_error($conn));
	mysqli_set_charset($conn,"UTF8");
	if(isset($_POST['dangky']))
	{
		if (!empty($_POST['username']) || !empty($_POST['ten']) || !empty($_POST['diachi']))
		{
			$sql="select * from khachhang where username='".$_POST['username']."'";
			$query=mysqli_query($conn,$sql);
			if (mysqli_num_rows($query) <= 0 ) {
				if ($_POST['password']==$_POST['cfmpass']) {
					$sql="INSERT INTO `khachhang`(`ten`,`username`, `password`,`diachi`) VALUES ('".$_POST['ten']."','".	$_POST['username']."','".$_POST['password']."','".$_POST['diachi']."')";
					if ($conn->query($sql) or die($conn->error)) {
						$_SESSION['loi'] = 'Đăng ký thành công';
						header("Location: dangnhap.php");
					}	
				}else {
					$_SESSION['loi']='Vui Lòng Xác Nhận Lại Mật Khẩu';
					header("Location:".$_SERVER["HTTP_REFERER"]);
				}
			}else {	
				$_SESSION['loi']='Tài Khoản Tồn Tại';
				header("Location:".$_SERVER["HTTP_REFERER"]);	
			}
		}else {
			$_SESSION['loi']='username,ten,diachi còn trống';
			header("Location:".$_SERVER["HTTP_REFERER"]);
		}
	}
	if (isset($_POST['editpw'])) {
	$old=$_POST['password'];
	$new=$_POST['mkmoi'];
		$query=mysqli_query($conn,"SELECT password FROM `khachhang` where idkh='".$_SESSION['id']."'") or die($conn->error);
		$row=mysqli_fetch_array($query);
		if ($row['password']==$old) {
			$sql="Update khachhang set password='".$new."' where idkh='".$_SESSION['id']."'";
			if ($conn->query($sql) or die($conn->error)) {
				$_SESSION['thongbao'] = 'Chỉnh sửa thành công';
				header("Location:".$_SERVER["HTTP_REFERER"]);
			}
		}

}
	if(isset($_POST['dangnhap']))
	{
		$username=$_POST['username'];
		$password=$_POST['password'];	
		$loi='';
		if ($username == 'admin' && $password == '123') 
		{
			$_SESSION['user'] = 'admin';
			$_SESSION['pass'] = '123';
			header('Location: sanpham.php');
		}	
		else {
			$sql="select * from khachhang where username='".$username."' and password='".$password."'";
			$query=mysqli_query($conn,$sql);
			if (mysqli_num_rows($query) == 1) {
				$row=mysqli_fetch_array($query);
				$_SESSION['user'] = $row['username'];
				$_SESSION['id'] = $row['idkh'];	
				header('Location: sanpham.php');
			}else {
				$_SESSION['loi']='Tài khoản hoặc Mật khẩu không đúng';
				header('Location:'.$_SERVER["HTTP_REFERER"]);
			}
		}
	}
	if (isset($_POST['editsp'])) {
	$title = $_POST["title"];
	$size = $_POST["size"];
	$about = $_POST["about"];
	$author = $_POST["author"];
	$price = $_POST["price"];
	$sale = $_POST['sale'];
	$sql="Update mathang SET sale='".$sale."',title='".$title."',size='".$size."',about='".$about."',author='".$author."',price='".$price."' WHERE id='".$_POST['editsp']."'";
	if ($conn->query($sql) or die($conn->error)) {
		$_SESSION['thongbao'] = 'Chỉnh sửa thành công';
		header("Location:".$_SERVER["HTTP_REFERER"]);
	}
}
	if (isset($_POST['editkh'])) {
	$username = $_POST["username"];
	$password = $_POST["password"];
	$ten = $_POST["ten"];
	$diachi = $_POST["diachi"];
	$sql="Update khachhang SET username='".$username."',password='".$password."',ten='".$ten."',diachi='".$diachi."' WHERE idkh='".$_POST['editkh']."'";
	if ($conn->query($sql) or die($conn->error)) {
		$_SESSION['thongbao'] = 'Chỉnh sửa thành công';
		header("Location:".$_SERVER["HTTP_REFERER"]);
	}
}
/*add sản phẩm*/
	if (isset($_POST['add'])) {
		$author = $_POST['author'];
		$title = $_POST['title'];
		$size = $_POST['size'];
		$img = $_FILES['image']['name'];
		$target = "upload/".basename($_FILES['image']['name']);
		$price = $_POST['price'];
		$about = $_POST['about'];
		$danhmuc = $_POST['danhmuc'];

			$sql="INSERT INTO `mathang`(`title`,`size`,`image`,`about`, `author`, `price`,`iddm`) VALUES ('".$title."','".$size."','".$img."','".$about."','".$author."','".$price."','".$danhmuc."')";
			if ($conn->query($sql) or die($conn->error)) 
			{

				header("Location:add.php");
				$_SESSION['thongbao'] = 'Thêm thành công';
				if(move_uploaded_file($_FILES['image']['tmp_name'], $target)){
			$msg = "Image uploaded successfully";
		}else{
			$msg = "there was a problem uploading image";
		}
			}
}
/*End add Sản Phẩm*/

if (isset($_POST['editpw'])) {
	$old=$_POST['password'];
	$new=$_POST['mkmoi'];
	$query=mysqli_query($conn,"SELECT password FROM `khachhang` where id='".$_SESSION['id']."'") or die($conn->error);
		$row=mysqli_fetch_array($query);
		if ($row['matkhau']==$old) {
			$sql="Update khachhang set password='".$new."' where id='".$_SESSION['id']."'";
			if ($conn->query($sql) or die($conn->error)) {
				$_SESSION['thongbao'] = 'Chỉnh sửa thành công';
				header("Location:".$_SERVER["HTTP_REFERER"]);
			}
		}
	}
if (isset($_POST['edithd'])) {
	$query=mysqli_query($conn,"SELECT trangthai FROM `hoadon` where idhd='".$_POST['edithd']."'") or die($conn->error);
		$row=mysqli_fetch_array($query);
			$sql="Update hoadon set trangthai='".$_POST['trangthai']."' where idhd='".$_POST['edithd']."'";
			if ($conn->query($sql) or die($conn->error)) {
				$_SESSION['thongbao'] = 'Chỉnh sửa thành công';
				header("Location:".$_SERVER["HTTP_REFERER"]);
		}
}

if (isset($_POST['logout'])) {
	session_unset();
	header("Location: sanpham.php");
}
if(isset($_GET['idkh']))
{
				$sql="DELETE FROM khachhang WHERE idkh='".$_GET['idkh']."'";
				if ($conn->query($sql) or die($conn->error)) {
				$_SESSION['thongbao'] = 'Chỉnh sửa thành công';
				header("Location:".$_SERVER["HTTP_REFERER"]);
			}
	
}
if(isset($_GET['idssp']))
{
				$sql="DELETE FROM mathang WHERE id='".$_GET['idssp']."'";
				if ($conn->query($sql) or die($conn->error)) {
				$_SESSION['thongbao'] = 'Chỉnh sửa thành công';
				header("Location:".$_SERVER["HTTP_REFERER"]);
			}
}
if(isset($_GET['idhd']))
{
				$sql="DELETE FROM hoadon WHERE idhd='".$_GET['idhd']."'";
				$sqll="DELETE FROM cthoadon WHERE idhd='".$_GET['idhd']."'";
				$query=mysqli_query($conn,$sqll);
				if ($conn->query($sql) or die($conn->error)) {
				$_SESSION['thongbao'] = 'Chỉnh sửa thành công';
				header("Location:".$_SERVER["HTTP_REFERER"]);
			}
}
?>