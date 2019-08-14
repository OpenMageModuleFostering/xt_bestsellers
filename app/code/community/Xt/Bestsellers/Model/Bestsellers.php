<?php

class Xt_Bestsellers_Model_Bestsellers extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('bestsellers/bestsellers');
    }
	public function getproids()
	{
		$connection = Mage::getSingleton('core/resource')->getConnection('core_write');
		$result = $connection->query("select * from grid_bestsellers order by position");
		while ($row = $result->fetch() ) {
		$ids[]=$row['product_id'];
		}
		return $ids;
	}
}