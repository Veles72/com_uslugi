<?php
// No direct access to this file
defined('_JEXEC') or die;
 
/**
 * Uslugi component helper.
 */
abstract class UslugiHelper
{
	/**
	 * Configure the Linkbar.
	 */
	public static function addSubmenu($submenu) 
	{
		JSubMenuHelper::addEntry(JText::_('COM_USLUGI_SUBMENU_USLUGI'), 'index.php?option=com_uslugi', $submenu == 'uslugi');
		JSubMenuHelper::addEntry(JText::_('COM_USLUGI_SUBMENU_CADITEMS'), 'index.php?option=com_uslugi&view=caditems', $submenu == 'caditem');
		// set some global property
		$document = JFactory::getDocument();
		$document->addStyleDeclaration('.icon-48-uslugi {background-image: url(../media/com_uslugi/images/tux-48x48.png);}');
		if ($submenu == 'caditems') 
		{
			$document->setTitle(JText::_('COM_USLUGI_ADMINISTRATION_CADITEMS'));
		}
	}
	/**
	 * Get the actions
	 */
	public static function getActions($messageId = 0)
	{
		$user	= JFactory::getUser();
		$result	= new JObject;
 
		if (empty($messageId)) {
			$assetName = 'com_uslugi';
		}
		else {
			$assetName = 'com_uslugi.message.'.(int) $messageId;
		}
 
		$actions = array(
			'core.admin', 'core.manage', 'core.create', 'core.edit', 'core.delete'
		);
 
		foreach ($actions as $action) {
			$result->set($action,	$user->authorise($action, $assetName));
		}
 
		return $result;
	}
}
