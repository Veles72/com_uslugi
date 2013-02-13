<?php

// No direct access.
defined('_JEXEC') or die;

// Include dependancy of the main controllerform class
jimport('joomla.application.component.controllerform');

class UslugiControllerCreazemuch extends JControllerForm
{


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
            $func = JRequest::getString('func','');
            // Библиотека загрузчика
            jimport('uploader.uploader');
            $uploader = new Uploader(JPATH_ROOT.DS.'tmp'.DS);
            // Загружаем файл с перезаписью
            $uploader->upload_file($func,TRUE);
        }

}
