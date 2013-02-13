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
	 * @var user id
	 */
	protected $user_id = 0;
 
        public function __construct($config = array()) {
            parent::__construct($config);
            $user = JFactory::getUser();
            $this->set_keys(array(
                'user_id' => $user->id
            ));
        }

        /**
         * 
         */
        public function set_keys($keys)
        {
            $this->_user_id = $keys['user_id'];
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
            if($this->user_id)
            {
                $query->where('user_id = '.$this->user_id);
            }
            return $query;
    }
}
