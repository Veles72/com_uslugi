<?php
// No direct access
defined('_JEXEC') or die('Restricted access');
$form_action = JRoute::_('index.php?option=com_uslugi');
JHtml::_('behavior.formvalidation');
$triggers = array();
foreach($this->tablelist['triggers'] as $row)
{
    $triggers[$row->alias] = $row->price;
}
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
    span.ugoda_text{margin: 0 5px; font-weight: bold}
    span.com_uslugi-tooltipe{margin: 0 5px; font-weight: bold}
    td.align-right{text-align: right}
</style>
<script type="text/javascript">
    // Инициализация данных формы и расчета стоимости
    ComUslugiFormData = new usluga_object();
    //Стоимость земельного участка в зависимости от размера
    ComUslugiFormData.square = {
        cost: '<?=$this->tablelist['square'][0]->price?>',
        inp: '<1500',
        scale: new Array(
        <?php $k=count($this->tablelist['square']);?>
        <?php foreach($this->tablelist['square'] as $row):?>
                <?php $k--; $comma=$k?',':''?>
                {range:<?=$row->range?>,cost:'<?=$row->price?>'}<?=$comma?>
        <?php endforeach?>
            )
    };
    //Стоимость дополнительных экземпляров межевого плана
    ComUslugiFormData.ex_count = {
        cost:'0',
        inp:'0',
        cost_unit:'<?=$triggers['ex_count']?>'
    };
    //Стоимость  процедуры внесения сведений о земельном участке на кадастровый учет
    ComUslugiFormData.trust_saved = {
        cost:'<?=$triggers['trust_saved']?>',
        inp: 1,
        cost_unit:'<?=$triggers['trust_saved']?>'
    };
    //Дополнительная услуга «Доставка на дом» (да, или нет)
    ComUslugiFormData.home_delivery = {
        cost:'0',
        cost_unit:'1'
    };
    //Стоимость доставки на дом в зависимости от района земельного участка
    ComUslugiFormData.rayon_id = {
        cost: '<?=$this->tablelist['rayon'][0]->price?>',
        inp: '',
        scale: new Array(
            <?php $k=count($this->tablelist['rayon']);?>
            <?php foreach($this->tablelist['rayon'] as $row):?>
                <?php $k--; $comma=$k?',':''?>
                {index:<?=$row->id?>,cost:'<?=$row->price?>'}<?=$comma?>
            <?php endforeach?>
                )
    };
    //ИД типа клиента (юр. или физ. лицо)
    ComUslugiFormData.clienttype_id = 1;
    //Тип клиента (юр. или физ. лицо)
    ComUslugiFormData.clienttype = {
        name:'Юр. лицо',
        names: new Array(
                    {index:1,name:'Физ. лицо'},
                    {index:2,name:'Юр. лицо'}
                )
    };
    //Адрес земельного участка
    ComUslugiFormData.rayon_text = '';
</script>
<h1><?=JText::_('COM_USLUGI_CREAZEMUCH')?></h1>
<div id="uslugi-main">
    <div id="uslugi-step-container">
<form action="<?=$form_action ?>" method="post" name="adminForm" id="uslugi-form" class="form-validate">
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
                    <td colspan="2">
                        <?=JText::_('COM_USLUGI_CREAZEMUCH_TEXT_7')?>
                        <?=JText::_('COM_USLUGI_CREAZEMUCH_TEXT_8')?>
                        <span class="com_uslugi-tooltipe"><?=JTEXT::_('COM_USLUGI_WHOT_IT_IS')?></span>
                        <?=JTEXT::_('COM_USLUGI_END_TIPE')?>
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
<form method="post" action="<?=$form_action?>" enctype="multipart/form-data">
        <input type="file" name="Filedata" id="Filedata" />
        <input type="submit" value="Upload" />
        <input type="hidden" name="task" value="creazemuch.upload" />
        <?=JHtml::_('form.token'); ?>
</form>
