<?php 
class Imedia_ProductInquiry_FormController extends Mage_Core_Controller_Front_Action
{
    public function submitAction()
    {
		$post           = $this->getRequest()->getPost();
		$captchaSession = Mage::getSingleton('core/session')->getCaptchaVal();
		$captchaVal     = $post['captcha_answer'];
		if($captchaSession == $captchaVal){
			$currentUrl     = $post['current_url'];
			$productId      = $post['product_id'];
			$productName    = $post['product_name'];
			$productSku     = $post['product_sku'];
			$userName       = $post['user_name'];
			$userEmail      = $post['user_email'];
			$userQuestion   = $post['user_question'];
			$postData       = array("product_id"=>$productId, "product_name"=>$productName, "product_sku"=>$productSku, "user_name"=> $userName, "user_email"=> $userEmail, "user_question"=> htmlspecialchars ($userQuestion),"is_active"=>"No");

			// save the values to inquiry model
			$inquiryModel = Mage::getModel('imedia_productinquiry/inquiry');
			try{				
				$inquiryModel->setData($postData);
				$inquiryModel->save();
				echo '<ul class="messages"><li class="success-msg"><ul><li><span>Your Inquiry about <u>'.$productName.'</u> is Successfully Submitted.</span></li></ul></li></ul>';
				//send inquiry to admin
				$emailTemplate = Mage::getModel('core/email_template')->loadDefault('admin_notification_template');
				//Getting the Store E-Mail Sender Name.
				$storeName = Mage::getStoreConfig('general/store_information/name');
				//Getting the Store General E-Mail.
				$adminEmail = Mage::getStoreConfig('trans_email/ident_general/email');
				//Variables for Confirmation Mail.
				$emailTemplateVariables = array();
				$emailTemplateVariables['userName'] = ucfirst($userName);
				$emailTemplateVariables['userQuestion'] = $userQuestion;
				$emailTemplateVariables['productName'] = $productName;
				$emailTemplateVariables['storeName'] = $storeName;
				
				$processedTemplate = $emailTemplate->getProcessedTemplate($emailTemplateVariables);
				
				$mail = Mage::getModel('core/email')
							->setToName($storeName)
							->setToEmail($adminEmail)
							->setBody($processedTemplate)
							->setSubject('Product Inquiry - '.$productName)
							->setFromEmail($userEmail)
							->setFromName($userName)
							->setType('html');
				
				$mail->send();			
			}catch(Exception $e){
				echo '<ul class="messages"><li class="error-msg"><ul><li><span>Error in saving data</span></li></ul></li></ul>';
			}
			
		}else{
			echo '<ul class="messages"><li class="error-msg"><ul><li><span>Please enter the correct captcha value.</span></li></ul></li></ul>&&1';
		}		
	}	
}