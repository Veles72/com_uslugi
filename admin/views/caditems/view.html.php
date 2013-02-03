<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla view library
jimport('joomla.application.component.view');
 
/**
 * Caditems View
 */
class UslugiViewCaditems extends JView
{
	/**
	 * Caditems view display method
	 * @return void
	 */
	function display($tpl = null) 
	{
		// Get data from the model
		$items = $this->get('Items');
		$pagination = $this->get('Pagination');
		$alias = JRequest::getString('alias', 'cadsved_doctype');
                $tables = $this->get('Tables');
                var_dump($tables);
		// Check for errors.
		if (count($errors = $this->get('Errors'))) 
		{
			JError::raiseError(500, implode('<br />', $errors));
			return false;
		}
		// Assign data to the view
		$this->items = $items;
		$this->pagination = $pagination;
		$this->alias = $alias;
		$this->tables = $this->show_tables($tables);
 
		// Set the toolbar
		$this->addToolBar();
 
		// Display the template
		parent::display($tpl);
 
		// Set the document
		$this->setDocument();
	}
 
	/**
	 * Setting the toolbar
	 */
	protected function addToolBar() 
	{
		$canDo = UslugiHelper::getActions();
		JToolBarHelper::title(JText::_('COM_USLUGI_MANAGER_CADITEMS'), 'item');
		if ($canDo->get('core.create')) 
		{
			JToolBarHelper::addNew('item.add', 'JTOOLBAR_NEW');
		}
		if ($canDo->get('core.edit')) 
		{
			JToolBarHelper::editList('item.edit', 'JTOOLBAR_EDIT');
		}
		if ($canDo->get('core.delete')) 
		{
			JToolBarHelper::deleteList('', 'items.delete', 'JTOOLBAR_DELETE');
		}
		if ($canDo->get('core.admin')) 
		{
			JToolBarHelper::divider();
			JToolBarHelper::preferences('com_item');
		}
	}
	/**
	 * Method to set up the document properties
	 *
	 * @return void
	 */
	protected function setDocument() 
	{
		$document = JFactory::getDocument();
		$document->setTitle(JText::_('COM_USLUGI_ADMINISTRATION'));
	}
        
        protected function show_tables($tables)
        {
            $table_id = JRequest::getInt('table_id',1);
            $state = array();
                foreach ($tables as $table)
                {
                    $state[] = JHTML::_('select.option'
                            , $table->id
                            , JText::_($table->name)
                    );
                }
                return JHTML::_('select.genericlist'
                                , $state
                                , 'table_id'
                                , array() // attributes
                                , 'value'
                                , 'text'
                                , $table_id  // selected
                                , 'table_id' // DOOM tag ID
                                , false );
            
        }
}
