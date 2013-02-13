<?php
// No direct access
defined('_JEXEC') or die('Restricted access');
JHtml::_('behavior.formvalidation');
?>
<thead><?php echo $this->loadTemplate('head');?></thead>
<h1><?=JText::_('COM_USLUGI_CREAZEMUCH')?></h1>
<div id="uslugi-main">
    <div id="uslugi-step-container">
<form action="<?=$this->form_action ?>" method="post" name="adminForm" id="uslugi-form" class="form-validate">
        <div class="uslugi-step">
        <fieldset>
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
                    <td>
                        <?=JTEXT::_('COM_USLUGI_LAND_SQUARE_PLACE')?>
                        <?=JTEXT::_('COM_USLUGI_INPUT_SQUARE_PLACE_START_TIPE')?>
                        <span class="com_uslugi-tooltipe"><?=JTEXT::_('COM_USLUGI_WHOT_IT_IS')?></span>
                        <?=JTEXT::_('COM_USLUGI_END_TIPE')?>
                    </td>
                    <td><?=$this->form->getInput('square')?></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <span><?=JTEXT::_('COM_USLUGI_COST')?></span>
                        <ul>
                        <?php foreach($this->tablelist['square'] as $row):?>
                            <li><?=JTEXT::_('COM_USLUGI_LAND_SQUARE')
                                .' '.$row->name.' ('.$row->price
                                .JTEXT::_('COM_USLUGI_RUB').')'?></li>
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
                <tr>
                    <td>
                        <?=JTEXT::_('COM_USLUGI__DOSTAVKA')?>
                        <?=JTEXT::_('COM_USLUGI__DOSTAVKA_START_TIPE')?>
                        <span class="com_uslugi-tooltipe"><?=JTEXT::_('COM_USLUGI_WHOT_IT_IS')?></span>
                        <?=JTEXT::_('COM_USLUGI_END_TIPE')?>
                    </td>
                    <td><?=$this->form->getInput('home_delivery')?></td>
                </tr>
            </table>
        </fieldset>
        <fieldset>
            <table>
                <tr><td colspan="2"><?=JText::_('COM_USLUGI_CREAZEMUCH_TEXT_1')?></td></tr>
                <tr><td colspan="2"><?=JText::_('COM_USLUGI_CREAZEMUCH_TEXT_2')?></td></tr>
                <tr>
                    <td><?=JText::_('COM_USLUGI_CREAZEMUCH_TEXT_3')?></td>
                    <td class="align-right"><span class='ugoda_text' id='ugoda_square_text'>____</span><?=JTEXT::_('COM_USLUGI_KV_M')?></td>
                </tr>
                <tr id="tr_ex_count">
                    <td><?=JText::_('COM_USLUGI_FORM_LBL_EX_COUNT')?></td>
                    <td class="align-right"><span class='ugoda_text' id='ugoda_ex_count_text'>____</span><?=JTEXT::_('COM_USLUGI_SHT')?></td>
                </tr>
                <tr id="tr_trust_saved"><td colspan="2"><?=JText::_('COM_USLUGI_TRUST_SAVED_ADD')?></td></tr>
                <tr>
                    <td><?=JText::_('COM_USLUGI_CREAZEMUCH_TEXT_4')?></td>
                    <td class="align-right"><span class='ugoda_text' id='ugoda_srok_vipolnenia'>____</span><?=JTEXT::_('COM_USLUGI_DNEJ')?></td>
                </tr>
                <tr id="tr_home_delivery"><td colspan="2"><?=JText::_('COM_USLUGI_CREAZEMUCH_TEXT_5')?></td></tr>
                <tr>
                    <td><?=JText::_('COM_USLUGI_CREAZEMUCH_TEXT_6')?></td>
                    <td class="align-right"><span class='ugoda_text' id='ugoda_cost_text'>____</span><?=JTEXT::_('COM_USLUGI_RUB')?></td>
                </tr>
                <tr>
                    <td>
                        <?=JText::_('COM_USLUGI_CREAZEMUCH_TEXT_7')?>
                        <?=JText::_('COM_USLUGI_CREAZEMUCH_TEXT_8')?>
                        <span class="com_uslugi-tooltipe"><?=JTEXT::_('COM_USLUGI_WHOT_IT_IS')?></span>
                        <?=JTEXT::_('COM_USLUGI_END_TIPE')?>
                    </td>
                    <td>
                        <span id="button_pravdoc" class="uslugi-button uslugi-upload"><<Загрузить>></span>
                    </td>
                </tr>
                <tr id="tr_rukov_poln">
                    <td colspan="2">
                        <?=JText::_('COM_USLUGI_CREAZEMUCH_TEXT_9')?>
                        <?=JText::_('COM_USLUGI_CREAZEMUCH_TEXT_10')?>
                        <span class="com_uslugi-tooltipe"><?=JTEXT::_('COM_USLUGI_WHOT_IT_IS')?></span>
                        <?=JTEXT::_('COM_USLUGI_END_TIPE')?>
                    </td>
                </tr>
            </table>
        </fieldset>
        <input type="submit" name="jform_submit" value="<?=JText::_('COM_USLUGI_FORM_SUBMIT')?>">
        </div>
        <input type="hidden" name="jform[cost]" id="jform_cost" value="0" />
        <input type="hidden" name="task" value="creazemuch.submit" />
        <?=JHtml::_('form.token'); ?>
</form>
    </div>
    <div class="uslugi-clear"></div>
</div>
<tfoot><?php echo $this->loadTemplate('foot');?></tfoot
