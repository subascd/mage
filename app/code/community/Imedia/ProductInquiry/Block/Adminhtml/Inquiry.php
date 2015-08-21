<?php
/**
 *Product Inquiry Widget Grid Container
 */
class Imedia_ProductInquiry_Block_Adminhtml_Inquiry extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_blockGroup='imedia_productinquiry';
        $this->_controller='adminhtml_inquiry';
        $this->_headerText= Mage::helper('imedia_productinquiry')->__('Imedia Product Inquiry');
        parent::__construct();
        $this->removeButton('add');
    }
}