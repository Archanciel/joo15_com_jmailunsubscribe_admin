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
defined( '_JEXEC' ) or die( 'Restricted access' );


// Include library dependencies
  jimport('joomla.filter.input');
/**
  * JMailUnsubscribe Item Table class
  * @package JMailUnsubscribe
  */
  class TableItem extends JTable {
  /**
  * Primary Key
  *
  * @var int
  */
  var $id = null;
 /**
  * @var int
  */
  var $catid = null;
 /**
  * @var string
  */
  var $title = null;
  
  /**
  * @var string
  */
  var $alias = null;

 var $alertid = null;
var $subscribed = null;
var $pluginssubscribedto = null;


 /**
  * @var datetime
  */
  var $created = null;
 /**
  * @var int
  */
  var $created_by = null;
 /**
  * @var string
  */
  var $created_by_alias = null;
 /**
  * @var datetime
  */
  var $modified = null;

 /**
  * @var int
  */
  var $modified_by = null;
 /**
  * @var boolean
  */
  var $checked_out = 0;
 /**
  * @var time
  */
  var $checked_out_time = 0;
 /**
  * @var int
  */
  var $published = null;
   /**
  * @var int
  */
  var $ordering = null;
 /**
  * @var int
  */
  var $hits = null;
	/**
	 * @var int
	 */
	 var $params = null;

 /**
  * Constructor
  *
  * @param object Database connector object
  */
  function __construct(& $db) {
  	parent::__construct('#__jmailunsubscribe', 'id', $db);
  }
 /**
  * Overloaded bind function
  *
  * @acces public
  * @param array $hash named array
  * @return null|string null is operation was satisfactory, otherwise returns an error
  * @see JTable:bind
  */
  function bind($array, $ignore = '') {
	  if (key_exists('params', $array) && is_array($array['params'])) {
	  $registry = new JRegistry();
	  $registry->loadArray($array['params']);
	  $array['params'] = $registry->toString();
  }
	// get wysiwyg code
	
	return parent::bind($array, $ignore);
  }
 /**
  * Overloaded check method to ensure data integrity
  *
  * @access public
  * @return boolean True on success
  */
  function check() {
	  /** check for valid name */
	  if (trim($this->title) == '') {
	  	$this->_error = JText::_('Please provide a valid title');
	  	return false;
  	}
	 /** check for existing name */
	  $query = 'SELECT id FROM #__jmailunsubscribe WHERE title = ' . $this->_db->Quote($this->title) . ' AND catid = ' . (int) $this->catid;
	  $this->_db->setQuery($query);
	  $xid = intval($this->_db->loadResult());
	  if ($xid && $xid != intval($this->id)) {
	  	$this->_error = JText::sprintf('WARNNAMETRYAGAIN', JText::_('Item'));
	  	return false;
  	}
  	if(empty($this->alias)) {
  		$this->alias = $this->title;
  	}
  	$this->alias = JFilterOutput::stringURLSafe($this->alias);
  	if(trim(str_replace('-','',$this->alias)) == '') {
  		$datenow =& JFactory::getDate();
  		$this->alias = $datenow->toFormat("%Y-%m-%d-%H-%M-%S");
  	}
	 jimport('joomla.filter.output');
	 return true;
  }
}