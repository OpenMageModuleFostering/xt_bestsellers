<?php

class Xt_Bestsellers_Model_Mysql4_Bestsellers_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('bestsellers/bestsellers');
    }
}