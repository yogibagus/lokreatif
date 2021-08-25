<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// tb_token
// 1. AKTIVASI
// 2. RECOVERY ACCOUNT

// SAVE LOG
// 1. LOGIN
// 2. DAFTAR
// 3. AKTIVASI
// 4. RECOVERY
// 5. PENGAJUAN
// 6. HAPUS AKUN

// RECEIVER GROUP
// 1. PRIVATE
// 2. ADMIN

class Authentication extends MX_Controller {

	private $sender = "System";

	public function __construct(){
		parent::__construct();
		$this->load->model('M_authentication', 'M_auth');
        $this->load->model('General');

	}

	// MAILER SENDER
    function send_email($email, $subject, $message){

    	$mail = array(
    		'to' 			=> $email,
    		'subject'		=> $subject,
    		'message'		=> $message
    	);

    	if ($this->mailer->send($mail) == TRUE) {
    		return true;
    	}else {
    		return false;
    	}
    }

	function penalty_remaining($datetime, $full = false) {
		// $datetime = date("Y-m-d H:i:s", time()+120);
		$now = new DateTime;
		$ago = new DateTime($datetime);
		$diff = $now->diff($ago);

		$diff->w = floor($diff->d / 7);
		$diff->d -= $diff->w * 7;

		$string = array(
			'i' => 'menit ',
			's' => 'detik',
		);
		$a = null;
		foreach ($string as $k => &$v) {
			if ($diff->$k) {
				$v = $diff->$k . ' ' . $v;
				$a .= $v;
			} else {
				unset($string[$k]);
			}
		}
		return $a;
	}

	public function index(){

		$data['module'] 		= "authentication";
		$data['fileview'] 		= "login";
		echo Modules::run('template/frontend_auth', $data);
	}

	public function daftar(){
		if ($this->input->get('email')) {
			$this->session->set_flashdata('success', 'Untuk melanjutkan harap daftarkan diri, sesuai email invitation anda!!');
			$data['email']	= $this->input->get('email');
		}else{
			$data['email']	= null;
		}

		$data['module'] 	= "authentication";
		$data['fileview'] 	= "peserta";
		echo Modules::run('template/frontend_auth', $data);
	}

	public function daftar_univ(){
		if ($this->input->get('email')) {
			$this->session->set_flashdata('success', 'Untuk melanjutkan harap daftarkan diri, sesuai email invitation anda!!');
			$data['email']	= $this->input->get('email');
		}else{
			$data['email']	= null;
		}

		$data['module'] 	= "authentication";
		$data['fileview'] 	= "univ";
		$data['pts']		= $this->M_auth->get_pts();
		echo Modules::run('template/frontend_auth', $data);
	}

	public function recovery(){

		$data['module'] 	= "authentication";
		$data['fileview'] 	= "recovery";
		echo Modules::run('template/frontend_auth', $data);
	}

	public function ubah_password(){
		if ($this->session->userdata('logged_in') == FALSE || !$this->session->userdata('logged_in')){
			if (!empty($_SERVER['QUERY_STRING'])) {
				$uri = uri_string() . '?' . $_SERVER['QUERY_STRING'];
			} else {
				$uri = uri_string();
			}
			$this->session->set_userdata('redirect', $uri);
			$this->session->set_flashdata('error', "Harap login ke akun anda, untuk melanjutkan");
			redirect('login');
		}else{

			$data['module'] 	= "authentication";
			$data['fileview'] 	= "ubah_password";
			echo Modules::run('template/frontend_auth', $data);
		}
	}

	//PROCESS

