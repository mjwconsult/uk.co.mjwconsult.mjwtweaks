<?php
/*--------------------------------------------------------------------+
 | CiviCRM version 4.7                                                |
+--------------------------------------------------------------------+
 | Copyright CiviCRM LLC (c) 2004-2017                                |
+--------------------------------------------------------------------+
 | This file is a part of CiviCRM.                                    |
 |                                                                    |
 | CiviCRM is free software; you can copy, modify, and distribute it  |
 | under the terms of the GNU Affero General Public License           |
 | Version 3, 19 November 2007 and the CiviCRM Licensing Exception.   |
 |                                                                    |
 | CiviCRM is distributed in the hope that it will be useful, but     |
 | WITHOUT ANY WARRANTY; without even the implied warranty of         |
 | MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.               |
 | See the GNU Affero General Public License for more details.        |
 |                                                                    |
 | You should have received a copy of the GNU Affero General Public   |
 | License and the CiviCRM Licensing Exception along                  |
 | with this program; if not, contact CiviCRM LLC                     |
 | at info[AT]civicrm[DOT]org. If you have questions about the        |
 | GNU Affero General Public License or the licensing of CiviCRM,     |
 | see the CiviCRM license FAQ at http://civicrm.org/licensing        |
 +-------------------------------------------------------------------*/

