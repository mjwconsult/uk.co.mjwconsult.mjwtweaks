<?php
/**
 * https://civicrm.org/licensing
 */

/**
 * Class CRM_Mjwtweaks_Profile
 */
class CRM_Mjwtweaks_Profile {

  /**
   * This allows you to use "contactsubtype=Student" etc to force selection of a specific contact subtype.
   *
   * @throws \CRM_Core_Exception
   */
  public static function contactSubTypeURLParameter(&$form) {
    // Allow to specify contactsubtype as URL parameter
    $contactSubType = CRM_Utils_Request::retrieve('contactsubtype', 'String', $form);
    if (!empty($contactSubType)) {
      $form->getElement('contact_sub_type')->freeze();
      $form->setDefaults(['contact_sub_type' => $contactSubType]);
    }
  }

}
