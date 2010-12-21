<?php
/**
 * @package silverstripe-holdingpage
 */

//Extend the site config
DataObject::add_extension('SiteConfig', 'HoldingPageConfigDecorator');

//Extend the controller
DataObject::add_extension('Page_Controller', 'HoldingPageControllerExtension');