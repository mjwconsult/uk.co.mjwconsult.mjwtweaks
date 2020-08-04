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
  $item[] =  [
    'label' => E::ts('MJW Tweaks'),
    'name'       => 'MJW Tweaks',
    'url'        => 'civicrm/admin/mjwtweaks',
    'permission' => 'administer CiviCRM',
    'operator'   => NULL,
    'separator'  => NULL,
  ];
  _mjwtweaks_civix_insert_navigation_menu($menu, 'Administer/Customize Data and Screens', $item[0]);
  _mjwtweaks_civix_navigationMenu($menu);
}

function mjwtweaks_event_civicrm_coreResourceList($event) {
  if ((boolean)CRM_Mjwtweaks_Settings::getValue('display_blockformajaxload')) {
    CRM_Core_Resources::singleton()
      ->addScriptFile(E::LONG_NAME, 'js/crm.blockformonajaxload.js');
  }
}

function mjwtweaks_extension_is_active($extensionKey) {
  try {
    civicrm_api3('Extension', 'getsingle', [
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
  $min = ((boolean) \Civi::settings()->get('debug_enabled')) ? '' : '.min';

  switch ($formName) {
    case 'CRM_Contribute_Form_Contribution_Main':
    case 'CRM_Event_Form_Registration_Register':
      if ((boolean)CRM_Mjwtweaks_Settings::getValue('display_hidenotyoumessage')) {
        CRM_Core_Resources::singleton()->addScriptFile('uk.co.mjwconsult.mjwtweaks', "js/display_hidenotyoumessage{$min}.js");
      }
      break;

    case 'CRM_Case_Form_Activity':
      foreach (['caseui_activitypriority', 'caseui_activitysendcopy', 'caseui_activityschedulefollowup'] as $setting) {
        if (empty(\Civi::settings()->get("mjwtweaks_{$setting}"))) {
          CRM_Core_Resources::singleton()
            ->addScriptFile(E::LONG_NAME, "js/{$setting}{$min}.js", -50, 'page-header');
        }
      }
      break;
  }
}

function mjwtweaks_civicrm_pageRun(&$page) {
  if ($page instanceof CRM_Case_Page_Tab) {
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
  if ((boolean)CRM_Mjwtweaks_Settings::getValue('display_enableadminimaltweaks')) {
    $cssURL = CRM_Core_Resources::singleton()
      ->getUrl('uk.co.mjwconsult.mjwtweaks', 'css/adminimal.css', TRUE);
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
function mjwtweaks_civicrm_links($op, $objectName, &$objectId, &$links, &$mask = NULL, &$values = []) {
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

/**
 * Customise the defaults for the tinymce editor on Mosaico
 *
 * @param array $config
 */
function mjwtweaks_civicrm_mosaicoConfig(&$config) {
  $config['tinymceConfig']['browser_spellcheck'] = TRUE;
  $config['tinymceConfig']['forced_root_block'] = FALSE;
  $config['tinymceConfig']['style_formats'] = [
    0 => [
      'title' => 'Headings',
      'items' => [
        0 => [
          'title' => 'Heading 1',
          'format' => 'h1',
        ],
        1 => [
          'title' => 'Heading 2',
          'format' => 'h2',
        ],
        2 => [
          'title' => 'Heading 3',
          'format' => 'h3',
        ],
        3 => [
          'title' => 'Heading 4',
          'format' => 'h4',
        ],
        4 => [
          'title' => 'Heading 5',
          'format' => 'h5',
        ],
        5 => [
          'title' => 'Heading 6',
          'format' => 'h6',
        ],
      ],
    ],
    1 => [
      'title' => 'Inline',
      'items' => [
        0 => [
          'title' => 'Bold',
          'icon' => 'bold',
          'format' => 'bold',
        ],
        1 => [
          'title' => 'Italic',
          'icon' => 'italic',
          'format' => 'italic',
        ],
        2 => [
          'title' => 'Underline',
          'icon' => 'underline',
          'format' => 'underline',
        ],
        3 => [
          'title' => 'Strikethrough',
          'icon' => 'strikethrough',
          'format' => 'strikethrough',
        ],
        4 => [
          'title' => 'Superscript',
          'icon' => 'superscript',
          'format' => 'superscript',
        ],
        5 => [
          'title' => 'Subscript',
          'icon' => 'subscript',
          'format' => 'subscript',
        ],
        6 => [
          'title' => 'Code',
          'icon' => 'code',
          'format' => 'code',
        ],
      ],
    ],
    2 => [
      'title' => 'Blocks',
      'items' => [
        0 => [
          'title' => 'Paragraph',
          'format' => 'p',
        ],
        1 => [
          'title' => 'Blockquote',
          'format' => 'blockquote',
        ],
        2 => [
          'title' => 'Div',
          'format' => 'div',
        ],
        3 => [
          'title' => 'Pre',
          'format' => 'pre',
        ],
        4 => [
          'title' => 'Bullet list',
          'icon' => 'bullist',
          'cmd' => 'InsertUnorderedList',
        ],
        5 => [
          'title' => 'Numbered list',
          'icon' => 'numlist',
          'cmd' => 'InsertOrderedList',
        ],
      ],
    ],
    3 => [
      'title' => 'Alignment',
      'items' => [
        0 => [
          'title' => 'Left',
          'icon' => 'alignleft',
          'format' => 'alignleft',
        ],
        1 => [
          'title' => 'Center',
          'icon' => 'aligncenter',
          'format' => 'aligncenter',
        ],
        2 => [
          'title' => 'Right',
          'icon' => 'alignright',
          'format' => 'alignright',
        ],
        3 => [
          'title' => 'Justify',
          'icon' => 'alignjustify',
          'format' => 'alignjustify',
        ],
      ],
    ],
    4 => [
      'title' => 'Remove Formatting',
      'cmd' => 'removeformat',
    ],
  ];
}
