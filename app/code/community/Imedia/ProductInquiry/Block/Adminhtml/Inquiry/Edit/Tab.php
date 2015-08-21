<?php
/**
 *Product Inquiry Widget Tabs
*/
class Imedia_ProductInquiry_Block_Adminhtml_Inquiry_Edit_Tab extends Mage_Adminhtml_Block_Widget_Tabs
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('form_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('imedia_productinquiry')->__('Product Inquiry Information'));
    }
    protected function _beforeToHtml()
    {
        $this->addTab('form_section', array(
            'label'     => Mage::helper('imedia_productinquiry')->__('Product Inquiry Information'),
            'title'     => Mage::helper('imedia_productinquiry')->__('Product Inquiry Information'),
        ));

        return parent::_beforeToHtml();
    }
}