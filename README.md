Multibyte_VATFix
================
![Build Status](https://travis-ci.org/roman204/Multibyte_VATFix.svg?branch=master "Build Status")
This Extension for Magento fixes VAT check in Magento when a VAT with countrycode is given. (usual in EU)
In Europe the VAT is called UID and we provide a fix for Magento with this Module.

It overrides the Customer class Mage_Customer_Helper_Data and checks if given VAT-Code has a Countrycode given or not.

It can be enabled by setting config "customer/create_account/vatfix_enabled" to true|false.