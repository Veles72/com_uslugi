<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
// import the Joomla modellist library
jimport('joomla.application.component.modellist');
/**
 * UslugiList Model
 */
class UslugiModelCaditems extends JModelList
{
    private $_table_alias;

    
    public function __construct($config = array()) {
        parent::__construct($config);
        $this->_set_table_alias();
    }
    /**
     * Устанавливаем  имя таблицы
     */
    public function _set_table_alias($alias=NULL)
    {
        if(!isset($alias))
        {
            $alias = JRequest::getString('alias','cadsved_doctype');
        }
        $this->_table_alias = $alias;
    }

    /**
    * Method to build an SQL query to load the list data.
    * @return	string	An SQL query
    */
    protected function getListQuery()
    {
            $query = $this->_db->getQuery(true);
            $query->select('*');
            $query->from('#__uslugi_'.$this->_table_alias);
            return $query;
    }
    /**
    * Получаем список рабочих таблиц
    * @return	object Список таблиц
    */
    public function getTables()
    {
            $query = $this->_db->getQuery(true);
            $query->select('*');
            $query->from('#__uslugi_tables');
            $this->_db->setQuery($query);
            return $this->_db->getObjectList();
    }
}
