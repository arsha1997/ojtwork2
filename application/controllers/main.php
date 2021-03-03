<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class main extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	
/*function for view  home page
*@Arsha
03/03/2021*/
	public function index()
	{
		
		$this->load->view('index');

	}

	/*registration form
	*@Arsha
	02/03/2021*/

	public function regview()
	{
		
		$this->load->view('registration');

	}
	/*Insertion of value
	*@Arsha
	02/03/2021*/
	public function userinsert()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules("name","Name",'required');
		$this->form_validation->set_rules("lname","lname",'required');
		$this->form_validation->set_rules("email","Email",'required');
		$this->form_validation->set_rules("mobile","Phonenumber",'required');
		$this->form_validation->set_rules("dob","dob",'required');
		$this->form_validation->set_rules("address","Address",'required');
		$this->form_validation->set_rules("dict","District",'required');
		$this->form_validation->set_rules("pin","pin",'required');
		$this->form_validation->set_rules("uname","uname",'required');
		$this->form_validation->set_rules("pass","password",'required');
		if($this->form_validation->run())
		{
			$this->load->model('Mainmodel');
			$pass=$this->input->post("pass");
			$encpass=$this->Mainmodel->encpassword($pass);
		$a=array("name"=>$this->input->post("name"),"lname"=>$this->input->post("lname"),"mobile"=>$this->input->post("mobile"),"dob"=>$this->input->post("dob"),"address"=>$this->input->post("address"),"dict"=>$this->input->post("dict"),"pin"=>$this->input->post("pin"));
		$b=array("email"=>$this->input->post("email"),"uname"=>$this->input->post("uname"),"pass"=>$encpass,"usertype"=>'0');
		
		$this->Mainmodel->userinsert($a,$b);
		redirect(base_url().'main/regview');

	    }

}
/*View user details
*@Arsha
02/03/2021*/
public function usertable()
	{
		if($_SESSION['logged_in']==true&&$_SESSION['usertype']=='1')
		{
		$this->load->model('Mainmodel');
		$data['n']=$this->Mainmodel->usertable();
		$this->load->view('userview',$data);
	}
	else{
		redirect('main/log','refresh');


	}

	}
/* user approval
*@Arsha
02/03/2021*/
	public function userapprove()
	{
		$this->load->model('Mainmodel');
		$id=$this->uri->segment(3);
		$this->Mainmodel->userapprove($id);
		redirect('main/usertable','refresh');

	}
/*user reject
*@Arsha
02/03/2021*/
	public function userreject()
	{
		$this->load->model('Mainmodel');
		$id=$this->uri->segment(3);
		$this->Mainmodel->userreject($id);
		redirect('main/usertable','refresh');

	}
/*login function
*@Arsha
02/03/2021*/
	public function log()
	{
		
		$this->load->view('login');

	}
	public function userlogin()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules("email","email",'required');
		$this->form_validation->set_rules("pass","password",'required');
		if($this->form_validation->run())
		{
			$this->load->model('Mainmodel');
			$pass=$this->input->post("pass");
			$email=$this->input->post("email");
			$rslt=$this->Mainmodel->selectpass2($email,$pass);
			if($rslt)
			{
				$id=$this->Mainmodel->getuserid2($email);
				$user=$this->Mainmodel->getuser2($id);
				$this->load->library(array('session'));
				$this->session->set_userdata(array('id'=>(int)$user->id,'status'=>$user->status,'usertype'=>$user->usertype,'logged_in'=>(bool)true));
				if($_SESSION['status']=='1'&&$_SESSION['usertype']=='0'&&$_SESSION['logged_in']==true)
				{
					redirect(base_url().'main/uhome');
				}
				else if($_SESSION['status']=='1'&&$_SESSION['usertype']=='1'&&$_SESSION['logged_in']==true)
				{
					redirect(base_url().'main/ahome');	
				}
				else
				{
					echo "waiting for approval";
				}
			}
			else
			{
				echo "invalid user";
			}
		}
		else{
			redirect('main/log','refresh');
		}
	}
/*function for view admin home
*@Arsha
02/03/2021*/
	public function ahome()
	{
		
		$this->load->view('adminhome');

	}
/*function for view user home
*@Arsha
02/03/2021*/
	public function uhome()
	{
		
		$this->load->view('userhome');

	}
