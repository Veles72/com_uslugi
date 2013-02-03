<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
// load tooltip behavior
JHtml::_('behavior.tooltip');
?>
<form id="admin_form" action="<?php echo JRoute::_('index.php?option=com_uslugi'); ?>" method="post" name="adminForm">
    <div class="form-header">
        <?=$this->tablelists?>
    </div>
	<table class="adminlist">
		<thead><?php echo $this->loadTemplate('head');?></thead>
		<tfoot><?php echo $this->loadTemplate('foot');?></tfoot>
		<tbody><?php echo $this->loadTemplate('body');?></tbody>
	</table>
	<div>
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="option" value="com_uslugi" />
		<input type="hidden" name="view" value="caditems" />
		<input type="hidden" name="boxchecked" value="0" />
		<?php echo JHtml::_('form.token'); ?>
	</div>
</form>
<script type="text/javascript">
    jQuery(document).ready(function($){
        $('#table_list').change(function(){
          $('#admin_form').submit();  
        });
    });
</script>    
    