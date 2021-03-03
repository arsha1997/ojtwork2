<?php
class Mainmodel extends CI_model
{
/*function for password encryption
*@Arsha
02/03/2021*/
	public function encpassword($pass)
	{
		return password_hash($pass,PASSWORD_BCRYPT);
	}
/*function for user details insertion
*@Arsha
02/03/2021*/
	public function userinsert($a,$b)
		{
			$this->db->insert("login",$b);
			$loginid=$this->db->insert_id();
			$a['userid']=$loginid;
		$this->db->insert("registration",$a);
	}
/*function for view user details
*@Arsha
02/03/2021*/
	public function usertable()
	{
		$this->db->select('*');
		$this->db->join('login','login.id=registration.userid','inner');
		$qry=$this->db->get("registration");
		return $qry;
	}
	public function userapprove($id)
	{
		$this->db->set('status','1');
		$this->db->where("id",$id);
		$this->db->update("login");

	}
	public function userreject($id)
	{
		$this->db->set('status','2');
		$this->db->where("id",$id);
		$this->db->update("login");

	}
/*function for loggin
*@Arsha
02/03/2021*/
	public function selectpass2($email,$pass)
	{
		$this->db->select('pass');
		$this->db->from("login");
		$this->db->where("email","$email");
		$query=$this->db->get()->row('pass');
		return $this->verifypass2($pass,$query);
		}
		public function verifypass2($pass,$query)
		{
			return password_verify($pass,$query);
		}
		public function getuserid2($email)
		{
			$this->db->select('id');
			$this->db->from("login");
			$this->db->where("email",$email);
			return $this->db->get()->row('id');

		}
		public function getuser2($id)
		{
			$this->db->select('*');
			$this->db->from("login");
			$this->db->where("id",$id);
			return $this ->db->get()->row();

		}
/*function for user profile updation
*@Arsha
02/03/2021*/
		public function userupdateform($id)
	{
		$this->db->select('*');
		$qry=$this->db->join("login",'login.id=registration.userid','inner');
		$qry=$this->db->where("registration.userid",$id);
		$qry=$this->db->get("registration");
		return $qry;
	}
	public function userupdateform2($a,$b,$id)
	{
        $this->db->select('*');
        $qry=$this->db->where("userid",$id);
        $qry=$this->db->join('registration','login.id=registration.userid','inner');
        $qry=$this->db->update("registration",$a);
        $qry=$this->db->where("login.id",$id);
        $qry=$this->db->update("login",$b);
        return $qry;


	}
/*function for delete details
*@Arsha
02/03/2021*/
	public function deletedetails($id)
	{
		$this->db->where("id",$id);
		 $qry=$this->db->join('registration','login.id=registration.userid','inner');
		$this->db->delete("registration");
		$qry=$this->db->where("login.id",$id);
		$this->db->delete("login");

	}
/*function for emailvalidation
*@Arsha
02/03/2021*/
	function is_email_available($email)  
      {  
           $this->db->where('email', $email);  
           $query = $this->db->get("login");  
           if($query->num_rows() > 0)  
           {  
                return true;  
           }  
           else  
           {  
                return false;  
           }  
      }  

	
	

	
	

	
}
?>