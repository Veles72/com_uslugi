
window.addEvent('domready', function() {
	document.formvalidator.setHandler('fio',
		function (value) {
			regex=/^[^0-9]+$/;
			return regex.test(value);
	});
});
    jQuery(document).ready(function($){
        // Заполняем таблицу
        fill_table(ComUslugiFormData);
        // Phone input mask
        $.mask.definitions['#']='[9]';  
        $("#jform_phone").mask("+7(#99) 999-99-99");
        // Submit button
        $('#usligi-form-submit').click(function(){
            form = $('#uslugi-form').submit();
        });
        // Slider
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
        /**
         * Обработчик ввода данных
         */

        $( ":input" ).change(function(){
            var name = /^jform_([A-Za-z_]+)\d?$/i.exec($(this).attr('id'))[1];
            var val = $(this).val();
            var count = eval('ComUslugiFormData.get_cost_'+name+'("'+val+'")');
            fill_table(ComUslugiFormData);
            console.log(count);
        });
        
        /**
        *Заполнение таблицы
        */
        function fill_table(FormData)
        {
            $('#cost_square').text(FormData.square.cost);
            $('#inp_square').text(FormData.square.inp);
            $('#cost_ex_count').text(FormData.ex_count.cost);
            $('#inp_ex_count').text(FormData.ex_count.inp);
            $('#cost_trust_saved').text(FormData.trust_saved.cost);
            $('#inp_trust_saved').text(FormData.trust_saved.inp);
            $('#cost_home_delivery').text(FormData.home_delivery.cost);
            $('#inp_home_delivery').text(FormData.home_delivery.inp);
        };
    });
    /**
     * Класс данных формы и расчета стоимости услуги:
     * "Образование земельных участков из земель государственной собственности" 
     */
    function usluga_object()
    {
        //Стоимость земельного участка по умолчанию
        this.square = {
            cost: '10000',
            inp: '',
            scale: new Array(
                        {range:5000,cost:'NoData'},
                        {range:3000,cost:'14000'},
                        {range:1500,cost:'12000'},
                        {range:0,   cost:'10000'}
                    )
        };
        //Стоимость дополнительных экземпляров межевого плана
        this.ex_count = {
            cost:'800',
            inp:'1',
            cost_unit:'800'
        };
        //Стоимость  процедуры внесения сведений о земельном участке на кадастровый учет
        this.trust_saved = {
            cost:'1000',
            inp:'Да',
            cost_unit:'1000'
        };
        //Дополнительная услуга «Доставка на дом» (да, или нет)
        this.home_delivery = {
            cost:'0',
            inp:'Нет',
            cost_unit:'1'
        };
        //Стоимость доставки на дом в зависимости от района земельного участка
        this.rayon_id = {
            cost:'3000',
            inp:'',
            scale: new Array(
                        {index:1,cost:'3000'},
                        {index:2,cost:'3000'},
                        {index:3,cost:'5000'},
                        {index:4,cost:'5000'}
                    )
        };
        //ИД типа клиента (юр. или физ. лицо)
        this.clienttype_id = 1;
        //Тип клиента (юр. или физ. лицо)
        this.clienttype = {
            name:'Юр. лицо',
            names: new Array(
                        {index:1,name:'Физ. лицо'},
                        {index:2,name:'Юр. лицо'}
                    )
        };
        //Адрес земельного участка
        this.rayon_text = '';
        
        
        //Получение стоимости земельного участка
        this.get_cost_square = function(inp_square)
        {
            inp_square = parseInt(inp_square);
            for(var i=0; i<this.square.scale.length; i++)
            {
                if(inp_square < this.square.scale[i].range)
                {
                    this.square.cost = this.square.scale[i].cost;
                    return this.square.cost;
                }
            }
            return 'NoData';
        };  
        //Получение стоимости дополнительных экземпляров межевого плана
        this.get_cost_ex_count = function(inp_ex_count)
        {
            this.ex_count.cost = parseInt(inp_ex_count)*this.ex_count.cost_unit;
            return this.ex_count.cost;
        };  
        //Получение стоимости процедуры внесения сведений о земельном участке на кадастровый учет
        this.get_cost_trust_saved = function(inp_trust_saved)
        {
            this.trust_saved.cost = parseInt(inp_trust_saved)*this.trust_saved.cost_unit;
            return this.trust_saved.cost;
        };  
        //Дополнительная услуга «Доставка на дом» (да, или нет)
        this.get_cost_home_delivery = function(inp_home_delivery)
        {
            this.home_delivery.cost = parseInt(inp_home_delivery)*this.home_delivery.cost_unit;
            return this.home_delivery.cost;
        };  
        //Получение стоимость доставки на дом в зависимости от района земельного участка
        this.get_cost_rayon_id = function(inp_rayon_id)
        {
            inp_rayon_id = parseInt(inp_rayon_id);
            for(var i=0; i<this.rayon_id.scale.length; i++)
            {
                if(inp_rayon_id == this.rayon_id.scale[i].index)
                {
                    this.rayon_id.cost = this.rayon_id.scale[i].cost;
                    return this.rayon_id.cost;
                }

            }
            return this.rayon_id.cost;
        };  
        //ИД типа клиента (юр. или физ. лицо)
        this.get_cost_clienttype_id = function(inp_clienttype_id)
        {
            this.clienttype_id = parseInt(inp_clienttype_id);
            for(var i=0; i<this.clienttype.names.length; i++)
            {
                if(this.clienttype_id == this.clienttype.names[i].index)
                {
                    this.clienttype.name = this.clienttype.names[i].name;
                    return this.clienttype.name;
                }

            }
            return this.clienttype.name;
        };  
        //Адрес земельного участка
        this.get_cost_rayon_text = function(inp_rayon_text)
        {
            this.rayon_text = inp_rayon_text;
            return this.rayon_text;
        };  
    };

