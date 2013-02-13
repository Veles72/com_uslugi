<?php
// No direct access
defined('_JEXEC') or die('Restricted access');

?>
<style type="text/css">
    #uslugi-main{width: 500px; overflow: hidden;}
    #usligi-form-submit{float: right;}
    div.uslugi-clear{clear: both}
    span.uslugi-button{width: 100px; cursor: pointer}
    span.ugoda_text{margin: 0 5px; font-weight: bold}
    span.com_uslugi-tooltipe{margin: 0 5px; font-weight: bold}
    td.align-right{text-align: right}
    .uslugi-hidden{display: none}
</style>
<script type="text/javascript">
    jQuery(document).ready(function($){
        // Инициируем загрузчик
        FileUploader = new file_uploader({
            action:'<?=$this->form_action?>',
            data: {
                    'task':'creazemuch.upload',
                    '<?=JUtility::getToken()?>':'1'
                  },
            max_file_size:1000000,
            file_types:['jpeg','png']
        });
    });

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
        cost_unit:'<?=$this->triggerst['ex_count']?>'
    };
    //Стоимость  процедуры внесения сведений о земельном участке на кадастровый учет
    ComUslugiFormData.trust_saved = {
        cost:'<?=$this->triggerst['trust_saved']?>',
        inp: 1,
        cost_unit:'<?=$this->triggerst['trust_saved']?>'
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
