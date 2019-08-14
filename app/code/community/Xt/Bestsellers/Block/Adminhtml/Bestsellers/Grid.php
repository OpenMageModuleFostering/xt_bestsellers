<?php 

class Xt_Bestsellers_Block_Adminhtml_Bestsellers_Grid extends Mage_Adminhtml_Block_Widget_Grid 
{
  public function __construct()
  {
      parent::__construct();
      $this->setId('bestsellersGrid');
      $this->setDefaultSort('bestsellers_id');
      $this->setDefaultDir('ASC');
      $this->setSaveParametersInSession(true);
  }

  protected function _prepareCollection()
  {
      $collection = Mage::getModel('bestsellers/bestsellers')->getCollection();
      $this->setCollection($collection);
      return parent::_prepareCollection();
  }

  protected function _prepareColumns()
  {
      $this->addColumn('bestsellers_id', array(
          'header'    => Mage::helper('bestsellers')->__('ID'),
          'align'     =>'right',
          'width'     => '50px',
          'index'     => 'bestsellers_id',
      ));

      $this->addColumn('title', array(
          'header'    => Mage::helper('bestsellers')->__('Title'),
          'align'     =>'left',
          'index'     => 'title',
      ));

        $this->addColumn('action',
            array(
                'header'    =>  Mage::helper('bestsellers')->__('Action'),
                'width'     => '100',
                'type'      => 'action',
                'getter'    => 'getId',
                'actions'   => array(
                    array(
                        'caption'   => Mage::helper('bestsellers')->__('Edit'),
                        'url'       => array('base'=> '*/*/edit'),
                        'field'     => 'id'
                    )
                ),
                'filter'    => false,
                'sortable'  => false,
                'index'     => 'stores',
                'is_system' => true,
        ));
		
      return parent::_prepareColumns();
  }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('bestsellers_id');
        $this->getMassactionBlock()->setFormFieldName('bestsellers');

        $this->getMassactionBlock()->addItem('delete', array(
             'label'    => Mage::helper('bestsellers')->__('Delete'),
             'url'      => $this->getUrl('*/*/massDelete'),
             'confirm'  => Mage::helper('bestsellers')->__('Are you sure?')
        ));

        return $this;
    }

  public function getRowUrl($row)
  {
      return $this->getUrl('*/*/edit', array('id' => $row->getId()));
  }

}