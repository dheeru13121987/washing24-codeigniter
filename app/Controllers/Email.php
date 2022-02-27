<?php namespace App\Controllers;
use PHPMailer\PHPMailer\PHPMailer; 
use PHPMailer\PHPMailer\Exception; 
error_reporting(-1);
ini_set('display_errors', '1');
defined('SHOW_DEBUG_BACKTRACE') || define('SHOW_DEBUG_BACKTRACE', true);
defined('CI_DEBUG') || define('CI_DEBUG', 1);
/*
  |--------------------------------------------------------------------------
  | DEBUG BACKTRACES
  |--------------------------------------------------------------------------
  | If true, this constant will tell the error screens to display debug
  | backtraces along with the other error information. If you would
  | prefer to not see this, set this value to false.
 */

/*
  |--------------------------------------------------------------------------
  | DEBUG MODE
  |--------------------------------------------------------------------------
  | Debug mode is an experimental flag that can allow changes throughout
  | the system. This will control whether Kint is loaded, and a few other
  | items. It can always be used within your own application too.
 */	
		
class Email extends BaseController
{
	public function __construct(){		 
		// Include PHPMailer library files 
		require_once APPPATH.'ThirdParty/PHPmailer/Exception.php'; 
		require_once APPPATH.'ThirdParty/PHPmailer/PHPMailer.php'; 
		require_once APPPATH.'ThirdParty/PHPmailer/SMTP.php'; 
        //$this->load->library('PHPMailer_Lib');
    }
	public function index(){
        /*
        |--------------------------------------------------------------------------
        | ERROR DISPLAY
        |--------------------------------------------------------------------------
        | In development, we want to show as many errors as possible to help
        | make sure they don't make it to production. And save us hours of
        | painful debugging.
        */


	    // Load PHPMailer library
        // Import PHPMailer classes into the global namespace 	
		 
		// Create an instance of PHPMailer class 
		$mail = new PHPMailer;
        
        // PHPMailer object
        //$mail = $this->PHPMailer_Lib->load();
        //$mail = new PHPMailer;
		
		//define('SMTP_HOST','smtp.mailtrap.io');
		//define('SMTP_PORT','465');
		//define('SMTP_UNAME','6a38aa2a5548df');
		//define('SMTP_PWORD','071da5f2f0a1fa');
		//define('SMTP_SSL','tsl');
		
		//define('SMTP_HOST','ssl://smtp.gmail.com');
		//define('SMTP_PORT','465');
		//define('SMTP_UNAME','leith@anxioustomatter.com');
		//define('SMTP_PWORD','nqfbendtemaqaiza');
		//define('SMTP_SSL','ssl');
		
		//define('SMTP_HOST','smtp.office365.com');
		//define('SMTP_PORT','587');
		//define('SMTP_SSL','tsl');		
        
        // SMTP configuration
        $mail->SMTPDebug = 4;
        $mail->isSMTP();
        $mail->Host     = SMTP_HOST;
        $mail->SMTPAuth = true;
        $mail->Username = SMTP_UNAME;
        $mail->Password = SMTP_PWORD;
        $mail->SMTPSecure = SMTP_SSL;
        $mail->Port     = SMTP_PORT;        
        
        $mail->setFrom(SMTP_FROM_EMAIL, 'Select and Switch');
        $mail->addReplyTo(SMTP_FROM_EMAIL, 'Select and Switch');
        
        // Add a recipient
        $mail->addAddress('dheerendra.tiwari@kozmoservices.com.au');
        
        // Add cc or bcc 
        //$mail->addCC('leith@anxioustomatter.com');
        //$mail->addBCC('leith@anxioustomatter.com');
        
        // Email subject
        $mail->Subject = 'Send Email via SMTP using PHPMailer in CodeIgniter';
        
        // Set email format to HTML
        $mail->isHTML(true);
        
        // Email body content
        $mailContent = "<h1>Send HTML Email using SMTP in CodeIgniter</h1>
            <p>This is a test email sending using SMTP mail server with PHPMailer.</p>";
        $mail->Body = $mailContent;
        
        // Send email
        if(!$mail->send()){
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }else{
            echo 'Message has been sent';
        }
	}

    public function demo(){
        $data['fname']="";
        $data['url']="";
        $data['quotes_id']="";
        echo view('emailtemplate/quoteLinkEmail',$data);
    }

    public function demo1(){
        $data['fname']="";
        $data['url']="";
        $data['quotes_id']="";
        $data['name']="";
        echo view('emailtemplate/quoteLinkEmailNew',$data);
    }
}