return [
  'mjwtweaks_display_hidenotyoumessage' => [
    'admin_group' => 'mjwtweaks_display',
    'admin_grouptitle' => 'Display Settings',
    'admin_groupdescription' => 'Tweaks for display.',
    'group_name' => 'MJWTweaks Settings',
    'group' => 'mjwtweaks',
    'name' => 'mjwtweaks_display_hidenotyoumessage',
    'type' => 'Boolean',
    'add' => '5.3',
    'is_domain' => 1,
    'is_contact' => 0,
    'default' => FALSE,
    'description' => 'Hide the "Not You" message/link on Contribution/Event Registration pages',
    'html_type' => 'Checkbox',
    'html_attributes' => [],
  ],
  'mjwtweaks_display_disableshoreditchtweaks' => [
    'admin_group' => 'mjwtweaks_display',
    'group_name' => 'MJWTweaks Settings',
    'group' => 'mjwtweaks',
    'name' => 'mjwtweaks_display_disableshoreditchtweaks',
    'type' => 'Boolean',
    'add' => '5.3',
    'is_domain' => 1,
    'is_contact' => 0,
    'default' => TRUE,
    'description' => 'Disable loading the shoreditch.css customisations included in this extension.',
    'html_type' => 'Checkbox',
    'html_attributes' => [],
  ],
  'mjwtweaks_display_blockformajaxload' => [
    'admin_group' => 'mjwtweaks_display',
    'group_name' => 'MJWTweaks Settings',
    'group' => 'mjwtweaks',
    'name' => 'mjwtweaks_display_blockformajaxload',
    'type' => 'Boolean',
    'add' => '5.3',
    'is_domain' => 1,
    'is_contact' => 0,
    'default' => FALSE,
    'description' => 'Block form when AJAX loading (good for waiting for custom data, not so good for mailing screen etc).',
    'html_type' => 'Checkbox',
    'html_attributes' => [],
  ],

  'mjwtweaks_caseui_printreport' => [
    'admin_group' => 'mjwtweaks_caseui',
    'admin_grouptitle' => 'Case UI settings',
    'admin_groupdescription' => 'Tweaks for Cases UI.',
    'group_name' => 'MJWTweaks Settings',
    'group' => 'mjwtweaks',
    'name' => 'mjwtweaks_caseui_printreport',
    'type' => 'Boolean',
    'add' => '5.13',
    'is_domain' => 1,
    'is_contact' => 0,
    'default' => TRUE,
    'description' => 'Show "Print Report" on Manage cases',
    'html_type' => 'Checkbox',
    'html_attributes' => [],
  ],
  'mjwtweaks_caseui_exportpdf' => [
    'admin_group' => 'mjwtweaks_caseui',
    'group_name' => 'MJWTweaks Settings',
    'group' => 'mjwtweaks',
    'name' => 'mjwtweaks_caseui_exportpdf',
    'type' => 'Boolean',
    'add' => '5.13',
    'is_domain' => 1,
    'is_contact' => 0,
    'default' => TRUE,
    'description' => 'Show "Export as PDF" on Manage cases',
    'html_type' => 'Checkbox',
    'html_attributes' => [],
  ],
  'mjwtweaks_caseui_mergecases' => [
    'admin_group' => 'mjwtweaks_caseui',
    'group_name' => 'MJWTweaks Settings',
    'group' => 'mjwtweaks',
    'name' => 'mjwtweaks_caseui_mergecases',
    'type' => 'Boolean',
    'add' => '5.13',
    'is_domain' => 1,
    'is_contact' => 0,
    'default' => TRUE,
    'description' => 'Show "Merge Cases" on Manage cases',
    'html_type' => 'Checkbox',
    'html_attributes' => [],
  ],
  'mjwtweaks_caseui_assignotherclient' => [
    'admin_group' => 'mjwtweaks_caseui',
    'group_name' => 'MJWTweaks Settings',
    'group' => 'mjwtweaks',
    'name' => 'mjwtweaks_caseui_assignotherclient',
    'type' => 'Boolean',
    'add' => '5.13',
    'is_domain' => 1,
    'is_contact' => 0,
    'default' => TRUE,
    'description' => 'Show "Assign to other client" on Manage cases',
    'html_type' => 'Checkbox',
    'html_attributes' => [],
  ],
  'mjwtweaks_caseui_timeline' => [
    'admin_group' => 'mjwtweaks_caseui',
    'group_name' => 'MJWTweaks Settings',
    'group' => 'mjwtweaks',
    'name' => 'mjwtweaks_caseui_timeline',
    'type' => 'Boolean',
    'add' => '5.13',
    'is_domain' => 1,
    'is_contact' => 0,
    'default' => TRUE,
    'description' => 'Show "Add Timeline / Activity Audit" on Manage cases',
    'html_type' => 'Checkbox',
    'html_attributes' => [],
  ],
  'mjwtweaks_caseui_otherrelationships' => [
    'admin_group' => 'mjwtweaks_caseui',
    'group_name' => 'MJWTweaks Settings',
    'group' => 'mjwtweaks',
    'name' => 'mjwtweaks_caseui_otherrelationships',
    'type' => 'Boolean',
    'add' => '5.13',
    'is_domain' => 1,
    'is_contact' => 0,
    'default' => TRUE,
    'description' => 'Show "Other relationships" on Manage cases',
    'html_type' => 'Checkbox',
    'html_attributes' => [],
  ],
  'mjwtweaks_caseui_activityschedulefollowup' => [
    'admin_group' => 'mjwtweaks_caseui',
    'group_name' => 'MJWTweaks Settings',
    'group' => 'mjwtweaks',
    'name' => 'mjwtweaks_caseui_activityschedulefollowup',
    'type' => 'Boolean',
    'add' => '5.13',
    'is_domain' => 1,
    'is_contact' => 0,
    'default' => TRUE,
    'description' => 'Show Schedule Follow-up on Case activities',
    'html_type' => 'Checkbox',
    'html_attributes' => [],
  ],
  'mjwtweaks_caseui_activitysendcopy' => [
    'admin_group' => 'mjwtweaks_caseui',
    'group_name' => 'MJWTweaks Settings',
    'group' => 'mjwtweaks',
    'name' => 'mjwtweaks_caseui_activitysendcopy',
    'type' => 'Boolean',
    'add' => '5.13',
    'is_domain' => 1,
    'is_contact' => 0,
    'default' => TRUE,
    'description' => 'Show "Send a copy" on Case activities',
    'html_type' => 'Checkbox',
    'html_attributes' => [],
  ],
  'mjwtweaks_caseui_activitypriority' => [
    'admin_group' => 'mjwtweaks_caseui',
    'group_name' => 'MJWTweaks Settings',
    'group' => 'mjwtweaks',
    'name' => 'mjwtweaks_caseui_activitypriority',
    'type' => 'Boolean',
    'add' => '5.13',
    'is_domain' => 1,
    'is_contact' => 0,
    'default' => TRUE,
    'description' => 'Show "Priority" on Case activities',
    'html_type' => 'Checkbox',
    'html_attributes' => [],
  ],
];
