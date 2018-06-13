<?php

require_once 'mjwtweaks.civix.php';
use CRM_Mjwtweaks_ExtensionUtil as E;

/**
 * Implements hook_civicrm_config().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_config
 */
function mjwtweaks_civicrm_config(&$config) {
  _mjwtweaks_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_xmlMenu().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_xmlMenu
 */
function mjwtweaks_civicrm_xmlMenu(&$files) {
  _mjwtweaks_civix_civicrm_xmlMenu($files);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_install
 */
function mjwtweaks_civicrm_install() {
  _mjwtweaks_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_postInstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_postInstall
 */
function mjwtweaks_civicrm_postInstall() {
  _mjwtweaks_civix_civicrm_postInstall();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_uninstall
 */
function mjwtweaks_civicrm_uninstall() {
  _mjwtweaks_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function mjwtweaks_civicrm_enable() {
  _mjwtweaks_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_disable
 */
function mjwtweaks_civicrm_disable() {
  _mjwtweaks_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_upgrade
 */
function mjwtweaks_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _mjwtweaks_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_managed
 */
function mjwtweaks_civicrm_managed(&$entities) {
  _mjwtweaks_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Generate a list of case-types.
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function mjwtweaks_civicrm_caseTypes(&$caseTypes) {
  _mjwtweaks_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Generate a list of Angular modules.
 *
 * Note: This hook only runs in CiviCRM 4.5+. It may
 * use features only available in v4.6+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_angularModules
 */
function mjwtweaks_civicrm_angularModules(&$angularModules) {
  _mjwtweaks_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_alterSettingsFolders
 */
function mjwtweaks_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _mjwtweaks_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

/**
 * Implements hook_coreResourceList
 *
 * @param array $list
 * @param string $region
 */
function mjwtweaks_civicrm_coreResourceList(&$list, $region) {
//  Civi::resources()
//    ->addStyleFile(E::LONG_NAME, 'css/shoreditch.css', 0, 'page-header');
}

/**
 * Implementation of hook_civicrm_alterContent
 *
 * Adding civicrm_stripe.js in a way that works for webforms and (some) Civi forms.
 * hook_civicrm_buildForm is not called for webforms
 *
 * @return void
 */
function mjwtweaks_civicrm_alterContent(&$content, $context, $tplName, &$object) {
  $cssURL = CRM_Core_Resources::singleton()
    ->getUrl('uk.co.mjwconsult.mjwtweaks', 'css/shoreditch.css');
  $content = "<style>
  @import url(\"{$cssURL}\");
</style>" . $content;
}

/**
 * This hook retrieves links from other modules and injects it into.
 * the view contact tabs
 *
 * @param string $op
 *   The type of operation being performed.
 * @param string $objectName
 *   The name of the object.
 * @param int $objectId
 *   The unique identifier for the object.
 * @param array $links
 *   (optional) the links array (introduced in v3.2).
 * @param int $mask
 *   (optional) the bitmask to show/hide links.
 * @param array $values
 *   (optional) the values to fill the links.
 *
 * @return null
 *   the return value is ignored
 */
function mjwtweaks_civicrm_links($op, $objectName, &$objectId, &$links, &$mask = NULL, &$values = array()) {
  if ($op !== 'case.selector.actions') return;
  if ($objectName !== 'Case') return;

  // Make "Manage" link on contact case tab open in new tab
  foreach ($links as $index => $link) {
    if ($link['name'] = 'Manage') {
      $links[$index]['extra'] = ' target="_blank"';
      return;
    }
  }
}


