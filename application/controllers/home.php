<?php if( ! defined('BASEPATH')) exit ('No direct script access allowed');

class Home extends My_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('Home_model','HOME');
		$this->output->enable_profiler(FALSE);
	}

	function index()
	{
		if(!sessionUserId())
			redirect('home/main');

		if(sessionUserLevel() == USER)
			redirect('home/appointments');

		if(sessionUserLevel() == ADMIN)
			redirect('admin/dashboard');

		$this->_checkSession();
	}

	function main()
	{
		$this->load->view('main');
	}
 
	private function _form_validate($post)
  	{
  		$this->form_validation->set_error_delimiters('<div class="alert alert-danger text_left" style="margin-bottom:0px" role="alert">', '</div>');

  		$this->form_validation->set_message('regex_match', "The %s is not in its correct format. Use A-Z lowercase or uppercase only.");

  		$this->form_validation->set_message('is_unique', "The %s is already taken");

  	 	if(isset($post['btn_registerUser']))
			return $this->form_validation->run('registerUser');

		if(isset($post['btn_resetPassword']))
			return $this->form_validation->run('resetPassword');

    }

	private function _checkSession()
	{
		if(sessionUserId() > 0)
		{
			if(sessionUserLevel() == USER)
				redirect(base_url('home/appointments'));
			else 
				redirect(base_url('admin/dashboard'));
		}
	}

	function login()
	{
		$this->_checkSession();
		$form_error = $username = "";
		$post = $this->input->post();
		if($post)
		{
			$data = $this->HOME->verifyLogin($post);
			if(count($data)>0)
			{
				if($data[0][IS_ACTIVE] != 0)
				{
					$sess = array(
							USER_ID => $data[0][USER_ID],
							NAME => $data[0][USER_FIRSTNAME]." ".$data[0][USER_LASTNAME],
							USER_LEVEL => $data[0][USER_LEVEL],
						);

					$this->session->set_userdata('login_user',$sess);
					redirect(base_url('home/appointments'));
				}
				else
					$form_error = '<div style="margin-left:45px;margin-top: 10px;color:red">Account is not yet activated.</div>';
			} 
			else 
				$form_error = '<div style="margin-left:40px;margin-top:10px;color:red">Wrong Username or Password</div>';
			$username = $post['txt_username'];
		}
		$data['form_error'] = $form_error;
		$data['username'] = $username;
		$this->load->view('login', $data);

	}

	function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url());	
	}

	function register()
	{

		$post = $this->input->post();
		if($post)
		{
			if($this->_form_validate($post))
			{
				
				list($user_id, $user_key) = $this->HOME->registerUser($post);
				$this->_sendEmailVerification($post['txt_email'], $user_key, $user_id);
				redirect('home/successRegister/'.encryptString($post['txt_email']));
			}
		}
		else
		{
			$post = array(

				'txt_firstname' => '',
				'txt_lastname' => '',
				'txt_email' => '',
				'txt_username' => '',

				);
		}

	  	$register = '<div class="login-form">
	     <h1>Teether</h1>
	     <div class="form-group">
	     <tr>
	       <td><input type="text" class="form-control" name="txt_firstname" value="'.$post['txt_firstname'].'" placeholder="First Name" id="user_firstname"></td>
	       <td>'.form_error('txt_firstname').'</td>
	       </tr>
	       <input type="text" class="form-control" name="txt_lastname" value="'.$post['txt_lastname'].'"" placeholder="Last Name" id="user_lastname">
	       '.form_error('txt_lastname').'
	       <input type="email" class="form-control" name="txt_email" value="'.$post['txt_email'].'" placeholder="Email" id="user_email">
	       '.form_error('txt_email').'
	     </div>
	     <div class="form-group">
	       <input type="text" class="form-control" name="txt_username" value="'.$post['txt_username'].'" placeholder="Username " id="username">
	       '.form_error('txt_username').'
	       <input type="password" class="form-control" name="txt_password" placeholder="Password" id="user_password">
	       '.form_error('txt_password').'
	       <input type="password" class="form-control" name="txt_confirmpassword" placeholder="Confirm Password" id="confirm_password">
	       '.form_error('txt_confirmpassword').'
	     </div>
	     <button type="submit" class="log-btn" name="btn_registerUser" id="btn_registerUser">Sign up</button>  
	   </div>';

	   	$data['form'] = $register;
		$this->load->view('register', $data);
	}

	function _checkPassword()
	{
		$post = $this->input->post();

		list($error, $isPasswordCorrect) = $this->HOME->checkPassword($post);

		if (!$isPasswordCorrect)
        {
        	if($error)
        		$this->form_validation->set_message('_checkPassword', 'The passwords do not match.');	 
            return FALSE;
        }
        else 
        	return TRUE;
	}

	function _sendEmailVerification($to, $code, $user_id)
	{

		
        require_once(APPPATH.'third_party/PHPMailer/PHPMailerAutoload.php');
     

        $mail = new PHPMailer;

		$mail->SMTPDebug = 3;                               // Enable verbose debug output
		$mail = new PHPMailer(); // create a new object
		$mail->IsSMTP(); // enable SMTP
		$mail->SMTPOptions = array(
                    'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                    )
                );

		$mail->isSMTP();                                      // Set mailer to use SMTP
		$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = 'teether.clinics@gmail.com';                 // SMTP username
		$mail->Password = 'OU31LP3K2YY';                           // SMTP password
		$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 465;                                    // TCP port to connect to
		$mail->setFrom('teether.clinics@gmail.com', 'Teether');
		$mail->addAddress($to);     // Add a recipient
		$mail->isHTML(true);                                  // Set email format to HTML
		
		$mail->Subject = 'Teether - Account Verificaton';
		$mail->Body    = '<html>
   		<body>
   		<h1>Greetings from Teether!</h1>
   		<p>Thank you for registering on our site, click the link to activate your account:</p>
   		<p>Activation Link: '.base_url('home/activate').'/'.encryptString($user_id).'/'.encryptString($code).'</p>
 
   		</body>
   		</html>';
		
		
		if(!$mail->send()) {
		    //echo 'Message could not be sent.';
		    //echo 'Mailer Error: ' . $mail->ErrorInfo;
		} else {
		   // echo 'Message has been sent';
		}

	}

	function _sendPasswordReset($to, $user_id)
	{
        require_once(APPPATH.'third_party/PHPMailer/PHPMailerAutoload.php');
     

        $mail = new PHPMailer;

		$mail->SMTPDebug = 3;                               // Enable verbose debug output
		$mail = new PHPMailer(); // create a new object
		$mail->IsSMTP(); // enable SMTP
		$mail->SMTPOptions = array(
                    'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                    )
                );

		$mail->isSMTP();                                      // Set mailer to use SMTP
		$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = 'teether.clinics@gmail.com';                 // SMTP username
		$mail->Password = 'OU31LP3K2YY';                           // SMTP password
		$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 465;                                    // TCP port to connect to
		$mail->setFrom('teether.clinics@gmail.com', 'Teether');
		$mail->addAddress($to);     // Add a recipient
		$mail->isHTML(true);                                  // Set email format to HTML
		
		$mail->Subject = 'Teether - Password Reset';
		$mail->Body    = '<html>
   		<body>
   		<h1>Password Reset</h1>
   		<p>Please use the given link to reset your password on Teether.<br>
   		<p>Reset Password: '.base_url('home/resetPassword/'.encryptString($user_id)).'.</p>
   		</body>
   		</html>';
		
		
		if(!$mail->send()) {
		    //echo 'Message could not be sent.';
		    //echo 'Mailer Error: ' . $mail->ErrorInfo;
		} else {
		   // echo 'Message has been sent';
		}

	}

	function successRegister()
	{
		$data['email'] = decryptString($this->uri->segment(3));
		$this->load->view('registrationSuccess', $data);

	}

	function activate()
	{
		$user_id = decryptString($this->uri->segment(3));
		$user_key = decryptString($this->uri->segment(4));
		
		$isKeyCorrect = $this->HOME->checkExistingKey($user_key);
		$query_name = $this->HOME->getName($user_id);
		$name = $query_name[0];
		
		$fullname = $name[USER_FIRSTNAME].' '.$name[USER_LASTNAME];
		
		$data['fullname'] = $fullname;

		if($isKeyCorrect)
		{
			$this->HOME->deleteKeys($user_id);
			$this->HOME->activateAccount($user_id);
			$showConfirmation = 1;
		}
		else
			$showConfirmation = 0;

		$data['isActivated'] = $showConfirmation;
		$this->load->view('accountActivated', $data);
	}

	function forgotPassword()
	{

		$post = $this->input->post();
		$text = '';
		if($post)
		{
			$trueOrFalse = $this->HOME->checkIfExistingEmail($post);
			
			if($trueOrFalse)
        	{
        		$user_id = $this->HOME->getIdUsingEmail($post);
        		$user_id = $user_id[0][USER_ID];
        		$this->_sendPasswordReset($post['txt_email'], $user_id);
        		$this->HOME->resetUserPassword($user_id);
        		$text = 'Password Reset Sent to Email.';
        	}
       		else
        		$text ='Email Address Not Found.';
			}
		

		$form =  ''.form_open(base_url('home/forgotPassword')).'
                     <div class="form-group">
                       <div class="input-group center-block">
                         <input id="email" name="txt_email" placeholder="Email" class="form-control"  type="email">
                         <p>'.$text.'</p>
                       </div>
                     </div>
                     <div class="form-group">
                       <input name="" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                     </div> 
                   '.form_close().'';


        $data['form'] = $form;
		$this->load->view('forgotPassword', $data);
	}

	function resetPassword()
	{

		$user_id = decryptString($this->uri->segment(3));
		$post = $this->input->post();
		$text = '';
		$form = '';
		$form1 = ''.form_open(base_url('home/resetPassword'.'/'.$this->uri->segment(3))).'
                     <div class="form-group">
                       <div class="center-block">
                         <input name="txt_password" placeholder="New Password" text-align="center" class="form-control"  type="password">
                         '.form_error('txt_password').'
                         <input name="txt_confirmpassword" placeholder="Confirm Password" class="form-control"  type="password">
                         '.form_error('txt_confirmpassword').'';

		$data['textdesc'] = 'You can reset your password here.';
		$btn = '<div class="form-group">
                       <input name="btn_resetPassword" class="btn btn-lg btn-primary btn-block" value="Submit" type="submit">
                     </div>';
		if($this->_form_validate($post))
		{
			$this->HOME->setNewUserPassword($post,$user_id);
			$text = 'Password successfully changed.';
			$btn = '<div class="form-group">
                       <a href='.base_url('home/welcome').'><button type="button" class="btn btn-lg btn-primary btn-block" >Home</button</a>
                     </div>';
            $form1 = '';
		}
			$form =  ''.$form1.'
                         <p>'.$text.'</p>
                       </div>
                     </div>
                     '.$btn.'
                   '.form_close().'';
		
		
        $data['form'] = $form;
		$this->load->view('resetPassword', $data);
	}

	function appointments()
	{

		$mySession = $this->session->userdata('login_user');
		$flashdata = $this->session->flashdata('appointment_notification');

		$table = '';

		$query = $this->HOME->getAppointments();
		$services = $this->HOME->getServices();
		$serviceArr = array();

		if(count($services) > 0)
			foreach ($services as $service)
			{
				$serviceArr[$service[SERVICE_ID]] = $service[SERVICE_NAME]; 
			}

		if(count($query) > 0)
		{
			$plusOrMinus = '';
			foreach($query as $q)
			{
				($q[IS_PAID] == '0' 

				 	? 
				 	$paidOrNot = '<a href='.base_url('home/cancelAppointment/'.encryptString($q[APPOINTMENT_ID])).'><span style="margin:3px 3px" aria-hidden="true" title="Cancel" class="fa fa-times"></span></a>'
				 	:  
				 	""
				 	);  

				$table .= '<tr>
					<td></td>
					<td>'.(count($serviceArr)>0 ? $serviceArr[$q[SERVICE_ID]] : '' ).'</td>
					<td>'.format_date($q[APPOINTMENT_DATE]).'</td>
					<td>'.$q[APPOINTMENT_TIME].'</td>
					<td>'.($q[IS_ACCEPTED] == 1 ? 'Accepted' : ($q[IS_ACCEPTED] == 0 ? 'Waiting for approval' : 'Declined' ) ).'</td>
					<td>
						'.$paidOrNot.'					
					</td>
				</tr>';
			}
		}

		$data['flashdata'] = $flashdata;	
		$data['table'] = $table;
		$this->load->view('myAppointments',$data);
	}

	function newAppointment()
	{

		$mySession = $this->session->userdata('login_user');
		$flashdata = $this->session->flashdata('appointment_notification');

		$table = '';

		$query = $this->HOME->getAppointments();
		$services = $this->HOME->getServices();
		$serviceArr = array();

		if(count($services) > 0)
			foreach ($services as $service)
			{
				$serviceArr[$service[SERVICE_ID]] = $service[SERVICE_NAME]; 
			}

		if(count($query) > 0)
		{
			$plusOrMinus = '';
			foreach($query as $q)
			{
				($q[IS_PAID] == '0' 

				 	? 
				 	$paidOrNot = '<a href='.base_url('home/cancelAppointment/'.encryptString($q[APPOINTMENT_ID])).'><span style="margin:3px 3px" aria-hidden="true" title="Cancel" class="fa fa-times"></span></a>'
				 	:  
				 	""
				 	);  

				$table .= '<tr>
					<td></td>
					<td>'.(count($serviceArr)>0 ? $serviceArr[$q[SERVICE_ID]] : '' ).'</td>
					<td>'.format_date($q[APPOINTMENT_DATE]).'</td>
					<td>'.$q[APPOINTMENT_TIME].'</td>
					<td>'.($q[IS_ACCEPTED] == 1 ? 'Accepted' : ($q[IS_ACCEPTED] == 0 ? 'Waiting for approval' : 'Declined' ) ).'</td>
					<td>
						'.$paidOrNot.'					
					</td>
				</tr>';
			}
		}

		$data['flashdata'] = $flashdata;	
		$data['table'] = $table;
		$this->load->view('newAppointment',$data);
	}

}

?>