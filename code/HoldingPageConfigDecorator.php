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

    $holdingPages = DataObject::get('HoldingPage', "`Status` = 'Published'");
    if ($holdingPages) {
      $treedropdownfield = new DropdownField("ShowHoldingPageID", "Choose a holding page to display <br />(only published holding pages are available)", $holdingPages->toDropDownMap());
      $treedropdownfield->setHasEmptyDefault(true);
      $fields->addFieldToTab("Root.Main", $treedropdownfield);
    }
    
  }

}