<?php
defined( '_JEXEC' ) or die;

// Get an instance of the JApplication object
$app = JFactory::getApplication();

// Get params from the menu item
$params = $app->getMenu()->getActive()->params;
$logoutmessage = $params->get('logoutmessage', JText::_('COM_LOGOUT_SUCCESS'));
// Set the default redirect to the home page if none is set in the parameters
$redirect = $params->get('redirect', $app->getMenu()->getDefault()->id);

// Perform the logout
$error = $app->logout();

// Redirect after logout
if (!($error instanceof Exception)) {
	$return = 'index.php?Itemid='.$redirect;
	$app->redirect(JRoute::_($return, $logoutmessage, 'message', false));
} else {
	$app->redirect(JRoute::_('index.php?option=com_users&view=login', false));
}