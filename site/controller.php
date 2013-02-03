<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla controller library
jimport('joomla.application.component.controller');
 
/**
 * Hello World Component Controller
 */
class UslugiController extends JController
{
    /**
     * Запись заказа на услугу 
     */
    public function save()
    {
        var_dump($_POST);exit;
    }
}
