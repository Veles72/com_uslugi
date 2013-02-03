<?php
// No direct access
defined('_JEXEC') or die('Restricted access');
 
// import Joomla table library
jimport('joomla.database.table');
 
/**
 * Hello Table class
 */
class TableKTable extends JTable
{
 	/**
	 * Method to perform sanity checks on the JTable instance properties to ensure
	 * they are safe to store in the database.  Child classes should override this
	 * method to make sure the data they are storing in the database is safe and
	 * as expected before storage.
	 *
	 * @return  boolean  True if the instance is sane and able to be stored in the database.
	 *
	 * @link    http://docs.joomla.org/JTable/check
	 * @since   11.1
	 */
	public function check()
	{
            $this->name = addslashes($this->name);
            return parent::check();
	}
        
        /**
         * Overload parent bind method
         * @param type $keys
         * @param type $reset
         */
        public function load($keys = null, $reset = true)
	{
            if( parent::load($keys, $reset))
            {
                $this->name = stripcslashes($this->name);
                return TRUE;
            }
            return FALSE;
        }
   /**
     * Возвращаем список объектов
     * @return object List of rows
     */
    public function get_rows() 
    {
        // Initialise the query.
        $query = $this->_db->getQuery(true);
        $query->select('*');
        $query->from($this->_tbl);
        $this->_db->setQuery($query);
        return  $this->_db->loadObjectList();

    }
}
