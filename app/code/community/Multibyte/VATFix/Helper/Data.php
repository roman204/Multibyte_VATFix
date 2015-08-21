<?php

/**
 * @category Multibyte
 * @package Multibyte_VatFix
 * @author Roman Hutterer <info@multibyte.at>
 */
class Multibyte_VATFix_Helper_Data extends Mage_Customer_Helper_Data
{
    const VAT_VALIDATION_WSDL_URL = 'http://ec.europa.eu/taxation_customs/vies/checkVatService.wsdl';

    /**
     * override the checkVatNumber from CustomerHelper
     * @param string $countryCode
     * @param string $vatNumber
     * @param string $requesterCountryCode
     * @param string $requesterVatNumber
     * @return boolean
     */
    public function checkVatNumber($countryCode, $vatNumber, $requesterCountryCode = '', $requesterVatNumber = '')
    {
        $storeId = Mage::app()->getStore()->getStoreId();
        $newVatNumber = $vatNumber;
        $newRequesterVatNumber = $requesterVatNumber;
        
        //@RHU take the VAT without the first two signs (which are the countrycode)
        if (Mage::getStoreConfigFlag('customer/create_account/vatfix_enabled', $storeId)) {
            if ($this->includesCountryCode($vatNumber)) {
                $newVatNumber = substr(str_replace(' ', '', trim($vatNumber)), 2);
                Mage::log('Countrycode removed from customer-VAT.(before:' . $vatNumber . '/after:' . $newVatNumber . ')');
            }

            if ($requesterVatNumber !== '' && $this->includesCountryCode($requesterVatNumber)) {
                $newRequesterVatNumber = substr(str_replace(' ', '', trim($requesterVatNumber)), 2);
                Mage::log('Countrycode removed from requester-VAT.(before:' . $requesterVatNumber . '/after:' . $newRequesterVatNumber . ')');
            }
        }

        return parent::checkVatNumber($countryCode, $newVatNumber, $requesterCountryCode, $newRequesterVatNumber);
    }

    /**
     * Create SOAP client based on VAT validation service WSDL
     *
     * @param boolean $trace
     * @return SoapClient
     */
    protected function _createVatNumberValidationSoapClient($trace = false)
    {
        return new SoapClient(self::VAT_VALIDATION_WSDL_URL, array('trace' => $trace));
    }

    /**
     * parse the VAT if it includes the countrycode
     * @param string $vatNumber
     * @return boolean
     */
    public function includesCountryCode($vatNumber)
    {
        $countryCode = substr(str_replace(' ', '', trim($vatNumber)), 0, 2);
        if (array_key_exists(strtoupper($countryCode), Mage::helper('multibyte_vatfix/countries')->getCountries())) {
            return true;
        }

        return;
    }
}
