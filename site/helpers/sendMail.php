<?php defined('_JEXEC') or die('Restricted access'); // no direct access 
	
require_once(JPATH_COMPONENT.DS.'helpers' . DS. 'adminConfig.php');

class jEventMailer {
	
	/**
	 * Send application/cancel email to applicant 
	 * @return boolean True if send succeeded
	 */
	function sendApplicationEmail2($application, $postData, $applyEvent, $bCancel = false){
		//echo 'postdata: ' . $postData[0][0] . ' / applyEvent ' .  $applyEvent[0][0]; 	
				// Lets load the data if it doesn't already exist
		$db =& JFactory::getDBO();
		
		$query = ' SELECT * '
		. ' FROM #__jevent_admin_options ';

		$db->setQuery($query);
		$_data = $db->loadRowList();
		if($bCancel)
			$mailMasked = $_data[0][4];
		else
			$mailMasked = $_data[0][3];
		
		if($bCancel)
			$subjectMasked = $_data[0][7];
		else
			$subjectMasked = $_data[0][6];
		
		$mailer =& JFactory::getMailer();
		
		$config =& JFactory::getConfig();
		$sender = array( 
		    $config->getValue( 'config.mailfrom' ),
		    $config->getValue( 'config.fromname' ) );
		 
		$mailer->setSender($sender);	
		
		$user =& JFactory::getUser();
		
		$mailer->addRecipient($postData[0][6]);
		//$mailer->addRecipient('');
		
		$lines = file(JPATH_COMPONENT.DS.'templates'.DS.'MailApplication.html');
	
		foreach($lines as $line)
			$mailTxt = $mailTxt . $line;

	    $mailMasked2 = str_replace("{s_event_category}", $applyEvent[0][3], $mailMasked);
		$mailMasked = str_replace("{s_prename}", $postData[0][1], $mailMasked2);
		$mailMasked2 = str_replace("{s_name}", $postData[0][0], $mailMasked);
		$mailMasked = str_replace("{s_address}", $postData[0][2], $mailMasked2);
		$mailMasked2 = str_replace("{s_plz}", $postData[0][3], $mailMasked);
		$mailMasked = str_replace("{s_city}", $postData[0][4], $mailMasked2);
		$mailMasked2 = str_replace("{s_phone}", $postData[0][5], $mailMasked);
		$mailMasked = str_replace("{s_email}", $postData[0][6], $mailMasked2);
		$mailMasked2 = str_replace("{s_event_date}", $applyEvent[0][0], $mailMasked);
		$mailMasked = str_replace("{s_event_timefrom}", $applyEvent[0][1], $mailMasked2);
		$mailMasked2 = str_replace("{s_event_timeto}", $applyEvent[0][2], $mailMasked);
		$mailMasked = str_replace("{s_event_address}", $applyEvent[0][4], $mailMasked2);
		$mailMasked2 = str_replace("{s_event_price}", $applyEvent[0][5], $mailMasked);
		$mailMasked = str_replace("{s_ouremail}", $config->getValue( 'config.mailfrom' ), $mailMasked2);
		$mailMasked2 = str_replace("{s_oursignature}", $config->getValue( 'config.fromname' ), $mailMasked);
		$mailMasked = str_replace("{s_ourname}", $config->getValue( 'config.sitename' ), $mailMasked2);
		
		$admc = new jEventAdminConfig();
 		$mailMasked2 = str_replace("{s_ourphone}", $admc->phonenumber, $mailMasked);
		$mailMasked = str_replace("{s_title}", $postData[0][8], $mailMasked2);
		$mailMasked2 = $mailMasked;
		
		$subjectMasked2 = str_replace("{s_event_category}", $applyEvent[0][3], $subjectMasked);
		$subjectMasked = str_replace("{s_prename}", $postData[0][1], $subjectMasked2);
		$subjectMasked2 = str_replace("{s_name}", $postData[0][0], $subjectMasked);
		$subjectMasked = str_replace("{s_address}", $postData[0][2], $subjectMasked2);
		$subjectMasked2 = str_replace("{s_plz}", $postData[0][3], $subjectMasked);
		$subjectMasked = str_replace("{s_city}", $postData[0][4], $subjectMasked2);
		$subjectMasked2 = str_replace("{s_phone}", $postData[0][5], $subjectMasked);
		$subjectMasked = str_replace("{s_email}", $postData[0][6], $subjectMasked2);
		$subjectMasked2 = str_replace("{s_event_date}", $applyEvent[0][0], $subjectMasked);
		$subjectMasked = str_replace("{s_event_timefrom}", $applyEvent[0][1], $subjectMasked2);
		$subjectMasked2 = str_replace("{s_event_timeto}", $applyEvent[0][2], $subjectMasked);
		$subjectMasked = str_replace("{s_event_address}", $applyEvent[0][4], $subjectMasked2);
		$subjectMasked2 = str_replace("{s_event_price}", $applyEvent[0][5], $subjectMasked);
		$subjectMasked = str_replace("{s_ouremail}", $config->getValue( 'config.mailfrom' ), $subjectMasked2);
		$subjectMasked2 = str_replace("{s_oursignature}", $config->getValue( 'config.fromname' ), $subjectMasked);
		$subjectMasked = str_replace("{s_ourname}", $config->getValue( 'config.sitename' ), $subjectMasked2);
		
 		$subjectMasked2 = str_replace("{s_ourphone}", $admc->phonenumber, $subjectMasked);
		$subjectMasked = str_replace("{s_title}", $postData[0][8], $subjectMasked2);
		$subjectMasked2 = $subjectMasked;
		
		$mailer->isHTML(true);
		$mailer->Encoding = 'base64';
		$mailer->setBody($mailMasked2);
		$mailer->setSubject($subjectMasked2);
			
		// Optionally add embedded image
		//$mailer->AddEmbeddedImage('C:'.DS.'xampp'.DS.'htdocs'.DS.'fahrschule2'.DS.'modules'.DS.'mod_hello_world2'.DS.'img'.DS.'ulistein.jpg', 'logo_id', 'logo.jpg', 'base64', 'image/jpeg' );
		
		$send =& $mailer->Send();
		if ( $send !== true ) {
		    //echo 'Error sending email: ' . $send->message;
		    $this->error = 'Error sending email: ' . $send->message;
		    return false;
		} else {
		    //echo 'Mail sent';
		    return true;
		}
	}
	/*
	function sendApplicationEmail($postData, $applyEvent){
			
		$mailer =& JFactory::getMailer();
		
		$config =& JFactory::getConfig();
		$sender = array( 
		    $config->getValue( 'config.mailfrom' ),
		    $config->getValue( 'config.fromname' ) );
		 
		$mailer->setSender($sender);	
		
		$user =& JFactory::getUser();
		
		$mailer->addRecipient($postData['dsr_txt_email']);
		//$mailer->addRecipient('');
		
		$lines = file(JPATH_COMPONENT.DS.'templates'.DS.'MailApplication.html');
	
		foreach($lines as $line)
			$mailTxt = $mailTxt . $line;

	    $body = JText::sprintf($mailTxt /*'COM_JEVENT_TXT_APPLY_EMAIL_MESSAGE'*//*, 
	    	$applyEvent[0][3], $applyEvent[0][3], 
	    	$applyEvent[0][0], $applyEvent[0][1], 
	    	$applyEvent[0][2], $applyEvent[0][4], 
	    	$applyEvent[0][5], $postData['dsr_txt_prename'],
	    	$postData['dsr_txt_name'], $postData['dsr_txt_address'],
	    	$postData['dsr_txt_plz'], $postData['dsr_txt_city'],
	    	$postData['dsr_txt_phone'], $postData['dsr_txt_email'] );
		
		$mailer->isHTML(true);
		$mailer->Encoding = 'base64';
		$mailer->setBody($body);
		$mailer->setSubject(JText::sprintf('COM_JEVENT_TXT_APPLY_EMAIL_SUBJECT', 
			$applyEvent[0][3], $applyEvent[0][0], 
			$applyEvent[0][1], $applyEvent[0][2]));
			
		// Optionally add embedded image
		$mailer->AddEmbeddedImage('C:'.DS.'xampp'.DS.'htdocs'.DS.'fahrschule2'.DS.'modules'.DS.'mod_hello_world2'.DS.'img'.DS.'ulistein.jpg', 'logo_id', 'logo.jpg', 'base64', 'image/jpeg' );
		
		$send =& $mailer->Send();
		if ( $send !== true ) {
		    //echo 'Error sending email: ' . $send->message;
		    $this->error = 'Error sending email: ' . $send->message;
		    return false;
		} else {
		    //echo 'Mail sent';
		    return true;
		}
	}
	
	function sendCancelEmail($emailAdr, $eventId){
	
		$applyEvent = ModHelloWorld2Helper::getEventById($eventId);
		
		$mailer =& JFactory::getMailer();
		
		$config =& JFactory::getConfig();
		$sender = array( 
		    $config->getValue( 'config.mailfrom' ),
		    $config->getValue( 'config.fromname' ) );
		 
		$mailer->setSender($sender);	
		
		$user =& JFactory::getUser();
		//$recipient = $user->email;
		
		$mailer->addRecipient($emailAdr);
		
		$body   = '<h2>Abmeldebestätigung zu Lektion</h2>'
	    . '<a href="http://localhost/fahrschule2/index.php/hello-module?eventListId=1" target="_blank"><b>'. JText::_('LBLLESSION') . ': ' . $applyEvent[0][2] . '</b></a><br/>' .
		JText::_('LBLDATE') . ': ' . $applyEvent[0][0] . '<br/>' . JText::_('LBLTIME') . ': ' . $applyEvent[0][1] . '<br/>' . 
		JText::_('LBLPLACE') . ': <a href="' . $gMapLink . $applyEvent[0][3] . '" target="_blank">'  . $applyEvent[0][3] . '</a><br/><br/>' . 
	    '<img src="cid:logo_id" alt="logo"/>';
		$mailer->isHTML(true);
		$mailer->Encoding = 'base64';
		$mailer->setBody($body);
		$mailer->setSubject(JText::sprintf('LBLAPPLICATIONEMAILSUBJECT', $applyEvent[0][2], $applyEvent[0][0], $applyEvent[0][1]));//'Anmeldung zu Letion am ');
		// Optionally add embedded image
		$mailer->AddEmbeddedImage('C:'.DS.'xampp'.DS.'htdocs'.DS.'fahrschule2'.DS.'modules'.DS.'mod_hello_world2'.DS.'img'.DS.'ulistein.jpg', 'logo_id', 'logo.jpg', 'base64', 'image/jpeg' );
		
		$send =& $mailer->Send();
		if ( $send !== true ) {
		    echo 'Error sending email: ' . $send->message;
		    return false;
		} else {
		    //echo 'Mail sent';
		    return true;
		}
	}*/
}
?>
