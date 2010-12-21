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

  function doUnpublish() {
    
    //TODO return status message to inform user page has been removed from holding in config
    
    //If the holding page is unpublished then remove from the config automatically
    $siteConfig = SiteConfig::current_site_config();
    $holdingPage = $siteConfig->ShowHoldingPage();
    if ($this == $holdingPage) {
      
      $siteConfig->setField('ShowHoldingPageID', 0);
      if (!$siteConfig->write()) {
        return false;
      }
      //Session::set("FormInfo.Form_EditForm.formError.message", 'Removed this page from holding');
    }
    parent::doUnpublish();
    
    /*
    $controller = Controller::curr();
    $request = $controller->getRequest();
    //$response = $controller->getResponse();
    $session = Session::get_all();
    
    SS_Log::log(new Exception(print_r($request, true)), SS_Log::NOTICE);
    SS_Log::log(new Exception(print_r($session, true)), SS_Log::NOTICE);
    
    $holdingPage = SiteConfig::current_site_config()->ShowHoldingPage();
    if ($this == $holdingPage) {
      
      Session::set("FormInfo.Form_EditForm.formError.message", 'Could not unpublish this page');
      Session::set("FormInfo.Form_EditForm.formError.type", 'bad');
      
      return false;
    }
    
    parent::doUnpublish();
    */
  }
  
}
 
class HoldingPage_Controller extends Page_Controller {

  function init() { 
    parent::init();
  }

}
?>