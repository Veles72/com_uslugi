<?php
// No direct access
defined('_JEXEC') or die('Restricted access');
 
require_once dirname(__FILE__) . '/ktable.php'; 
/**
 * Hello Table class
 */
class UslugiTableCadsved_doctype extends TableKTable
{
	/**
	 * Constructor
	 *
	 * @param object Database connector object
	 */
	function __construct(&$db) 
	{
		parent::__construct('#__uslugi_cadsved_doctype', 'id', $db);
	}
}
