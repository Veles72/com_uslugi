<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla modelitem library
jimport('joomla.application.component.modellist');
 
/**
 * Requisition Model
 */
class UslugiModelRequisition extends JModelList
{
	/**
	 * @var alias
	 */
	protected $_id = 0;
	/**
	 * @var id
	 */
	protected $_tablelist_id = 0;
 
        public function __construct($config = array()) {
            parent::__construct($config);
            $alias_id = JRequest::getInt('alias_id',0);
            $tablelist_id = JRequest::getString('tablelist_id','');
            $this->set_keys(array(
                'alias_id' => $alias_id,
                'tablelist_id' => $tablelist_id,
            ));
        }

        /**
         * 
         */
        public function set_keys($keys)
        {
            $this->_alias_id = $keys['alias_id'];
            $this->_tablelist_id = $keys['tablelist_id'];
        }

    /**
    * Method to build an SQL query to load the list data.
    * @return	string	An SQL query
    */
    protected function getListQuery()
    {
            $query = $this->_db->getQuery(true);
            $query->select('*');
            $query->from('#__uslugi_requisition');
            $query->where('alias_id = '.$this->_alias_id);
            $query->where('tablelist_id = '.$this->_tablelist_id);
            return $query;
    }
}
