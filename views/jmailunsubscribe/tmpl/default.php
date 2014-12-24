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
					<th width="15%" class="title">
						<?php echo JHTML::_('grid.sort', 'Name', 'user_name', $this->lists['order_Dir'], $this->lists['order'] ); ?>
					</th>
					<th width="150" class="title">
						<?php echo JHTML::_('grid.sort', 'Pseudo', 'user_pseudo', $this->lists['order_Dir'], $this->lists['order'] ); ?>
					</th>
					<th class="title">
						<?php echo JHTML::_('grid.sort', 'Email', 'user_email', $this->lists['order_Dir'], $this->lists['order'] ); ?>
					</th>
					<th class="title">
						<?php echo JHTML::_('grid.sort', 'Registered', 'user_regdate', $this->lists['order_Dir'], $this->lists['order'] ); ?>
					</th>
					<th class="title">
						<?php echo JHTML::_('grid.sort', 'Last login', 'user_lastvisit', $this->lists['order_Dir'], $this->lists['order'] ); ?>
					</th>
					<th width="1%" nowrap="nowrap">
						<?php echo JHTML::_('grid.sort', 'Alert ID', 'alert_id', $this->lists['order_Dir'], $this->lists['order'] ); ?>
					</th>
					<th width="1%" class="title">
						<?php echo JHTML::_('grid.sort', 'Alert name', 'alert_name', $this->lists['order_Dir'], $this->lists['order'] ); ?>
					</th>
					<th width="1%" class="title">
						<?php echo JHTML::_('grid.sort', 'Alert option', 'alert_option', $this->lists['order_Dir'], $this->lists['order'] ); ?>
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
						$link = JRoute::_ ( 'index.php?option=com_jmailunsubscribe&view=item&task=edit&cid[]=' . $row->alert_id );
						$checked = JHTML::_ ( 'grid.checkedout', $row, $i );
						?>
				<tr class="<?php echo "row$k"; ?>">
					<td>
						<?php echo $this->pagination->getRowOffset( $i ); ?>
					</td>
					<td>
						<?php echo $checked; ?>
					</td>
					<td align="left">
						<?php echo $row->user_name; ?>
					</td>
					<td align="left">
						<?php echo $row->user_pseudo; ?>
					</td>
					<td align="left">
						<?php echo $row->user_email; ?>
					</td>
					<td align="left"><?php echo $row->user_regdate; ?>
					</td>
					<td align="left"><?php echo $row->user_lastvisit; ?>
					</td>
					<td align="center">
						<a href="<?php echo $link; ?>" title="<?php echo JText::_( 'Edit' ); ?>">
						<?php echo $row->alert_id; ?></a>
					</td>
					<td align="left">
						<?php echo $row->alert_name; ?>
					</td>
					<td align="center">
						<?php echo $row->alert_option; ?>
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
