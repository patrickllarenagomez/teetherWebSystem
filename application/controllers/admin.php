<?php if( ! defined('BASEPATH')) exit ('No direct script access allowed');

class Admin extends My_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('Home_model','HOME');
		$this->load->model('Admin_model', 'ADMIN');
		$this->output->enable_profiler(FALSE);
	}


	function index()
	{
		if(!sessionUserId())
			redirect('home/main');

		if(sessionUserLevel() == USER)
			redirect('user/dashboard');

		if(sessionUserLevel() == ADMIN)
			redirect('admin/dashboard');

		$this->_checkSession();
	}

	function dashboard()
	{
		$data['test'] = '';
		$this->load->view('adminDashboard',$data);
	}

	private function _checkSession()
	{
		if(sessionUserId() > 0)
		{
			if(sessionUserLevel() == ADMIN)
				redirect(base_url('admin/dashboard'));
			else 
				redirect(base_url('home/main'));
		}
	}

	private function _form_validate($post)
  	{
  		$this->form_validation->set_error_delimiters('<div class="alert alert-danger text_left" style="margin-bottom:0px" role="alert">', '</div>');

  		$this->form_validation->set_message('regex_match', "The %s is not in its correct format.");

  		$this->form_validation->set_message('is_unique', "The %s is already taken");

  	 	if(isset($post['btn_addService']))
			return $this->form_validation->run('addService');

		if(isset($post['btn_editService']))
			return $this->form_validation->run('editService');

		if(isset($post['btn_addStorage']))
			return $this->form_validation->run('addStorage');

		if(isset($post['btn_editStorage']))
			return $this->form_validation->run('editStorage');

		if(isset($post['btn_addStock']))
			return $this->form_validation->run('addStock');

		if(isset($post['btn_editStock']))
			return $this->form_validation->run('editStock');

		if(isset($post['btn_addNewStock']))
			return $this->form_validation->run('addNewStock');

		if(isset($post['btn_subtractStock']))
			return $this->form_validation->run('subtractStock');
    }

	function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url());	
	}

	function service()
	{
		$mySession = $this->session->userdata('login_user');
		$flashdata = $this->session->flashdata('service_notification');

		$query = $this->ADMIN->getServices();

		$table = '';

		if(count($query) > 0)
		{
			foreach($query as $q)
			{
				$table .= '<tr>
					<td></td>
					<td>'.$q[SERVICE_NAME].'</td>
					<td>'."&#x20B1;".format_money($q[SERVICE_PRICE]).'</td>
					<td>'.($q[IS_ACTIVE] == 1 ? "Active": "Inactive" ).'</td>
					<td>'.format_date($q[INSERTED_DATE]).'</td>
					<td>
					<a href='.base_url('admin/addEditService/'.encryptString('Edit').'/'.encryptString($q[SERVICE_ID])).'><span style="margin:3px 3px" aria-hidden="true" title="Edit" class="fa fa-edit"></span></a>
					<a class="isDelete" no='.encryptString($q[SERVICE_ID]).'><span style="margin:3px 3px" aria-hidden="true" title="Inactive" class="fa fa-times"></span></a>
					</td>
				</tr>';
			}
		}

		$data['flashdata'] = $flashdata;
		$data['table'] = $table;
		$this->load->view('service',$data);
	}

	function addEditService()
	{
		// if(!sessionUserId())
		// 	redirect(base_url());
		
		$action = decryptString($this->uri->segment(3));
		$id = decryptString($this->uri->segment(4));
		$post = $this->input->post();
		
		$recordData = $this->ADMIN->getServiceData($id);
		if($recordData)
			$recordData = $recordData[0];

		$isRequired = isset($action) && ($action == 'Edit' || $action == 'Add')   ? '<span style="color:red">*</span>' : "";
		$mySession = $this->session->userdata('login_user');

		if($post)
		{

			if($action == 'Add')
			{

				if($this->_form_validate($post))
				{
					$this->ADMIN->addService($post);
					$this->session->set_flashdata('service_notification', notifSuccess("Service has been registered successfully."));
					redirect(base_url('admin/service'));
					
				}
			}
			else
			{
				if($this->_form_validate($post))
				{
					$this->ADMIN->updateService($post, $id);
					$this->session->set_flashdata('service_notification', notifSuccess('Service has been updated successfully.'));
					redirect(base_url('admin/service'));
				}
			}		
		}

		elseif($id)
		{
			$post = array(

				'txt_service' => $recordData[SERVICE_NAME],
				'txt_price' => $recordData[SERVICE_PRICE],
				'chk_isActive' => $recordData[IS_ACTIVE],
				
				);
		}
		else
		{
			$post = array(

				'txt_service' => "",
				'txt_price' => "",
				'chk_isActive' => "",
				
				);
		}

			$btn = ((isset($action) && $action == "Add") ?  
				'<div class="col-md-2">
          		<a href="'.base_url('admin/service').'">
          		<button class="form-control btn btn-primary" type="button">Cancel</button></a>
          		</div>
          		<div class="col-md-2">
          		<button class="form-control btn btn-primary" type="submit" name="btn_addService">Submit</button>
        		</div>' :
         	(($action == "Edit") ? 
        		'<div class="col-md-2 pull-left" style="padding-left:0px">
          		<a style="text-decoration:none" href="'.base_url('admin/service').'">
          		<button class="form-control btn btn-primary" type="button">Cancel</button></a>
          		</div>
          		<div class="col-md-2 pull-left" style="padding-left:5px">
          		<a style="text-decoration:none" href="'.base_url('admin/service').'">
          		<button class="form-control btn btn-primary" type="submit" name="btn_editService">Submit</button></a>
          		</div>'
          		: ""));


			$form = ''.form_open('admin/addEditService/'.encryptString($action).'/'.encryptString($id)).'<div><table>';
			$form .= 
			'<tr>
              <td>Service: </td>
              <td><input class="form-control" name="txt_service" type="text" value='.(isset($post['txt_service']) ? $post['txt_service'] : "").'></td>
              <td>'.$isRequired.'</td>
              <td>'.form_error('txt_service').'</td>
            </tr>

            <td>Service Price: </td>
              <td><input class="form-control" id="price" name="txt_price" placeholder="0.00" type="text" value='.(isset($post['txt_price']) ? $post['txt_price'] : "").'></td>
              <td>'.$isRequired.'</td>
              <td>'.form_error('txt_price').'</td>
            </tr>

            <tr>
              <td>Active:</td>
              <td><input id="chk_isActive" type="checkbox" value="1" name="chk_isActive" '.((isset($post['chk_isActive']) && $post['chk_isActive'] == 1) ? "checked" : "").' '.($mySession[USER_ID] == $id ? 'readOnly' : "").'></td>
            </tr>';

		$form .= '</table><br>'.$btn.'</div>'.form_close().'';

		$data['id'] = isset($id) ? $id : NULL;
		$data['form'] = $form;
		$data['action'] = $action;	
		$this->load->view('addEditService', $data);
	}

	function deleteService()
	{
		$id = decryptString($this->uri->segment(3));
		$this->ADMIN->deleteService($id);
		$this->session->set_flashdata('service_notification' ,notifSuccess('Service has been successfully made inactive.'));

		redirect('admin/service');
	}	

	//--------------- PATIENTS RECORD ---------------------

	function patients()
	{
		$mySession = $this->session->userdata('login_user');
		$flashdata = $this->session->flashdata('patient_notification');

		$users = $this->ADMIN->getAllUsers();

		foreach($users as $user)
		{
			$userArr[$user[USER_ID]] = $user[USER_FIRSTNAME].' '.$user[USER_LASTNAME];
		}

		$services = $this->ADMIN->getServices();


		if(count($services) > 0 )
			foreach ($services as $service)
			{
				$serviceArr[$service[SERVICE_ID]] = $service[SERVICE_NAME];
			}

		$table = '';

		$query = $this->ADMIN->getPatients();

		if(count($query) > 0)
		{
			foreach($query as $q)
			{
				$table .= '<tr>
					<td></td>
					<td>'.$userArr[$q[USER_ID]].'</td>
					<td>'.isset($serviceArr) ? $serviceArr[$q[SERVICE_ID]] : NONE .'</td>
					<td>'.format_date($q[APPOINTMENT_DATE]).'</td>
					<td><a href='.base_url('admin/printCertificate').'><span style="margin:3px 3px" class="fa fa-file-pdf-o"></span></a></td>
				</tr>';
			}
		}

		$data['flashdata'] = $flashdata;
		$data['table'] = $table;
		$this->load->view('patients',$data);
	}	

	//------------------ STORAGE ---------------------------------

	function storage()
	{
		$mySession = $this->session->userdata('login_user');
		$flashdata = $this->session->flashdata('storage_notification');

		$table = '';

		$query = $this->ADMIN->getStorage();

		if(count($query) > 0)
		{
			foreach($query as $q)
			{
				$table .= '<tr>
					<td></td>
					<td>'.$q[STORAGE_NAME].'</td>
					<td>'.($q[IS_ACTIVE] == 1 ?  'Active' : 'Inactive' ).'</td>
					<td>
						<a href='.base_url('admin/addEditStorage/'.encryptString('Edit').'/'.encryptString($q[STORAGE_ID])).'><span style="margin:3px 3px" aria-hidden="true" title="Edit" class="fa fa-edit"></span></a>
						<a href='.base_url('admin/deleteStorage/'.encryptString($q[STORAGE_ID])).'><span style="margin:3px 3px" aria-hidden="true" title="Inactivate" class="fa fa-times"></span></a>
					</td>
				</tr>';
			}
		}

		$data['flashdata'] = $flashdata;	
		$data['table'] = $table;
		$this->load->view('storage',$data);
	}

	function addEditStorage()
	{
		$action = decryptString($this->uri->segment(3));
		$id = decryptString($this->uri->segment(4));
		$post = $this->input->post();
		
		$recordData = $this->ADMIN->getStorageData($id);
		if($recordData)
			$recordData = $recordData[0];

		$isRequired = isset($action) && ($action == 'Edit' || $action == 'Add')   ? '<span style="color:red">*</span>' : "";
		$mySession = $this->session->userdata('login_user');

		if($post)
		{

			if($action == 'Add')
			{

				if($this->_form_validate($post))
				{
					$this->ADMIN->addStorage($post);
					$this->session->set_flashdata('storage_notification', notifSuccess("Storage has been registered successfully."));
					redirect(base_url('admin/storage'));
					
				}
			}
			else
			{
				if($this->_form_validate($post))
				{
					$this->ADMIN->updateStorage($post, $id);
					$this->session->set_flashdata('storage_notification', notifSuccess('Storage has been updated successfully.'));
					redirect(base_url('admin/storage'));
				}
			}		
		}

		elseif($id)
		{
			$post = array(

				'txt_storage' => $recordData[STORAGE_NAME],
				'chk_isActive' => $recordData[IS_ACTIVE],
				
				);
		}
		else
		{
			$post = array(

				'txt_storage' => "",
				'chk_isActive' => "",
				
				);
		}

			$btn = ((isset($action) && $action == "Add") ?  
				'<div class="col-md-2">
          		<a href="'.base_url('admin/storage').'">
          		<button class="form-control btn btn-primary" type="button">Cancel</button></a>
          		</div>
          		<div class="col-md-2">
          		<button class="form-control btn btn-primary" type="submit" name="btn_addStorage">Submit</button>
        		</div>' :
         	(($action == "Edit") ? 
        		'<div class="col-md-2 pull-left" style="padding-left:0px">
          		<a style="text-decoration:none" href="'.base_url('admin/storage').'">
          		<button class="form-control btn btn-primary" type="button">Cancel</button></a>
          		</div>
          		<div class="col-md-2 pull-left" style="padding-left:5px">
          		<a style="text-decoration:none" href="'.base_url('admin/storage').'">
          		<button class="form-control btn btn-primary" type="submit" name="btn_editStorage">Submit</button></a>
          		</div>'
          		: ""));


			$form = ''.form_open('admin/addEditStorage/'.encryptString($action).'/'.encryptString($id)).'<div><table>';
			$form .= 
			'<tr>
              <td>Storage: </td>
              <td><input class="form-control" name="txt_storage" type="text" value='.(isset($post['txt_storage']) ? $post['txt_storage'] : "").'></td>
              <td>'.$isRequired.'</td>
              <td>'.form_error('txt_storage').'</td>
            </tr>

            <tr>
              <td>Active:</td>
              <td><input id="chk_isActive" type="checkbox" value="1" name="chk_isActive" '.((isset($post['chk_isActive']) && $post['chk_isActive'] == 1) ? "checked" : "").' '.($mySession[USER_ID] == $id ? 'readOnly' : "").'></td>
            </tr>';

		$form .= '</table><br>'.$btn.'</div>'.form_close().'';

		$data['id'] = isset($id) ? $id : NULL;
		$data['form'] = $form;
		$data['action'] = $action;	
		$this->load->view('addEditStorage', $data);
	}

	function deleteStorage()
	{
		$id = decryptString($this->uri->segment(3));
		$this->ADMIN->deleteStorage($id);
		$this->session->set_flashdata('storage_notification' ,notifSuccess('Storage has been successfully made inactive.'));

		redirect('admin/storage');
	}
