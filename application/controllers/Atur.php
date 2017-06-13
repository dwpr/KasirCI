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
        $data = array(
        	'title' => 'Beranda',
        	'content' => 'main/content_home',
        	'stokbuku' => $this->MBuku->getWhere('buku','stock<=5')->result(),
        	);
        $this->parser->parse('template',$data);
	}

	public function login(){
		//khususon gan
        $this->load->view('login');
	}

    public function logout(){
        $this->session->sess_destroy();
        redirect('atur');
    }

	public function proseslogin(){
		//form  validationnya gan
		$this->form_validation->set_error_delimiters('<div class="error alert alert-danger">', '</div>');
		$this->form_validation->set_rules('username','Username','required',array(
																			'required'=>'Username tidak boleh kosong gan'));
		$this->form_validation->set_rules('password','Password','required|min_length[2]',array(
																			'required'=>'Password tidak boleh kosong gan',
																			'min_length'=>'Password minimal 2 char gan'));

		if($this->form_validation->run()==false){
			//jika tidak sesuai yang diminta muncul validasinya
			$this->login(); ///script ini lemah tidak seperti redirect menurut saya
			//redirect('atur/login');
		}else{
			//jika benar valid dicek dulu seperti security dan kesesuaian di dbnya, jika tidak sesuai redirect login
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
    }

	public function buku(){
        if(! $this->session->userdata('validated')){
            redirect('atur/login');
        }
		//bagian buku belum ada validasinya karena saya bingung ngevalidasi form via ajax jquery
		//data parser cek dibagian else terakhir
		$data = array(
			'title' => 'Inventori Buku',
			'buku' => $this->MBuku->getAll('buku')->result(),
			'content' => 'main/addbook',
			);

		//for sub menu only gan
		$ke=$this->uri->segment(3); //sub menu atau function dari buku (cek url untuk lebih jelasnya)
        $code = $this->uri->segment(4); //sub juga tapi digunakan untuk beberapa data param non ajax
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
                //redirect('atur/buku','refresh');//harus modal biar ajaxnya tidak error
                redirect('atur/buku');//ndak jadi direfresh, silahkan refresh manual saja karena emang kadang error :v
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
            redirect('atur/buku');//refresh agar urlnya tidak kelihatan arraynya tapi kalau direfresh session setflashdatanya terhapus
    	}else if($ke=="getbukubyid"){
			$datanya = $this->MBuku->get_by_id($code);
			$datanya2 = $datanya->row();
    		//data must via model if use json
			echo json_encode($datanya2);
    	}else{
    		$this->parser->parse('template',$data);
		} 
	}

	public function kasir(){
        if(! $this->session->userdata('validated')){
            redirect('atur/login');
        }
		//data parser cek dibagian else terakhir
		$data = array(
			'title' => 'Kasir Toko Buku',
			'cari' => $this->MBuku->getAll('buku')->result(),
			'content' => 'main/kasir',
			);
    		$this->parser->parse('template',$data); 	
	}

	public function cekvalid(){
		$this->form_validation->set_rules('bayaruang', 'tesasdas', 'trim|required|decimal]');

		if($this->form_validation->run() == FALSE)
		{
			$this->kasir();
		}
		else
		{
			$this->kasir();
		}
	}

	public function keranjang(){
        if(! $this->session->userdata('validated')){
            redirect('atur/login');
        }
		$data = array(
			'kdbuku' => $this->input->post('bookcode')
			);
		$get = $this->MBuku->getWhere('buku',$data);
		$jml = $get->num_rows();

		if(empty($this->input->post('quantity'))){
			$jumlah = 1;
		}else{
			$jumlah = $this->input->post('quantity');
		}

	        if($jml == 0){
	        	echo "<script>
	        	alert('Id barang yang dimasukan tidak ada!');
	        	</script>";
	        }else{
	        	foreach ($get->result() as $row) {
					$data = array(
						'id'      => $row->kdbuku,
						'qty'     => $jumlah,
						'price'   => $row->harga,
						'name'    => $row->judul
					);
					$this->cart->insert($data);
					break;
				}
			}
	}

	public function daftarkeranjang(){
        if(! $this->session->userdata('validated')){
            redirect('atur/login');
        }
		foreach ($this->cart->contents() as $it){
			echo "<tr>";
				echo "<td>".$it['id']."</td>";	 
				echo "<td>".$it['name']."</td>"; 
				echo "<td>".$it['qty']."</td>";
				echo "<td>".$it['price']."</td>";
				$total = $it['price']*$it['qty'];
				echo "<td>".$total."</td>";
				echo "<td>Hapus</td>";			
			echo "</tr>";
		}
	}

	public function deleteCart($id){
        if(! $this->session->userdata('validated')){
            redirect('atur/login');
        }
		$this->cart->remove($id);
		redirect('atur/buku','refresh'); 
	}

	public function deleteAllCart(){
        if(! $this->session->userdata('validated')){
            redirect('atur/login');
        }
        $this->cart->destroy();
        $this->session->set_flashdata("pesan", "<div style='font-size:12px;' class='alert alert-danger'> 
	                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Semua data pembelian berhasil dihapus       
	                                </div>");
        redirect('atur/kasir','refresh');		
	}

	public function transaksi(){
		if(! $this->session->userdata('validated')){
            redirect('atur/login');
        }
        $data = array(
        	'title' => 'Transaksi',
        	'content' => 'main/transaksi',
        	'transaksi' => $this->MBuku->getAll('transaksi')->result(),
        	);
        $this->parser->parse('template',$data);
	}

	public function addtransaksi(){
        if(! $this->session->userdata('validated')){
            redirect('atur/login');
        }
        $param = array(
        	'tgl'=>date('Y/m/d'),
        	'operator'=>$this->input->get('operator'),
        	'uang'=>$this->input->get('uang')
        	);

	        $cek  = $this->MBuku->getAll('transaksi');
	        $cek2  = $cek->num_rows();   
	        if($cek2<=0) {
	        	$this->MBuku->AlterIncrement('transaksi','1');//di reset auto increment id-nya	        	
	        	$this->MBuku->insertDataDB('transaksi',$param);
	        	
	        	 //belum berfungsi
	        	foreach ($this->cart->contents() as $value) {
		        	$stockbeli = $value['qty'];
		        	$stocksaatini = $this->MBuku->getWhere('buku','kdbuku='.$value['id'])->row();
		        	$stocksaatini2 =  $stocksaatini->stock;
		        	$data = array(
		        		"stock" => $stocksaatini2-$stockbeli
		        		);
		        	$this->MBuku->bukuupdate(array('kdbuku' => $value['id]']), $data);
	        	}
	        }else{
	        	$this->MBuku->insertDataDB('transaksi',$param);
	        }

        redirect('atur/kasir');
	}


    public function doprint($pdf=false)
    {  
            $this->gen_pdf();  
            $this->deleteAllCart();             
    }

	private function gen_pdf()
    {
    	$this->load->library('cfpdf');
        $pdf=new FPDF('P','mm','A4');
        $pdf->AddPage();
        $pdf->SetFont('Arial','B','L');
        $pdf->SetFontSize(14);
        $pdf->Text(10, 10, 'DAFTAR BELANJAAN ANDA');
        $pdf->Text(10,15,'Toko : Toko Buku ABC');
        $pdf->Image("assets/img/abc_bookshop.PNG",135,-8,40,40);
        $pdf->SetFont('Arial','B','L');
        $pdf->SetFontSize(10);
        $pdf->Cell(10, 10,'','',1);
        $pdf->Cell(10, 7, 'No', 1,0);
        $pdf->Cell(80, 7, 'Buku', 1,0);
        $pdf->Cell(30, 7, 'Jumlah', 1,0);
        $pdf->Cell(38, 7, 'Total Transaksi', 1,1);
        // tampilkan dari database
        $pdf->SetFont('Arial','','L');
        //$data=  $this->MBuku->getviaQuery('select * from bla bla');
        $no=1;
        $total=0;
        $total2=0;
        foreach ($this->cart->contents() as $r)
        {

            $pdf->Cell(10, 7, $no, 1,0);
            $pdf->Cell(80, 7, $r['name'] , 1,0);
            $pdf->Cell(30, 7, $r['qty'] , 1,0,'C');
            $pdf->Cell(38, 7, uangRP($r['price']) , 1,1);
            $no++;
            $total=$total+$r['price'];
            $total2=$total2+$r['qty'];
        }
        // end
        $pdf->Cell(90,7,'Total',1,0,'L');
        $pdf->Cell(30,7,$total2,1,0,'C');
        $pdf->Cell(38,7,uangRP($total),1,0);
        $pdf->Output();
    } 

}