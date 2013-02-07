<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla modelitem library
jimport('joomla.application.component.modelform');
 
/**
 * Uslugi Model
 */
class UslugiModelCreazemuch extends JModelForm
{

    protected $_tablelist;

    public function __construct($config = array()) {
        parent::__construct($config);
        $this->_tablelist = array('square','triggers','rayon');
    }

    /**
	 * Get the data for a new qualification
	 */
	public function getForm($data = array(), $loadData = true)
	{
            // Get the form.
            $form = $this->loadForm('com_uslugi.creazemuch', 'creazemuch', array('control' => 'jform', 'load_data' => true));
            if (empty($form)) {
                    return false;
            }
            return $form;

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
	public function getTable($type = 'Creazemuch', $prefix = 'UslugiTable', $config = array()) 
	{
		return JTable::getInstance($type, $prefix, $config);
	}
        
        /**
         * Save record
         * @param type $data
         * @return boolean
         */
	public function createItem($data)
	{
            $table = $this->getTable();
            if (!$table->save($data)) 
            {
                JError::raiseError(500, $this->_db->getErrorMsg());
                return false;
            }
            else
            {
                return true;
            }
        }
        
        /**
         * Возвращаем вспомогательные таблицы
         * @return array of objects Список вспомогательных таблиц
         */
        public function getTablelist()
        {
            $tablelist = array();
            
            foreach ($this->_tablelist as $table_alias)
            {
                $table = $this->getTable($table_alias,'UslugiTable');
                $tablelist[$table_alias] = $table->get_rows();
            }
            return $tablelist;
        }
}