// ---------------------------- STOCKS ------------------------- 

	function stocks()
	{
		$mySession = $this->session->userdata('login_user');
		$flashdata = $this->session->flashdata('stocks_notification');

		$table = '';

		$query = $this->ADMIN->getStocks();

		$storage = $this->ADMIN->getStorage();

		if(count($storage) > 0 )
			foreach ($storage as $stor)
			{
				$stoArr[$stor[STORAGE_ID]] = $stor[STORAGE_NAME]; 
			}

		if(count($query) > 0)
		{
			$plusOrMinus = '';
			foreach($query as $q)
			{
				($q[IS_ACTIVE] == '1' 

				 	? 
				 	$plusOrMinus = '<a href='.base_url('admin/addMinusStock/'.encryptString('Add').'/'.encryptString($q[STOCK_ID])).'><span style="margin:3px 3px" aria-hidden="true" title="Add" class="fa fa-plus-circle"></span></a>
				 	<a href='.base_url('admin/addMinusStock/'.encryptString('Subtract').'/'.encryptString($q[STOCK_ID])).'><span style="margin:3px 3px" aria-hidden="true" title="Subtract" class="fa fa-minus-circle"></span></a>'
						
				 	:  
				 	$plusOrMinus = ''
				 	);  

				$table .= '<tr>
					<td></td>
					<td>'.$q[STOCK_NAME].'</td>
					<td>'.$q[STOCK_QUANTITY].'</td>
					<td>'.(isset($stoArr[$q[STORAGE_ID]]) ? $stoArr[$q[STORAGE_ID]] : NONE).'</td>
					<td>
						<a href='.base_url('admin/addEditStock/'.encryptString('Edit').'/'.encryptString($q[STOCK_ID])).'><span style="margin:3px 3px" aria-hidden="true" title="Edit" class="fa fa-edit"></span></a>'.$plusOrMinus.'					
					</td>
				</tr>';
			}
		}

		$data['flashdata'] = $flashdata;	
		$data['table'] = $table;
		$this->load->view('stocks',$data);
	}

	function addEditStock()
	{
		$action = decryptString($this->uri->segment(3));
		$id = decryptString($this->uri->segment(4));
		$post = $this->input->post();
		
		$recordData = $this->ADMIN->getStockData($id);
		if($recordData)
			$recordData = $recordData[0];

		$isRequired = isset($action) && ($action == 'Edit' || $action == 'Add')   ? '<span style="color:red">*</span>' : "";
		$mySession = $this->session->userdata('login_user');

		if($post)
		{

			if($action == 'Add')
			{

				if($this->_form_validate($post))
				{
					$this->ADMIN->addStock($post);
					$this->session->set_flashdata('stock_notification', notifSuccess("Stock has been registered successfully."));
					redirect(base_url('admin/stocks'));
					
				}
			}
			else
			{
				if($this->_form_validate($post))
				{
					$this->ADMIN->updateStock($post, $id);
					$this->session->set_flashdata('stock_notification', notifSuccess('Stock has been updated successfully.'));
					redirect(base_url('admin/stocks'));
				}
			}		
		}

		elseif($id)
		{
			$post = array(

				'txt_stock' => $recordData[STOCK_NAME],
				'dd_storageDD' => $recordData[STORAGE_ID],
				'chk_isActive' => $recordData[IS_ACTIVE],

				);
		}
		else
		{
			$post = array(

				'txt_stock' => '',
				'dd_storageDD' => '',
				'chk_isActive' =>'',
				
				);
		}

		$storageDD = createStorageDD(isset($post['dd_storageDD']) ? $post['dd_storageDD'] : 0);

		if($action == 'Add')
		{
			$qty = 
				'<tr>
				<td>Quantity :</td>
            	<td><input class="form-control" name="txt_quantity" type="text" value='.(isset($post['txt_quantity']) ? $post['txt_quantity'] : "").'></td>
            	<td>'.$isRequired.'</td>
             	<td>'.form_error('txt_quantity').'</td>
            	</tr>';
		}
		else
			$qty = '';
			

			$btn = ((isset($action) && $action == "Add") ?  
				'<div class="col-md-2">
          		<a href="'.base_url('admin/stocks').'">
          		<button class="form-control btn btn-primary" type="button">Cancel</button></a>
          		</div>
          		<div class="col-md-2">
          		<button class="form-control btn btn-primary" type="submit" name="btn_addStock">Submit</button>
        		</div>' :
         	(($action == "Edit") ? 
        		'<div class="col-md-2 pull-left" style="padding-left:0px">
          		<a style="text-decoration:none" href="'.base_url('admin/stocks').'">
          		<button class="form-control btn btn-primary" type="button">Cancel</button></a>
          		</div>
          		<div class="col-md-2 pull-left" style="padding-left:5px">
          		<a style="text-decoration:none" href="'.base_url('admin/stocks').'">
          		<button class="form-control btn btn-primary" type="submit" name="btn_editStock">Submit</button></a>
          		</div>'
          		: ""));

			$form = ''.form_open('admin/addEditStock/'.encryptString($action).'/'.encryptString($id)).'<div><table>';
			$form .= 
			'
			
			<tr>
				<td>Storage : </td>
            	<td>'.$storageDD.'</td>
            	<td>'.form_error('dd_storageDD').'</td>
            </tr>

			<tr>
              <td>Stock Name: </td>
              <td><input class="form-control" name="txt_stock" type="text" value='.(isset($post['txt_stock']) ? $post['txt_stock'] : "").'></td>
              <td>'.$isRequired.'</td>
              <td>'.form_error('txt_stock').'</td>
            </tr>
            
            	'.$qty.'

            <tr>
              <td>Active :</td>
              <td><input id="chk_isActive" type="checkbox" value="1" name="chk_isActive" '.((isset($post['chk_isActive']) && $post['chk_isActive'] == 1) ? "checked" : "").' '.($mySession[USER_ID] == $id ? 'readOnly' : "").'></td>
            </tr>';

		$form .= '</table><br>'.$btn.'</div>'.form_close().'';

		$data['id'] = isset($id) ? $id : NULL;
		$data['form'] = $form;
		$data['action'] = $action;	
		$this->load->view('addEditStock', $data);
	}

	function deleteStock()
	{
		$id = decryptString($this->uri->segment(3));
		$this->ADMIN->deleteStock($id);
		$this->session->set_flashdata('stock_notification' ,notifSuccess('Stock has been successfully made inactive.'));

		redirect('admin/stocks');
	}

	function stocksHistory()
	{
		$mySession = $this->session->userdata('login_user');
		$flashdata = $this->session->flashdata('stocksHistory_notification');

		$table = '';
		$query = $this->ADMIN->getStocksHistory();

		$storage = $this->ADMIN->getStorage();

		$stocks = $this->ADMIN->getStocks();
		$stocksArr = array();
		$stoArr = array();

		if(count($stocks) > 0)
			foreach ($stocks as $stock)
			{
				$stocksArr[$stock[STOCK_ID]] = $stock[STOCK_NAME];
			}

		if(count($storage) > 0 )
			foreach ($storage as $stor)
			{
				$stoArr[$stor[STORAGE_ID]] = $stor[STORAGE_NAME]; 
			}

		if(count($query) > 0)
		{
			foreach($query as $q)
			{
				$table .= '<tr>
					<td></td>
					<td>'.(count($stocksArr) > 0 ? $stocksArr[$q[STOCK_ID]] : '').'</td>
					<td>'.$q[STOCK_QUANTITY].'</td>
					<td>'.(count($stoArr)> 0 ? $stoArr[$q[STORAGE_ID]]: '' ).'</td>
					<td>'.format_date($q[INSERTED_DATE]).'</td>
				</tr>';
			}
		}

		$data['flashdata'] = $flashdata;	
		$data['table'] = $table;
		$this->load->view('stocksHistory',$data);
	}

	function addMinusStock()
	{
		$action = decryptString($this->uri->segment(3));
		$id = decryptString($this->uri->segment(4));

		$post = $this->input->post();

		$recordData = $this->ADMIN->getStockData($id);
		if($recordData)
			$recordData = $recordData[0];

		$isRequired = isset($action) && ($action == 'Subtract' || $action == 'Add')   ? '<span style="color:red">*</span>' : "";
		$mySession = $this->session->userdata('login_user');

		if($post)
		{

			if($action == 'Add')
			{

				if($this->_form_validate($post))
				{
					$this->ADMIN->addStockHistory($post);
					$this->session->set_flashdata('stock_notification', notifSuccess("Stock quantity has been updated successfully."));
					redirect(base_url('admin/stocks'));
					
				}
			}
			else
			{
				if($this->_form_validate($post))
				{
					$this->ADMIN->addStockHistory($post);
					$this->session->set_flashdata('stock_notification', notifSuccess('Stock quantity has been updated successfully.'));
					redirect(base_url('admin/stocks'));
				}
			}
		}

		elseif($id)
		{
			$post = array(

				'txt_stock' => $recordData[STOCK_NAME],

				);
		}
		else
		{
			$post = array(

				'txt_stock' => '',
				
				);
		}


			$qty = 
				'<tr>
				<td>'.($action == 'Subtract'? 'Used ': '').'Quantity :</td>
            	<td><input class="form-control" name="txt_quantity" type="text" value='.(isset($post['txt_quantity']) ? $post['txt_quantity'] : "").'></td>
            	<td>'.$isRequired.'</td>
             	<td>'.form_error('txt_quantity').'</td>
            	</tr>';


			$btn = ((isset($action) && $action == "Add") ?  
				'<div class="col-md-2">
          		<a href="'.base_url('admin/stocks').'">
          		<button class="form-control btn btn-primary" type="button">Cancel</button></a>
          		</div>
          		<div class="col-md-2">
          		<button class="form-control btn btn-primary" type="submit" name="btn_addNewStock">Submit</button>
        		</div>' :
         	(($action == "Subtract") ? 
        		'<div class="col-md-2 pull-left" style="padding-left:0px">
          		<a style="text-decoration:none" href="'.base_url('admin/stocks').'">
          		<button class="form-control btn btn-primary" type="button">Cancel</button></a>
          		</div>
          		<div class="col-md-2 pull-left" style="padding-left:5px">
          		<a style="text-decoration:none" href="'.base_url('admin/stocks').'">
          		<button class="form-control btn btn-primary" type="submit" name="btn_subtractStock">Submit</button></a>
          		</div>'
          		: ""));

			$form = ''.form_open('admin/addMinusStock/'.encryptString($action).'/'.encryptString($id)).'<div><table>';
			$form .= 
			'

			<tr>
              <td>Stock Name: </td>
              <td><input class="form-control" readOnly name="txt_stock" type="text" value='.(isset($post['txt_stock']) ? $post['txt_stock'] : "").'></td>
              <td>'.$isRequired.'</td>
            </tr>
            
            	'.$qty.'';

		$form .= '</table><br>'.$btn.'</div>'.form_close().'';

		$data['id'] = isset($id) ? $id : NULL;
		$data['form'] = $form;
		$data['action'] = $action;	
		$this->load->view('addEditStock', $data);
	}

	function _checkQuantity()
	{
		$post = $this->input->post();

		$bool = $this->ADMIN->checkQuantity($post);

		if (!$bool)
        {
        	$this->form_validation->set_message('_checkQuantity', 'Actual Quantity is less than stock used.');	 
            return FALSE;
        }
        else 
        	return TRUE;
	}

	function _checkIfZero()
	{
		$post = $this->input->post();

		if ($post['txt_quantity'] == 0)
        {
        	$this->form_validation->set_message('_checkIfZero', 'Quantity cannot be zero.');	 
            return FALSE;
        }
        else 
        	return TRUE;
	}

	function invoices()
	{
		$mySession = $this->session->userdata('login_user');
		$flashdata = $this->session->flashdata('invoice_notification');

		$table = '';

		$query = $this->ADMIN->getInvoices();

		$users = $this->ADMIN->getAllUsers();
		$userArr = array();

		if(count($users) > 0 )
			foreach ($users as $user)
			{
				$userArr[$user[USER_ID]] = $user[USER_FIRSTNAME].' '.$user[USER_LASTNAME]; 
			}

		if(count($query) > 0)
		{
			$plusOrMinus = '';
			foreach($query as $q)
			{
				($q[IS_PAID] == '0' 

				 	? 
				 	$paidOrNot = '<a href='.base_url('admin/invoicePaid/'.encryptString($q[INVOICE_ID])).'><span style="margin:3px 3px" aria-hidden="true" title="Add" class="fa fa-check"></span></a>'
				 	:  
				 	$paidOrNot = ''
				 	);  

				$table .= '<tr>
					<td></td>
					<td>'.$q[INVOICE_NAME].'</td>
					<td>'.(count($userArr)>0 ? $userArr[$q[USER_ID]] : '' ).'</td>
					<td>'.$q[IS_PAID].'</td>
					<td>'.format_date($q[DATE_OF_PAYMENT]) .'</td>
					<td>
						'.$paidOrNot.'					
					</td>
				</tr>';
			}
		}

		$data['flashdata'] = $flashdata;	
		$data['table'] = $table;
		$this->load->view('invoices',$data);
	}

	function paidInvoice()
	{
		$id = decryptString($this->uri->segment(3));
		$this->ADMIN->makeInvoicePaid($id);
		$this->session->set_flashdata('invoice_notification' ,notifSuccess('Invoice has been registered as paid.'));

		redirect('admin/invoices');
	}

	function appointments()
	{
		$mySession = $this->session->userdata('login_user');
		$flashdata = $this->session->flashdata('appointment_notification');

		$table = '';

		$query = $this->ADMIN->getAppointments();
		$services = $this->ADMIN->getServices();
		$users = $this->ADMIN->getAllUsers();
		$userArr = array();
		$serviceArr = array();
		if(count($users) > 0 )
			foreach ($users as $user)
			{
				$userArr[$user[USER_ID]][NAME] = $user[USER_FIRSTNAME].' '.$user[USER_LASTNAME];
				$userArr[$user[USER_ID]][IS_VERIFIED] = ($user[IS_VERIFIED] == 1) ? 'Verified' : 'Unverified' ; 
			}

		if(count($services) > 0)
			foreach ($services as $servie)
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
				 	$paidOrNot = '<a href='.base_url('admin/acceptAppointment/'.encryptString($q[APPOINTMENT_ID])).'><span style="margin:3px 3px" aria-hidden="true" title="Accept" class="fa fa-check"></span></a>'
				 	:  
				 	$paidOrNot = '<a href='.base_url('admin/cancelAppointment/'.encryptString($q[APPOINTMENT_ID])).'><span style="margin:3px 3px" aria-hidden="true" title="Cancel" class="fa fa-times"></span></a>'
				 	);  

				$table .= '<tr>
					<td></td>
					<td>'.(count($userArr)>0 ? $userArr[$q[USER_ID]][NAME] : '' ).'</td>
					<td>'.(count($serviceArr)>0 ? $serviceArr[$q[SERVICE_ID]] : '' ).'</td>
					<td>'.format_date($q[APPOINTMENT_DATE]).'</td>
					<td>'.$q[APPOINTMENT_TIME].'</td>
					<td>'.(count($userArr)>0 ? $userArr[$q[USER_ID]][IS_VERIFIED] : '').'</td>					<td>'.($q[IS_ACCEPTED] == 1 ? 'Accepted' : ($q[IS_ACCEPTED] == 0 ? 'Waiting for approval' : 'Declined' ) ).'</td>
					<td>
						'.$paidOrNot.'					
					</td>
				</tr>';
			}
		}

		$data['flashdata'] = $flashdata;	
		$data['table'] = $table;
		$this->load->view('adminAppointments',$data);
	}
}