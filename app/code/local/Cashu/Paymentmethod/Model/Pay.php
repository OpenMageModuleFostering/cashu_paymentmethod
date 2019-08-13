<?php
class Cashu_Paymentmethod_Model_Pay extends Mage_Payment_Model_Method_Abstract {
	protected $_code = 'paymentmethod';
	
	protected $_isInitializeNeeded      = true;
	protected $_canUseInternal          = true;
	protected $_canUseForMultishipping  = false;
	
	public function getOrderPlaceRedirectUrl() {
		return Mage::getUrl('paymentmethod/payment/redirect', array('_secure' => true));
	}
}
