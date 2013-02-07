<?php
// No direct access
defined('_JEXEC') or die('Restricted access');
 
// import Joomla table library
jimport('joomla.database.table');
 
/**
 * Hello Table class
 */
class UslugiTableCreazemuch extends JTable
{
	/**
	 * Constructor
	 *
	 * @param object Database connector object
	 */
	function __construct(&$db) 
	{
		parent::__construct('#__uslugi_creazemuch', 'id', $db);
	}
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
            $this->rayon_text = addslashes($this->rayon_text);
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
                $this->rayon_text = stripcslashes($this->rayon_text);
                return TRUE;
            }
            return FALSE;
        }
}
