<?php
class Cashu_Prepaid_Block_Onepage_Payment_Methods extends Mage_Checkout_Block_Onepage_Payment_Methods
{

    /**
     * Payment method form html getter
     * @param Mage_Payment_Model_Method_Abstract $method
     */
    public function getPaymentMethodFormHtml(Mage_Payment_Model_Method_Abstract $method)
    {
        switch($method->getCode()):

        case 'prepaid':

            return '<ul class="form-list" id="payment_form_' . $method->getCode() . '" style="display: none;"><li class="form-alt">' . $this->__('You will be redirected to the CashU website to complete your payment after placing your order.') . '</li></ul>';

        break;

        case 'onecard':

            return '<ul class="form-list" id="payment_form_' . $method->getCode() . '" style="display: none;"><li class="form-alt">' . $this->__('You will be redirected to the OneCard website to complete your payment after placing your order.') . '</li></ul>';

        break;

        default:

            return $this->getChildHtml('payment.method.' . $method->getCode());

        endswitch;

    }

}
