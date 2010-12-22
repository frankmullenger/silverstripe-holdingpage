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

  /**
   * Remove Unpublish button if this page is currently being used as the holding
   * page for the website.
   */
  function getCMSActions() {
    
    $actions = parent::getCMSActions();
    
    $siteConfig = SiteConfig::current_site_config();
    $holdingPage = $siteConfig->ShowHoldingPage();

    if ($this->ID == $holdingPage->ID) {

      $actions->removeByName('action_unpublish');
      
      $url = Director::absoluteURL('admin/show/root', true);
      $message = <<<EOS
You cannot unpublish this page because it is currently being used as a holding page for your site.<br />
You can change the holding page here: <a href="$url">Change Holding Page</a>
EOS;
      
      Session::set("FormInfo.Form_EditForm.formError.message", $message);
      Session::set("FormInfo.Form_EditForm.formError.type", 'bad');
    }
    
    return $actions;
  }

  /**
   * If the current page is set as the holding page then once it gets unpublished
   * it is removed as the holding page. Already removing unpublish button above so this 
   * is belt and braces.
   */
  function doUnpublish() {

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
  }

}

class HoldingPage_Controller extends Page_Controller {

  function init() {
    parent::init();
  }

}
?>