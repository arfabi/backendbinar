<?php

class crud
{
	private $db;
	
	function __construct($DB_con)
	{
		$this->db = $DB_con;
	}


	public function databank(){
		try{
			$query = "select * from master_bank";
			$stmt = $this->db->prepare($query);
			$stmt->execute();			
			$row=$stmt->fetchAll();	
			return $row;
		}catch(PDOException $e){

			echo $e->getMessage();
			return false;

		}
	}



	public function cekstatuskonfirmasi($id_transaksi){
		try{

			$query = "SELECT status_konfirm FROM pembayaran_transaksi WHERE id_transaksi=:id";
			$stmt = $this->db->prepare($query);
			$stmt->bindparam(":id",$id_transaksi);			
			$stmt->execute();			
			$row=$stmt->fetch();	
			return $row['status_konfirm'];
		}catch(PDOException $e){
			echo $e->getMessage();
			return false;
		}
		
	}


	public function cekkekurangan($id_tagihan){
		try{

			$query = "SELECT kekurangan FROM pembayaran_tagihan WHERE id_tagihan=:id";
			$stmt = $this->db->prepare($query);
			$stmt->bindparam(":id",$id_tagihan);			
			$stmt->execute();			
			$row=$stmt->fetch();
			$row=$row['kekurangan'];
		
			return $row;

		}catch(PDOException $e){
			echo $e->getMessage();
			return false;
		}
		
	}

	public function total_pembayaran($id_tagihan){
		try{

			$query = "SELECT total_pembayaran FROM pembayaran_tagihan WHERE id_tagihan=:id";
			$stmt = $this->db->prepare($query);
			$stmt->bindparam(":id",$id_tagihan);			
			$stmt->execute();			
			$row=$stmt->fetch();	
			return $row['total_pembayaran'];
		}catch(PDOException $e){
			echo $e->getMessage();
			return false;
		}
	}

