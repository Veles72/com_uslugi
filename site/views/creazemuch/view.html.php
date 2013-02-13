<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla view library
jimport('joomla.application.component.view');
// import Joomla html for use with stylesheets
jimport('joomla.html.html');

/**
 * HTML View class for the UpdUslugi Component
 */
class UslugiViewCreazemuch extends JView
{
	// Overwriting JView display method
	function display($tpl = null) 
	{
//		$app		= JFactory::getApplication();
//		$params		= $app->getParams();
//		$dispatcher = JDispatcher::getInstance();

		// Get some data from the models
//		$this->title	= $this->get('Title');
//		$this->alias	= $this->get('Alias');
//		$this->state	= $this->get('State');
		$this->form	= $this->get('Form');
		$this->tablelist= $this->get('Tablelist');
		$this->triggerst= $this->_get_triggers();
                $this->form_action = JURI::base().'index.php?option=com_uslugi';
//                $this->uslugi_pravdoc_href = 'index.php?option=com_uslugi&task=creazemuch.show_image&img=pravdoc';
                $this->uslugi_pravdoc_href = JURI::base().'index.php?option=com_uslugi&task=creazemuch.show_image&img=pravdoc&'.JUtility::getToken().'=1';                
//		$this->item	= $this->get('Item');

		// Check for errors.
		if (count($errors = $this->get('Errors'))) 
		{
			JError::raiseError(500, implode('<br />', $errors));
			return false;
		}

		// get the stylesheet and/or other document values
        $this->addDocStyle();

		// Display the view
        parent::display($tpl);

	}

	/**
	 * Add the stylesheet to the document.
	 */
	protected function addDocStyle()
	{
        $doc = JFactory::getDocument();
        $doc->addStyleSheet('media/com_uslugi/css/site.stylesheet.css');
        $doc->addScript(JURI::root()."components/com_uslugi/views/creazemuch/submitbutton.js");
        $doc->addScript(JURI::root()."components/com_uslugi/models/forms/creazemuch.js");
        $doc->addScript(JURI::root().'media/com_uslugi/js/jquery.maskedinput-1.3.min.js');
    }
    /**
     * Обработка тфблицы тригеров 
     * 
     */
    private function _get_triggers()
    {
        $triggers = array();
        foreach($this->tablelist['triggers'] as $row)
        {
            $triggers[$row->alias] = $row->price;
        }
        return $triggers;
    }
}
