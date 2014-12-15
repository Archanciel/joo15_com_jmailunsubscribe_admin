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
class JElementItem extends JElement {
	/**
	* Element name
	*
	* @access protected
	* @var string
*/
	var $_name = 'Item';
	function fetchElement($name, $value, &$node, $control_name) {
		$db = &JFactory::getDBO();
 		$query = 'SELECT a.id, CONCAT( a.title ) AS text, a.catid '
	  . ' FROM #__jmailunsubscribe AS a'
	  . ' INNER JOIN #__categories AS c ON a.catid = c.id'
	  . ' WHERE a.published = 1'
	  . ' AND c.published = 1'
	  . ' ORDER BY a.catid, a.title'
	  ;
	  $db->setQuery( $query );
	  $options = $db->loadObjectList( );
	 	return JHTML::_('select.genericlist', $options, ''.$control_name.'['.$name.']', 'class="inputbox"', 'id', 'text', $value, $control_name.$name );
	}
}