	function proses_login(){
		$email   		= htmlspecialchars($this->input->post('email', true));
		$pass        	= htmlspecialchars($this->input->post('password'), true);

		if ($this->General->get_auth($email) == FALSE) {
			$this->session->set_flashdata('error', 'Pengguna tidak terdaftar !!');
			redirect('login');
		}else{

			if(isset($_COOKIE['penalty']) && $_COOKIE['penalty'] == true){
				$time_left =  ($_COOKIE["expire"]);
				$time_left = $this->penalty_remaining(date("Y-m-d H:i:s", $time_left));
				$this->session->set_flashdata('error', 'Terlalu banyak permintaan login, harap coba lagi dalam '.$time_left.'!!');
				redirect('login');
			}else{

				$peserta = $this->General->get_auth($email);
				$nama = $peserta->ROLE == 3 ? $this->M_auth->get_auth_univ($email)->namapt : $peserta->NAMA;

// 				$peserta 	= $this->M_auth->get_auth($email);
// 				$nama 		= $peserta->NAMA;
// 				if($peserta->ROLE == 3){
// 					$peserta 	= $this->M_auth->get_auth_univ($email);					
// 					$nama 		= $peserta->namapt;
// 				}

				if(password_verify($pass, $peserta->PASSWORD)){
					
					$sessiondata = array(
						'kode_user'     => $peserta->KODE_USER,
						'email'         => $peserta->EMAIL,
						'nama'       	=> $nama,
						'role'       	=> $peserta->ROLE,
						'logged_in' 	=> TRUE
					);

					$this->session->set_userdata($sessiondata);

				// SAVE LOG
					$this->M_auth->log_aktivitas($peserta->KODE_USER, $peserta->KODE_USER, 1);

				// CEK HAK AKSES
				// ADMIN
					if ($peserta->ROLE == 0) {
						if ($this->session->userdata('redirect')) {
							$this->session->set_flashdata('success', 'Hai, anda telah login. Silahkan melanjutkan aktivitas anda !!');
							redirect($this->session->userdata('redirect'));
						} else {
							$this->session->set_flashdata('success', "Selamat Datang admin, {$peserta->NAMA}");
							redirect(site_url('admin'));
						}

				// PESERTA
					}elseif ($peserta->ROLE == 1) {

					// CHECK AKTIVASI
						$aktivasi = $this->M_auth->get_aktivasi($peserta->KODE_USER);

						if ($this->session->userdata('redirect')) {
							$this->session->set_flashdata('success', 'Hai, anda telah login. Silahkan melanjutkan aktivitas anda !!');
							redirect($this->session->userdata('redirect'));
						} else {
							if ($aktivasi->STATUS == 0) {
								$this->session->set_flashdata('error', 'Harap melakukan aktivasi email terlebih dahulu !!');
								redirect(site_url('hold-verification'));
							}else{
								$this->session->set_flashdata('success', "Selamat Datang, {$peserta->NAMA}");
								redirect(site_url('peserta'));
							}
						}

				// JURI
					}elseif ($peserta->ROLE == 2) {

						if ($this->session->userdata('redirect')) {
							$this->session->set_flashdata('success', 'Hai, anda telah login. Silahkan melanjutkan aktivitas anda !!');
							redirect($this->session->userdata('redirect'));
						} else {
							$this->session->set_flashdata('success', "Selamat Datang, {$peserta->NAMA}");
							redirect(base_url());
						}
// 					ADMIN UNIV
					}elseif ($peserta->ROLE == 3) {

						if ($this->session->userdata('redirect')) {
							$this->session->set_flashdata('success', 'Hai, anda telah login. Silahkan melanjutkan aktivitas anda !!');
							redirect($this->session->userdata('redirect'));
						} else {
							$this->session->set_flashdata('success', "Selamat Datang, {$nama}");
							redirect(site_url('univ'));
						}

					}else{
						$this->session->set_flashdata('error', 'Hak akses bermasalah !!');
						redirect('login');
					}

				}else{
					$attempt = $this->session->userdata('attempt');
					$attempt++;
					$this->session->set_userdata('attempt', $attempt);

					if ($attempt == 3) {
                        $attempt = 0;
                        $this->session->set_userdata('attempt', $attempt);

                        setcookie("penalty", true, time() + 180);
                        setcookie("expire", time() + 180, time() + 180);

                        $this->session->set_flashdata('error', 'Terlalu banyak permintaan login, harap tunggu selama 3 menit !!');
                        redirect('login');

                    } else {
                    	$this->session->set_flashdata('warning', 'Password yang anda masukkan SALAH!! <br><i><b>Kesempatan login - '.(3-$attempt).'</b></i>');
                    	redirect('login');
                    }
                }
            }
        }
    }

