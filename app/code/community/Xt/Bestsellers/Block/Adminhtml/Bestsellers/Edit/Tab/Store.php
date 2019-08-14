<?php 
class Xt_Bestsellers_Block_Adminhtml_Bestsellers_Edit_Tab_Store extends Mage_Adminhtml_Block_Widget_Grid 
{
	public function __construct()
	{
        parent::__construct();
        $this->setTemplate('bestsellers/stores.phtml');
	}
		
}