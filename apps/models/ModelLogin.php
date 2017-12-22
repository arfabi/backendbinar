<?php

class crud
{
	private $db;
	
	function __construct($DB_con)
	{
		$this->db = $DB_con;
	}
	
	
	public function login($username,$password)
	{
		$stmt = $this->db->prepare("SELECT * FROM admin WHERE username=:username and password=:password and level='Owner'");
		$stmt->bindparam(":username",$username);
		$stmt->bindparam(":password",$password);
		$stmt->execute();
			//$row['data']=$stmt->fetchAll();	
		$editRow=$stmt->fetch(PDO::FETCH_ASSOC);



		$id=$editRow['id_admin'];
		$image=$editRow['foto'];
		$email=$editRow['username'];
		$no_hp=$editRow['no_hp'];
		$nama=$editRow['nama_admin'];
		$level=$editRow['level'];

		$token=md5($id);
		$now=DATE("Y-m-d H:i:s");
		$update=$this->db->prepare("UPDATE admin SET token=:token, last_login=:now WHERE id_admin=:id ");
			$update->bindparam(":token",$token);
			$update->bindparam(":now",$now);
			$update->bindparam(":id",$id);
			$update->execute();

		if(!empty($editRow)){
		create_sesi($token,$image,$nama,$no_hp,$email,$level);
		}
		
		return $id;
	}

		
	
}
