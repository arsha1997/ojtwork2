<!DOCTYPE html>
<html>
<head>
<title>first site</title>
<style>
	table,td{
		padding: 20px;
		font-size: 20px;
	}
	*{
	padding:0px;
	margin:0px;
}
.bi{
	background-image:url("../img/27.jpg");
	background-size:cover;

}
.menubar{
	background-color:black;
	text-align:center;
}
.menubar ul{
	list-style:none;
	display:inline-flex;
	padding:15px;
	
}
.menubar ul li a{
	color:white;
	text-decoration:none;
	padding:10px;
}
.menubar ul li{
	padding:15px;
}
.menubar ul li a:hover{
	background-color:red;
	border-radius:10px;
}
.submenu{
	display:none;
}
.menubar ul li:hover .submenu{
	display:block;
	position:absolute;
	background-color:black;
	border-radius:10px;
	
	
}
.submenu ul{
	display:block;
}
.submenu ul li{
	border-bottom:2px solid red;
}


	
h1{
	text-align: center;
	color: white;
	font-size: 35px;
}
	</style>
</head>
<body class="bi">
	<nav class="menubar">
<ul>
<li><a href="<?php echo base_url()?>main/index">HOME</a></li>
<li><a href="<?php echo base_url()?>main/regview">REGISTRATION</a></li>
<li><a href="<?php echo base_url()?>main/log">LOGIN</a></li>
</ul>

</nav>
	
	<form style="margin-left: 450px" action="<?php echo base_url()?>main/userlogin" method="post">
		<fieldset style="width:100px;height:400px;background-color: black; margin-top: 100px;">
			<legend style="color: white"><strong></strong></legend>
			
		<table>
			<tr>
				<td style="color: white;">
		New password:</td>
		<td><input type="password" name="pass1"></td>
	</tr>

		<tr><td style="color: white;">Confirm Password:</td>
		<td><input type="password" name="pass2"></td></tr>
		<tr><td><input type="submit" name="sub" value="submit" style="width: 60px;"></td></tr>
		
		

	</table>
</fieldset>


	</form>
</body>
</html>