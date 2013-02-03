<?php
// No direct access
defined('_JEXEC') or die('Restricted access');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
//$params = $this->form->getFieldsets('params');
?>
<form action="<?php echo JRoute::_('index.php?option=com_uslugi&layout=edit&id=' . (int) $this->item->id); ?>" method="post" name="adminForm" id="uslugi-form" class="form-validate">

    <div class="width-60 fltlft">
        <fieldset class="adminform">
            <legend><?php echo $this->caditem['name']; ?></legend>
            <ul class="adminformlist">
                <?php foreach ($this->form->getFieldset('caditem') as $field): ?>
                    <li><?php echo $field->label;
                    echo $field->input; ?></li>
                <?php endforeach; ?>
            </ul>
    </div>

    <div>
        <input type="hidden" name="alias" value="<?=$this->caditem['alias']?>" />
        <input type="hidden" name="task" value="uslugi.edit" />
<?php echo JHtml::_('form.token'); ?>
    </div>
</form>
