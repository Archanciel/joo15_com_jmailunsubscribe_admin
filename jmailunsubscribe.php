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

// Require the base controller
require_once (JPATH_COMPONENT . DS . 'controller.php');

$controller = new JMailUnsubscribeController ();

// Perform the Request task
$controller->execute ( JRequest::getCmd ( 'task' ) );
$controller->redirect ();
