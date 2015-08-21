<?php
/**
 *Product Inquiry Widget Form
*/
class Imedia_ProductInquiry_Block_Adminhtml_Inquiry_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    /**
     * Init class
     */
    public function __construct()
    {
        parent::__construct();

        $this->setId('imedia_productinquiry_inquiry_form');
        $this->setTitle(Mage::helper('imedia_productinquiry')->__('Product Inquiry Information'));
    }

    /**
     * Setup form fields for inserts/updates
     *
     * return Mage_Adminhtml_Block_Widget_Form
     */
    protected function _prepareForm()
    {
        $model = Mage::registry('imedia_productinquiry');
		
		
		$inquiryCollections = Mage::getModel('imedia_productinquiry/inquiry')->getCollection()
									->addFieldToFilter('id', $model->getData('id'))
									->getFirstItem();
										
		$active = $inquiryCollections->getIsActive();

		
		$form = new Varien_Data_Form(array(
            'id' => 'edit_form',
            'action'    =>$this->getUrl('*/*/save', array('id' => $this->getRequest()->getParam('id'))),
            'method'    => 'post'
        ));

        $fieldset = $form->addFieldset('base_fieldset', array(
            'legend' => Mage::helper('imedia_productinquiry')->__('Product Inquiry Information'),
            'class' => 'fieldset-wide',
        ));

        if ($model->getId()) {
            $fieldset->addField('id', 'hidden', array(
                'name' => 'id',				
            ));
        }

        $fieldset->addField('product_name', 'label', array(
            'product_name' => 'product_name',
            'label' => Mage::helper('imedia_productinquiry')->__('Product Name'),
            'title' => Mage::helper('imedia_productinquiry')->__('Product Name'),			
        ));
		
		$fieldset->addField('product_sku', 'label', array(
            'product_sku' => 'product_sku',
            'label' => Mage::helper('imedia_productinquiry')->__('Product SKU'),
            'title' => Mage::helper('imedia_productinquiry')->__('Product SKU'),			
        ));
		
		$fieldset->addField('user_name', 'label', array(
            'user_name' => 'user_name',
            'label' => Mage::helper('imedia_productinquiry')->__('Name'),
            'title' => Mage::helper('imedia_productinquiry')->__('Name'),
        ));

        $fieldset->addField('user_email', 'label', array(
            'user_email' => 'user_email',
            'label' => Mage::helper('imedia_productinquiry')->__('Email'),
            'title' => Mage::helper('imedia_productinquiry')->__('Email'),
        ));
		
		$fieldset->addField('user_question', 'label', array(
            'user_question' => 'user_question',
            'label' => Mage::helper('imedia_productinquiry')->__('Question'),
            'title' => Mage::helper('imedia_productinquiry')->__('Question'),
        ));
		
		$fieldset->addField('admin_answer', 'textarea', array(
          'label'     => Mage::helper('imedia_productinquiry')->__('Answer'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'admin_answer',
        ));
		
		$fieldset->addField('is_active', 'select', array(
          'label'     => Mage::helper('imedia_productinquiry')->__('Is Active'),
          'class'     => 'required-entry',
		  'name'      => 'is_active',
          'required'  => true,
		  'value'=>$active,
          'values' => array('Yes' => 'Yes','No' => 'No'),
		  'after_element_html' => '<br/><small>Select Yes to show this answer on Product Page</small>',
		));
		$fieldset->addField('sand_mail', 'checkbox', array(
          'label'     => Mage::helper('imedia_productinquiry')->__('Notify User by Email'),
		  'onclick'   => 'this.value = this.checked ? 1 : 0;',
          'name'      => 'send_mail',
        ));
		
		$form_data = $model->getData();
		$form->setValues($form_data);
		$form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}