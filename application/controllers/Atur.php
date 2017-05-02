<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Atur extends CI_Controller{

	function __construct() {
        parent::__construct();
    }


	public function Index(){
        if(! $this->session->userdata('validated')){
            redirect('atur/login');
        }
		$this->load->view('header');
		$this->load->view('content_home');
		$this->load->view('footer');		
	}

	public function login(){
        $this->load->view('login');
	}

    public function logout(){
        $this->session->sess_destroy();
        redirect('atur');
    }

	public function proseslogin(){
        $u = $this->security->xss_clean($this->input->post('username'));
        $p = md5($this->security->xss_clean($this->input->post('password')));
        $dtlogin = array(
        	'username' => $u,
        	'password' => $p, 
        	);
         
        $q_cek  = $this->MBuku->getWhere('user',$dtlogin);
        $j_cek  = $q_cek->num_rows();
        $d_cek  = $q_cek->row();        
        
        if($j_cek == 1) {
            $data = array(
                    'nama' => $d_cek->nama,
                    'level' => $d_cek->lv,
                    'validated' => true
                    );
            $this->session->set_userdata($data);
            redirect('atur');
        } else {    
            $this->session->set_flashdata("k", "<div style='font-size:12px;' class='alert alert-danger'> 
                                    Username / Password anda salah        
                                </div>");
            redirect('atur/login');
        }
    }

	public function buku(){
		$data['buku'] = $this->MBuku->getAll('buku')->result();
		$ke=$this->uri->segment(3);
        $code = $this->uri->segment(4);
		if($ke=="tambah"){
			$data = array(
				'kdbuku' => $this->input->post('kdbuku'),
				'judul' => $this->input->post('judul'),
				'pengarang' => $this->input->post('pengarang'),
				'harga' => $this->input->post('harga'),
				'stock' => $this->input->post('stock'),
				);
				$this->MBuku->insertData($data);
                $this->session->set_flashdata("k", "<div class=\"alert alert-success\">Buku berhasil ditambahkan</div>");
                redirect('atur/buku','refresh');//harus modal biar ajaxnya tidak error
        }else if($ke=="delete"){
        	$this->MBuku->deleteData($code,'kdbuku','buku');
            $this->session->set_flashdata("k", "<div class=\"alert alert-danger\">Buku berhasil dihapus</div>");
            redirect('atur/buku');
    	}else if($ke=="edit"){
    		$data = array(
				'kdbuku' => $this->input->post('kdbuku'),
				'judul' => $this->input->post('judul'),
				'pengarang' => $this->input->post('pengarang'),
				'harga' => $this->input->post('harga'),
				'stock' => $this->input->post('stock'),
			);
			$this->MBuku->bukuupdate(array('kdbuku' => $this->input->post('idedit')), $data);
			echo json_encode(array("status" => TRUE));//jika dihilangkan error tapi muncul session flashdatanya
            $this->session->set_flashdata("k", "<div class=\"alert alert-success\">Buku berhasil diedit</div>");
            redirect('atur/buku');//refresh agar urlnya tidak kelihatan arraynya tapi kalau direfresh sessionnya terhapus
    	}else if($ke=="getbukubyid"){
			$datanya = $this->MBuku->get_by_id($code);
			$datanya2 = $datanya->row();
    		//$datanya = $this->db->query("SELECT from buku where kdbuku='$code'")->result();
    		//data must via model if use json
			echo json_encode($datanya2);
    	}else{
			$this->load->view('header');
			$this->load->view('addbook',$data);
			$this->load->view('footer');   
		} 
	}

	public function kasir(){
		$data['cari'] = $this->db->query("SELECT * from buku")->result();
			$this->load->view('header');
			$this->load->view('kasir',$data);
			$this->load->view('footer'); 	
	}

	public function keranjang2(){
		$kodeid = $this->input->get('bookcode');
		$qtyy = $this->input->post('quantity');
		$get = $this->MBuku->get_by_id($kodeid)->row();
			$kd1 = $get->kdbuku;
			$kd2 = $get->judul;
			$kd3 = $get->harga;
		$data = array(
			'kodebuku'      => $kd1,
			'judul' => $kd2,
			'qty'     => $qtyy,
			'harga'   => $kd3);
		$this->cart->insert($data);
		header('location:'.base_url('atur/kasir').'');
	}

	public function keranjang(){
		$kodeid = $this->input->get('bookcode');
		$get = $this->MBuku->get_by_id($kodeid);
		$jml = $get->num_rows();
		$tambah = TRUE;

			foreach ($this->cart->contents() as $items){
				$kode = $kodeid;
				  if($items['id'] == $kode){
				  	$total = $items['qty'] + 1;
				  	$data = array(
						'rowid'   => $items['rowid'],
						'qty'     => $total
					);

					$this->cart->update($data);
					$tambah = FALSE;
					break;
				  }
			}

		$jumlahnya = $this->input->post('quantity');

			if($tambah){
		        if($jml == 0){
		        	/*
		        	echo "<script>
		        	alert('Id barang yang dimasukan tidak ada!');
		        	</script>";
		        	*/
		        }else{
			//$jumlahnya = $this->input->post('quantity');
		        	foreach ($get->result() as $row) {
						$data = array(
							'kdbuku'      => $row->kdbuku,
							'qty'     => $jumlahnya,
							'harga'   => $row->harga,
							'judul'    => $row->judul
						);
						$this->cart->insert($data);
						break;
					}
				}
			}
	}

	public function daftarkeranjang(){
		foreach ($this->cart->contents() as $items){
			echo "<tr>";
				echo "<td>".$items['kodebuku']."</td>";	 
				echo "<td>".$items['judul']."</td>"; 
				echo "<td>".$items['qty']."</td>";
				echo "<td>".$items['harga']."</td>";
				$total = $items['harga']*$items['qty'];
				echo "<td>".$total."</td>";
				echo "<td>Hapus</td>";			
			echo "</tr>";
		}
	}

	public function databuku(){
		$kode = $this->input->post('kdbk');
		$tampil = $this->db->query("SELECT * from buku where kdbuku='$kode'")->result();
		foreach ($tampil as $d) {
			echo "<td>Judul </td>";
			echo "<td>".$d->judul."</td>";
			echo "<td>Harga</td>";
			echo "<td>".$d->harga."</td>";
		}
	}

	public function keranjan(){
		//$data = array('kdbuku' => $this->input->post('kodebukugan'),'jumlah' => $this->input->post('jumlahbukugan'),);
		//$data2 = $this->db->query("SELECT * from buku where kdbuku='$data->kode'")->result();
		//$byr = Bayar($jum,$data2->harga);
		//$this->db->query("INSERT INTO pembelian VALUES($data->kode,$data2->judul,$data->jum,$data2->harga,NOW(),'1')");

		/*
		$jum = $this->input->post('kdbuku');
		$kd = $this->input->post('jumlah');
		$this->db->query("INSERT into pembelian2 VALUES($kd,$jum)");
		echo json_encode(array("status" => TRUE));
		*/

		$jum = $this->input->post('kdbuku');
		$kd = $this->input->post('jumlah');		
		$tampil = $this->db->query("SELECT * from buku where kdbuku='$kd'")->result();
		foreach ($tampil as $t) {
			echo "<tr>";
			echo "<td>".$d->kdbuku."</td>";
			echo "<td>".$d->judul."</td>";
			echo "<td>".$jum."</td>";
			echo "<td>".$d->harga."</td>";
			$bayar = $d->harga*$jum;
			echo "<td>".$bayar."</td>";
			echo "</tr>";
		}

	}
}