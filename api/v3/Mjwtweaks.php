<?php

/**
 * Enable / disable Household
 */
function civicrm_api3_mjwtweaks_contacttype_household($params) {
  if ($params['enable']) {
    CRM_Core_DAO::executeQuery('UPDATE civicrm_contact_type SET is_active=1 WHERE name="Household"');
    CRM_Core_DAO::executeQuery('UPDATE civicrm_relationship_type SET is_active=1 WHERE name_a_b="Head of Household for"');
    CRM_Core_DAO::executeQuery('UPDATE civicrm_relationship_type SET is_active=1 WHERE name_a_b="Household Member of"');
  }
  else {
    CRM_Core_DAO::executeQuery('UPDATE civicrm_contact_type SET is_active=0 WHERE name="Household"');
    CRM_Core_DAO::executeQuery('UPDATE civicrm_relationship_type SET is_active=0 WHERE name_a_b="Head of Household for"');
    CRM_Core_DAO::executeQuery('UPDATE civicrm_relationship_type SET is_active=0 WHERE name_a_b="Household Member of"');
  }
  return civicrm_api3_create_success(TRUE, $params, 'Mjwtweaks', 'contacttype_household');
}

function _civicrm_api3_mjwtweaks_contacttype_household_spec(&$spec) {
  $spec['enable']['title'] = 'Enable Household Contact Type?';
  $spec['enable']['type'] = CRM_Utils_Type::T_BOOLEAN;
  $spec['enable']['api.required'] = TRUE;
}
