<!DOCTYPE html>
<html>
<head>
<title>first site</title>
<style>
	*{
	padding:0px;
	margin:0px;
}
	table,td{
		padding: 20px;
		font-size: 20px;
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
	color: red;
	font-size: 50px;
}

	.bi{
	background-image:url("../img/11.jpg");
	background-size:cover;
}
	</style>
</head>
<body class="bi">
	<nav class="menubar">
<ul>
<li><a href="<?php echo base_url()?>main/uhome">HOME</a></li>

<li><a href="<?php echo base_url()?>main/dupdateform">PROFILE</a></li>

<li><a href="<?php echo base_url()?>main/logout">LOGOUT</a></li>

</ul>

</nav>

	<h1>Edit Profile</h1>
	<form style="margin-left: 450px" method="post" action="<?php echo base_url()?>main/userupdate">
		<?php
			
	if(isset($user_data))
	{
		foreach($user_data->result() as $row1)
		{
			?>
		<fieldset style="width:400px;height:900px; background-color:red;">
			<legend style="color: red"><strong></strong></legend>

			
		<table>

			<tr>
				<td>
		Name:</td>
		<td><input type="text" name="name" value="<?php echo $row1->name;?>">
		</td>
	</tr>
	<tr>
				<td>
		Last Name:</td>
		<td><input type="text" name="lname" value="<?php echo $row1->lname;?>">
		</td>
	</tr>
	<tr><td>Email:</td>
		<td><input type="Email" name="email" value="<?php echo $row1->email;?>" ></td></tr>
		<tr>
		<td>
		Phone number:</td>
		<td><input type="text" name="mobile" value="<?php echo $row1->mobile;?>"></td>
	</tr>
	<tr>
				<td>
		DOB:</td>
		<td><input type="date" name="dob" value="<?php echo $row1->dob;?>">
		</td>
	</tr>
	

		<tr><td>Address:</td>
		<td><textarea name="address"><?php echo $row1->address;?></textarea></td></tr>
		
		<tr>
		<td>
		District:</td>
		<td><input list="district" name="dict" value="<?php echo $row1->dict;?>" >
			<datalist id="district">
				<option value="kollam">
				<option value="Trivandrum">
				<option value="kottayam">
				<option value="Alapuzha">
				<option value="Idukki">
			</datalist></td>
	</tr>
	
	
	<tr>
		<td>
		Pincode:</td>
		<td><input type="text" name="pin" value="<?php echo $row1->pin;?>"></td>
	</tr>
		
		<tr><td><input type="submit" name="update" value="Update"></td></tr>
		
		


	</table>
	<?php
		}
	}
	?>
	
</fieldset>


	</form>

</body>
</html>