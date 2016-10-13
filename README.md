VATFix for Magento
================
![Build Status](https://travis-ci.org/roman204/Multibyte_VATFix.svg?branch=master "Build Status")

This Extension for Magento fixes VAT check in Magento when a VAT with countrycode is given. (usual in EU)
In Europe the VAT is called UID and we provide a fix for Magento with this Module. It uses the original VIES Service to validate the given VAT / UID.

It overrides the Customer class Mage_Customer_Helper_Data and checks if given VAT-Code has a Countrycode given or not.

It can be enabled by setting config "customer/create_account/vatfix_enabled" to true|false.

Link to our Blogpost in german: https://copex.io/blog/magento-uid-validierung/

Screenshots:
![Result](https://copex.io/wp-content/uploads/2015/09/Bildschirmfoto6-1024x294-1024x294.png)
