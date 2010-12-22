<?php
class HoldingPageControllerExtension extends Extension {
   
  /**
   * Redirect to the holding page if necessary
   * 
   * @return Void
   */
  public function onBeforeInit() {
    HoldingPage::redirect_to_holding();
  }
  
  /**
   * Indicate if we are currently on the holding page.
   * Useful for using in templates and view files.
   * 
   * @return Boolean Whether current page is the set holding page
   */
  public function OnHoldingPage() {
    $holdingPage = SiteConfig::current_site_config()->ShowHoldingPage();
    if (Director::get_current_page() == $holdingPage) {
      return true;
    }
    return false;
  }
}