    public function daftar_peserta(){

    	$email        = htmlspecialchars($this->input->post('email'), true);
    	$password     = htmlspecialchars($this->input->post('password'), true);
    	$password_ver = htmlspecialchars($this->input->post('confirmPassword'), true);

    	if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

    		if ($password == $password_ver) {

    			if ($this->General->get_auth($email) == FALSE) {

    				if ($this->M_auth->register_peserta() == TRUE) {

    					$peserta 			= $this->General->get_auth($email);

    					$sessiondata = array(
    						'kode_user'     => $peserta->KODE_USER,
    						'email'         => $peserta->EMAIL,
    						'nama'       	=> $peserta->NAMA,
    						'role'       	=> $peserta->ROLE,
    						'logged_in' 	=> TRUE
    					);

    					$this->session->set_userdata($sessiondata);

						// SAVE LOG
    					$this->M_auth->log_aktivitas($peserta->KODE_USER, $peserta->KODE_USER, 2);

    					redirect(site_url('email-verification'));

    				}else {
    					$this->session->set_flashdata('error', 'Terjadi kesalahan saat mendaftarkan diri anda !!');
    					redirect($this->agent->referrer());
    				}

    			}else{
    				$this->session->set_flashdata('error', 'Email telah digunakan, harap gunakan email lain !!');
    				redirect($this->agent->referrer());
    			}
    		}else{
    			$this->session->set_flashdata('error', 'Kombinasi password anda tidak cocok !!');
    			redirect($this->agent->referrer());
    		}
    	}else{
    		$this->session->set_flashdata('error', 'Email tidak valid, harap masukkan email dengan benar !!');
    		redirect($this->agent->referrer());
    	}
    }
    public function proses_daftar_univ(){

    	$email        = htmlspecialchars($this->input->post('email'), true);
    	$password     = htmlspecialchars($this->input->post('password'), true);
    	$password_ver = htmlspecialchars($this->input->post('confirmPassword'), true);

    	if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

    		if ($password == $password_ver) {

    			if ($this->General->get_auth($email) == FALSE) {

    				if ($this->M_auth->register_univ() == TRUE) {

    					$univ 			= $this->M_auth->get_auth_univ($email);

    					$sessiondata = array(
    						'kode_user'     => $univ->KODE_USER,
    						'email'         => $univ->EMAIL,
    						'nama'       	=> $univ->namapt,
    						'role'       	=> $univ->ROLE,
    						'logged_in' 	=> TRUE
    					);

    					$this->session->set_userdata($sessiondata);

						// SAVE LOG
    					$this->M_auth->log_aktivitas($univ->KODE_USER, $univ->KODE_USER, 2);

    					redirect(site_url('email-verification'));

    				}else {
    					$this->session->set_flashdata('error', 'Terjadi kesalahan saat mendaftarkan diri anda !!');
    					redirect($this->agent->referrer());
    				}

    			}else{
    				$this->session->set_flashdata('error', 'Email telah digunakan, harap gunakan email lain !!');
    				redirect($this->agent->referrer());
    			}
    		}else{
    			$this->session->set_flashdata('error', 'Kombinasi password anda tidak cocok !!');
    			redirect($this->agent->referrer());
    		}
    	}else{
    		$this->session->set_flashdata('error', 'Email tidak valid, harap masukkan email dengan benar !!');
    		redirect($this->agent->referrer());
    	}
    }

	// AKTIVASI AKUN
    public function aktivasi_email(){
    	if ($this->session->userdata('logged_in') == TRUE) {
    		$email 		= htmlspecialchars($this->session->userdata('email'), TRUE);

    		if ($this->M_auth->get_aktivasi(htmlspecialchars($this->session->userdata('kode_user'), TRUE)) == FALSE) {
    			$this->session->set_flashdata('error', 'Terjadi kesalahan saat mengambil data anda !!');
    			redirect(site_url('login'));

    		}else {
    			$aktivasi = $this->M_auth->get_aktivasi(htmlspecialchars($this->session->userdata('kode_user'), TRUE));

    			if ($aktivasi->STATUS == 0) {
    				$subject	= "KODE AKTIVASI AKUN LO Kreatif";
    				$message 	= "Kode aktivasi anda <b>{$this->encryption->decrypt($aktivasi->KEY)}</b></br><small class='text-muted'>TOKEN AKTIVASI akan valid selama 1x24JAM, harap melakukan aktivasi dalam batas waktu yang telah ditentukan. <span class='text-danger'>JIKA MELEBIHI BATAS WAKTU, AKUN ANDA AKAN DIHAPUS DAN HARAP MELAKUKAN PROES PENDAFTARAN AKUN DARI AWAL.</span></small></br></br></br><span class='text-muted'>Regards,</br></br>LO Kreatif</span>";

    				if ($this->send_email($email, $subject, $message) == TRUE) {

    					$data['mail']			= $email;
    					$data['kode_aktivasi']	= $this->encryption->decrypt($aktivasi->KEY);

    					$data['module'] 		= "authentication";
    					$data['fileview'] 		= "aktivasi";
    					echo Modules::run('template/frontend_auth', $data);

    				}else {
    					$this->session->set_flashdata('error', 'Terjadi kesalahan saat mengirimkan pesan ke email anda !!');
    					redirect(site_url('hold-verification'));
    				}
    			}else {
    				redirect('peserta');
    			}
    		}
    	}else {
    		if (!empty($_SERVER['QUERY_STRING'])) {
    			$uri = uri_string() . '?' . $_SERVER['QUERY_STRING'];
    		} else {
    			$uri = uri_string();
    		}
    		$this->session->unset_userdata('redirect');
    		$this->session->set_userdata('redirect', $uri);
    		$this->session->set_flashdata('error', "Harap login ke akun anda, untuk melanjutkan");
    		redirect('login');
    	}
    }

    public function waiting(){
    	if ($this->session->userdata('logged_in') == TRUE || $this->session->userdata('logged_in')) {

    		$email 		= htmlspecialchars($this->session->userdata('email'), TRUE);

    		if ($this->M_auth->get_aktivasi(htmlspecialchars($this->session->userdata('kode_user'), TRUE)) == FALSE) {

    			$this->session->set_flashdata('error', 'Terjadi kesalahan saat mengambil data anda !!');
    			redirect(site_url('login'));

    		}else {
    			$aktivasi = $this->M_auth->get_aktivasi(htmlspecialchars($this->session->userdata('kode_user'), TRUE));

    			if ($aktivasi->STATUS == 0) {
    				$subject	= "KODE AKTIVASI AKUN LO Kreatif";
    				$message 	= "Kode aktivasi anda <b>{$this->encryption->decrypt($aktivasi->KEY)}</b></br><small class='text-muted'>TOKEN AKTIVASI akan valid selama 1x24JAM, harap melakukan aktivasi dalam batas waktu yang telah ditentukan. <span class='text-danger'>JIKA MELEBIHI BATAS WAKTU, AKUN ANDA AKAN DIHAPUS DAN HARAP MELAKUKAN PROES PENDAFTARAN AKUN DARI AWAL.</span></small></br></br></br><span class='text-muted'>Regards,</br></br>LO Kreatif</span>";

    				if ($this->send_email($email, $subject, $message) == TRUE) {

    					$data['mail']		= $email;

    					$data['module'] 	= "authentication";
    					$data['fileview'] 	= "waiting";
    					echo Modules::run('template/frontend_auth', $data);

    				}else {
    					$this->session->set_flashdata('error', 'Terjadi kesalahan saat mengirimkan pesan ke email anda !!');
    					redirect(site_url('hold-verification'));
    				}
    			}else {
    				redirect('peserta');
    			}
    		}

    	}else {
    		if (!empty($_SERVER['QUERY_STRING'])) {
    			$uri = uri_string() . '?' . $_SERVER['QUERY_STRING'];
    		} else {
    			$uri = uri_string();
    		}
    		$this->session->unset_userdata('redirect');
    		$this->session->set_userdata('redirect', $uri);
    		$this->session->set_flashdata('error', "Harap login ke akun anda, untuk melanjutkan");
    		redirect('login');
    	}
    }

    function aktivasi_akun(){

    	if ($this->session->userdata('logged_in') == TRUE || $this->session->userdata('logged_in')) {

    		$kode_aktivasi 	= htmlspecialchars($this->input->post('kode_aktivasi'), TRUE);
    		$aktivasi 		= $this->M_auth->get_aktivasi(htmlspecialchars($this->session->userdata('kode_user'), TRUE), TRUE);

    		if(time() - $aktivasi->DATE_CREATED < (60*60*24)){

    			if ($this->M_auth->aktivasi_kode(str_replace('-', '', $kode_aktivasi), $this->session->userdata('kode_user')) == TRUE) {
    				if ($this->M_auth->aktivasi_akun($this->session->userdata('kode_user')) == TRUE) {

						// SAVE LOG
						// 2. AKTIVASI AKUN
    					$this->M_auth->log_aktivitas($this->session->userdata('kode_user'), $this->session->userdata('kode_user'), 3);

    					$this->session->set_flashdata('success', 'Berhasil aktivasi akun, Selamat datang di LO Kreatif !!');
    					redirect(base_url());
    				}else {
    					$this->session->set_flashdata('error', 'Terjadi kesalahan saat mencoba meng-aktivasi akun anda !!');
    					redirect($this->agent->referrer());
    				}
    			}else {
    				$this->session->set_flashdata('error', 'Kode yang anda masukkan salah, cek kembali email anda !!');
    				redirect($this->agent->referrer());
    			}

    		}else {

    			$kode_user = htmlspecialchars($this->session->userdata('kode_user'), TRUE);

    			$kode_user = $this->db->escape($kode_user);

    			$this->db->delete("tb_token", array('KODE' => $kode_user, 'TYPE' => 1));
    			$this->session->set_flashdata('error', 'Token aktivasi akun untuk akun anda telah melewati batas waktu. Harap melakukan proses pendaftaran akun kembali. ');
    			redirect(site_url('pendaftaran'));
    		}

    	}else {
    		if (!empty($_SERVER['QUERY_STRING'])) {
    			$uri = uri_string() . '?' . $_SERVER['QUERY_STRING'];
    		} else {
    			$uri = uri_string();
    		}
    		$this->session->unset_userdata('redirect');
    		$this->session->set_userdata('redirect', $uri);
    		$this->session->set_flashdata('error', "Harap login ke akun anda, untuk melanjutkan");
    		redirect('login');
    	}

    }

	// PROSES LUPA PASSWORD

    public function proses_lupa(){
    	if ($this->M_auth->cek_akun(htmlspecialchars($this->input->post("email"), TRUE)) == TRUE) {

    		$user 		= $this->General->get_auth(htmlspecialchars($this->input->post("email"), TRUE));
    		$kode_user 	= $this->db->escape($user->KODE_USER);
    		$this->db->delete("tb_token", array('KODE' => $kode_user, 'TYPE' => 2));

    		do {
    			$token = bin2hex(random_bytes(32));
    		} while ($this->M_auth->cek_token($token) == TRUE);

    		$data = array(
    			'KODE' 			=> $user->KODE_USER,
    			'KEY' 			=> $token,
				'TYPE' 			=> 2, // 1. AKTIVASI AKUN, 2. CHANGE PASSWORD
				'DATE_CREATED' 	=> time()
			);

    		$this->db->insert("tb_token", $data);

    		$email 		= htmlspecialchars($this->input->post("email"), TRUE);

    		$subject	= "RESET PASSWORD AKUN LO Kreatif";
    		$message 	= "Hai, kami mendapatkan permintaan recovery password atas akun dengan email <b>{$email}</b>.<br> Harap klik link berikut untuk melanjutkan proses recovery password! <br><hr>".base_url()."recovery-password/{$token}</br><small class='text-muted'>Tautan tersebut akan aktif selama 1x24JAM, jika melebihi waktu tersebut harap melakukan proses recovery password anda dari awal atau abaikan email ini jika anda tidak melakukan permintaan recovery password</small></br></br></br><span class='text-muted'>Regards,</br></br>LO Kreatif</span>";

    		if ($this->send_email($email, $subject, $message) == TRUE) {
    			$this->session->set_flashdata('success', 'Berhasil mengirimkan email, cek kontak masuk atau folder spam anda');
    			redirect($this->agent->referrer());
    		}else {
    			$this->session->set_flashdata('error', 'Terjadi kesalahan saat mengirimkan token recovery pass ke email anda !!');
    			redirect($this->agent->referrer());
    		}
    	}else {
    		$this->session->set_flashdata('error', 'Tidak dapat menemukan akan dengan email <b>'.$this->input->post("email").'</b> !!');
    		redirect($this->agent->referrer());
    	}
    }

    public function ubah_pass($token){

    	if ($this->M_auth->get_token($token) == FALSE) {
    		$this->session->set_flashdata('error', 'Token tidak dikenali, harap lakukan proses recovery akun ulang jika hal ini masih terjadi');
    		redirect(site_url('login'));

    	}else {

    		$find = $this->M_auth->get_token($token);

    		if (time() - $find->DATE_CREATED < (60*60*24)) {

    			$user = $this->General->get_akun($find->KODE);

    			$data['email']	= $user->EMAIL;
    			$data['token']	= $token;

    			$data['module'] 	= "authentication";
    			$data['fileview'] 	= "reset-pass";
    			echo Modules::run('template/frontend_auth', $data);

    		}else {

    			$kode_user = $this->db->escape($user->KODE_USER);

    			$this->db->delete("tb_token", array('KODE' => $kode_user, 'TYPE' => 2));
    			$this->session->set_flashdata('error', 'Token URL recovery password untuk akun anda telah melewati batas. Harap melakukan proses recovery password kembali. ');
    			redirect(site_url('lupa-password'));
    		}
    	}

    }

    public function reset_pass(){

    	if ($this->M_auth->cek_akun(htmlspecialchars($this->input->post("email"), TRUE)) == TRUE) {
    		$user = $this->General->get_auth(htmlspecialchars($this->input->post("email"), TRUE));

    		$data = array('PASSWORD' => password_hash(htmlspecialchars($this->input->post("password"), TRUE), PASSWORD_DEFAULT));
    		$this->db->where("EMAIL", htmlspecialchars($this->input->post("email"), TRUE));
    		$this->db->update('tb_auth', $data);

    		$cek = ($this->db->affected_rows() != 1) ? false : true;

    		if ($cek == TRUE) {

				// SAVE LOG
				// 3. RECOVERY PASSWORD
    			$this->M_auth->log_aktivitas($user->KODE_USER, $user->KODE_USER, 4);
    			$kode_user 	= $this->db->escape($user->KODE_USER);
    			$this->db->delete("tb_token", array('KODE' => $kode_user, 'TYPE' => 2));

    			$subject	= "PERUBAHAN PASSWORD AKUN LO Kreatif";
    			$now 		= date("H:i | d-m-Y");

    			$email 		= htmlspecialchars($this->input->post("email"), TRUE);

    			$message 	= "Hai, password akun lo kreatif anda dengan email <b>{$email}</b> telah dirubah pada {$now}.<br> Jika anda tidak merasa melakukan perubahan password harap segera menghubungi admin.</br></br></br><span class='text-muted'>Regards,</br></br>LO Kreatif</span>";

    			$this->send_email(htmlspecialchars($this->input->post("email"), TRUE), $subject, $message);
    			$this->session->sess_destroy();

    			$this->session->set_flashdata('success', 'Berhasil mereset password anda, harap masuk menggunakan hak akses baru anda');
    			redirect(site_url('login'));
    		}else {
    			$this->session->set_flashdata('error', 'Gagal mereset password anda, harap masuk coba lagi');
    			redirect($this->agent->referrer());
    		}
    	}else {
    		$this->session->set_flashdata('error', 'Email tidak dikenali, harap hubungi admin jika hal ini terjadi.');
    		redirect($this->agent->referrer());
    	}
    }

	// LOGOUT
    public function logout(){

		// SESS DESTROY
    	$user_data = $this->session->all_userdata();

    	foreach ($user_data as $key => $value) {
    		if ($key != 'session_id' && $key != 'ip_address' && $key != 'user_agent' && $key != 'last_activity') {
    			$this->session->unset_userdata($key);
    		}
    	}

    	$this->session->sess_destroy();

    	if ($this->input->get("act")) {
    		if (!empty($_SERVER['QUERY_STRING'])) {
    			$uri = uri_string() . '?' . $_SERVER['QUERY_STRING'];
    		} else {
    			$uri = uri_string();
    		}
    		$this->session->unset_userdata('redirect');
    		$this->session->set_userdata('redirect', $uri);
    		$this->session->set_flashdata('error', "Harap login ke akun anda, untuk melanjutkan");
    		redirect('login');
    	}else {
    		$this->session->set_flashdata('success','Berhasil keluar!');
    		redirect(base_url());
    	}
    }
}
