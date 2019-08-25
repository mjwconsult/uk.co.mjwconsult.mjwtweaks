<?php

require_once 'mjwtweaks.civix.php';
use CRM_Mjwtweaks_ExtensionUtil as E;

/**
 * Implements hook_civicrm_config().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_config
 */
function mjwtweaks_civicrm_config(&$config) {
  if (isset(Civi::$statics[__FUNCTION__])) { return; }
  Civi::$statics[__FUNCTION__] = 1;

  Civi::dispatcher()->addListener('hook_civicrm_coreResourceList', 'mjwtweaks_event_civicrm_coreResourceList', -1000);

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
 * Implements hook_civicrm_navigationMenu().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_navigationMenu
 *
 */
function mjwtweaks_civicrm_navigationMenu(&$menu) {
  $item[] =  array (
    'label' => E::ts('MJW Tweaks'),
    'name'       => 'MJW Tweaks',
    'url'        => 'civicrm/admin/mjwtweaks',
    'permission' => 'administer CiviCRM',
    'operator'   => NULL,
    'separator'  => NULL,
  );
  _mjwtweaks_civix_insert_navigation_menu($menu, 'Administer/Customize Data and Screens', $item[0]);
  _mjwtweaks_civix_navigationMenu($menu);
}

function mjwtweaks_event_civicrm_coreResourceList($event) {
  // We don't want to add the datepicker icon twice!
  if (mjwtweaks_extension_is_active('org.civicrm.shoreditch')) {
    $file = 'js/add-missing-date-addons.js';
    $url = CRM_Core_Resources::singleton()
      ->getUrl('org.civicrm.shoreditch', $file, TRUE);
    $registration = CRM_Core_Region::instance(CRM_Core_Resources::DEFAULT_REGION)
      ->get($url);
    if ($registration) {
      CRM_Core_Region::instance(CRM_Core_Resources::DEFAULT_REGION)
        ->update($url, ['disabled' => TRUE]);
    }
  }
  if ((boolean)CRM_Mjwtweaks_Settings::getValue('display_blockformajaxload')) {
    CRM_Core_Resources::singleton()
      ->addScriptFile(E::LONG_NAME, 'js/crm.blockformonajaxload.js');
  }
}

function mjwtweaks_extension_is_active($extensionKey) {
  try {
    $result = civicrm_api3('Extension', 'getsingle', [
      'is_active' => 1,
      'full_name' => $extensionKey,
    ]);
  }
  catch (Exception $e) {
    return FALSE;
  }
  return TRUE;
}

/**
 * Intercept form functions
 * @param string $formName
 * @param CRM_Core_Form $form
 */
function mjwtweaks_civicrm_buildForm($formName, &$form) {
  switch ($formName) {
    case 'CRM_Contribute_Form_Contribution_Main':
    case 'CRM_Event_Form_Registration_Register':
      if ((boolean)CRM_Mjwtweaks_Settings::getValue('display_hidenotyoumessage')) {
        CRM_Core_Resources::singleton()->addScriptFile('uk.co.mjwconsult.mjwtweaks', 'js/display_hidenotyoumessage.js');
      }
      break;

    case 'CRM_Profile_Form_Dynamic':
      CRM_Mjwtweaks_Profile::contactSubTypeURLParameter($form);
      break;
  }
}

function mjwtweaks_civicrm_pageRun(&$page) {
  if ($page instanceof CRM_Contact_Page_View_Summary) {
    $file = 'templates/CRM/Contact/Page/View/Summary.js';
    $url = CRM_Core_Resources::singleton()->getUrl( 'civicrm', $file, TRUE );
    $registration = CRM_Core_Region::instance('html-header')->get($url);
    if ($registration) {
      CRM_Core_Region::instance('html-header')->update($url, ['disabled' => TRUE]);
    }

    // We override Summary.js so that we can alter the "narrowpage" width with shoreditch
    CRM_Core_Resources::singleton()
      ->addScriptFile('uk.co.mjwconsult.mjwtweaks', $file, 2, 'html-header');
  }
  elseif ($page instanceof CRM_Case_Page_Tab) {
    $caseUI = [
      'mergecases' => CRM_Mjwtweaks_Settings::getValue('caseui_mergecases'),
      'printreport' => CRM_Mjwtweaks_Settings::getValue('caseui_printreport'),
      'exportpdf' => CRM_Mjwtweaks_Settings::getValue('caseui_exportpdf'),
      'assignotherclient' => CRM_Mjwtweaks_Settings::getValue('caseui_assignotherclient'),
      'otherrelationships' => CRM_Mjwtweaks_Settings::getValue('caseui_otherrelationships'),
      'timeline' => CRM_Mjwtweaks_Settings::getValue('caseui_timeline'),
    ];
    $page->assign('caseUI', $caseUI);
  }
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
  if (!(boolean)CRM_Mjwtweaks_Settings::getValue('display_disableshoreditchtweaks')) {
    $cssURL = CRM_Core_Resources::singleton()
      ->getUrl('uk.co.mjwconsult.mjwtweaks', 'css/shoreditch.css');
    $content = "<style>
  @import url(\"{$cssURL}\");
</style>" . $content;
  }
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
