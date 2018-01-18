<?php

require_once 'attendees.civix.php';

/**
 * Implements hook_civicrm_config().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_config
 */
function attendees_civicrm_config(&$config) {
  _attendees_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_xmlMenu().
 *
 * @param array $files
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_xmlMenu
 */
function attendees_civicrm_xmlMenu(&$files) {
  _attendees_civix_civicrm_xmlMenu($files);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_install
 */
function attendees_civicrm_install() {
  _attendees_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_uninstall
 */
function attendees_civicrm_uninstall() {
  _attendees_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function attendees_civicrm_enable() {
  _attendees_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_disable
 */
function attendees_civicrm_disable() {
  _attendees_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @param $op string, the type of operation being performed; 'check' or
 *   'enqueue'
 * @param $queue CRM_Queue_Queue, (for 'enqueue') the modifiable list of
 *   pending up upgrade tasks
 *
 * @return mixed
 *   Based on op. for 'check', returns array(boolean) (TRUE if upgrades are
 *   pending) for 'enqueue', returns void
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_upgrade
 */
function attendees_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _attendees_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_managed
 */
function attendees_civicrm_managed(&$entities) {
  _attendees_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Generate a list of case-types.
 *
 * @param array $caseTypes
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function attendees_civicrm_caseTypes(&$caseTypes) {
  _attendees_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Generate a list of Angular modules.
 *
 * Note: This hook only runs in CiviCRM 4.5+. It may
 * use features only available in v4.6+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function attendees_civicrm_angularModules(&$angularModules) {
  _attendees_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_alterSettingsFolders
 */
function attendees_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _attendees_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

/**
 * Implements hook_civicrm_searchTasks().
 *
 * @link https://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_searchTasks
 * @link http://artfulrobot.uk/content/adding-custom-civicrm-search-tasks
 */
function attendees_civicrm_searchTasks($objectType, &$tasks) {
  if ($objectType == 'event') {
    // Create new task = 'Attendee list'
    $tasks['ctrl-1'] = [
      'title' => ts('Print Participant List'),
      'class' => ['CRM_Event_Form_Task_Attendee_List'],
      'result' => FALSE,
    ];
    // Create new task = 'Signature list'
    $tasks['ctrl-2'] = [
      'title' => ts('Signature') . ' ' . ts('List'),
      'class' => ['CRM_Event_Form_Task_Signature_List'],
      'result' => FALSE,
    ];
    // Create new task = 'Grid list'
    $tasks['ctrl-3'] = [
      'title' => ts('Signature') . ' ' . ts('Grid'),
      'class' => ['CRM_Event_Form_Task_Grid_List'],
      'result' => FALSE,
    ];
    // Create new task = 'Attendee list with email'
    $tasks['ctrl-4'] = [
      'title' => ts('Signature') . ' ' . ts('List') . ' + ' . ts('Email'),
      'class' => ['CRM_Event_Form_Task_Email_List'],
      'result' => FALSE,
    ];
    // Create new task = 'Attendee list with employer'
    $tasks['ctrl-5'] = [
      'title' => ts('Print Participant List') . ' + ' . ts('Employer'),
      'class' => ['CRM_Event_Form_Task_Employer_List'],
      'result' => FALSE,
    ];
  }
}
