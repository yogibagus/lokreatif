<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Template extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model(['M_template']);
	}

	function time_elapsed($datetime, $full = false)
	{
		$now = new DateTime;
		$ago = new DateTime($datetime);
		$diff = $now->diff($ago);

		$diff->w = floor($diff->d / 7);
		$diff->d -= $diff->w * 7;

		$string = array(
			'y' => 'year',
			'm' => 'month',
			'w' => 'week',
			'd' => 'day',
			'h' => 'hour',
			'i' => 'min',
			's' => 'sec',
		);
		foreach ($string as $k => &$v) {
			if ($diff->$k) {
				$v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
			} else {
				unset($string[$k]);
			}
		}

		if (!$full) $string = array_slice($string, 0, 1);
		return $string ? implode(', ', $string) . ' ago' : 'just now';
	}

	public function aktivitas_ajax(){
		$aktivitas	= $this->M_template->get_aktivitasAdmin();

		if ($aktivitas == FALSE):

			echo '<li class="step-item">
			<center>Tidak ada aktivitas terbaru</center>
			</li>';

		else:
			foreach ($aktivitas as $key):
				$sender = explode(" ", $this->M_template->get_sender($key->SENDER));
				echo '<li class="step-item">
				<div class="step-content-wrapper">';

				if ($this->M_template->get_profil($key->SENDER) == FALSE):
					echo '<span class="step-icon step-icon-soft-dark">'.substr($this->M_template->get_sender($key->SENDER), 0, 1).'</span>';
				else:
					echo '<div class="step-avatar">
					<img class="step-avatar-img" src="'.base_url().'berkas/peserta/'.$key->SENDER.'/foto/'.$this->M_template->get_profil($key->SENDER).'" alt="Image Description">
					</div>';
				endif;

				echo '<div class="step-content">
				<h5 class="mb-1">'.$sender[0].'</h5>

				<p class="font-size-sm mb-1">'.$key->MESSAGE.'</p>

				<small class="text-muted text-uppercase">'.$this->time_elapsed($key->CREATED_AT).'</small>
				</div>
				</div>
				</li>';
			endforeach;
		endif;
	}

	public function backend_main($data)
	{

		// SOSMED
		$data['LN_FACEBOOK']		= $this->M_template->get_facebookLink();
		$data['LN_INSTAGRAM']		= $this->M_template->get_instagramLink();
		$data['LN_TWITTER']			= $this->M_template->get_twitterLink();
		$data['LN_GITHUB']			= $this->M_template->get_githubLink();

		// LOGO
		$data['LOGO_FAV']			= $this->M_template->get_logoFav();
		$data['LOGO_WHITE']			= $this->M_template->get_logoWhite();
		$data['LOGO_BLACK']			= $this->M_template->get_logoBlack();

		// META
		$data['WEB_JUDUL']			= $this->M_template->get_webJudul();
		$data['WEB_DESKRIPSI']		= $this->M_template->get_webDeskripsi();
		$data['WEB_WA']				= $this->M_template->get_webWa();
		$data['WEB_EMAIL']			= $this->M_template->get_webEmail();
		$data['WEB_HERO_BUTTON']	= $this->M_template->get_webHeroButton();

		// ETC
		$data['pFoto']				= $this->M_template->get_foto($this->session->userdata('kode_user'), $this->session->userdata('role'));
		$data['notifikasi']			= $this->M_template->get_notifikasiAdmin();
		$data['aktivitas']			= $this->M_template->get_aktivitasAdmin();
		$data['c_notifikasi']		= $this->M_template->count_notifikasiAdmin();
		$data['c_aktivitas']		= $this->M_template->count_aktivitasAdmin();

		$data['controller']			= $this;

		$this->load->view('backend/backend_main', $data);
	}

	public function manage_kegiatan_main($data)
	{

		// SOSMED
		$data['LN_FACEBOOK']		= $this->M_template->get_facebookLink();
		$data['LN_INSTAGRAM']		= $this->M_template->get_instagramLink();
		$data['LN_TWITTER']			= $this->M_template->get_twitterLink();
		$data['LN_GITHUB']			= $this->M_template->get_githubLink();

		// LOGO
		$data['LOGO_FAV']			= $this->M_template->get_logoFav();
		$data['LOGO_WHITE']			= $this->M_template->get_logoWhite();
		$data['LOGO_BLACK']			= $this->M_template->get_logoBlack();

		// META
		$data['WEB_JUDUL']			= $this->M_template->get_webJudul();
		$data['WEB_DESKRIPSI']		= $this->M_template->get_webDeskripsi();
		$data['WEB_WA']				= $this->M_template->get_webWa();
		$data['WEB_EMAIL']			= $this->M_template->get_webEmail();
		$data['WEB_HERO_BUTTON']	= $this->M_template->get_webHeroButton();

		// ETC
		$data['pFoto']				= $this->M_template->get_foto($this->session->userdata('kode_user'), $this->session->userdata('role'));
		$data['notifikasi']			= $this->M_template->get_notifikasiKegiatan($this->session->userdata('manage_kegiatan'));
		$data['aktivitas']			= $this->M_template->get_aktivitasKegiatan($this->session->userdata('manage_kegiatan'));
		$data['c_notifikasi']		= $this->M_template->count_notifikasiKegiatan($this->session->userdata('manage_kegiatan'));
		$data['c_aktivitas']		= $this->M_template->count_aktivitasKegiatan($this->session->userdata('manage_kegiatan'));

		$data['cek_form']   		= $this->M_template->cek_form($this->session->userdata('manage_kegiatan'));

		$data['CI']					= $this;

		$this->load->view('manage_kegiatan/manage_main', $data);
	}

	public function frontend_util($data)
	{

		// SOSMED
		$data['LN_FACEBOOK']		= $this->M_template->get_facebookLink();
		$data['LN_INSTAGRAM']		= $this->M_template->get_instagramLink();
		$data['LN_TWITTER']			= $this->M_template->get_twitterLink();
		$data['LN_GITHUB']			= $this->M_template->get_githubLink();

		// LOGO
		$data['LOGO_FAV']			= $this->M_template->get_logoFav();
		$data['LOGO_WHITE']			= $this->M_template->get_logoWhite();
		$data['LOGO_BLACK']			= $this->M_template->get_logoBlack();

		// META
		$data['WEB_JUDUL']			= $this->M_template->get_webJudul();
		$data['WEB_DESKRIPSI']		= $this->M_template->get_webDeskripsi();
		$data['WEB_WA']				= $this->M_template->get_webWa();
		$data['WEB_EMAIL']			= $this->M_template->get_webEmail();
		$data['WEB_HERO_BUTTON']	= $this->M_template->get_webHeroButton();

		// ETC

		$data['CI']					= $this;

		$this->load->view('frontend/frontend_util', $data);
	}

	public function frontend_auth($data)
	{

		// SOSMED
		$data['LN_FACEBOOK']		= $this->M_template->get_facebookLink();
		$data['LN_INSTAGRAM']		= $this->M_template->get_instagramLink();
		$data['LN_TWITTER']			= $this->M_template->get_twitterLink();
		$data['LN_GITHUB']			= $this->M_template->get_githubLink();

		// LOGO
		$data['LOGO_FAV']			= $this->M_template->get_logoFav();
		$data['LOGO_WHITE']			= $this->M_template->get_logoWhite();
		$data['LOGO_BLACK']			= $this->M_template->get_logoBlack();

		// META
		$data['WEB_JUDUL']			= $this->M_template->get_webJudul();
		$data['WEB_DESKRIPSI']		= $this->M_template->get_webDeskripsi();
		$data['WEB_WA']				= $this->M_template->get_webWa();
		$data['WEB_EMAIL']			= $this->M_template->get_webEmail();
		$data['WEB_HERO_BUTTON']	= $this->M_template->get_webHeroButton();
		$data['TERM_CONDITION']		= $this->M_template->get_termAndCondition();

		// ETC

		$data['CI']					= $this;

		$this->load->view('frontend/frontend_auth', $data);
	}

	public function frontend_main($data)
	{

		// SOSMED
		$data['LN_FACEBOOK']		= $this->M_template->get_facebookLink();
		$data['LN_INSTAGRAM']		= $this->M_template->get_instagramLink();
		$data['LN_TWITTER']			= $this->M_template->get_twitterLink();
		$data['LN_GITHUB']			= $this->M_template->get_githubLink();

		// LOGO
		$data['LOGO_FAV']			= $this->M_template->get_logoFav();
		$data['LOGO_WHITE']			= $this->M_template->get_logoWhite();
		$data['LOGO_BLACK']			= $this->M_template->get_logoBlack();

		// META
		$data['WEB_JUDUL']			= $this->M_template->get_webJudul();
		$data['WEB_DESKRIPSI']		= $this->M_template->get_webDeskripsi();
		$data['WEB_WA']				= $this->M_template->get_webWa();
		$data['WEB_EMAIL']			= $this->M_template->get_webEmail();
		$data['WEB_HERO_BUTTON']	= $this->M_template->get_webHeroButton();

		// ETC
		$data['pFoto']				= $this->M_template->get_foto($this->session->userdata('kode_user'), $this->session->userdata('role'));
		$data['aktivasi']			= $this->M_template->cek_aktivasi($this->session->userdata('kode_user'));
		$data['c_notifikasi']	= $this->M_template->count_notifikasi($this->session->userdata('kode_user'));

		$data['CI']					= $this;

		$this->load->view('frontend/frontend_main', $data);
	}

	public function frontend_user($data)
	{

		// SOSMED
		$data['LN_FACEBOOK']		= $this->M_template->get_facebookLink();
		$data['LN_INSTAGRAM']		= $this->M_template->get_instagramLink();
		$data['LN_TWITTER']			= $this->M_template->get_twitterLink();
		$data['LN_GITHUB']			= $this->M_template->get_githubLink();

		// LOGO
		$data['LOGO_FAV']			= $this->M_template->get_logoFav();
		$data['LOGO_WHITE']			= $this->M_template->get_logoWhite();
		$data['LOGO_BLACK']			= $this->M_template->get_logoBlack();

		// META
		$data['WEB_JUDUL']			= $this->M_template->get_webJudul();
		$data['WEB_DESKRIPSI']		= $this->M_template->get_webDeskripsi();
		$data['WEB_WA']				= $this->M_template->get_webWa();
		$data['WEB_EMAIL']			= $this->M_template->get_webEmail();
		$data['WEB_HERO_BUTTON']	= $this->M_template->get_webHeroButton();

		// ETC

		$data['pFoto']				= $this->M_template->get_foto($this->session->userdata('kode_user'), $this->session->userdata('role'));
		$data['aktivasi']			= $this->M_template->cek_aktivasi($this->session->userdata('kode_user'));
		$data['c_notifikasi']		= $this->M_template->count_notifikasi($this->session->userdata('kode_user'));

		$data['CI']					= $this;

		$this->load->view('frontend/frontend_user', $data);
	}

	public function frontend_payment($data)
	{

		// SOSMED
		$data['LN_FACEBOOK']		= $this->M_template->get_facebookLink();
		$data['LN_INSTAGRAM']		= $this->M_template->get_instagramLink();
		$data['LN_TWITTER']			= $this->M_template->get_twitterLink();
		$data['LN_GITHUB']			= $this->M_template->get_githubLink();

		// LOGO
		$data['LOGO_FAV']			= $this->M_template->get_logoFav();
		$data['LOGO_WHITE']			= $this->M_template->get_logoWhite();
		$data['LOGO_BLACK']			= $this->M_template->get_logoBlack();

		// META
		$data['WEB_JUDUL']			= $this->M_template->get_webJudul();
		$data['WEB_DESKRIPSI']		= $this->M_template->get_webDeskripsi();
		$data['WEB_WA']				= $this->M_template->get_webWa();
		$data['WEB_EMAIL']			= $this->M_template->get_webEmail();
		$data['WEB_HERO_BUTTON']	= $this->M_template->get_webHeroButton();
		$data['TERM_CONDITION']		= $this->M_template->get_termAndCondition();

		// ETC

		$data['CI']					= $this;

		$this->load->view('frontend/frontend_payment', $data);
	}

	public function mail_template($data)
	{
		$data['CI']					= $this;
		$this->load->view('mail/mail_template', $data);
	}

	public function blank_template($data)
	{
		$data['CI']					= $this;
		$this->load->view('backend/blank', $data);
	}
}
