<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla controlleradmin library
jimport('joomla.application.component.controlleradmin');
 
/**
 * Uslugis Controller
 */
class UslugiControllerCaditems extends JControllerAdmin
{
    public function __construct($config = array()) {
        parent::__construct($config);
        JFactory::getApplication()->setUserState('com_uslugi.alias', 
        JRequest::getString('alias'),NULL);

    }
}
