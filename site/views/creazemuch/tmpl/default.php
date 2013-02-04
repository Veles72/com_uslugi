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
    #uslugi-step-container{width: 1000px; height: auto}
    #to-step_2{float: right}
    #to-step_1{float: left; display: none}
    #usligi-form-submit{float: right;}
    div.uslugi-clear{clear: both}
    span.uslugi-button{width: 100px; cursor: pointer}
</style>
<script type="text/javascript">
    jQuery(document).ready(function($){
        $.mask.definitions['#']='[9]';  
        $("#jform_phone").mask("+7(#99) 999-99-99");
        
        $('#usligi-form-submit').click(function(){
            form = $('#uslugi-form').submit();
        });
        $('#to-step_2').click(function(){
            $('#uslugi-step-container').animate({"margin-left": "-500px"}, "slow");
            $('#to-step_2').fadeTo('slow', 0);
            $('#to-step_1').fadeTo('slow', 1);
        });
        $('#to-step_1').click(function(){
            $('#uslugi-step-container').animate({"margin-left": "0"}, "slow");
            $('#to-step_1').fadeTo('slow', 0);
            $('#to-step_2').fadeTo('slow', 1);
        });
    });
</script>
<div id="uslugi-main">
    <div id="uslugi-step-container">
<form action="<?php echo $form_action ?>" method="post" name="adminForm" id="uslugi-form" class="form-validate">
        <div class="uslugi-step">
        <fieldset class="step-1">
            <legend>
                <?php echo empty($this->item->id) ? JText::_('COM_USLUGI_NEW_USLUGA') : JText::sprintf('COM_USLUGI_EDIT_USLUGA_DETAILS', $this->item->id); ?>
            </legend>
            <table>
                <tr>
                    <td><?=$this->form->getLabel('clienttype_id')?></td>
                    <td><?=$this->form->getInput('clienttype_id')?></td>
                </tr>
                <tr>
                    <td><?=$this->form->getLabel('rayon_id')?></td>
                    <td><?=$this->form->getInput('rayon_id')?>
                       <?=$this->form->getInput('rayon_text')?></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <span><?=JTEXT::_('COM_USLUGI_COST')?></span>
                        <ul>
                        <?php foreach($this->tablelist['square'] as $row):?>
                            <li><?='земельный участок '.$row->name.' ('.$row->price.'р.)'?></li>
                        <?php endforeach;?>
                        </ul>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <?=JTEXT::_('COM_USLUGI_END_MEG_PLAN')?>
                        <?=JTEXT::_('COM_USLUGI_END_MEG_PLAN_START_TIPE')?>
                        <span class="com_uslugi-tooltipe"><?=JTEXT::_('COM_USLUGI_WHOT_IT_IS')?></span>
                        <?=JTEXT::_('COM_USLUGI_END_TIPE')?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <?=JTEXT::_('COM_USLUGI_DOP_MEG_PLAN_1')?> <?=$this->form->getInput('ex_count')?> <?=JTEXT::_('COM_USLUGI_DOP_MEG_PLAN_2')?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?=JTEXT::_('COM_USLUGI_TRAST_INPUT_DATA_SQUARE')?>
                        <?=JTEXT::_('COM_USLUGI_INPUT_DATA_SQUARE_START_TIPE')?>
                        <span class="com_uslugi-tooltipe"><?=JTEXT::_('COM_USLUGI_WHOT_IT_IS')?></span>
                        <?=JTEXT::_('COM_USLUGI_END_TIPE')?>
                    </td>
                    <td><?=$this->form->getInput('trust_saved')?></td>
                </tr>
            </table>
        </fieldset>
        </div>
        <div class="uslugi-step">
            <fieldset class="step-2">
                <?php foreach($this->form->getFieldset('step_2') as $field): ?>
                        <li><?php echo $field->label; ?>
                                <?php echo $field->input; ?></li>
                <?php endforeach; ?>
            </fieldset>
        <span id="usligi-form-submit" class="uslugi-button"><?=JText::_('COM_USLUGI_FORM_SUBMIT')?></span>
        </div>
        <input type="hidden" name="controller" value="upduslugi" />
        <input type="hidden" name="task" value="uslugi.submit" />
        <?php echo JHtml::_('form.token'); ?>
</form>
    </div>
    <div class="uslugi-clear"></div>
    <span id="to-step_1" class="uslugi-button"><?=JText::_('COM_USLUGI_TO_STEP_1')?></span>
    <span id="to-step_2" class="uslugi-button"><?=JText::_('COM_USLUGI_TO_STEP_2')?></span>
</div>
