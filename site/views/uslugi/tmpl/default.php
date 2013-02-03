<?php
// No direct access
defined('_JEXEC') or die('Restricted access');
$form_action = JRoute::_('index.php?option=com_uslugi');
JHtml::_('behavior.formvalidation');
$document =& JFactory::getDocument();
$document->addScript(JURI::base().'media/com_uslugi/js/jquery.maskedinput-1.3.min.js');
?>
<style type="text/css">
    #uslugi-main{width: 500px; overflow: hidden;}
    .uslugi-step{width: 500px; float: left;}
    #uslugi-step-container{width: 1000px; height: 200px}
    #to-step_3{float: right}
    #to-step_2{float: left; display: none}
    #usligi-form-submit{float: right;}
    div.uslugi-clear{clear: both}
    span.uslugi-button{width: 100px; cursor: pointer}
</style>
<script type="text/javascript">
    jQuery(document).ready(function($){
        $.mask.definitions['#']='[9]';  
        $("#jform_phone").mask("+7(#99) 999-99-99");
//        $("#jform_phone").removeAttr('aria-invalid');
        
        $('#usligi-form-submit').click(function(){
            form = $('#uslugi-form').submit();
        });
        $('#to-step_3').click(function(){
            $('#uslugi-step-container').animate({"margin-left": "-500px"}, "slow");
            $('#to-step_3').fadeTo('slow', 0);
            $('#to-step_2').fadeTo('slow', 1);
        });
        $('#to-step_2').click(function(){
            $('#uslugi-step-container').animate({"margin-left": "0"}, "slow");
            $('#to-step_2').fadeTo('slow', 0);
            $('#to-step_3').fadeTo('slow', 1);
        });
    });
</script>
<h1><?=$this->title?></h1>
<div id="uslugi-main">
    <div id="uslugi-step-container">
<form action="<?php echo $form_action ?>" method="post" name="adminForm" id="uslugi-form" class="form-validate">
        <div class="uslugi-step">
        <fieldset class="step-2">
            <legend>
                <?php echo empty($this->item->id) ? JText::_('COM_USLUGI_NEW_USLUGA') : JText::sprintf('COM_USLUGI_EDIT_USLUGA_DETAILS', $this->item->id); ?>
            </legend>
                <ul class="adminformlist">
                    <?if($this->item->id == 0):?>
			<?php foreach($this->form->getFieldset('new_'.$this->alias) as $field): ?>
				<li><?php echo $field->label; ?>
					<?php echo $field->input; ?></li>
			<?php endforeach; ?>
                    <?php else:?>
			<?php foreach($this->form->getFieldset('edit_'.$this->alias) as $field): ?>
				<li><?php echo $field->label; ?>
					<?php echo $field->input; ?></li>
			<?php endforeach; ?>
                    <?php endif?>
                </ul>
        </fieldset>
        </div>
        <div class="uslugi-step">
            <fieldset class="step-3">
                <?php foreach($this->form->getFieldset('step_3') as $field): ?>
                        <li><?php echo $field->label; ?>
                                <?php echo $field->input; ?></li>
                <?php endforeach; ?>
            </fieldset>
            <fieldset class="client-data">
                <?php foreach($this->form->getFieldset('client_data') as $field): ?>
                        <li><?php echo $field->label; ?>
                                <?php echo $field->input; ?></li>
                <?php endforeach; ?>
            </fieldset>
        <span id="usligi-form-submit" class="uslugi-button"><?=JText::_('COM_USLUGI_FORM_SUBMIT')?></span>
        </div>
        <input type="hidden" name="controller" value="upduslugi" />
        <input type="hidden" name="task" value="uslugi.submit" />
        <input type="hidden" name="alias" value="<?=$this->alias?>" />
        <?php echo JHtml::_('form.token'); ?>
</form>
    </div>
    <div class="uslugi-clear"></div>
    <span id="to-step_2" class="uslugi-button"><?=JText::_('COM_USLUGI_TO_STEP_2')?></span>
    <span id="to-step_3" class="uslugi-button"><?=JText::_('COM_USLUGI_TO_STEP_3')?></span>
</div>
