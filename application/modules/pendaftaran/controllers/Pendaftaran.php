<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendaftaran extends MX_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('M_pendaftaran', 'M_daftar');

	}

	public function daftar($kode){
		$tabel	= 'pendaftaran_kegiatan';

		if ($this->General->get_kegiatan($kode) != false) {
			if ($this->General->get_formMeta($kode) != false) {
				if ($this->M_daftar->cek_dataPeserta($kode, $this->session->userdata('kode_user'), $tabel) == false) {
					$data['kegiatan']		= $this->General->get_kegiatan($kode);
					$data['formulir']		= $this->General->get_formMeta($kode);
					$data['KODE_KEGIATAN']	= $kode;

					$data['CI']			= $this;

					$data['module'] 	= "pendaftaran";
					$data['fileview'] 	= "pendaftaran";
					echo Modules::run('template/frontend_main', $data);
				}else{
					$this->session->set_flashdata('warning', "Anda telah mendaftarkan diri pada kegiatan ini !!");
					redirect(site_url('kegiatan/'.$this->M_daftar->cek_dataPeserta($kode, $this->session->userdata('kode_user'))->KODE));
				}
			}else{
				$this->session->set_flashdata('error', "Tidak dapat menemukan formulir kegiatan tersebut !!");
				redirect($this->agent->referrer());
			}
		}else{
			$this->session->set_flashdata('error', "Tidak dapat menemukan kegiatan tersebut !!");
			redirect($this->agent->referrer());
		}
	}

	public function daftar_kompetisi(){
		$kode 	= 'lokreatif';
		$tabel	= 'pendaftaran_kompetisi';
		if ($this->General->cek_pendaftaranStatus() != false) {
			if ($this->General->get_bidangLomba() != false) {
				if ($this->General->get_formMeta($kode) != false) {
					if ($this->M_daftar->cek_dataPesertaKompetisi($this->session->userdata('kode_user'), $tabel) == false) {
						$data['kegiatan']		= $this->General->get_kegiatan($kode);
						$data['formulir']		= $this->General->get_formMeta($kode);
						$data['bidang_lomba']	= $this->General->get_bidangLomba();
						$data['pts']			= $this->General->get_pts();

						$data['KODE_KEGIATAN']	= $kode;

						$data['CI']			= $this;

						$data['module'] 	= "pendaftaran";
						$data['fileview'] 	= "pendaftaran_kompetisi";
						echo Modules::run('template/frontend_main', $data);
					}else{
						$this->session->set_flashdata('warning', "Anda telah mendaftarkan diri pada kompetisi ini !!");
						redirect(base_url());
					}
				}else{
					$this->session->set_flashdata('error', "Mohon maaf formulir pendaftaran sedang diatur, harap tunggu beberapa saat !!");
					redirect($this->agent->referrer());
				}
			}else{
				$this->session->set_flashdata('error', "Mohon maaf bekum ada bidang lomba yang dibuka, harap tunggu beberapa saat !!");
				redirect($this->agent->referrer());
			}
		}else{
			$this->session->set_flashdata('error', "Pendaftaran belum dibuka !!");
			redirect($this->agent->referrer());
		}
	}

	function prosesPendaftaran($kegiatan){

		if ($kegiatan == "kegiatan") {
			$tabel = "pendaftaran_kegiatan";
		}else{
			$tabel = "pendaftaran_kompetisi";
		}

		$uniqid		= substr(md5(strtolower($this->session->userdata('kode_user'))), 0, 4);
		$time 		= substr(md5(time()), 0, 6);

		do {
			$KODE_PENDAFTARAN      = "{$uniqid}-{$time}";
		} while ($this->M_daftar->cek_kodeDaftar($KODE_PENDAFTARAN) > 0);

		// STATIC FORM DEFAULT
		$KODE_KOMPETISI		= $this->input->post('KODE_KOMPETISI');
		$KODE_KEGIATAN		= $this->input->post('KODE_KEGIATAN');
		$ID_TIKET			= $this->input->post('ID_TIKET');
		$BIDANG_LOMBA		= $this->input->post('BIDANG_LOMBA');
		$NAMA_TIM			= $this->input->post('NAMA_TIM');

		// PTS
		$PT					= $this->input->post('ASAL_PTS');
		$PT 	    		= explode("-", $PT);
		$ASAL_PTS			= $PT[0];
		$ALAMAT_PTS			= $this->input->post('ALAMAT_PTS');

		// DYNAMIC FORM SECONDARY
		$ID_FORM			= $this->input->post('ID_FORM', true);
		$ID_FORM_FILE		= $this->input->post('ID_FORM_FILE', true);
		$TYPE				= $this->input->post('TYPE', true);
		$JAWABAN			= $this->input->post('JAWABAN');
		$FILE_SIZE			= $this->input->post('FILE_SIZE', true);
		$FILE_TYPE			= $this->input->post('FILE_TYPE', true);

		if ($kegiatan == "kegiatan") {
			$daftar = array(
				'KODE_PENDAFTARAN' 	=> $KODE_PENDAFTARAN, 
				'KODE_KEGIATAN'		=> $KODE_KEGIATAN, 
				'KODE_USER' 		=> $this->session->userdata('kode_user'), 
				'ID_TIKET' 			=> $ID_TIKET
			);
		}else{
			$daftar = array(
				'KODE_PENDAFTARAN' 	=> $KODE_PENDAFTARAN, 
				'KODE_USER' 		=> $this->session->userdata('kode_user'), 
				'BIDANG_LOMBA' 		=> $BIDANG_LOMBA,
				'NAMA_TIM' 			=> $NAMA_TIM,
				'ASAL_PTS' 			=> $ASAL_PTS,
				'ALAMAT_PTS' 		=> $ALAMAT_PTS
			);
		}

		if ($this->M_daftar->insert_pendaftaran($daftar, $tabel) == true) {

			$prosesJawaban = false;

			$cpt = count($_FILES['JAWABAN']['name']);
			for($j=0; $j<$cpt; $j++) {
				if (!empty($_FILES['JAWABAN']['name'])) {
				      // CREATE FILENAME

					$files = $_FILES['JAWABAN'];

					echo var_dump($_FILES['JAWABAN']['name'][$j]);

					$_FILES['BERKAS[]']['name']		= $files['name'][$j];
					$_FILES['BERKAS[]']['type']		= $files['type'][$j];
					$_FILES['BERKAS[]']['tmp_name']	= $files['tmp_name'][$j];
					$_FILES['BERKAS[]']['error']	= $files['error'][$j];
					$_FILES['BERKAS[]']['size']		= $files['size'][$j];

					$time   	= time();
					$KODE_USER  = $this->session->userdata('kode_user');

					$folder   	= "berkas/pendaftaran/{$kegiatan}/{$KODE_KEGIATAN}/{$KODE_USER}/";

					if (!is_dir($folder)) {
						mkdir($folder, 0755, true);
					}

					$config['upload_path']          = $folder;
					$config['allowed_types']        = '*';
					$config['max_size']             = 1000000;
					$config['overwrite']            = true;

					$this->load->library('upload', $config);
					if ($this->upload->do_upload('BERKAS[]')) {
						$upload_data 	= $this->upload->data();

						$data = array(
							'KODE_PENDAFTARAN' 	=> $KODE_PENDAFTARAN, 
							'ID_FORM'			=> isset($ID_FORM_FILE[$j]) ? $ID_FORM_FILE[$j] : null, 
							'JAWABAN' 			=> $upload_data['file_name']
						);
						if ($this->M_daftar->insert_jawaban($data) == false) {
							break;
							// echo "a";
							$this->M_daftar->delete_pendaftaran($KODE_PENDAFTARAN, $tabel);
							$this->session->set_flashdata('error', "Terjadi kesalahan saat mengirim jawaban anda !!");
							redirect($this->agent->referrer());
						}else{
							$prosesJawaban = true;
						}
					}else{
						break;
						// echo "b";
						$this->M_daftar->delete_pendaftaran($KODE_PENDAFTARAN, $tabel);
						$this->session->set_flashdata('error', "Terjadi kesalahan saat mengunggah berkas anda !!");
						redirect($this->agent->referrer());
					}
				}else{
					break;
					// echo "c";
					$this->M_daftar->delete_pendaftaran($KODE_PENDAFTARAN, $tabel);
					$this->session->set_flashdata('error', "Terjadi kesalahan, anda belum memilih berkas !!");
					redirect($this->agent->referrer());
				}
			}
			foreach ($ID_FORM as $i => $a) {
				if ($TYPE[$i] != "FILE") {
					$data = array(
						'KODE_PENDAFTARAN' 	=> $KODE_PENDAFTARAN, 
						'ID_FORM'			=> isset($ID_FORM[$i]) ? $ID_FORM[$i] : null, 
						'JAWABAN' 			=> isset($JAWABAN[$i]) ? $JAWABAN[$i] : null
					);
					if ($this->M_daftar->insert_jawaban($data) == false) {
						break;
						// echo "d";
						$this->M_daftar->delete_pendaftaran($KODE_PENDAFTARAN, $tabel);
						$this->session->set_flashdata('error', "Terjadi kesalahan saat mengirim jawaban anda !!");
						redirect($this->agent->referrer());
					}else{
						// echo "e";
						$prosesJawaban = true;
					}
				}

			}
			if ($prosesJawaban == true) {
				$this->session->set_flashdata('success', "Berhasil mengirim data pendaftaran anda !!");
				if ($kegiatan == "kegiatan") {
					$this->General->log_aktivitas($this->session->userdata('kode_user'), $this->session->userdata('kode_user'), 13);
					redirect(site_url('peserta/kegiatan'));
				}else{
					$this->General->log_aktivitas($this->session->userdata('kode_user'), $this->session->userdata('kode_user'), 14);
					redirect(site_url('peserta/data-pendaftaran'));
				}
			}else{
				$this->M_daftar->delete_pendaftaran($KODE_PENDAFTARAN, $tabel);
				$this->session->set_flashdata('error', "Terjadi kesalahan saat mengirim jawaban anda !!");
				redirect($this->agent->referrer());
			}
		}else{
			$this->M_daftar->delete_pendaftaran($KODE_PENDAFTARAN, $tabel);
			$this->session->set_flashdata('error', "Terjadi kesalahan saat mengirim pendaftaran anda !!");
			redirect($this->agent->referrer());
		}

	}

}?>
