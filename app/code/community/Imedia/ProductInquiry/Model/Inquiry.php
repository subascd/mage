<?php
class Imedia_ProductInquiry_Model_Inquiry extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('imedia_productinquiry/inquiry');
    }
}