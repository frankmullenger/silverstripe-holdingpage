<?php
 
class HoldingPage extends Page {
  
  static $db = array(
  );
  static $has_one = array(
  );
  static $allowed_children = array(
  );
  static $has_many = array (
  );
  static $defaults = array(
    "ShowInMenus" => 0,
    "ShowInSearch" => 0
  );
  
  function getCMSFields() {
    $fields = parent::getCMSFields();
    return $fields;
  }
  
  /**
   * If a holding page is set then redirect to it, unless current user is an admin
   */
  public static function redirectToHolding() {

    $holdingPage = SiteConfig::current_site_config()->ShowHoldingPage();
    $currentUser = Member::currentUser();
    
    if ($holdingPage->exists() 
        && $holdingPage instanceof HoldingPage 
        && $holdingPage->getExistsOnLive()) {

      //Do not redirect for admin users, allow them to browse the site
      if ($currentUser && $currentUser->isAdmin()) {
        return;
      }    
          
      if (Director::get_current_page() != $holdingPage) {
        Director::redirect($holdingPage->Link());
      }
    }
  }
  
}
 
class HoldingPage_Controller extends Page_Controller {

  function init() { 
    parent::init();
  }

}
?>