<?php if( ! defined('BASEPATH')) exit ('No direct script access allowed');

class Admin_model extends My_Model
{
	function __construct()
	{
		parent::__construct();
	}


	function getServiceData($id)
	{
		$this->db->where(SERVICE_ID, $id);
		$query =$this->db->get(TBL_SERVICE);
		return $query->result_array();
	}

	function addService($post)
	{
		$insertRecord = array(

			SERVICE_NAME => $post['txt_service'],
			IS_ACTIVE => isset($post['chk_isActive']) ? ACTIVE : INACTIVE,
			SERVICE_PRICE => str_replace(',','',$post['txt_price']),
			SERVICE_BY_USER_ID => sessionUserId(),
			INSERTED_DATE => date('Y-m-d H:i:s'),
			
			);

		$this->db->insert(TBL_SERVICE, $insertRecord);
	}

	function updateService($post, $id)
	{

		$updateRecord = array(

			SERVICE_NAME => filter_string($post['txt_service']),
			SERVICE_PRICE => str_replace(',','',$post['txt_price']),
			IS_ACTIVE => isset($post['chk_isActive']) ? ACTIVE : INACTIVE,
			);

		$this->db->where(SERVICE_ID, $id);
		$this->db->update(TBL_SERVICE, $updateRecord);
	}

	function getServices()
	{	
		$this->db->where(SERVICE_BY_USER_ID,sessionUserId());
		$query = $this->db->get(TBL_SERVICE);
		return $query->result_array();
	}

	function deleteService($id)
	{
		$updateQuery = array(

			IS_ACTIVE => INACTIVE,

			);

		$this->db->where(SERVICE_ID, $id);
		$this->db->update(TBL_SERVICE, $updateQuery);
	}

	function getAllUsers()
	{
		$query = $this->db->get(TBL_USERS);
		return $query->result_array();
	}

	function getPatients()
	{
		$this->db->where(USER_CLINIC_ID, sessionUserId());
		$query = $this->db->get(TBL_PATIENTS);
		return $query->result_array();
	}

	function getStocks()
	{	
		$this->db->where(USER_CLINIC_ID,sessionUserId());
		$query = $this->db->get(TBL_STOCKS);
		return $query->result_array();
	}

	function getStorage()
	{
		$this->db->where(USER_CLINIC_ID, sessionUserId());
		$query = $this->db->get(TBL_STORAGE);
		return $query->result_array();
	}

	function getActiveStorage()
	{
		$this->db->where(USER_CLINIC_ID, sessionUserId());
		$this->db->where(IS_ACTIVE, ACTIVE);
		$query = $this->db->get(TBL_STORAGE);
		return $query->result_array();
	}

	function getStocksHistory()
	{
		$this->db->where(USER_CLINIC_ID, sessionUserId());
		$query = $this->db->get(TBL_STOCKS_HISTORY);
		return $query->result_array();	
	}	

	function getStocksHistoryUsingStockID($id)
	{
		$this->db->select("SUM(".STOCK_QUANTITY.") as Quantity".'');
		$this->db->where(STOCK_ID, $id);
		$this->db->where(USER_CLINIC_ID, sessionUserId());
		$this->db->where(IS_ACTIVE, ACTIVE);
		$query = $this->db->get(TBL_STOCKS_HISTORY);
		return $query->result_array();	
	}

	function getStorageData($id)
	{
		$this->db->where(STORAGE_ID, $id);
		$query =$this->db->get(TBL_STORAGE);
		return $query->result_array();
	}

	function addStorage($post)
	{
		$insertRecord = array(

			STORAGE_NAME => filter_string($post['txt_storage']),
			IS_ACTIVE => isset($post['chk_isActive']) ? ACTIVE : INACTIVE,
			USER_CLINIC_ID => sessionUserId(),
			INSERTED_DATE => date('Y-m-d H:i:s'),
			
			);

		$this->db->insert(TBL_STORAGE, $insertRecord);
	}

	function updateStorage($post, $id)
	{

		$updateRecord = array(

			STORAGE_NAME => filter_string($post['txt_storage']),
			USER_CLINIC_ID => sessionUserId(),
			IS_ACTIVE => isset($post['chk_isActive']) ? ACTIVE : INACTIVE,
				
			);

		$this->db->where(STORAGE_ID, $id);
		$this->db->update(TBL_STORAGE, $updateRecord);
	}

