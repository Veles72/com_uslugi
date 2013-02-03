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
    private $_table_name;

    
    public function __construct($config = array()) {
        parent::__construct($config);
        $state = JFactory::getApplication()->getUserState('com_uslugi.alias','cadsved_doctype');
        $alias = JRequest::getString('alias',NULL);
        $this->_table_name = $alias?$alias:$state;
        JFactory::getApplication()->setUserState('com_uslugi.alias',$this->_table_name);
//        var_dump($state,$alias);
    }

    public function getAlias()
    {
        return $this->_table_name;
    }

    /**
    * Method to build an SQL query to load the list data.
    * @return	string	An SQL query
    */
    protected function getListQuery()
    {
            $query = $this->_db->getQuery(true);
            $query->select('*');
            $query->from('#__uslugi_'.$this->_table_name);
            return $query;
    }
        /**
         * Возвращаем список вспомогательных таблиц
         * @return type HTML select
         */
        public function getTablelists()
        {
            $tables = $this->getTable('tablelists','UslugiTable')->get_rows();

            $state = array();
                foreach ($tables as $table)
                {
                    $state[] = JHTML::_('select.option'
                            , $table->alias
                            , JText::_($table->name)
                    );
                }
                return JHTML::_('select.genericlist'
                                , $state
                                , 'alias'
                                , array() // attributes
                                , 'value'
                                , 'text'
                                , $this->_table_name  // selected
                                , 'table_list' // DOOM tag ID
                                , false );
            
        }

}
