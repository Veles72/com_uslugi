
window.addEvent('domready', function() {
	document.formvalidator.setHandler('fio',
		function (value) {
			regex=/^[^0-9]+$/;
			return regex.test(value);
	});
	document.formvalidator.setHandler('square',
		function (value) {
			regex=/^[0-9]+$/;
			return regex.test(value);
	});
	document.formvalidator.setHandler('ex_count',
		function (value) {
			regex=/^[0-9]+$/;
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
            $("body").animate({scrollTop: 0}, "slow");
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
            var name = /^jform_([a-z_]+)\d?$/i.exec($(this).attr('id'));
            if(name)
            {
                var val = $(this).val();
                eval('ComUslugiFormData.get_cost_'+name[1]+'("'+val+'")');
                fill_table(ComUslugiFormData);
            }
                
        });
        
        /**
        *Заполнение таблицы
        */
        function fill_table(FormData)
        {
            $('#ugoda_rayon_text').text(FormData.rayon_text);
            $('#ugoda_square_text').text(FormData.square.inp);
            $('#ugoda_cost_text').text(FormData.get_total_cost());
            if(parseInt(FormData.ex_count.inp)>0)
            {
                $('#tr_ex_count').show('slow');
            }
            else
            {
                $('#tr_ex_count').hide('slow');
            }
            if(parseInt(FormData.trust_saved.inp)>0)
            {
                $('#tr_trust_saved').show('slow');
            }
            else
            {
                $('#tr_trust_saved').hide('slow');
            }
            if(parseInt(FormData.home_delivery.cost)>0)
            {
                $('#tr_home_delivery').show('slow');
                $('#ugoda_srok_vipolnenia').text('30');
            }
            else
            {
                $('#tr_home_delivery').hide('slow');
                $('#ugoda_srok_vipolnenia').text('60');
            }
            if(parseInt(FormData.clienttype_id) == 2)
            {
                $('#tr_rukov_poln').show('slow');
            }
            else
            {
                $('#tr_rukov_poln').hide('slow');
            }
            $('#ugoda_ex_count_text').text(FormData.ex_count.inp);
            $('#jform_cost').val(FormData.cost);
        };
    });
    /**
     * Класс данных формы и расчета стоимости услуги:
     * "Образование земельных участков из земель государственной собственности" 
     */
    function usluga_object()
    {
        //Общая стоимость
        this.cost = 0;
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
            this.square.inp = parseInt(inp_square);
            for(var i=0; i<this.square.scale.length; i++)
            {
                if(this.square.inp < this.square.scale[i].range)
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
            this.ex_count.inp = parseInt(inp_ex_count);
            this.ex_count.cost = this.ex_count.inp*this.ex_count.cost_unit;
            return this.ex_count.cost;
        };  
        //Получение стоимости процедуры внесения сведений о земельном участке на кадастровый учет
        this.get_cost_trust_saved = function(inp_trust_saved)
        {
            this.trust_saved.inp = parseInt(inp_trust_saved);
            this.trust_saved.cost = this.trust_saved.inp*this.trust_saved.cost_unit;
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
        //Адрес земельного участка
        this.get_total_cost = function()
        {
            this.cost = parseInt(this.square.cost)+parseInt(this.ex_count.cost)
                    +parseInt(this.trust_saved.cost)+(this.home_delivery.cost*this.rayon_id.cost);
            return this.cost;
        };  
    };
    function file_uploader(params)
    {
        var $ = jQuery;
        var name = '';
        var this_class = this;
        $(document.body).append('<div id="file_upload_div_00"></div>');
        $(document.body).append('<iframe id="upload_target" name="upload_target" src="#" style="width:0;height:0;border:0px solid #fff;"></iframe>');
        $('#file_upload_div_00').css('display','none');
        $('#file_upload_div_00').append('<form id="file_upload_form_00"></form>');
        $('#file_upload_form_00').attr('method','post');
        $('#file_upload_form_00').attr('enctype','multipart/form-data');
        $('#file_upload_form_00').attr('target','upload_target');
        $('#file_upload_form_00').attr('action',params.action);
        $.each(params.data, function(name, value) {
            $('#file_upload_form_00').append('<input type="hidden" name="'+name+'" value="'+value+'">');
        });
        $('#file_upload_form_00').append('<input id="file_upload_file_00" type="file" name="Filedata"/>');
        // Загрузка файла
        $('#file_upload_file_00').change(function(){
            for (var i = 0; i < this.files.length; i++) 
            {
                if(this.files[i].size>params.max_file_size)
                {
                    var max_file_size_mb = params.max_file_size/1000000;
                    alert('Загружаемый файл первышает максмально допустимый размер: '+max_file_size_mb+'Мб');
                    return false;
                }
                var file_type = /^(\w+)\/(\w+)$/i.exec(this.files[i].type);
                if(!file_type)
                {
                    alert('Не правильный тип файла');
                    return false;
                    
                }
                var is_image = params.file_types.indexOf(file_type[2]);
                if(is_image == -1)
                {
                    alert('Не правильный тип файла');
                    return false;
                    
                }
                $('#file_upload_form_00').submit();
            }
        });
        // Обработка при клике на кнопку загрузки
        $('.uslugi-upload').click(function(){
            var name = /^button_([a-z_]+)$/i.exec($(this).attr('id'))[1];
            this_class.set_name(name);
//            $('#file_'+file_name).click();
            $('#file_upload_file_00').click();
        });
        // Имя группы элементов, на которой произошел клик
        function set_name(name){
            this.name = name;
        };
    }
    /**
     * Обработка результатов загрузки
     */
    function stopUpload(success){
        console.log(success);
    }    
