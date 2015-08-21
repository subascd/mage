<?php
class Imedia_ProductInquiry_Block_Inquiry extends Mage_Core_Block_Template
{
	public function inquiryCollection($productId){
  
		$inquiryCollections = Mage::getModel('imedia_productinquiry/inquiry')->getCollection()
									->addFieldToFilter('product_id', $productId)
									->addFieldToFilter('is_active','Yes')
									->setOrder('id', 'DESC');
		
		return $inquiryCollections;
	
	}
}
?>