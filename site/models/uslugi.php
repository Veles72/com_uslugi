<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla modelitem library
jimport('joomla.application.component.modelform');
 
/**
 * Uslugi Model
 */
class UslugiModelUslugi extends JModelForm
{
	/**
	 * @var object item
	 */
	protected $item;
	/**
	 * @var string alias
	 */
	private $_alias='';
 
        public function __construct($config = array()) {
            $this->_alias = JRequest::getString('alias');
            parent::__construct($config);
        }

        /**
	 * Get the data for a new qualification
	 */
	public function getForm($data = array(), $loadData = true)
	{
            // Get the form.
            $form = $this->loadForm('com_uslugi.uslugi', 'uslugi', array('control' => 'jform', 'load_data' => true));
            if (empty($form)) {
                    return false;
            }
            return $form;

	}
	/**
	 * Method to auto-populate the model state.
	 *
	 * This method should only be called once per instantiation and is designed
	 * to be called on the first call to the getState() method unless the model
	 * configuration flag to ignore the request is set.
	 *
	 * Note. Calling getState in this method will result in recursion.
	 *
	 * @return	void
	 * @since	1.6
	 */
	protected function populateState() 
	{
            // Get the message id
            $id = JRequest::getInt('id');
            $this->setState('alias.id', $id);

            parent::populateState();
	}
 
	/**
	 * Returns a reference to the a Table object, always creating it.
	 *
	 * @param	type	The table type to instantiate
	 * @param	string	A prefix for the table class name. Optional.
	 * @param	array	Configuration array for model. Optional.
	 * @return	JTable	A database object
	 * @since	1.6
	 */
	public function getTable($type = 'Uslugi', $prefix = 'UslugiTable', $config = array()) 
	{
		return JTable::getInstance($type, $prefix, $config);
	}
 
	/**
	 * Get the item
	 * @return object The message to be displayed to the user
	 */
	public function getItem() 
	{
            
            if (!isset($this->item)) 
            {
                $id = $this->getState('alias.id');
                if($id)
                {
                    $query = $this->_db->getQuery(true)
                            ->from('#__uslugi_'.$this->_alias)
                            ->select('*')
                            ->where('id=' . (int)$id);
                    $this->_db->setQuery($query);
                    if (!$this->item = $this->_db->loadObject()) 
                    {
                            $this->setError($this->_db->getError());
                    }
                }
                else 
                {
                    $this->item = new stdClass;
                    $this->item->id = 0;
                }
            }
            return $this->item;
	}
	/**
	 * Returns a title.
	 *
	 * @return	string
	 * @since	0.0.1
	 */
        public function getTitle()
        {
            $title = '';
            if($this->_alias)
            {
                $usluga = $this->getTable('Uslugi');
                if($usluga->load(array('alias'=>$this->_alias)))
                {
                    $title = $usluga->name;
                }
            }
            return $title;
        }
	/**
	 * Returns a alias.
	 *
	 * @return	string
	 * @since	0.0.1
	 */
        public function getAlias()
        {
            return $this->_alias;
        }
        
	public function createItem($data)
	{
            $table = $this->getTable($this->_alias);
            if (!$table->save($data)) 
            {
                JError::raiseError(500, $this->_db->getErrorMsg());
                var_dump($this->_db->getErrorMsg());exit;
                return false;
            }
            else
            {
                return true;
            }
        }
}
