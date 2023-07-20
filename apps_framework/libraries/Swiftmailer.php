<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}
require_once 'vendor/swiftmailer/swiftmailer/lib/swift_required.php';

class Swiftmailer
{
	public  $CI            = '';
	public  $transport     = '';
	public  $transport_set = '';
	private $set_config    = array(
		'host'        => 'mail.ergonomic.co.id',
		'port'        => '465',
		'user'        => 'info@indoconnex.com',
		'pass'        => 'Indo@12345',
		'user_name'   => 'info@indoconnex.com',
		'admin_email' => 'info@indoconnex.com'
	);

	public function __construct()
	{
		$this->CI = &get_instance();
		if (version_compare(PHP_VERSION, '7.0.0') >= 0) {
			$this->transport = new Swift_SmtpTransport($this->set_config['host'], $this->set_config['port'], 'SSL');
			$this->transport->setUsername($this->set_config['user'])->setPassword($this->set_config['pass']);
			$this->transport->setStreamOptions([
				                                   'ssl' => ['allow_self_signed' => true, 'verify_peer' => false, 'verify_peer_name' => false]
			                                   ]);
			$this->transport_set = '7';
		} else {
			$this->transport = Swift_SmtpTransport::newInstance($this->set_config['host'], $this->set_config['port'], 'SSL');
			$this->transport->setUsername($this->set_config['user']);
			$this->transport->setPassword($this->set_config['pass']);
			$this->transport->setStreamOptions([
				                                   'ssl' => ['allow_self_signed' => true, 'verify_peer' => false, 'verify_peer_name' => false]
			                                   ]);
			$this->transport_set = '5';
		}
	}

	public function send_email($parameter_send_email_to = '', $subject = '', $messages = '', $parameter_send_email_cc = '', $parameter_send_email_bcc = '', $parameter_send_email_reply_to = '')
	{
		if (version_compare(PHP_VERSION, '7.0.0') >= 0) {
			$message = new Swift_Message();
		} else {
			$message = Swift_Message::newInstance();
		}

		$message->setTo($parameter_send_email_to);


		if ($parameter_send_email_cc != '') {
			if (!empty($parameter_send_email_cc)) {
				$parameter_send_email_cc = array_filter($parameter_send_email_cc);
				$message->setCC($parameter_send_email_cc);
			}
		}

		if ($parameter_send_email_bcc != '') {
			if (!empty($parameter_send_email_bcc)) {
				$parameter_send_email_bcc = explode(',', str_replace(' ', '', $parameter_send_email_bcc));
				$parameter_send_email_bcc = array_filter($parameter_send_email_bcc);
				$message->setBcc($parameter_send_email_bcc);
			}
		}

		if ($parameter_send_email_reply_to != '') {
			if (!empty($parameter_send_email_reply_to)) {
				$message->setReplyTo($parameter_send_email_reply_to);
			}
		}

		$message->setSubject($subject);
		$message->setBody($messages, 'text/html');
		$message->setFrom($this->set_config['admin_email'], $this->set_config['user_name']);

		if (version_compare(PHP_VERSION, '7.0.0') >= 0) {
			$mailer = new Swift_Mailer($this->transport);
		} else {
			$mailer = Swift_Mailer::newInstance($this->transport);
		}

		$logger = new Swift_Plugins_Loggers_ArrayLogger();
		$mailer->registerPlugin(new Swift_Plugins_LoggerPlugin($logger));

		echo '<Pre>';
		try {
			$mailer->send($message);
		} catch (Swift_TransportException $e) {
			print_r($e->getMessage());
		}
		// print_r($logger);
		// exit();
		return;
	}
}
