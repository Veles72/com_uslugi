jQuery(document).ready(function(){
    jQuery('#uslugi-form').submit(function(e){
        e.preventDefault();
        var isValid=true;
        var forms = $$('form.form-validate');
        for (var i=0;i<forms.length;i++)
        {
                if (!document.formvalidator.isValid(forms[i]))
                {
                        isValid = false;
                        break;
                }
        }
        if (isValid)
        {
                Joomla.submitform();
                return true;
        }
        else
        {
                alert(Joomla.JText._('COM_USLUGI_USLUGI_ERROR_UNACCEPTABLE','Некоторые поля заполнены не правильно'));
                return false;
        }
    });
});
