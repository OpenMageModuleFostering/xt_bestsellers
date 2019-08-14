<?php 

class Xt_Bestsellers_Adminhtml_BestsellersController extends Mage_Adminhtml_Controller_action
{

	public function gridAction(){
		$this->loadLayout();
		$this->getLayout()->getBlock('customer.grid');
		$this->renderLayout();
	}
	
	public function upsellgridAction(){
		$this->loadLayout();
		$this->getLayout()->getBlock('customer.grid');
		$this->renderLayout();
	}


	protected function _initAction() {
		$this->loadLayout()
		->_setActiveMenu('bestsellers/items')
		->_addBreadcrumb(Mage::helper('adminhtml')->__('Items Bestsellers'), Mage::helper('adminhtml')->__('Item Manager'));

		return $this;
	}

	public function indexAction() {
		$this->_initAction()
		->renderLayout();
	}

	public function editAction() {
		$id     = $this->getRequest()->getParam('id');
		$model  = Mage::getModel('bestsellers/bestsellers')->load($id);

		if ($model->getId() || $id == 0) {
			$data = Mage::getSingleton('adminhtml/session')->getFormData(true);
			if (!empty($data)) {
				$model->setData($data);
			}

			Mage::register('bestsellers_data', $model);

			$this->loadLayout();
			$this->_setActiveMenu('bestsellers/items');

			$this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item Manager'), Mage::helper('adminhtml')->__('Item Manager'));
			$this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item News'), Mage::helper('adminhtml')->__('Item News'));

			$this->getLayout()->getBlock('head')->setCanLoadExtJs(true);

			$this->_addContent($this->getLayout()->createBlock('bestsellers/adminhtml_bestsellers_edit'))
			->_addLeft($this->getLayout()->createBlock('bestsellers/adminhtml_bestsellers_edit_tabs'));

			$this->renderLayout();
		} else {
			Mage::getSingleton('adminhtml/session')->addError(Mage::helper('bestsellers')->__('Item does not exist'));
			$this->_redirect('*/*/edit', array('id' => 1));
		}
	}

	public function newAction() {
		$this->_forward('edit');
	}

	public function saveAction() {
		if ($data = $this->getRequest()->getPost()) {

			/*$model = Mage::getModel('bestsellers/bestsellers');
			$model->setData($data)
			->setId($this->getRequest()->getParam('id'));*/

			try {

				//$model->save();
				$bestsellers_id = 1;
				if(isset($data['links'])){
					$customers = Mage::helper('adminhtml/js')->decodeGridSerializedInput($data['links']['customers']); //Save the array to your database

					$collection = Mage::getModel('bestsellers/grid')->getCollection();
					$collection->addFieldToFilter('bestsellers_id',$bestsellers_id);
					$collection->addFieldToFilter('store_id',$data['store_id']);
					foreach($collection as $obj){
						$obj->delete();
					}
					
					foreach($customers as $key => $value){
						$model2 = Mage::getModel('bestsellers/grid');
						$model2->setBestsellersId($bestsellers_id);
						$model2->setProductId($key);
						$model2->setPosition($value['position']);
						$model2->setStoreId($data['store_id']);
						$model2->save();
					}
				}

				Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('bestsellers')->__('Item was successfully saved'));
				Mage::getSingleton('adminhtml/session')->setFormData(false);

				//if ($this->getRequest()->getParam('back')) {
					//$this->_redirect('*/*/edit', array('id' => $model->getId()));
					//return;
				//}
				
				$this->_redirect('*/*/edit', array('id' => 1));
				return;
			} catch (Exception $e) {
				Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
				Mage::getSingleton('adminhtml/session')->setFormData($data);
				$this->_redirect('*/*/edit', array('id' => 1));
				return;
			}
		}
		Mage::getSingleton('adminhtml/session')->addError(Mage::helper('bestsellers')->__('Unable to find item to save'));
		$this->_redirect('*/*/edit', array('id' => 1));
	}

	public function deleteAction() {
		if( $this->getRequest()->getParam('id') > 0 ) {
			try {
				$model = Mage::getModel('bestsellers/bestsellers');

				$model->setId($this->getRequest()->getParam('id'))
				->delete();

				Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Item was successfully deleted'));
				$this->_redirect('*/*/');
			} catch (Exception $e) {
				Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
				$this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
			}
		}
		$this->_redirect('*/*/');
	}

	public function massDeleteAction() {
		$bestsellersIds = $this->getRequest()->getParam('bestsellers');
		if(!is_array($bestsellersIds)) {
			Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Please select item(s)'));
		} else {
			try {
				foreach ($bestsellersIds as $bestsellersId) {
					$bestsellers = Mage::getModel('bestsellers/bestsellers')->load($bestsellersId);
					$bestsellers->delete();
				}
				Mage::getSingleton('adminhtml/session')->addSuccess(
				Mage::helper('adminhtml')->__(
                        'Total of %d record(s) were successfully deleted', count($bestsellersIds)
				)
				);
			} catch (Exception $e) {
				Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
			}
		}
		$this->_redirect('*/*/index');
	}
	
	public function setregisterAction() {
		$store_id = $this->getRequest()->getParam('store_id');
		Mage::getSingleton('adminhtml/session')->setData('bestsellers_store_id',$store_id);
	}

}