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
.bi{
	background-image:url("../img/26.webp");
	background-size:cover;

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
<h1 style="text-align: center;">USER REGISTRATION</h1>

	<form style="margin-left: 450px" method="post" action="<?php echo base_url()?>main/userinsert">
		<fieldset style="width:300px;height:900px;background-color: blue;">
			<legend><strong></strong></legend>
		<table>
			<tr>
				<td>
		Name:</td>
		<td><input type="text" name="name" required="required" maxlength="25" pattern="[a-zA-Z]+"></td>
	</tr>
	<tr>
				<td>
		Last name:</td>
		<td><input type="text" name="lname" required="required" maxlength="25" pattern="[a-zA-Z]+"></td>
	</tr>
	<tr><td>Email:</td>
		<td><input type="Email" name="email" id="email"><span id="email_result"></span></td></tr>
		<tr>
		<td>
		Phone number:</td>
		<td><input type="text" name="mobile" required="required" pattern="[7-9]{1}[0-9]{9}"></td>
	</tr>
	<tr><td>DOB:</td>
			<td><input type="date" name="dob" required="required">
		</tr>
	<tr><td>Address:</td>
		<td><textarea name="address" required="required" maxlength="55" pattern="[a-zA-Z]+"></textarea></td></tr>
		
		<tr>
		<td>
		District:</td>
		<td><input list="district" name="dict">
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
		Pin:</td>
		<td><input type="text" name="pin" required="required"></td>
	</tr>
	
	
	<tr>
		<td>
		User name:</td>
		<td><input type="text" name="uname" required="required" maxlength="25" pattern="[a-zA-Z]+"></td>
	</tr>
		<tr><td>Password:</td>
		<td><input type="Password" name="pass" required="required" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"></td></tr>
		<tr><td><input type="submit" name="sub" value="Register"></td></tr>
		

	</table>
</fieldset>


	</form>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script>  
 $(document).ready(function(){  
      $('#email').change(function(){  
           var email = $('#email').val();  
           if(email != '')  
           {  
                $.ajax({  
                     url:"<?php echo base_url(); ?>main/email_availibility",  
                     method:"POST",  
                     data:{email:email},  
                     success:function(data){  
                          $('#email_result').html(data);  
                     }  
                });  
           }  
      }); 
       });  
 </script>   
</body>
</html>