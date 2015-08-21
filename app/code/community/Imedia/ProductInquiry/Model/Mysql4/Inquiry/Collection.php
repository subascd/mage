<?php

class Imedia_ProductInquiry_Model_Mysql4_Inquiry_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('imedia_productinquiry/inquiry');
    }
}