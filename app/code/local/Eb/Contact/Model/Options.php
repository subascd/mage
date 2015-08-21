<?php
class Eb_Contact_Model_Options {
/**
  * Provide available options as a value/label array
  *
  * @return array
  */
  public function toOptionArray() {
    return array(
      array('value' => 'contactform', 'label' => 'Contact Form'),
      array('value' => 'email', 'label' => 'Email Link'),
    );
  }
}