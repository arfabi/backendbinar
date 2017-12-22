<?php

class crud
{
	private $db;
	
	function __construct($DB_con)
	{
		$this->db = $DB_con;
	}

	public function editkategori($id_kategori,$nama_kategori,$status_kategori){
		try{		
			$query = "UPDATE barang_kategori set nama_kategori=:nama_kategori, status_kategori=:status_kategori where id_kategori=:id_kategori";
			$stmt = $this->db->prepare($query);			
			$stmt->bindparam(":nama_kategori",$nama_kategori);
			$stmt->bindparam(":id_kategori",$id_kategori);
			$stmt->bindparam(":status_kategori",$status_kategori);
			$stmt->execute();	
			return true;
		}
		catch(PDOException $e)
		{
		echo $e->getMessage();	
		return false;
		}
	}

	public function detailkategori($id){

		try{		
			$query = "SELECT * FROM barang_kategori where id_kategori=:id";
			$stmt = $this->db->prepare($query);			
			$stmt->bindparam(":id",$id);
			$stmt->execute();	
			$row=$stmt->fetch();		
			return $row;
		}
		catch(PDOException $e)
		{
		echo $e->getMessage();	
		return false;
		}

	}

	public function addkategori($nama_kategori,$status){

		try{		
			$query = "INSERT INTO barang_kategori
			(nama_kategori,status_kategori)
			VALUES (:nama_kategori,:status)";
			$stmt = $this->db->prepare($query);			
			$stmt->bindparam(":nama_kategori",$nama_kategori);
			$stmt->bindparam(":status",$status);
			$stmt->execute();	
			return true;
		}
		catch(PDOException $e)
		{
		echo $e->getMessage();	
		return false;
		}
	}

	public function deletekategori($id){
		try{		
			$stmt = $this->db->prepare("Delete from barang_kategori where id_kategori=:id");
			$stmt->bindparam(":id",$id);
			$stmt->execute();	
			return true;
		
		}
		catch(PDOException $e)
		{
		echo $e->getMessage();	
		return false;
		}
	}
	
	public function datakategori($search,$length,$start){

		$search="%$search%";
	
		try{		
			$query = "SELECT * FROM barang_kategori
			where nama_kategori like :search";

			$newquery = $this->paging($query,$length,$start);
			$stmt = $this->db->prepare($newquery);
			$stmt->bindparam(":search",$search);
			
			$stmt->execute();	
			$row=$stmt->fetchAll();		
			return $row;
		}catch(PDOException $e){
			echo $e->getMessage();	
			return false;
		}
	
	}

	public function totalkategori($search){
	
		try{		
			$query = "select count(id_kategori) as total from barang_kategori where nama_kategori LIKE '%$search%' ";
			$stmt = $this->db->prepare($query);
			$stmt->execute();	
			$row=$stmt->fetch();		
			return $row['total'];
		}
		catch(PDOException $e)
		{
		echo $e->getMessage();	
		return false;
		}
	
	}


	
	public function paging($query,$length,$start)
	{
		$starting_position=0;
		if($start>0)
		{
			$starting_position=($start-1)*$length;
		}
		$query2=$query." limit $starting_position,$length";
		return $query2;
	}




	
}

?>
