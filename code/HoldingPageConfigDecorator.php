<?php
class HoldingPageConfigDecorator extends DataObjectDecorator {
   
  function extraStatics() {
    return array(
      'has_one' => array(
        'ShowHoldingPage' => 'SiteTree',
      )
    );
  }

  public function updateCMSFields(FieldSet &$fields) {
    
    //TODO only get published HoldingPages
    
    $holdingPages = DataObject::get('HoldingPage');
    if ($holdingPages) {
      $treedropdownfield = new DropdownField("ShowHoldingPageID", "Choose a holding page to display", DataObject::get('HoldingPage')->toDropDownMap());
      $treedropdownfield->setHasEmptyDefault(true);
      $fields->addFieldToTab("Root.Main", $treedropdownfield);
    }
    
  }

}