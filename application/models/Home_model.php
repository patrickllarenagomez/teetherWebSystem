<?php if( ! defined('BASEPATH')) exit ('No direct script access allowed');

class Home_model extends My_Model
{
	function __construct()
	{
		parent::__construct();
	}

	public function verifyLogin($post)
	{
		$this->db->where(USERNAME, $post['txt_username']);
		$this->db->where(USER_PASSWORD, encryptPassword($post['txt_password']));
		$query = $this->db->get(TBL_USERS);
		
		return $query->result_array();
		echo $this->db->last_query();
	}

	function checkPassword($post)
	{
		$pwDoNotMatch = '';
		$boolTrueOrFalse = FALSE;
		if($post['txt_password'] == $post['txt_confirmpassword'])
		{
			$boolTrueOrFalse = TRUE;
		}
		else
		{
			$pwDoNotMatch = 'Passwords do not match.';
			$boolTrueOrFalse = FALSE;
		}
	
		return [$pwDoNotMatch, $boolTrueOrFalse];
		
	}

	function getServices()
	{	
		$query = $this->db->get(TBL_SERVICE);
		return $query->result_array();
	}

	function getAppointments()
	{
		$this->db->where(USER_ID, sessionUserId());
		$query = $this->db->get(TBL_APPOINTMENTS);
		return $query->result_array();
	}

	function registerUser($post)
	{
		$insertUser = array(

			USERNAME => filter_string($post['txt_username']),
			USER_PASSWORD => encryptPassword($post['txt_password']),
			USER_FIRSTNAME => ucwords(strtolower(filter_string($post['txt_firstname']))),
			USER_LASTNAME => ucwords(strtolower(filter_string($post['txt_lastname']))),
			USER_EMAIL => filter_string($post['txt_email']),
			USER_LEVEL => USER,
			IS_ACTIVE => 0,
			IS_VERIFIED => 0,

			);
		$this->db->insert(TBL_USERS, $insertUser);

		$user_id = $this->db->insert_id(); 

		$code = $this->generateKey($user_id);

		return [$user_id, $code];

	}

	function generateKey($user_id)
	{

		$code = generateRandomString();
		$insertUserKey = array(

			USER_ID => $user_id,
			USER_KEY => $code,

			);

		$this->db->insert(TBL_USER_VERIFICATION, $insertUserKey);

		return $code;
	}

	function getName($user_id)
	{
		$this->db->select(''.USER_FIRSTNAME.",".USER_LASTNAME.'');
		$this->db->where(USER_ID, $user_id);
		$query = $this->db->get(TBL_USERS);
		return $query->result_array();
	}

	function checkExistingKey($user_key)
	{
		$this->db->select(''.USER_ID.'');
		$this->db->where(USER_KEY, $user_key);
		$query = $this->db->get(TBL_USER_VERIFICATION);
		if ($query->num_rows() > 0)
	        return TRUE;
	    else
	        return FALSE;
	}

	function activateAccount($user_id)
	{
		$updateAccount = array(
			IS_ACTIVE => ACTIVE,
			);

		$this->db->where(USER_ID ,$user_id);
		$this->db->update(TBL_USERS, $updateAccount);
	}

	function deleteKeys($user_id)
	{
		$this->db->where(USER_ID, $user_id);
		$this->db->delete(TBL_USER_VERIFICATION);
	}

	function checkIfExistingEmail($post)
	{
		$this->db->where(USER_EMAIL, $post['txt_email']);
		$query = $this->db->get(TBL_USERS);
		if($query->num_rows() > 0)
			return TRUE;
		else
			return FALSE;
	}

	function getIdUsingEmail($post)
	{
		$this->db->where(USER_EMAIL, $post['txt_email']);
		$query = $this->db->get(TBL_USERS);
		return $query->result_array();
	}

	function resetUserPassword($user_id)
	{
		$updateArray = array(

			USER_PASSWORD => '',

			);

		$this->db->where(USER_ID, $user_id);
		$this->db->update(TBL_USERS, $updateArray);
	}

	function setNewUserPassword($post,$user_id)
	{
		$updateArray = array(

			USER_PASSWORD => encryptPassword($post['txt_password']),

			);

		$this->db->where(USER_ID, $user_id);
		$this->db->update(TBL_USERS, $updateArray);
		
	}
}

?>	