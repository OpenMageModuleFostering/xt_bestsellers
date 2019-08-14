<?php 
class Xt_Bestsellers_Block_Adminhtml_Bestsellers extends Mage_Adminhtml_Block_Widget_Grid_Container
{
  public function __construct()
  {
    $this->_controller = 'adminhtml_bestsellers';
    $this->_blockGroup = 'bestsellers';
    $this->_headerText = Mage::helper('bestsellers')->__('Item Manager');
    $this->_addButtonLabel = Mage::helper('bestsellers')->__('Add Item');
    parent::__construct();
  }
}