<?php
// No direct access
defined('_JEXEC') or die('Restricted access');
 
// import Joomla table library
jimport('joomla.database.table');
 
/**
 * Hello Table class
 */
class UslugiTableCadsved extends JTable
{
	/**
	 * Constructor
	 *
	 * @param object Database connector object
	 */
	function __construct(&$db) 
	{
		parent::__construct('#__uslugi_cadsved', 'id', $db);
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
            // Конвертируем номер телефона
            if (substr($this->phone,0,3) == '+7(') 
            {
                preg_match("/\+7\(([0-9]{3})\) ([0-9]{3})-([0-9]{2})-([0-9]{2})/", $this->phone, $regs);
                $this->phone = $regs[1].$regs[2].$regs[3].$regs[4];
            }
            $this->address = addslashes($this->address);
            $this->time = addslashes($this->time);
            $this->fio = addslashes($this->fio);
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
                $this->address = stripcslashes($this->address);
                $this->time = stripcslashes($this->time);
                $this->fio = stripcslashes($this->fio);
                return TRUE;
            }
            return FALSE;
        }
}
