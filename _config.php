<?php

//Extend the site config
DataObject::add_extension('SiteConfig', 'HoldingPageConfigDecorator');

//Extend the controller
DataObject::add_extension('Page_Controller', 'HoldingPageControllerExtension');