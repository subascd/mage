<?php
/**
 *Product Inquiry Controller
*/
class Imedia_ProductInquiry_Adminhtml_InquiryController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $this->_initAction()->renderLayout();
    }


    /**
     * Initialize action
     * @return Mage_Adminhtml_Controller_Action
     */
    protected function _initAction()
    {
        $this->loadLayout()
            ->_setActiveMenu('imedia_productinquiry_inquiry')
            ->_title(Mage::helper('imedia_productinquiry')->__('Product Inquiry'))
            ->_addBreadcrumb(Mage::helper('imedia_productinquiry')->__('Product Inquiry'))
            ->_addBreadcrumb(Mage::helper('imedia_productinquiry')->__('Product Inquiry'));

        return $this;
    }
    public function newAction()
    {
        $this->_forward('edit');
    }

    public function editAction()
    {
        $this->_initAction();

        // Get id if available
        $id  = $this->getRequest()->getParam('id');
        $model = Mage::getModel('imedia_productinquiry/inquiry');

        if ($id) {
            // Load record
            $model->load($id);
           
            if (!$model->getId()) {
                Mage::getSingleton('adminhtml/session')->addError(Mage::helper('imedia_productinquiry')->__('This Enquiry no longer exists.'));
                $this->_redirect('*/*/');

                return;
            }
        }

        $data = Mage::getSingleton('adminhtml/session')->getMenuData(true);
        if (!empty($data)) {
            $model->setData($data);
        }

        Mage::register('imedia_productinquiry', $model);

        $this->_initAction()
             ->_addContent($this->getLayout()->createBlock('imedia_productinquiry/adminhtml_inquiry_edit')->setData('action', $this->getUrl('*/*/save')))
             ->_addLeft($this->getLayout()->createBlock('imedia_productinquiry/adminhtml_inquiry_edit_tab'))
             ->renderLayout();
    }
    public function deleteAction()
    {
        if( $this->getRequest()->getParam('id') > 0 ) {
            try {
                $model = Mage::getModel('imedia_productinquiry/inquiry');
				$model->setId($this->getRequest()->getParam('id'))->delete();
				Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('imedia_productinquiry')->__('Item was successfully deleted'));
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            }
        }
        $this->_redirect('*/*/');
    }
    public function saveAction()
    {
        if ($postData = $this->getRequest()->getPost()) {
            
			$model = Mage::getSingleton('imedia_productinquiry/inquiry');
            
			$inquiryCollections = $model->getCollection()->addFieldToFilter('id', $postData['id'])->getFirstItem();
			
			$userName =  $inquiryCollections->getUserName();
			$userEmail =  $inquiryCollections->getUserEmail();
			$userQuestion =  $inquiryCollections->getUserQuestion();
			$productName = $inquiryCollections->getProductName();
			
			try {
                
				if($postData['send_mail'] == 1)
				{	
					
					$userTemplateVal = Mage::getStoreConfig('inquiry/product/template');
					if($userTemplateVal == 'inquiry_product_template' || $userTemplateVal == ''){ 
						$emailTemplate = Mage::getModel('core/email_template')->loadDefault('inquiry_product_template');
					}else{
						$emailTemplate = Mage::getModel('core/email_template')->load($userTemplateVal);
					}
					
					//Getting the Store E-Mail Sender Name.
					$storeName = Mage::getStoreConfig('general/store_information/name');
					//Getting the Store General E-Mail.
					$senderEmail = Mage::getStoreConfig('trans_email/ident_general/email');
					//Variables for Confirmation Mail.
					$emailTemplateVariables = array();
					$emailTemplateVariables['userName'] = $userName;
					$emailTemplateVariables['userQuestion'] = $userQuestion;
					$emailTemplateVariables['userAnswer'] = $postData['admin_answer'];
					$emailTemplateVariables['productName'] = $productName;
					$emailTemplateVariables['storeName'] = $storeName;
					
					$processedTemplate = $emailTemplate->getProcessedTemplate($emailTemplateVariables);
					
					$mail = Mage::getModel('core/email')
								->setToName($userName)
								->setToEmail($userEmail)
								->setBody($processedTemplate)
								->setSubject('Product Inquiry - '.$productName)
								->setFromEmail($senderEmail)
								->setFromName($storeName)
								->setType('html');
					
					$mail->send();
				}
				$model->setData($postData);
				$model->save();

                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('imedia_productinquiry')->__('The Status has been saved.'));
                $this->_redirect('*/*/');

                return;
            }
            catch (Mage_Core_Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
            catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError(Mage::helper('imedia_productinquiry')->__('An error occurred while saving this status.'));
            }

            Mage::getSingleton('adminhtml/session')->setEnquiryData($postData);
            $this->_redirectReferer();
        }
    }
   
    public function massDeleteAction()
    {
        $adListingIds = $this->getRequest()->getParam('id');
        if(!is_array($adListingIds)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('imedia_productinquiry')->__('Please select Any Listing(s).'));
        } else {
            try {
                $model = Mage::getSingleton('imedia_productinquiry/inquiry');
				
                foreach ($adListingIds as $adId) {
				
					$model->load($adId)->delete();
				
				}
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('imedia_productinquiry')->__('Total of %d record(s) were deleted.', count($adListingIds)));
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/');
    }
    public function messageAction()
    {
        $data = Mage::getModel('imedia_productinquiry/inquiry')->load($this->getRequest()->getParam('id'));
        echo $data->getContent();
    }
    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('imedia_productinquiry_inquiry');
    }
   
}