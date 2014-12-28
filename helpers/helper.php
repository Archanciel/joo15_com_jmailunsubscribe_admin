<?php
/**
 * Joomla! 1.5 component jmailunsubscribe
 * Code generated by : Joomla! 1.5 MVC Component Code Generator
 * http://www.hopper-intermedia.de
 * date generated: 2014-12-15
 * @version 0.8
 * @author Jean-Pierre Schnyder 
 * @package com_jmailunsubscribe
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 **/

// no direct access
defined ( '_JEXEC' ) or die ( 'Restricted access' );

require_once JPATH_COMPONENT_ADMINISTRATOR . '/models/item.php';

/**
 *
 * @package jmailunsubscribe
 *         
 */
class JMailUnsubscribeHelper {
	/**
	 * This method handles the user click on the unsubcribe link included in the plusconscient
	 * newsletters.
	 * 
	 * Link included (999 is the jos_email_alert id):
	 * http://localhost/plusconscient15_dev/index.php?option=com_jmailunsubscribe&unsubscribe=999
	 * 
	 * @param unknown $alertId
	 */
	public static function execUnsubscribe($alertId) {
		jimport ( 'joomla.error.log' );
		
		/* @var $db JDatabase */
		$db = JFactory::getDBO ();
		$query = "UPDATE #__email_alert as a SET a.option = 0 WHERE id = $alertId";
		
		self::executeQuery ( $db, $query );
		
		$item = new JMailUnsubscribeModelItem ();
		$item->setId($alertId);
		$alert_data = $item->getData ();
		
		$user_name = $alert_data->user_name;
		$user_email = $alert_data->user_email;
		$alert_name = $alert_data->alert_name;
		$user_regdate = $alert_data->user_reg_date;
		$user_lastvisit = $alert_data->user_last_visit_date;
		
		self::mailUnsubscribeConfirmation ( $user_email, $alert_name );

		$logEntry = array (
				'LEVEL' => '1',
				'STATUS' => 'INFO:',
				'COMMENT' => "Unsubscribed $user_name with email $user_email from list '$alert_name'.\r\nUser reg date / lst login: $user_regdate / $user_lastvisit." 
		);
		
		self::logAndMailToAdmin ("UNSUBSCRIBE PROCESSED" , $logEntry );
	}
	
	private static function executeQuery(JDatabase $db, $query) {
		$db->setQuery ( $query );
		$db->query ();
		
		if ($db->getErrorNum ()) {
			$errorMsg = $db->getErrorMsg ();
			// print_r( $e );
			$logEntry = array (
					'LEVEL' => '1',
					'STATUS' => 'ERROR:',
					'COMMENT' => "UNSUBSCRIPTION PROBLEM ENCOUNTERED.\r\nERROR MSG FOLLOWS:\r\n$errorMsg\r\n" 
			);
			self::logAndMailToAdmin ( 'Dailystats Cron ERROR', $logEntry );
			
			// throwing an exception instead of using JError::raiseError() makes it possible to
			// unit test the caae causing the exception. In the browser, this simply results in
			// a regular PHP orange error page which displays much more useful infos than JError does !
			// And anyway, we are in a CRON triggered action. No user would see such a page !
			// JError::raiseError ( 500, $errorMsg );
			
			throw new Exception ( $errorMsg );
		}
	}

	public static function mailUnsubscribeConfirmation( $user_email, $newsletter_name) {
		$unsubscribeConfirmMailBody = "Suite à votre demande, votre email '$user_email' a été supprimé de la liste de distribution '$newsletter_name' émise par <a href=\"http://plusconscient.net/\">Plusconscient.net</a>.\r\n\r\nCordiales salutations,\r\nJean-Pierre Schnyder, webmaster";
		
		self::sendMail("DESINCRIPTION EFFECTUEE", $unsubscribeConfirmMailBody, $user_email);
	}
	
	private static function logAndMailToAdmin($subject, $logEntry) {
		$log = JLog::getInstance ( "com_jmailunsubscribed.php" );
		$log->addEntry ( $logEntry );
		
		// fetch the site's email address and name from the global configuration. These are set in the
		// administration back-end (Global Configuration -> Server -> Mail Settings)
		
		/* @var $mailThis JFactory */
		$config = JFactory::getConfig ();
		$adminMail = array (
				$config->getValue ( 'config.mailfrom' ),
				$config->getValue ( 'config.fromname' ) 
		);

		self::sendMail($subject, $logEntry ['COMMENT'], $adminMail [0]);
	}	
	
	private static function sendMail($subject, $mailBody, $emailTo) {
		// fetch the site's email address and name from the global configuration. These are set in the
		// administration back-end (Global Configuration -> Server -> Mail Settings)
	
		/* @var $mailThis JFactory */
		$config = JFactory::getConfig ();
		$adminMail = array (
				$config->getValue ( 'config.mailfrom' ),
				$config->getValue ( 'config.fromname' )
		);
	
		/* @var $mailThis JMail */
		$mailThis = JFactory::getMailer ();
		$mailThis->setSender ( $adminMail );
		// $mailThis->addRecipient($adminMail); // Joomla 3
		$mailThis->addRecipient ( $emailTo ); // Joomla 1.5
		$mailThis->setSubject ( $subject );
	
		$mailThis->setBody ( $mailBody );
	
		$mailThis->Send ();
	}
}