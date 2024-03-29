<?php

class Cashu_Prepaid_PaymentController extends Mage_Core_Controller_Front_Action {
    // The redirect action is triggered when someone places an order
    public function redirectAction() {
        $this->loadLayout();
        $block = $this->getLayout()->createBlock('Mage_Core_Block_Template','cashu_prepaid',array('template' => 'cashu/prepaid/redirect.phtml'));
        $this->getLayout()->getBlock('content')->append($block);
        $this->renderLayout();
    }

    // The response action is triggered when your gateway sends back a response after processing the customer's payment
    public function responseAction() {
        if($this->getRequest()->isPost()) {

            /*
            /* Your gateway's code to make sure the reponse you
            /* just got is from the gatway and not from some weirdo.
            /* This generally has some checksum or other checks,
            /* and is provided by the gateway.
            /* For now, we assume that the gateway's response is valid
            */

            //extract($_POST);

            $validated = true;
            $orderId = $_POST['txt1']; // Generally sent by gateway

            //var_dump($orderId);

            if($validated) {

                // Payment was successful, so update the order's state, send order email and move to the success page
                $order = Mage::getModel('sales/order');
                $order->loadByIncrementId($orderId);
                //$order->setState(Mage_Sales_Model_Order::STATE_PROCESSING, true, 'Gateway has authorized the payment.');

                /** trying to create invoice **/
                try {


                    if(!$order->canInvoice()):

                        //Mage::throwException(Mage::helper('core')->__('cannot create invoice !'));
                        Mage::throwException(Mage::helper('core')->__('cannot create an invoice !'));

                    else:

                    /** create invoice  **/
                    //$invoiceId = Mage::getModel('sales/order_invoice_api')->create($order->getIncremenetId(), array());
                    $invoice = Mage::getModel('sales/service_order', $order)->prepareInvoice();

                    if(!$invoice->getTotalQty()):
                    Mage::throwException(Mage::helper('core')->__('cannot create an invoice without products !'));
                    endif;

                    $invoice->setRequestedCaptureCase(Mage_Sales_Model_Order_Invoice::CAPTURE_ONLINE);
                    $invoice->register();
                    $transactionSave = Mage::getModel('core/resource_transaction')->addObject($invoice)->addObject($invoice->getOrder());
                    $transactionSave->save();

                    $order->setState(Mage_Sales_Model_Order::STATE_PROCESSING, true, 'Gateway has authorized the payment.');
                    /** load invoice **/
                    //$invoice = Mage::getModel('sales/order_invoice')->loadByIncrementId($invoiceId);
                    /** pay invoice **/
                    //$invoice->capture()->save();



                    endif;
                }
                catch(Mage_Core_Exception $e){
                    Mage::throwException(Mage::helper('core')->__('cannot create an invoice !'));
                    }

                $order->sendNewOrderEmail();
                $order->setEmailSent(true);

                $order->save();

                //Mage::getSingleton('checkout/session')->unsQuoteId();

                //header('location: http://test.shopgo.me/cashument/payment/success');
                //Mage_Core_Controller_Varien_Action::_redirect('checkout/onepage/success', array('_secure'=>true));
                //echo $orderId;
                //$this->getLayout()->helper('page/layout')->applyTemplate('two_columns_left');

        $block = $this->getLayout()->createBlock('Mage_Core_Block_Template','cashu_prepaid_block',array('template' => 'cashu/prepaid/success.phtml'))->setData('order', $orderId);


        $this->loadLayout()->getLayout()->getBlock('root')->setTemplate('page/2columns-left.phtml');


        $this->loadLayout()->getLayout()->getBlock('content')->append($block);


        $this->renderLayout();


            }
            else {
                // There is a problem in the response we got
                $this->cancelAction();
                Mage_Core_Controller_Varien_Action::_redirect('checkout/onepage/failure', array('_secure'=>true));
            }
        }
        else
        {
            $this->_redirectUrl(Mage::getBaseUrl());
        }


    }

    // The cancel action is triggered when an order is to be cancelled
    public function cancelAction() {
        if (Mage::getSingleton('checkout/session')->getLastRealOrderId()) {
            $order = Mage::getModel('sales/order')->loadByIncrementId(Mage::getSingleton('checkout/session')->getLastRealOrderId());
            if($order->getId()) {
                // Flag the order as 'cancelled' and save it
                $order->cancel()->setState(Mage_Sales_Model_Order::STATE_CANCELED, true, 'Gateway has declined the payment.')->save();
            }
        }
    }

    public function successAction(){
        /**/

        }

    public function nourlAction(){

        echo 'error : check your configuration';
    }
}
