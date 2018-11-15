<?php
/*
 +--------------------------------------------------------------------+
 | CiviCRM version 5                                                  |
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
 +--------------------------------------------------------------------+
 */

/**
 * Retrieve one or more job log record.
 *
 * @param array $params
 *   input parameters
 *
 * @return array
 */
function civicrm_api3_log_get($params) {
  return _civicrm_api3_basic_get(_civicrm_api3_get_BAO(__FUNCTION__), $params);
}

/**
 * Get the last modified details for an entity
 *
 * @param $params
 *
 * @return array|null
 * @throws \CiviCRM_API3_Exception
 */
function civicrm_api3_log_lastmodified($params) {
  $result = CRM_Core_BAO_Log::lastModified($params['entity_id'], $params['entity_table']);
  if ($result) {
    return $result;
  }
  else {
    throw new CiviCRM_API3_Exception('Entity ID not found');
  }
}

function _civicrm_api3_log_lastmodified_spec(&$params) {
  $params['entity_id'] = [
    'api.required' => 1,
    'title' => 'Entity ID',
    'type' => CRM_Utils_Type::T_INT,
  ];
  $params['entity_table'] = [
    'api.required' => 1,
    'title' => 'Entity table',
    'type' => CRM_Utils_Type::T_STRING,
  ];
}
