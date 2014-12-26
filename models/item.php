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

jimport('joomla.application.component.model');
class JMailUnsubscribeModelItem extends JModel {
	/**
	* Item id
	*
	* @var int
	*/
	var $_id = null;
	/**
	* Item option
	*
	* @var int
	*/
	var $_alert_option = null;
	/**
	* Item data
	*
	* @var array
	*/
	var $_data = null;
	/**
	* Constructor
	*
	*/
	function __construct() {
		parent::__construct();
		$array = JRequest::getVar('cid', array(0), '', 'array');
		$edit = JRequest::getVar('edit',true);
		if($edit)
		$this->setId((int)$array[0]);
	}
	/**
	* Method to set the item identifier
	*
	* @access public
	* @param int Item identifier
	*/
	function setId($id) {
		// Set item id and wipe data
		$this->_id = $id;
		$this->_data = null;
	}
	/**
	* Method to get a item
	*
	*/
	function &getData() {
		// Load the item data
		if ($this->_loadData()) {
			// removed unnecessary checks
		} else {
			$this->_initData();
		}
		return $this->_data;
	}
	/**
	* Method to store the item
	*
	* @access public
	* @return boolean True on success
	*/
	function store($data) {
		$row =& $this->getTable();
		// Bind the form fields to the item table
		if (!$row->bind($data)) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}
		// Make sure the item table is valid
		if (!$row->check()) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}

// 		$query = "UPDATE #__email_alert SET option = '" . $data->option . "' WHERE id = " . $data->cid;
		
// 		$this->_db->setQuery ( $query );
// 		$result = $this->_db->query ();
		
// 		if ($this->_db->getErrorMsg ()) {
// 			$this->setError($this->_db->getErrorMsg());
// 			return false;
// 		}
		
		// Store the item table to the database
		if (!$row->store()) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}
		return true;
	}
	/**
	* Method to remove a item
	*
	* @access public
	* @return boolean True on success
	*/
	function delete($cid = array()) {
	$result = false;
	if (count( $cid )) {
		JArrayHelper::toInteger($cid);
		$cids = implode( ',', $cid );
		$query = 'DELETE FROM #__jmailunsubscribe'
		. ' WHERE id IN ( '.$cids.' )';
		$this->_db->setQuery( $query );
		if(!$this->_db->query()) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}
	}
	return true;
	}
	/**
	* Method to move a item
	*
	* @access public
	* @return boolean True on success
	*/
	function saveorder($cid = array(), $order) {
		$row =& $this->getTable();
		$groupings = array();
		// update ordering values
		for( $i=0; $i < count($cid); $i++ ) {
			$row->load( (int) $cid[$i] );
			// track categories
			$groupings[] = $row->catid;
			if ($row->ordering != $order[$i]) {
				$row->ordering = $order[$i];
				if (!$row->store()) {
					$this->setError($this->_db->getErrorMsg());
					return false;
				}
			}
		}
		// execute updateOrder for each parent group
		$groupings = array_unique( $groupings );
		foreach ($groupings as $group) {
			$row->reorder('catid = '.(int) $group);
		}
		return true;
	}
	/**
	* Method to load content item data
	*
	* @access private
	* @return boolean True on success
	*/
	function _loadData() {
		// Lets load the item if it doesn't already exist
		if (empty($this->_data)) {
			$query = 'SELECT
						a.id as alert_id, a.option as alert_option, u.username as user_pseudo, u.name as user_name, u.email as user_email
					  FROM
						#__email_alert as a
					  LEFT JOIN
						#__users as u
					  ON  
						a.user_id = u.id
					  WHERE 
						a.id = ' . (int) $this->_id;
			$this->_db->setQuery($query);
			$this->_data = $this->_db->loadObject();
			$this->_option = $this->_data->alert_option;
			return (boolean) $this->_data;
		}
		return true;
	}
	
	/**
	 * Method to initialise the item data
	 *
	 * @access private
	 * @return boolean True on success
	 */
	function _initData() {
		// Lets load the item if it doesn't already exist
		if (empty($this->_data)) {
			$item = new stdClass();
			$item->id = 0;
			$item->alert_option = 0;
			$this->_data = $item;
				
			return (boolean) $this->_data;
		}
		return true;
	}
}
	