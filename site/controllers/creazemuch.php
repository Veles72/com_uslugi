<?php

// No direct access.
defined('_JEXEC') or die;

// Include dependancy of the main controllerform class
jimport('joomla.application.component.controllerform');

class UslugiControllerCreazemuch extends JControllerForm
{
    /**
     * Папка для копирования загружаемых файлов
     * 
     */
    private $_upload_dirpath;
    /**
     * Путь к рисунку по умолчанию
     * 
     */
    private $_default_src;


    public function __construct($config = array()) {
        parent::__construct($config);
        $this->_upload_dirpath = 'media'.DS.'com_uslugi'.DS.'images'.DS.'temp_images'.DS;
        $this->_default_src = JURI::base().'media/com_uslugi/images/empty_sheet.png';
    }


    public function submit()
	{
            // Check for request forgeries.
            JRequest::checkToken() or jexit(JText::_('JINVALID_TOKEN'));
            $model = $this->getModel();

            // Get the data from the form POST
            $data = JRequest::getVar('jform', array(), 'post', 'array');

            // Now save the loaded data to the database via a function in the model
            // check if ok and display appropriate message.  This can also have a redirect if desired.
            if ($model->createItem($data)) 
            {
                echo JTEXT::_('ZAJAVKA_ERROR_SEND');
            } 
            else 
            {
                echo JTEXT::_('ZAJAVKA_SUCCES_SEND');
            }

            return true;
        }
        
        /**
         * Upload files 
         */
        public function upload()
        {
            // Check for request forgeries.
            JRequest::checkToken() or jexit(JText::_('JINVALID_TOKEN'));
            
            // Имя функции, запускаемой в браузере по окончании загрузки.
            $func = JRequest::getString('func','stopUpload');
            
            // Папка загрузки с корнем
            $filepath = JPATH_ROOT.DS.$this->_upload_dirpath;
            
            // Библиотека загрузчика
            jimport('uploader.uploader');
            $uploader = new Uploader($filepath);
            
            // Загружаем файл с перезаписью
            $result = $uploader->upload_file(TRUE);
            
            
            if($result[0])
            {
                $result[2] = JURI::base().$this->_upload_dirpath.$result[2];
                JFactory::getApplication()->setUserState('com_uslugi.src', $result[2]);
            }
            $result=json_encode($result);
            echo '<script language="javascript" type="text/javascript">window.top.window.'.$func.'('.$result.');</script>';
            exit;

        }
        /**
         * Show image 
         */
        public function show_image()
        {
            // Check for request forgeries.
            JRequest::checkToken('get') or jexit(JText::_('JINVALID_TOKEN'));
            
            $src = JFactory::getApplication()->getUserState('com_uslugi.src',$this->_default_src) ;
            echo '<img src="'.$src.'" />';exit;
            
            // Имя функции, запускаемой в браузере по окончании загрузки.
            $func = JRequest::getString('func','');
            
        }

}
