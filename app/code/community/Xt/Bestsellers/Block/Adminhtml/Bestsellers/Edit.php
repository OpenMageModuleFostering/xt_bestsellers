<?php     

class Xt_Bestsellers_Block_Adminhtml_Bestsellers_Edit extends Mage_Adminhtml_Block_Widget_Form_Container  
{
    public function __construct()
    {
        parent::__construct();
                 
        $this->_objectId = 'id';
        $this->_blockGroup = 'bestsellers';
        $this->_controller = 'adminhtml_bestsellers';
        
        $this->_updateButton('save', 'label', Mage::helper('bestsellers')->__('Save Item'));
        $this->_updateButton('delete', 'label', Mage::helper('bestsellers')->__('Delete Item'));
		
        $this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);

        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('bestsellers_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'bestsellers_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'bestsellers_content');
                }
            }

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
		$this->_removeButton('save');
		$this->_removeButton('delete');
    }

    public function getHeaderText()
    {
        if( Mage::registry('bestsellers_data') && Mage::registry('bestsellers_data')->getId() ) {
            return Mage::helper('bestsellers')->__('Manage Bestsellers Products');
        } else {
            return Mage::helper('bestsellers')->__('Manage Bestsellers Products');
        }
    }
}