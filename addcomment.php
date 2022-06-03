<?php
	session_start();
	$conn=mysqli_connect("localhost","root","","sanpham") or die(mysqli_error($conn));
	mysqli_set_charset($conn,"UTF8");

	$error = '';
	$comment_name= '';
	$idsp= $_SESSION['idsp'];
	$comment_content= '';
	if(empty($_SESSION['id']))
	{
		$error .= '<p class="text-danger">Yêu Cầu Đăng Nhập</p>';
	}
	else
	{
		$comment_name= $_SESSION['id'];
	}
	
	if(empty($_POST["comment_content"]))
	{
		$error .= '<p class="text-danger">Yêu Cầu Nhập Bình Luận</p>';
	}
	else
	{
		$comment_content = $_POST["comment_content"];
	}

	if($error == '')
	{
		$sql= "INSERT INTO comment(parent_comment_id, comment, comment_sender_id, idsp) VALUES (0,'".$comment_content."','".$comment_name."','".$idsp."')";
		$query=mysqli_query($conn,$sql);
		$error= '<label class="text-success">Bình Luận Thành Công	</label>';
	}
	$data = array(
		'error' => $error
	);
	echo json_encode($data);
?>