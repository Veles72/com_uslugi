<?php
// No direct access
defined('_JEXEC') or die('Restricted access');
 
require_once dirname(__FILE__) . '/caditems.php'; 
/**
 * Hello Table class
 */
class UslugiTableCadsved_doctype extends Caditems
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
