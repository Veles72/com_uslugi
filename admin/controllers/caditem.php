<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla controllerform library
jimport('joomla.application.component.controllerform');
 
/**
 * Uslugi Controller
 */
class UslugiControllerCaditem extends JControllerForm
{
    public function __construct($config = array()) {
        parent::__construct($config);
        JFactory::getApplication()->setUserState('com_uslugi.alias', 
                JRequest::getString('alias'));
    }
    public function delete()
    {
        // Check for request forgeries.
        JRequest::checkToken() or jexit(JText::_('JINVALID_TOKEN'));
        $cids = JRequest::getVar('cid',array(),'','array');
        if(!$this->getModel()->delete($cids))
        {
            JError::raiseWarning('ERROR_CODE', JText::_('COM_USLUGI_ERROR_DELETE_ROWS'));
        }
        else
        {
            JError::raiseNotice('NOTICE_CODE', JText::_('COM_USLUGI_OK_DELETE_ROWS'));
        }
        JRequest::setVar( 'view', 'caditems' );
        parent::display();
    }
    
}
