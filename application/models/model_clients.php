<?php
// Менеджер Журналов
//
class Model_Clients extends Model
{	
	private static $instance;	// экземпляр класса
	private $msql;				// драйвер БД

	
	
	public static function Instance()
	{
		if (self::$instance == null)
			self::$instance = new Model_Clients();
			
		return self::$instance;
	}

	//
	// Конструктор
	//
	public function __construct()
	{
		$this->msql = model_Msql::Instance();

	}
	
	public function getListClients()
	{
		$sql = "SELECT users.name,users.`phone`,`login`,data_reg FROM em_orders,users WHERE id_role>1 ";
		return $this->msql->Select($sql);
	}
	
	public function getInfoClients($id,$id_order)
	{
		if($id == 0)
		{
			
			$sql = "SELECT  id  as id_Zakaza, name,email,phone,description,userAdress,date_change_order,data_insert,status FROM em_orders  WHERE id=$id_order";
		}else{
			$id = $id*1;
			
			$sql = "SELECT  id as id_Zakaza, users.login as email,users.name,users.phone,description,userAdress,date_change_order,data_insert,status FROM users,em_orders WHERE id=$id_order AND id_client=id_user";
		}
		
		$info = $this->msql->SELECT($sql);
		return $info[0];
	}
	
}
