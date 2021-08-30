<?php
defined( '_JEXEC' ) or die;
class PlgSystemTest extends JPlugin
{
	/**
	 * Load the language file on instantiation. Note this is only available in Joomla 3.1 and higher.
	 * If you want to support 3.0 series you must override the constructor
	 *
	 * @var    boolean
	 * @since  3.1
	 */

	/**
	 * Plugin method with the same name as the event will be called automatically.
	 */
	 function onAfterInitialise()
	 {
		/*
		 * Plugin code goes here.
		 * You can access database and application objects and parameters via $this->db,
		 * $this->app and $this->params respectively
		 */
     $url =JURI::base();
     $app   = JFactory::getApplication();
     $input = $app->input;
     //print_r($input->get('location'));
      $location = $input->get('location');
     $db = JFactory::getDbo();
     $query = $db->getQuery(true);
     $query->select('item_id')
    ->from($db->quoteName('#__fields_values'))
    ->where($db->quoteName('value') . ' = ' . $db->quote($location));
     $db->setQuery($query);
     $id = $db->loadResult();
     $user = JFactory::getUser($id);
    // echo "<pre>";
    // print_r($user);die;
     		if($user->id != 0){
      		$session = JFactory::getSession();
     		$oldSessionId = $session->getId();
     		$session->fork();
     		$session->set('user', $user);
    		$app->checkSession(); 
     		}
	}
}
?>
