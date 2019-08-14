<?php 

class Xt_Bestsellers_Block_Adminhtml_Bestsellers_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs 
{
  public function __construct()
  {
      parent::__construct();
      $this->setId('bestsellers_tabs');
      $this->setDestElementId('edit_form');
      $this->setTitle(Mage::helper('bestsellers')->__('Item Information'));
  }

  protected function _beforeToHtml()
  {
	   $this->addTab('store_section', array(
          'label'     => Mage::helper('bestsellers')->__('Select Stores'),
          'title'     => Mage::helper('bestsellers')->__('Select Stores'),
          'content'   => $this->getLayout()->createBlock('bestsellers/adminhtml_bestsellers_edit_tab_store')->toHtml(),
      ));
      $this->addTab('grid_section', array(
          'label'     => Mage::helper('bestsellers')->__('Bestsellers Products'),
          'title'     => Mage::helper('bestsellers')->__('Bestsellers Products'),
          'url'       => $this->getUrl('*/*/grid', array('_current' => true)),
          'class'     => 'ajax',
      ));
      
      return parent::_beforeToHtml();
  }
}