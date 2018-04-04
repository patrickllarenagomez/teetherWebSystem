<?php 

$config = array(
		'addUser'=>array(
					array(

						'field' => 'txt_username',
						'label' => 'username',
                        'rules' => 'trim|required|is_unique['.TBL_USERS.".".USERNAME.']|min_length[6]|max_length[20]',
					),
					array(

						'field' => 'txt_password',
						'label' => 'password',
                        'rules' => 'trim|required|min_length[6]|callback__checkPassword',
					),
					array(

						'field' => 'txt_confirmpassword',
						'label' => 'password',
                        'rules' => 'trim|required|min_length[6]|callback__checkPassword',
					),
					array(

						'field' => 'txt_firstname',
						'label' => 'first name',
                        'rules' => 'trim|required|regex_match[/^[A-Za-z ]+$/]|max_length[25]',
					),
					array(

						'field' => 'txt_surname',
						'label' => 'surname',
                        'rules' => 'trim|required|regex_match[/^[A-Za-z ]+$/]|max_length[25]',
					),
					
		),
	   'editUser'=>array(
					array(

						'field' => 'txt_username',
						'label' => 'username',
                        'rules' => 'trim|required|min_length[5]|max_length[20]',
					),
					array(

						'field' => 'txt_password',
						'label' => 'old password',
                        'rules' => 'trim|required|min_length[5]|callback__checkOldPassword',
					),
					array(

						'field' => 'txt_newpassword',
						'label' => 'password',
                        'rules' => 'trim|required|min_length[5]|callback__checkPassword',
					),
					array(

						'field' => 'txt_confirmpassword',
						'label' => 'password',
                        'rules' => 'trim|required|min_length[5]|callback__checkPassword',
					),
					array(

						'field' => 'txt_firstname',
						'label' => 'first name',
                        'rules' => 'trim|required|regex_match[/^[A-Za-z ]+$/]|max_length[25]',
					),
					array(

						'field' => 'txt_surname',
						'label' => 'surname',
                        'rules' => 'trim|required|regex_match[/^[A-Za-z ]+$/]|max_length[25]',
					),
			),
	   'editUserSA'=>array(
					array(

						'field' => 'txt_username',
						'label' => 'username',
                        'rules' => 'trim|required|min_length[5]|max_length[20]',
					),
					array(

						'field' => 'txt_newpassword',
						'label' => 'password',
                        'rules' => 'trim|required|min_length[5]|callback__checkPassword',
					),
					array(

						'field' => 'txt_confirmpassword',
						'label' => 'password',
                        'rules' => 'trim|required|min_length[5]|callback__checkPassword',
					),
					array(

						'field' => 'txt_firstname',
						'label' => 'first name',
                        'rules' => 'trim|required|regex_match[/^[A-Za-z ]+$/]|max_length[25]',
					),
					array(

						'field' => 'txt_surname',
						'label' => 'surname',
                        'rules' => 'trim|required|regex_match[/^[A-Za-z ]+$/]|max_length[25]',
					),
			),
	   'registerUser'=>array(
					array(

						'field' => 'txt_username',
						'label' => 'username',
                        'rules' => 'trim|required|is_unique['.TBL_USERS.".".USERNAME.']|min_length[6]|max_length[20]',
					),
					array(

						'field' => 'txt_password',
						'label' => 'password',
                        'rules' => 'trim|required|min_length[6]|callback__checkPassword',
					),
					array(

						'field' => 'txt_confirmpassword',
						'label' => 'password',
                        'rules' => 'trim|required|min_length[6]|callback__checkPassword',
					),
					array(

						'field' => 'txt_firstname',
						'label' => 'first name',
                        'rules' => 'trim|required|regex_match[/^[A-Za-z ]+$/]|max_length[25]',
					),
					array(

						'field' => 'txt_lastname',
						'label' => 'last name',
                        'rules' => 'trim|required|regex_match[/^[A-Za-z ]+$/]|max_length[25]',
					),
					array(

						'field' => 'txt_email',
						'label' => 'email',
                        'rules' => 'trim|required|valid_email|is_unique['.TBL_USERS.".".USER_EMAIL.']',
					),
					
		),
	   'resetPassword'=>array(
					array(

						'field' => 'txt_password',
						'label' => 'username',
                        'rules' => 'trim|required|min_length[6]|callback__checkPassword',
					),
					array(

						'field' => 'txt_confirmpassword',
						'label' => 'password',
                        'rules' => 'trim|required|min_length[6]|callback__checkPassword',
					),
					
		),
	   'addService'=>array(
					array(

						'field' => 'txt_service',
						'label' => 'service name',
                        'rules' => 'trim|required',
					),
					array(

						'field' => 'txt_price',
						'label' => 'price',
                        'rules' => 'trim|required|regex_match[/^[0-9.,]+$/]',
					),
		),
	   'editService'=>array(
					array(

						'field' => 'txt_service',
						'label' => 'service name',
                        'rules' => 'trim|required',
					),
					array(

						'field' => 'txt_price',
						'label' => 'price',
                        'rules' => 'trim|required|regex_match[/^[0-9.,]+$/]',
					),
		),
	   'addStorage'=>array(
					array(

						'field' => 'txt_storage',
						'label' => 'storage name',
                        'rules' => 'trim|required',
					),
		),
	   'editStorage'=>array(
					array(

						'field' => 'txt_storage',
						'label' => 'storage name',
                        'rules' => 'trim|required',
					),
		),
	   'addStock'=>array(
					array(

						'field' => 'txt_stock',
						'label' => 'stock name',
                        'rules' => 'trim|required',
					),
					array(

						'field' => 'dd_storageDD',
						'label' => 'storage',
                        'rules' => 'trim|required',
					),
					array(

						'field' => 'dd_storageDD',
						'label' => 'storage',
                        'rules' => 'required',
					),
					array(

						'field' => 'txt_quantity',
						'label' => 'quantity',
                        'rules' => 'trim|required|numeric|regex_match[/^[0-9]+$/]',
					),
		),
	   'editStock'=>array(
					array(

						'field' => 'txt_stock',
						'label' => 'stock name',
                        'rules' => 'trim|required',
					),
		),
	   'addNewStock'=>array(
					array(

						'field' => 'txt_quantity',
						'label' => 'Quantity',
                        'rules' => 'trim|required|numeric|regex_match[/^[0-9]+$/]|callback__checkIfZero',
					),
		),
	   'subtractStock'=>array(
					array(

						'field' => 'txt_quantity',
						'label' => 'Used Quantity',
                        'rules' => 'trim|required|numeric|regex_match[/^[0-9]+$/]|callback__checkQuantity|callback__checkIfZero',
					),
		),
	   
	);
?>