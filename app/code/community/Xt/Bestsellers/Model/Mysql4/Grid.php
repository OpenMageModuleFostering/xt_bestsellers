<?php 

class Xt_Bestsellers_Model_Mysql4_Grid extends Mage_Core_Model_Mysql4_Abstract
{
	public function _construct()
	{
		// Note that the bestsellers_id refers to the key field in your database table.
		$this->_init('bestsellers/grid', 'id');
	}
	public function addGridPosition($collection,$bestsellers_id){
		$table2 = $this->getMainTable();
		$cond = $this->_getWriteAdapter()->quoteInto('e.entity_id = t2.product_id','');
		$where = $this->_getWriteAdapter()->quoteInto('t2.bestsellers_id = ? OR ', $bestsellers_id).
		$this->_getWriteAdapter()->quoteInto('isnull(t2.bestsellers_id)','');
		$collection->getSelect()->joinLeft(array('t2'=>$table2), $cond)->where($where);
			
		//echo $collection->getSelect();die;
	}
}