/*function for user profile updation
*@Arsha
02/03/2021*/
	public function userupdateform()
	{
		if($_SESSION['logged_in']==true&&$_SESSION['usertype']=='0')
		{
		
		$this->load->model('Mainmodel');
		$id=$this->session->id;
		$data['user_data']=$this->Mainmodel->userupdateform($id);
		$this->load->view('userupdate',$data);
		}
	else{
		redirect('main/log','refresh');


	}

	}
	public function userupdate()
	{
		$a=array("name"=>$this->input->post("name"),"lname"=>$this->input->post("lname"),"mobile"=>$this->input->post("mobile"),"dob"=>$this->input->post("dob"),"address"=>$this->input->post("address"),"dict"=>$this->input->post("dict"),"pin"=>$this->input->post("pin"));
		$b=array("email"=>$this->input->post("email"));
		$this->load->model('Mainmodel');
		
		if($this->input->post("update"))
		{
			$id=$this->session->id;
			$this->Mainmodel->userupdateform2($a,$b,$id);
			redirect('main/userupdateform','refresh');
		}

	}
/*function for delete user details
*@Arsha
02/03/2021*/
	public function deletedetails()
	{
		$this->load->model('Mainmodel');
		$id=$this->uri->segment(3);
		$this->Mainmodel->deletedetails($id);
		redirect('main/usertable','refresh');


	}
/*function for Email validation
*@Arsha
02/03/2021*/
	public function email_availibility()  
      {  
      if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL))  

           {  
                echo '<label class="text-danger"><span class="glyphicon glyphicon-remove"></span> Invalid Email</span></label>';  
           }  
           else  
           {  
                $this->load->model("Mainmodel");  
                if($this->Mainmodel->is_email_available($_POST["email"]))  
                {  
                     echo '<label class="text-danger"><span class="glyphicon glyphicon-remove"></span> Email Already register</label>';  
                }  
                else  
                {  
                     echo '<label class="text-success"><span class="glyphicon glyphicon-ok"></span> </label>';  
                }  
           }  
       

      }
     /*reset password form
	*@Arsha
	03/03/2021*/

	public function forgot()
	{
		
		$this->load->view('forgotpassword');

	}
	/****logout***********/
public function logout()
    {
        $data=new stdClass();
        if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']===true)
        {
            foreach ($_SESSION as $key => $value)
            {
               unset($_SESSION[$key]);
            }
            $this->session->set_flashdata('logout_notification','logged_out');
            redirect('main/log','refresh');
        }
        else{
            redirect('main/log','refresh');
        }
    }
    /**********logout end**************/
   /*forget password function
	*@Arsha
	03/03/2021*/
    public function forget()
{
$this->load->view('forgot');
}

public function send()
{
    $to =  $this->input->post('from');  // User email pass here
    $subject = 'Welcome To Elevenstech';

    $from = 'ojtteamfour123@gmail.com';              // Pass here your mail id

    $emailContent = '<!DOCTYPE><html><head></head><body><table width="600px" style="border:1px solid #cccccc;margin: auto;border-spacing:0;"><tr><td style="background:#000000;padding-left:3%"><img src="http://elevenstechwebtutorials.com/assets/logo/logo.png" width="300px" vspace=10 /></td></tr>';
    $emailContent .='<tr><td style="height:20px"></td></tr>';


    $emailContent .= $this->input->post('message');  //   Post message available here


    $emailContent .='<tr><td style="height:20px"></td></tr>';
    $emailContent .= "<tr><td style='background:#000000;color: #999999;padding: 2%;text-align: center;font-size: 13px;'><p style='margin-top:1px;'><a href='http://elevenstechwebtutorials.com/' target='_blank' style='text-decoration:none;color: #60d2ff;'>www.elevenstechwebtutorials.com</a></p></td></tr></table></body></html>";
               


    $config['protocol']    = 'smtp';
    $config['smtp_host']    = 'ssl://smtp.gmail.com';
    $config['smtp_port']    = '465';
    $config['smtp_timeout'] = '60';

    $config['smtp_user']    = 'ojtteamfour123@gmail.com';    //Important
    $config['smtp_pass']    = 'team4123';  //Important

    $config['charset']    = 'utf-8';
    $config['newline']    = "\r\n";
    $config['mailtype'] = 'html'; // or html
    $config['validation'] = TRUE; // bool whether to validate email or not

     

    $this->email->initialize($config);
    $this->email->set_mailtype("html");
    $this->email->from($from);
    $this->email->to($to);
    $this->email->subject($subject);
    $this->email->message($emailContent);
    $this->email->send();

    $this->session->set_flashdata('msg',"Mail has been sent successfully");
    $this->session->set_flashdata('msg_class','alert-success');
    return redirect('main/forget');
}




	










}
?>
























