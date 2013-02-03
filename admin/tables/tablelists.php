<?php
// No direct access
defined('_JEXEC') or die('Restricted access');
 
// import Joomla table library
require_once __DIR__ . '/ktable.php';

 
/**
 * List tables Table class
 */
class UslugiTableTablelists extends TableKTable
{
	/**
	 * Constructor
	 *
	 * @param object Database connector object
	 */
	function __construct(&$db) 
	{
		parent::__construct('#__uslugi_tablelists', 'id', $db);
	}
}
