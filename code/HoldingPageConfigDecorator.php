<?php
class HoldingPageConfigDecorator extends DataObjectDecorator {
   
  /**
   * Define extra database field for which holding page to show
   * 
   * @return Array
   */
  function extraStatics() {
    return array(
      'has_one' => array(
        'ShowHoldingPage' => 'SiteTree',
      )
    );
  }

  /**
   * Add a field to the config for choosing a holding page to show
   * 
   * @param FieldSet $fields
   * @return Void
   */
  public function updateCMSFields(FieldSet &$fields) {

    $holdingPages = DataObject::get('HoldingPage', "`Status` = 'Published'");
    if ($holdingPages) {
        
      //TODO need to localise string
      $treedropdownfield = new DropdownField("ShowHoldingPageID", "Choose a holding page to display <br />(only published holding pages are available)", $holdingPages->toDropDownMap());
      $treedropdownfield->setHasEmptyDefault(true);
      $fields->addFieldToTab("Root.Main", $treedropdownfield);
    }
    
  }

}