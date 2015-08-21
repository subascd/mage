<?php

class Imedia_ProductInquiry_Model_Mysql4_Inquiry extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {    
        $this->_init('imedia_productinquiry/inquiry', 'id');
    }
}