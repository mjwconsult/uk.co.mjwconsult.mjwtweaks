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
    'name' => 'mjwtweaks_display_hidenotyoumessage',
    'type' => 'Boolean',
    'add' => '5.3',
    'is_domain' => 1,
    'is_contact' => 0,
    'default' => FALSE,
    'title' => 'Hide the "Not You" message/link on Contribution/Event Registration pages',
    'html_type' => 'checkbox',
    'html_attributes' => [],
    'settings_pages' => [
      'mjwtweaks' => [
        'weight' => 10,
      ]
    ]
  ],
  'mjwtweaks_caseui_printreport' => [
    'name' => 'mjwtweaks_caseui_printreport',
    'type' => 'Boolean',
    'add' => '5.13',
    'is_domain' => 1,
    'is_contact' => 0,
    'default' => TRUE,
    'title' => 'Show "Print Report" on Manage cases',
    'html_type' => 'checkbox',
    'html_attributes' => [],
    'settings_pages' => [
      'mjwtweaks' => [
        'weight' => 20,
      ]
    ]
  ],
  'mjwtweaks_caseui_exportpdf' => [
    'name' => 'mjwtweaks_caseui_exportpdf',
    'type' => 'Boolean',
    'add' => '5.13',
    'is_domain' => 1,
    'is_contact' => 0,
    'default' => TRUE,
    'title' => 'Show "Export as PDF" on Manage cases',
    'html_type' => 'checkbox',
    'html_attributes' => [],
    'settings_pages' => [
      'mjwtweaks' => [
        'weight' => 30,
      ]
    ]
  ],
  'mjwtweaks_caseui_mergecases' => [
    'name' => 'mjwtweaks_caseui_mergecases',
    'type' => 'Boolean',
    'add' => '5.13',
    'is_domain' => 1,
    'is_contact' => 0,
    'default' => TRUE,
    'title' => 'Show "Merge Cases" on Manage cases',
    'html_type' => 'checkbox',
    'html_attributes' => [],
    'settings_pages' => [
      'mjwtweaks' => [
        'weight' => 40,
      ]
    ]
  ],
  'mjwtweaks_caseui_assignotherclient' => [
    'name' => 'mjwtweaks_caseui_assignotherclient',
    'type' => 'Boolean',
    'add' => '5.13',
    'is_domain' => 1,
    'is_contact' => 0,
    'default' => TRUE,
    'title' => 'Show "Assign to other client" on Manage cases',
    'html_type' => 'checkbox',
    'html_attributes' => [],
    'settings_pages' => [
      'mjwtweaks' => [
        'weight' => 50,
      ]
    ]
  ],
  'mjwtweaks_caseui_timeline' => [
    'name' => 'mjwtweaks_caseui_timeline',
    'type' => 'Boolean',
    'add' => '5.13',
    'is_domain' => 1,
    'is_contact' => 0,
    'default' => TRUE,
    'title' => 'Show "Add Timeline / Activity Audit" on Manage cases',
    'html_type' => 'checkbox',
    'html_attributes' => [],
    'settings_pages' => [
      'mjwtweaks' => [
        'weight' => 60,
      ]
    ]
  ],
  'mjwtweaks_caseui_otherrelationships' => [
    'name' => 'mjwtweaks_caseui_otherrelationships',
    'type' => 'Boolean',
    'add' => '5.13',
    'is_domain' => 1,
    'is_contact' => 0,
    'default' => TRUE,
    'title' => 'Show "Other relationships" on Manage cases',
    'html_type' => 'checkbox',
    'html_attributes' => [],
    'settings_pages' => [
      'mjwtweaks' => [
        'weight' => 70,
      ]
    ]
  ],
  'mjwtweaks_caseui_activityschedulefollowup' => [
    'name' => 'mjwtweaks_caseui_activityschedulefollowup',
    'type' => 'Boolean',
    'add' => '5.13',
    'is_domain' => 1,
    'is_contact' => 0,
    'default' => TRUE,
    'title' => 'Show Schedule Follow-up on Case activities',
    'html_type' => 'checkbox',
    'html_attributes' => [],
    'settings_pages' => [
      'mjwtweaks' => [
        'weight' => 80,
      ]
    ]
  ],
  'mjwtweaks_caseui_activitysendcopy' => [
    'name' => 'mjwtweaks_caseui_activitysendcopy',
    'type' => 'Boolean',
    'add' => '5.13',
    'is_domain' => 1,
    'is_contact' => 0,
    'default' => TRUE,
    'title' => 'Show "Send a copy" on Case activities',
    'html_type' => 'checkbox',
    'html_attributes' => [],
    'settings_pages' => [
      'mjwtweaks' => [
        'weight' => 90,
      ]
    ]
  ],
  'mjwtweaks_caseui_activitypriority' => [
    'name' => 'mjwtweaks_caseui_activitypriority',
    'type' => 'Boolean',
    'add' => '5.13',
    'is_domain' => 1,
    'is_contact' => 0,
    'default' => TRUE,
    'title' => 'Show "Priority" on Case activities',
    'html_type' => 'checkbox',
    'html_attributes' => [],
    'settings_pages' => [
      'mjwtweaks' => [
        'weight' => 100,
      ]
    ]
  ],
  'mjwtweaks_caseui_hidecopytocase' => [
    'name' => 'mjwtweaks_caseui_hidecopytocase',
    'type' => 'Boolean',
    'add' => '5.35',
    'is_domain' => 1,
    'is_contact' => 0,
    'default' => FALSE,
    'title' => 'Hide "Copy to case" on Manage Case.',
    'html_type' => 'checkbox',
    'html_attributes' => [],
    'settings_pages' => [
      'mjwtweaks' => [
        'weight' => 110,
      ]
    ]
  ],
];
