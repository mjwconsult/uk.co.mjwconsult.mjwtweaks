<?php

require_once 'mjwtweaks.civix.php';
use CRM_Mjwtweaks_ExtensionUtil as E;

/**
 * Implements hook_civicrm_install().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_install
 */
function mjwtweaks_civicrm_install() {
  _mjwtweaks_civix_civicrm_install();
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
        // The following requires https://github.com/civicrm/civicrm-core/pull/18236
        switch ($formName) {
          case 'CRM_Contribute_Form_Contribution_Main':
            CRM_Core_Region::instance('contribution-main-not-you-block')
              ->update('default', ['disabled' => TRUE]);
            break;

          case 'CRM_Event_Form_Registration_Register':
            CRM_Core_Region::instance('event-register-not-you-block')
              ->update('default', ['disabled' => TRUE]);
            break;
        }
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

    case 'CRM_Event_Form_ManageEvent_Registration':
      $defaults['registration_link_text'] = E::ts('Register');
      $form->setDefaults($defaults);
      break;

    case 'CRM_Event_Form_ManageEvent_EventInfo':
      $defaults['is_share'] = FALSE;
      $form->setDefaults($defaults);
      if ($form->elementExists('is_share')) {
        $form->removeElement('is_share');
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
    if ((boolean) \Civi::settings()->get('mjwtweaks_caseui_hidecopytocase')) {
      CRM_Core_Resources::singleton()
        ->addScriptFile(E::LONG_NAME, 'js/hide_copytocase.js');
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