	function deleteStorage($id)
	{
		$updateQuery = array(

			IS_ACTIVE => INACTIVE,

			);

		$this->db->where(STORAGE_ID, $id);
		$this->db->update(TBL_STORAGE, $updateQuery);
	}

	public function getStockData($id)
	{
		$this->db->where(STOCK_ID, $id);
		$query =$this->db->get(TBL_STOCKS);
		return $query->result_array();
	}

	function addStock($post)
	{
		$insertRecord = array(

			STOCK_NAME => filter_string($post['txt_stock']),
			STORAGE_ID => $post['dd_storageDD'],
			STOCK_QUANTITY => $post['txt_quantity'],
			IS_ACTIVE => isset($post['chk_isActive']) ? ACTIVE : INACTIVE,
			USER_CLINIC_ID => sessionUserId(),
			INSERTED_DATE => date('Y-m-d H:i:s'),
			
			);

		$this->db->insert(TBL_STOCKS, $insertRecord);
	}

	function updateStock($post, $id)
	{

		$updateRecord = array(

			STOCK_NAME => filter_string($post['txt_stock']),
			STORAGE_ID => $post['dd_storageDD'],
			USER_CLINIC_ID => sessionUserId(),
			IS_ACTIVE => isset($post['chk_isActive']) ? ACTIVE : INACTIVE,
				
			);

		$this->db->where(STOCK_ID, $id);
		$this->db->update(TBL_STOCKS, $updateRecord);
	}

	function deleteStock($id)
	{
		$updateQuery = array(

			IS_ACTIVE => INACTIVE,

			);

		$this->db->where(STOCK_ID, $id);
		$this->db->update(TBL_STOCKS, $updateQuery);
	}

	function checkQuantity($post)
	{
		$action = decryptString($this->uri->segment(3));
		$id = decryptString($this->uri->segment(4));
		
		$data = $this->getStockData($id);
		$data = $data[0];

		if($data[STOCK_QUANTITY] >= $post['txt_quantity'])
			return TRUE;
		else
			return FALSE;
	}

	function addStockHistory($post)
	{
		$id = decryptString($this->uri->segment(4));
		$stockStorage = $this->getStockData($id);
		$stockStorage = $stockStorage[0];
			
		$action = decryptString($this->uri->segment(3));

		if($action == 'Add')
		{
			$insertRecord = array(

				STOCK_ID => $id,
				STOCK_QUANTITY => $post['txt_quantity'],
				USER_CLINIC_ID => sessionUserId(),
				STORAGE_ID => $stockStorage[STORAGE_ID],
				INSERTED_DATE => date('Y-m-d H:i:s'),
				IS_ACTIVE => ACTIVE,
				);
		}
		else
		{
			$insertRecord = array(

				STOCK_ID => $id,
				STOCK_QUANTITY => '-'.$post['txt_quantity'],
				USER_CLINIC_ID => sessionUserId(),
				STORAGE_ID => $stockStorage[STORAGE_ID],
				INSERTED_DATE => date('Y-m-d H:i:s'),
				IS_ACTIVE => ACTIVE,

				);
		}

		$this->db->insert(TBL_STOCKS_HISTORY, $insertRecord);

		$this->updateStockQuantity($id);
	}


	function updateStockQuantity($id)
	{

		$data = $this->getStockData($id);
		$data = $data[0];

		$historyData = $this->getStocksHistoryUsingStockID($id);
		$historyData = $historyData[0];

		$updateRecord = array(

			STOCK_QUANTITY => $data[STOCK_QUANTITY] + $historyData['Quantity'], 

			);

		$this->db->where(STOCK_ID, $id);
		$this->db->update(TBL_STOCKS, $updateRecord);

		$this->updateStockHistoryUsingID($id);
		
	}

	function updateStockHistoryUsingID($id)
	{

		$this->db->where(STOCK_ID, $id);
		$updateRecord = array(

			IS_ACTIVE => INACTIVE,

			);

		$this->db->update(TBL_STOCKS_HISTORY, $updateRecord);

	}

	function getInvoices()
	{
		$this->db->where(USER_CLINIC_ID , sessionUserId());
		$query = $this->db->get(TBL_INVOICES);
		return $query->result_array();
	}

	function makeInvoicePaid($id)
	{
		$updateRecord = array(
			
			IS_PAID => PAID,

			);


		$this->db->where(INVOICE_ID, $id);
		$this->db->update(TBL_INVOICES, $updateRecord);
	}

	function getAppointments()
	{
		$this->db->where('"'.APPOINTMENT_DATE.' > '.date('Y-m-d H:i:s').' "' );
	}

}