<?php
/**
 *Product Inquiry Widget Form Container
*/
class Imedia_ProductInquiry_Block_Adminhtml_Inquiry_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
public function __construct()
{
    $this->_blockGroup = 'imedia_productinquiry';
    $this->_controller = 'adminhtml_inquiry';

    parent::__construct();

   
}

/**
 * Get Header text
 *
 * @return string
 */
public function getHeaderText()
{
    if (Mage::registry('imedia_productinquiry')->getId()) {
        return Mage::helper('imedia_productinquiry')->__('Edit Product Inquiry');
    }
    else {
        return Mage::helper('imedia_productinquiry')->__('New Product Inquiry');
    }
}
}