	public function updatekonfirm($id_transaksi, $jenis_pembayaran, $tgl_transfer, $bank_pengirim, $jumlah_bayar,$nama_pengirim,$newname,$status_konfirm){

		try
		{

			$stmt = $this->db->prepare("UPDATE pembayaran_transaksi SET jenis_pembayaran=:jenis_pembayaran, nama_pengirim=:nama_pengirim, tgl_transfer=:tgl_transfer,
			id_bank_pengirim=:id_bank_pengirim, jumlah_bayar=:jumlah_bayar, gambar_bukti=:gambar_bukti, status_konfirm=:status_konfirm
			WHERE id_transaksi=:id_transaksi");

			$stmt->bindparam(":id_transaksi",$id_transaksi);
			$stmt->bindparam(":nama_pengirim",$nama_pengirim);
			$stmt->bindparam(":tgl_transfer",$tgl_transfer);
			$stmt->bindparam(":id_bank_pengirim",$bank_pengirim);
			$stmt->bindparam(":jumlah_bayar",$jumlah_bayar);
			$stmt->bindparam(":jenis_pembayaran",$jenis_pembayaran);
			$stmt->bindparam(":gambar_bukti",$newname);
			$stmt->bindparam(":status_konfirm",$status_konfirm);
			$stmt->execute();
			return true;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();	
			return false;
		}
	}




	public function updatetagihan($id_tagihan,$status_tagihan,$kekurangan){
		try{

			$query = "UPDATE pembayaran_tagihan SET kekurangan=:kekurangan, status_tagihan=:status_tagihan
			WHERE id_tagihan=:id";
			$stmt = $this->db->prepare($query);
			$stmt->bindparam(":id",$id_tagihan);	
			$stmt->bindparam(":status_tagihan",$status_tagihan);		
			$stmt->bindparam(":kekurangan",$kekurangan);				
			$stmt->execute();		
			return true;
		}catch(PDOException $e){
			echo $e->getMessage();
			return false;
		}
	}


	public function updatekonfirmtanpagambar($id_transaksi, $jenis_pembayaran, $tgl_transfer, $bank_pengirim, $jumlah_bayar,$nama_pengirim,$status_konfirm){

		try
		{

			$stmt = $this->db->prepare("UPDATE pembayaran_transaksi SET jenis_pembayaran=:jenis_pembayaran, nama_pengirim=:nama_pengirim, tgl_transfer=:tgl_transfer,
			id_bank_pengirim=:id_bank_pengirim, jumlah_bayar=:jumlah_bayar, status_konfirm=:status_konfirm
			WHERE id_transaksi=:id_transaksi");

			$stmt->bindparam(":id_transaksi",$id_transaksi);
			$stmt->bindparam(":nama_pengirim",$nama_pengirim);
			$stmt->bindparam(":tgl_transfer",$tgl_transfer);
			$stmt->bindparam(":id_bank_pengirim",$bank_pengirim);
			$stmt->bindparam(":jumlah_bayar",$jumlah_bayar);
			$stmt->bindparam(":jenis_pembayaran",$jenis_pembayaran);
			$stmt->bindparam(":status_konfirm",$status_konfirm);
			$stmt->execute();
			return true;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();	
			return false;
		}
	}



	public function cekjumbayar($id_transaksi){
		try{

			$query = "SELECT jumlah_bayar FROM pembayaran_transaksi WHERE id_transaksi=:id";
			$stmt = $this->db->prepare($query);
			$stmt->bindparam(":id",$id_transaksi);			
			$stmt->execute();			
			$row=$stmt->fetch();
			$row=$row['jumlah_bayar'];		
			return $row;

		}catch(PDOException $e){
			echo $e->getMessage();
			return false;
		}
		
	}


	

	public function detailkonfirmasi($id){
		try{
			$query = "SELECT tr.*, m.id_mahasiswa,m.nama_lengkap, nama_prodi, b.nama_bank, nama_jenjang, 
			k.nama_kategori_pembayaran, jenis_semester.nama_jenis_semester, tahun_akademik.tahun_akademik
			FROM pembayaran_transaksi tr
			INNER JOIN pembayaran_tagihan t ON (tr.id_tagihan=t.id_tagihan)
			LEFT JOIN mahasiswa m ON (m.id_mahasiswa=t.id_mahasiswa)
			LEFT JOIN prodi p ON (m.id_prodi=p.id_prodi)
			LEFT JOIN master_jenjang j ON (j.id_jenjang=p.jenjang_prodi)
			LEFT JOIN pembayaran_kategori k ON (t.id_kategori_pembayaran=k.id_kategori_pembayaran)
			LEFT JOIN master_bank b ON (b.id_bank=tr.id_bank_pengirim)
			LEFT JOIN semester ON (semester.id_semester=t.id_semester)
			LEFT JOIN jenis_semester ON (semester.id_jenis_semester=jenis_semester.id_jenis_semester)
			LEFT JOIN tahun_akademik ON (semester.id_tahun_akademik=tahun_akademik.id_tahun_akademik)
			WHERE tr.id_transaksi=:id";
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



	public function detailpembayaran($id){
		try{
			$query = "SELECT tr.*, m.id_mahasiswa,m.nama_lengkap, nama_prodi, nama_jenjang, 
			k.nama_kategori_pembayaran, jenis_semester.nama_jenis_semester, tahun_akademik.tahun_akademik
			FROM pembayaran_transaksi tr
			INNER JOIN pembayaran_tagihan t ON (tr.id_tagihan=t.id_tagihan)
			LEFT JOIN mahasiswa m ON (m.id_mahasiswa=t.id_mahasiswa)
			LEFT JOIN prodi p ON (m.id_prodi=p.id_prodi)
			LEFT JOIN master_jenjang j ON (j.id_jenjang=p.jenjang_prodi)
			LEFT JOIN pembayaran_kategori k ON (t.id_kategori_pembayaran=k.id_kategori_pembayaran)
			LEFT JOIN semester ON (semester.id_semester=t.id_semester)
			LEFT JOIN jenis_semester ON (semester.id_jenis_semester=jenis_semester.id_jenis_semester)
			LEFT JOIN tahun_akademik ON (semester.id_tahun_akademik=tahun_akademik.id_tahun_akademik)
			WHERE tr.id_transaksi=:id";
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


	public function datatransaksi($no_trans,$nim){
		try{

			if(empty($no_trans) && !empty($nim)){
				$query = "SELECT t.*, k.nama_kategori_pembayaran, jenis_semester.nama_jenis_semester, tahun_akademik.tahun_akademik
			FROM pembayaran_transaksi t
			INNER JOIN pembayaran_tagihan tg ON (tg.id_tagihan=t.id_tagihan)
			INNER JOIN mahasiswa m ON (m.id_mahasiswa=tg.id_mahasiswa)
			INNER JOIN pembayaran_kategori k ON (tg.id_kategori_pembayaran=k.id_kategori_pembayaran)
			INNER JOIN semester ON (semester.id_semester=tg.id_semester)
			INNER JOIN jenis_semester ON (semester.id_jenis_semester=jenis_semester.id_jenis_semester)
			INNER JOIN tahun_akademik ON (semester.id_tahun_akademik=tahun_akademik.id_tahun_akademik)
			WHERE m.nim = '$nim'";
			}else if(!empty($no_trans) && empty($nim)){
			$query = "SELECT t.*, k.nama_kategori_pembayaran, jenis_semester.nama_jenis_semester, tahun_akademik.tahun_akademik
			FROM pembayaran_transaksi t
			INNER JOIN pembayaran_tagihan tg ON (tg.id_tagihan=t.id_tagihan)
			INNER JOIN mahasiswa m ON (m.id_mahasiswa=tg.id_mahasiswa)
			INNER JOIN pembayaran_kategori k ON (tg.id_kategori_pembayaran=k.id_kategori_pembayaran)
			INNER JOIN semester ON (semester.id_semester=tg.id_semester)
			INNER JOIN jenis_semester ON (semester.id_jenis_semester=jenis_semester.id_jenis_semester)
			INNER JOIN tahun_akademik ON (semester.id_tahun_akademik=tahun_akademik.id_tahun_akademik)
			WHERE t.no_transaksi='$no_trans'";
			 }else {			 
			$query = "SELECT t.*, k.nama_kategori_pembayaran, jenis_semester.nama_jenis_semester, tahun_akademik.tahun_akademik
			FROM pembayaran_transaksi t
			INNER JOIN pembayaran_tagihan tg ON (tg.id_tagihan=t.id_tagihan)
			INNER JOIN mahasiswa m ON (m.id_mahasiswa=tg.id_mahasiswa)
			INNER JOIN pembayaran_kategori k ON (tg.id_kategori_pembayaran=k.id_kategori_pembayaran)
			INNER JOIN semester ON (semester.id_semester=tg.id_semester)
			INNER JOIN jenis_semester ON (semester.id_jenis_semester=jenis_semester.id_jenis_semester)
			INNER JOIN tahun_akademik ON (semester.id_tahun_akademik=tahun_akademik.id_tahun_akademik)
			WHERE t.no_transaksi='$no_trans' AND m.nim = '$nim'";
			 }

			$stmt = $this->db->prepare($query);
			$stmt->execute();			
			$row=$stmt->fetchAll();	
			return $row;

		}catch(PDOException $e){

			echo $e->getMessage();
			return false;

		}
		
	}
	


	
}

?>
