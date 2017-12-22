<?php

class crud
{
	private $db;
	
	function __construct($DB_con)
	{
		$this->db = $DB_con;
	}

	public function editkategori($id_kategori,$nama_kategori){
		try{		
			$query = "UPDATE pembayaran_kategori set nama_kategori_pembayaran=:nama_kategori where id_kategori_pembayaran=:id";
			$stmt = $this->db->prepare($query);			
			$stmt->bindparam(":nama_kategori",$nama_kategori);
			$stmt->bindparam(":id",$id_kategori);
			$stmt->execute();	
			return true;
		}
		catch(PDOException $e)
		{
		echo $e->getMessage();	
		return false;
		}
	}

	public function detail($id){

		try{		
			$query = "SELECT * FROM barang where id_barang=:id";
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

	public function addproducts($id_kategori,$kd_barang,$nama_barang,$harga_beli,$harga_jual,$stok_awal){

		try{		
			$query = "INSERT INTO barang
			(id_kategori,kd_barang, nama_barang, harga_beli, harga_jual, stok)
			VALUES (:id_kategori,:kd_barang, :nama_barang, :harga_beli, :harga_jual, :stok)";
			$stmt = $this->db->prepare($query);			
			$stmt->bindparam(":id_kategori",$id_kategori);
			$stmt->bindparam(":kd_barang",$kd_barang);
			$stmt->bindparam(":nama_barang",$nama_barang);
			$stmt->bindparam(":harga_beli",$harga_beli);
			$stmt->bindparam(":harga_jual",$harga_jual);
			$stmt->bindparam(":stok",$stok_awal);
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
			$stmt = $this->db->prepare("Delete from pembayaran_kategori where id_kategori_pembayaran=:id");
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


	public function getkategori(){
		try{		
			$stmt = $this->db->prepare("Select * from barang_kategori");
			$stmt->execute();
			$row=$stmt->fetchAll();		
			return $row;	
		
		}
		catch(PDOException $e)
		{
		echo $e->getMessage();	
		return false;
		}

	}
	
	public function dataproducts($search,$length,$start){

		$search="%$search%";
	
		try{		
			$query = "SELECT * FROM barang 
			INNER JOIN barang_kategori ON (barang_kategori.id_kategori=barang.id_kategori)
			where barang.nama_barang like :search or barang.kd_barang like :search";

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

	public function totalproducts($search){
	
		try{		
			$query = "select count(id_barang) as total from barang where nama_barang LIKE '%$search%' ";
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
