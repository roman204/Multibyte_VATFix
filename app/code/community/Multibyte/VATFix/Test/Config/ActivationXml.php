<?php

/**
 * Created by PhpStorm.
 * User: rhutterer
 * Date: 07.07.15
 * Time: 09:10
 */
class Multibyte_VATFix_Test_Config_ActivationXml extends EcomDev_PHPUnit_Test_Case_Config {


    /**
     * @test
     */
    public function codePool() {
        $this->assertModuleCodePool( 'community' );
    }
}