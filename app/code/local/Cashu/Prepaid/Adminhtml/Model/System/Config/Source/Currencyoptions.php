<?php

class Cashu_Prepaid_Adminhtml_Model_System_Config_Source_Currencyoptions {
    /***/

    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        return array(
            array('value' => 'usd', 'label'=>Mage::helper('adminhtml')->__('USD')),
            array('value' => 'csh', 'label'=>Mage::helper('adminhtml')->__('CSH')),
            array('value' => 'aed', 'label'=>Mage::helper('adminhtml')->__('AED')),
            array('value' => 'eur', 'label'=>Mage::helper('adminhtml')->__('EUR')),
            array('value' => 'jod', 'label'=>Mage::helper('adminhtml')->__('JOD')),
            array('value' => 'egp', 'label'=>Mage::helper('adminhtml')->__('EGP')),
            array('value' => 'sar', 'label'=>Mage::helper('adminhtml')->__('SAR')),
            array('value' => 'dzd', 'label'=>Mage::helper('adminhtml')->__('DZD')),
            array('value' => 'lbp', 'label'=>Mage::helper('adminhtml')->__('LBP')),
            array('value' => 'mad', 'label'=>Mage::helper('adminhtml')->__('MAD')),
            array('value' => 'qar', 'label'=>Mage::helper('adminhtml')->__('QAR')),
            array('value' => 'try', 'label'=>Mage::helper('adminhtml')->__('TRY')),
            array('value' => 'kwd', 'label'=>Mage::helper('adminhtml')->__('KWD')),
            array('value' => 'bhd', 'label'=>Mage::helper('adminhtml')->__('BHD')),
            array('value' => 'omr', 'label'=>Mage::helper('adminhtml')->__('OMR')),
        );
    }

    }
