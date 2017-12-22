<?php

class crud
{
	private $db;
	
	function __construct($DB_con)
	{
		$this->db = $DB_con;
	}


	public function deletesetting($id){
		try{		
			$stmt = $this->db->prepare("Delete from pembayaran_setting_tagihan where id_setting_tagihan=:id");
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



public function datakategoripembayaran(){
	
		try{		
			$query = "SELECT * FROM pembayaran_kategori";
			$stmt = $this->db->prepare($query);
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


	


	public function detailsettingtagihan($id){
		try{
			$query = "SELECT  st.*, k.nama_kategori_pembayaran, nama_prodi, nama_jenjang, nama_jenis_semester, tahun_akademik,
			(SELECT s.tahun_akademik FROM tahun_akademik s WHERE s.id_tahun_akademik=st.id_angkatan) AS tahun_angkatan
			FROM pembayaran_setting_tagihan st
			INNER JOIN pembayaran_kategori k ON (k.id_kategori_pembayaran=st.id_kategori_pembayaran)
			INNER JOIN prodi p ON (st.id_prodi=p.id_prodi)
			INNER JOIN master_jenjang j ON (j.id_jenjang=p.jenjang_prodi)
			INNER JOIN semester ON (semester.id_semester=st.id_semester)
			INNER JOIN jenis_semester ON (semester.id_jenis_semester=jenis_semester.id_jenis_semester)
			INNER JOIN tahun_akademik ON (semester.id_tahun_akademik=tahun_akademik.id_tahun_akademik)
			where st.id_setting_tagihan=:id";
			$stmt = $this->db->prepare($query);
			$stmt->bindparam(":id",$id);
			$stmt->execute();			
			$row=$stmt->fetch();	
			return $row;
		}catch(PDOException $e){

			echo $e->getMessage();
			return false;

		}
	}

	public function datasettingtagihan(){
		try{
			$query = "SELECT  st.*, k.nama_kategori_pembayaran,
			nama_prodi, nama_jenjang, nama_jenis_semester, tahun_akademik,
			(SELECT s.tahun_akademik FROM tahun_akademik s WHERE s.id_tahun_akademik=st.id_angkatan) AS tahun_angkatan
			FROM pembayaran_setting_tagihan st
			INNER JOIN pembayaran_kategori k ON (k.id_kategori_pembayaran=st.id_kategori_pembayaran)
			INNER JOIN prodi p ON (st.id_prodi=p.id_prodi)
			INNER JOIN master_jenjang j ON (j.id_jenjang=p.jenjang_prodi)
			INNER JOIN semester ON (semester.id_semester=st.id_semester)
			INNER JOIN jenis_semester ON (semester.id_jenis_semester=jenis_semester.id_jenis_semester)
			INNER JOIN tahun_akademik ON (semester.id_tahun_akademik=tahun_akademik.id_tahun_akademik)
			ORDER BY st.tgl_generate DESC";
			$stmt = $this->db->prepare($query);
			$stmt->execute();			
			$row=$stmt->fetchAll();	
			return $row;
		}catch(PDOException $e){

			echo $e->getMessage();
			return false;

		}
	}

	public function getsettingtagihan($id_prodi,$id_angkatan,$id_semester){
		try{

			if(!empty($id_angkatan) && !empty($id_semester)){
			$query = "SELECT  st.*, k.nama_kategori_pembayaran, nama_prodi, nama_jenjang, nama_jenis_semester, tahun_akademik,
			(SELECT s.tahun_akademik FROM tahun_akademik s WHERE s.id_tahun_akademik=st.id_angkatan) AS tahun_angkatan
			FROM pembayaran_setting_tagihan st
			INNER JOIN pembayaran_kategori k ON (k.id_kategori_pembayaran=st.id_kategori_pembayaran)
			INNER JOIN prodi p ON (st.id_prodi=p.id_prodi)
			INNER JOIN master_jenjang j ON (j.id_jenjang=p.jenjang_prodi)
			INNER JOIN semester ON (semester.id_semester=st.id_semester)
			INNER JOIN jenis_semester ON (semester.id_jenis_semester=jenis_semester.id_jenis_semester)
			INNER JOIN tahun_akademik ON (semester.id_tahun_akademik=tahun_akademik.id_tahun_akademik)
			where st.id_prodi=:id_prodi
			and st.id_angkatan=:id_angkatan
			and st.id_semester=:id_semester
			order by st.tgl_generate DESC";
			$stmt = $this->db->prepare($query);
			$stmt->bindparam(":id_prodi",$id_prodi);
			$stmt->bindparam(":id_angkatan",$id_angkatan);
			$stmt->bindparam(":id_semester",$id_semester);

			}else if(!empty($id_angkatan) && empty($id_semester)){
			$query = "SELECT  st.*, k.nama_kategori_pembayaran, nama_prodi, nama_jenjang, nama_jenis_semester, tahun_akademik,
			(SELECT s.tahun_akademik FROM tahun_akademik s WHERE s.id_tahun_akademik=st.id_angkatan) AS tahun_angkatan
			FROM pembayaran_setting_tagihan st
			INNER JOIN pembayaran_kategori k ON (k.id_kategori_pembayaran=st.id_kategori_pembayaran)
			INNER JOIN prodi p ON (st.id_prodi=p.id_prodi)
			INNER JOIN master_jenjang j ON (j.id_jenjang=p.jenjang_prodi)
			INNER JOIN semester ON (semester.id_semester=st.id_semester)
			INNER JOIN jenis_semester ON (semester.id_jenis_semester=jenis_semester.id_jenis_semester)
			INNER JOIN tahun_akademik ON (semester.id_tahun_akademik=tahun_akademik.id_tahun_akademik)
			where st.id_prodi=:id_prodi
			and st.id_angkatan=:id_angkatan
			order by st.tgl_generate DESC";
			$stmt = $this->db->prepare($query);
			$stmt->bindparam(":id_prodi",$id_prodi);
			$stmt->bindparam(":id_angkatan",$id_angkatan);

			}else if(empty($id_angkatan) && !empty($id_semester)){
			$query = "SELECT  st.*, k.nama_kategori_pembayaran, nama_prodi, nama_jenjang, nama_jenis_semester, tahun_akademik,
			(SELECT s.tahun_akademik FROM tahun_akademik s WHERE s.id_tahun_akademik=st.id_angkatan) AS tahun_angkatan
			FROM pembayaran_setting_tagihan st
			INNER JOIN pembayaran_kategori k ON (k.id_kategori_pembayaran=st.id_kategori_pembayaran)
			INNER JOIN prodi p ON (st.id_prodi=p.id_prodi)
			INNER JOIN master_jenjang j ON (j.id_jenjang=p.jenjang_prodi)
			INNER JOIN semester ON (semester.id_semester=st.id_semester)
			INNER JOIN jenis_semester ON (semester.id_jenis_semester=jenis_semester.id_jenis_semester)
			INNER JOIN tahun_akademik ON (semester.id_tahun_akademik=tahun_akademik.id_tahun_akademik)
			where st.id_prodi=:id_prodi
			and st.id_semester=:id_semester
			order by st.tgl_generate DESC";
			$stmt = $this->db->prepare($query);
			$stmt->bindparam(":id_prodi",$id_prodi);
			$stmt->bindparam(":id_semester",$id_semester);
			}else{
			$query = "SELECT  st.*, k.nama_kategori_pembayaran, nama_prodi, nama_jenjang, nama_jenis_semester, tahun_akademik,
			(SELECT s.tahun_akademik FROM tahun_akademik s WHERE s.id_tahun_akademik=st.id_angkatan) AS tahun_angkatan
			FROM pembayaran_setting_tagihan st
			INNER JOIN pembayaran_kategori k ON (k.id_kategori_pembayaran=st.id_kategori_pembayaran)
			INNER JOIN prodi p ON (st.id_prodi=p.id_prodi)
			INNER JOIN master_jenjang j ON (j.id_jenjang=p.jenjang_prodi)
			INNER JOIN semester ON (semester.id_semester=st.id_semester)
			INNER JOIN jenis_semester ON (semester.id_jenis_semester=jenis_semester.id_jenis_semester)
			INNER JOIN tahun_akademik ON (semester.id_tahun_akademik=tahun_akademik.id_tahun_akademik)
			where st.id_prodi=:id_prodi
			order by st.tgl_generate DESC";
			$stmt = $this->db->prepare($query);
			$stmt->bindparam(":id_prodi",$id_prodi);
			}

			$stmt->execute();			
			$row=$stmt->fetchAll();	
			return $row;
		}catch(PDOException $e){

			echo $e->getMessage();
			return false;

		}
	}

	


	

	
	public function dataprodi(){
		
		try{
		$stmt = $this->db->prepare("SELECT p.id_prodi, p.nama_prodi, m.nama_jenjang 
			FROM prodi p
			inner join master_jenjang m
			on (p.jenjang_prodi=m.id_jenjang)");
		$stmt->execute();			
		$row  =$stmt->fetchAll();	
		return $row;

		}catch(PDOException $e){

			echo $e->getMessage();
			return false;

		}

	}

	public function datasemester(){
		
		try{

			$query = "SELECT nama_jenis_semester, tahun_akademik, semester.id_semester
			FROM semester
			INNER JOIN jenis_semester ON (semester.id_jenis_semester=jenis_semester.id_jenis_semester)
			INNER JOIN tahun_akademik ON (semester.id_tahun_akademik=tahun_akademik.id_tahun_akademik)
			order by semester.id_semester DESC";
		$stmt = $this->db->prepare($query);
		$stmt->execute();			
		$row  =$stmt->fetchAll();	
		return $row;

		}catch(PDOException $e){

			echo $e->getMessage();
			return false;

		}

	}

	public function dataangkatan(){
		
		try{
		$stmt = $this->db->prepare("SELECT * FROM tahun_akademik order by id_tahun_akademik DESC");
		$stmt->execute();			
		$row  =$stmt->fetchAll();	
		return $row;

		}catch(PDOException $e){

			echo $e->getMessage();
			return false;

		}

	}

	
}

?>
