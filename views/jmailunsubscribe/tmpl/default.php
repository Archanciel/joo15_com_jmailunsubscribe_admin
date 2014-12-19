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
?>
<?php JHTML::_('behavior.tooltip'); ?>
<?php
// Set toolbar items for the page
JToolBarHelper::title ( JText::_ ( 'JMailUnsubscribe' ), 'generic.png' );
JToolBarHelper::publishList ();
JToolBarHelper::unpublishList ();
JToolBarHelper::deleteList ();
JToolBarHelper::editListX ();
JToolBarHelper::addNewX ();
JToolBarHelper::preferences ( 'com_jmailunsubscribe', '550' );
?>
<form action="index.php" method="post" name="adminForm">
	<table>
		<tr>
			<td align="left" width="100%">
				<?php echo JText::_( 'Filter' ); ?>:
				<input type="text" name="search" id="search"
				value="<?php echo $this->lists['search'];?>" class="text_area"
				onchange="document.adminForm.submit();" />
				<button onclick="this.form.submit();"><?php echo JText::_( 'Go' ); ?></button>
				<button
					onclick="document.getElementById('search').value='';this.form.submit();"><?php echo JText::_( 'Reset' ); ?></button>
			</td>
			<td nowrap="nowrap">
				<?php
				echo $this->lists ['state'];
				?>
			</td>
		</tr>
	</table>
	<div id="editcell">
		<table class="adminlist">
			<thead>
				<tr>
					<th width="5">
					<?php echo JText::_( 'NUM' ); ?>
				</th>
					<th width="20"><input type="checkbox" name="toggle" value=""
						onclick="checkAll(<?php echo count( $this->items ); ?>);" /></th>
					<th width="150" class="title">
					<?php echo JHTML::_('grid.sort', 'Title', 'a.title', $this->lists['order_Dir'], $this->lists['order'] ); ?>
				</th>
					<th width="5%" nowrap="nowrap">
					<?php echo JHTML::_('grid.sort', 'Published', 'a.published', $this->lists['order_Dir'], $this->lists['order'] ); ?>
				</th>
					<th width="15%" class="title">
					<?php echo JHTML::_('grid.sort', 'Category', 'category', $this->lists['order_Dir'], $this->lists['order'] ); ?>
				</th>
					<th class="title">
					<?php echo JHTML::_('grid.sort', 'Created By', 'a.created_by', $this->lists['order_Dir'], $this->lists['order'] ); ?>
				</th>
					<th width="1%" nowrap="nowrap">
					<?php echo JHTML::_('grid.sort', 'ID', 'a.id', $this->lists['order_Dir'], $this->lists['order'] ); ?>
				</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<td colspan="12">
				<?php echo $this->pagination->getListFooter(); ?>
			</td>
				</tr>
			</tfoot>
			<tbody>
<?php
$k = 0;
if (count ( $this->items ) > 0) {
	for($i = 0, $n = count ( $this->items ); $i < $n; $i ++) {
		$row = &$this->items [$i];
		$link = JRoute::_ ( 'index.php?option=com_jmailunsubscribe&view=item&task=edit&cid[]=' . $row->id );
		$checked = JHTML::_ ( 'grid.checkedout', $row, $i );
		// You can use different time formats , DATE_FORMAT_LC1 DATE_FORMAT_LC2 DATE_FORMAT_LC3 DATE_FORMAT_LC4 , These are defined in the language file
		$datecreated = JHTML::_ ( 'date', $row->created, JText::_ ( 'DATE_FORMAT_LC3' ) );
		if ($row->modified = "0000-00-00 00:00:00") {
			$datemodified = JText::_ ( 'not modified' );
		} else {
			$datemodified = JHTML::_ ( 'date', $row->modified, JText::_ ( 'DATE_FORMAT_LC4' ) );
		}
		$published = JHTML::_ ( 'grid.published', $row, $i );
		$row->cat_link = JRoute::_ ( 'index.php?option=com_categories&section=com_jmailunsubscribe&task=edit&type=other&cid[]=' . $row->catid );
		?>
	<tr class="<?php echo "row$k"; ?>">
					<td>
		<?php echo $this->pagination->getRowOffset( $i ); ?>
	</td>
					<td>
<?php echo $checked; ?>
</td>
					<td>
<?php
		if (JTable::isCheckedOut ( $this->user->get ( 'id' ), $row->checked_out )) {
			echo $row->title;
		} else {
			?>
<a href="<?php echo $link; ?>" title="<?php echo JText::_( 'Edit' ); ?>">
<?php echo $row->title; ?></a>
<?php
		}
		?>
</td>
					<td align="center">
<?php echo $published;?>

					
					<td><a href="<?php echo $row->cat_link; ?>"
						title="<?php echo JText::_( 'Edit Category' ); ?>">
<?php echo $row->category; ?>
</a></td>
					<td align="left"><?php echo $row->author; ?>
</td>

					<td align="center">
<?php echo $row->id; ?>
</td>
				</tr>
<?php
		$k = 1 - $k;
	}
} else {
	?>
<tr>
					<td colspan="11">
<?php echo JText::_( 'There are no items present' ); ?>
</td>
				</tr>
<?php
}
?>
</tbody>
		</table>
	</div>
	<input type="hidden" name="option" value="com_jmailunsubscribe" /> <input
		type="hidden" name="task" value="" /> <input type="hidden"
		name="boxchecked" value="0" /> <input type="hidden"
		name="filter_order" value="<?php echo $this->lists['order']; ?>" /> <input
		type="hidden" name="filter_order_Dir" value="" />
</form>
<div>
	Diese Komponente wurde mit <a href="http://joodo.hopper-intermedia.de">jooDo!</a>
	erstellt. Ein Service von <a href="http://hopper-intermedia.de">hopper
		intermedia</a>.
</div>