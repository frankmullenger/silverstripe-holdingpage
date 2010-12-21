<?php
class HoldingPageControllerExtension extends Extension {
   
  public function onBeforeInit() {
    
    //Redirect to holding page if necessary
    HoldingPage::redirectToHolding();
  }
  
  /**
   * Indicate if we are currently on the holding page
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