<?php defined('BASEPATH') OR exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Mailer{
  public function __construct(){
    log_message('Debug', 'PHPMailer class is loaded.');
    $this->_ci = &get_instance();
    $this->_ci->load->database();
  }

  public function get_data($param){
    $query = $this->_ci->db->query("SELECT a.VALUE FROM tb_pengaturan a WHERE a.KEY = '$param'");
    return $query->row()->VALUE;
  }

  public function send($data){
    // Include PHPMailer library files
    require_once APPPATH.'third_party/PHPMailer/Exception.php';
    require_once APPPATH.'third_party/PHPMailer/PHPMailer.php';
    require_once APPPATH.'third_party/PHPMailer/SMTP.php';

    $mail = new PHPMailer(true);

    // SMTP configuration
    if ($this->get_data("SMPT_GMAIL") == true) {
        $mail->isSMTP();
    }
    try {
        $mail->SMTPDebug  = $this->get_data("EM_DEBUG");

        // SMTP configuration
        if ($this->get_data("SMPT_GMAIL") == true) {
        }
            $mail->SMTPAuth   = FALSE;
        $mail->SMTPSecure = "ssl";
        $mail->Port       = $this->get_data("EM_PORT");
        $mail->Host       = $this->get_data("EM_HOST");
        $mail->Username   = $this->get_data("EM_USERNAME");
        $mail->Password   = $this->get_data("EM_PASSWORD");

        $mail->setFrom($this->get_data("EM_USERNAME"), $this->get_data("EM_ALIAS"));
        $mail->addReplyTo($this->get_data("EM_USERNAME"), $this->get_data("EM_ALIAS"));

        // Add a recipient
        $mail->addAddress($data['to']);

        // Email subject
        $mail->Subject = $data['subject'];

        // Set email format to HTML
        $mail->isHTML(true);
        // Email body content
        $mail->Body = $data['message'];

        // Send email
        if (!$mail->send()) {
                echo 'Message could not be sent. <br>';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
                echo '<br>Contact ADMIN ';
                die();
          return false;
        } else {
          return true;
        }
        $mail->clearAddresses();
        $mail->clearAttachments();
    } catch (Exception $e) {
        echo 'Message could not be sent. <br>';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
        echo '<br>Contact ADMIN ';
        die();
        $data = array(
            'RECEIVER_GROUP'    => 1,
            'RECEIVER'          => 'ADM_001',
            'SENDER'            => 'System',
            'CUST_MESSAGE'      => 'Galat mailer pada:'.$e,
            'TYPE'              => 1
        );
        $this->_ci->db->insert('log_aktivitas', $data);
    }
  }

}
?>
