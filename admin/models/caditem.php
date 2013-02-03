<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla modelform library
jimport('joomla.application.component.modeladmin');
 
/**
 * Uslugi Model
 */
class UslugiModelCaditem extends JModelAdmin
{
    private $_table_name;

    public function __construct($config = array()) {
        parent::__construct($config);
        $this->_table_name = $type = JFactory::getApplication()->getUserState('com_uslugi.alias', 'cadsved_doctype');
    }

    /**
	 * Returns a reference to the a Table object, always creating it.
	 *
	 * @param	type	The table type to instantiate
	 * @param	string	A prefix for the table class name. Optional.
	 * @param	array	Configuration array for model. Optional.
	 * @return	JTable	A database object
	 * @since	1.6
	 */
	public function getTable($type = NULL, $prefix = 'UslugiTable', $config = array()) 
	{
            if(!isset($type))
            {
                $type = $this->_table_name;
            }
            return JTable::getInstance($type, $prefix, $config);
	}
	/**
	 * Method to get the record form.
	 *
	 * @param	array	$data		Data for the form.
	 * @param	boolean	$loadData	True if the form is to load its own data (default case), false if not.
	 * @return	mixed	A JForm object on success, false on failure
	 * @since	1.6
	 */
	public function getForm($data = array(), $loadData = true) 
	{
		// Get the form.
		$form = $this->loadForm('com_uslugi.caditem', 'caditem', array('control' => 'jform', 'load_data' => $loadData));
		if (empty($form)) 
		{
			return false;
		}
		return $form;
	}
	/**
	 * Method to get the script that have to be included on the form
	 *
	 * @return string	Script files
	 */
	public function getScript() 
	{
		return 'administrator/components/com_uslugi/models/forms/caditem.js';
	}
	/**
	 * Method to get the data that should be injected in the form.
	 *
	 * @return	mixed	The data for the form.
	 * @since	1.6
	 */
	protected function loadFormData() 
	{
		// Check the session for previously entered form data.
		$data = JFactory::getApplication()->getUserState('com_uslugi.edit.caditem.data', array());
		if (empty($data)) 
		{
			$data = $this->getItem();
		}
		return $data;
	}
        public function getCaditem()
        {
            $table = $this->getTable('tablelists');
            if($table->load(array('alias'=>$this->_table_name)))
            {
                return array(
                        'name'=>$table->name,
                        'alias'=>$table->alias
                        );
            }
            return array(
                    'name'=>'',
                    'alias'=>''
                    );
        }
}
