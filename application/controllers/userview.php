<!DOCTYPE html>
<html>
<head>
<title>first site</title>
<style>
	table,td{
		padding: 20px;
		font-size: 20px;
		border: 1px solid red;
		border-collapse:collapse;
	
	}
	*{
	padding:0px;
	margin:0px;
}
	
h1{
	text-align: center;
	color: red;
	font-size: 50px;
}

	</style>
</head>
<body class="bi">
	
<h1>USER VIEW</h1>
	<form method="post" action="">
	<table style="background-color: white;">
		<tr>
			<td>Name</td>
			<td>Last name</td>
			<td>Phone</td>
			<td>DOB</td>
			<td>Address</td>
			<td>District</td>
			<td>Pincode</td>
			<td>Email</td>
			<td>Approve</td>
			<td>Reject</td>
			</tr>
			<?php
			if($n->num_rows()>0)
			{
				foreach($n->result() as $row)
				{
					?>
					<tr>
						<td><?php echo $row->name;?></td>
						<td><?php echo $row->lname;?></td>
						<td><?php echo $row->mobile;?></td>
						<td><?php echo $row->dob;?></td>
						<td><?php echo $row->address;?></td>
						<td><?php echo $row->dict;?></td>
						<td><?php echo $row->pin;?></td>
						<td><?php echo $row->email;?></td>
						<?php
						if($row->status==1)
						{
							?>
							<td>approved</td>
							<td><a href="<?php echo base_url()?>main/userreject/<?php echo $row->id;?>">Reject</a></td>

							<?php
						}
						elseif($row->status==2)
						{
							?>
							<td>Rejected</td>
							<td><a href="<?php echo base_url()?>main/userapprove/<?php echo $row->id;?>">Approve
						</a>
						</td>
							<?php
						}
						else
						{
							?>
		
						<td><a href="<?php echo base_url()?>main/userapprove/<?php echo $row->id;?>">Approve
						</a>
						</td>
						<td><a href="<?php echo base_url()?>main/userrreject/<?php echo $row->id;?>">Reject</a></td>
						<?php
					}
					?>
				</tr>

						
					<?php
				}
			}
			
				?>
				


	</table>
	
</form>
</body>
</html>