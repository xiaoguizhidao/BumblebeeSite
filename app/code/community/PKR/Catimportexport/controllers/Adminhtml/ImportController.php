<?php
/**
@author: Pardeep Kumar <pardeep19@gmail.com>
@copyright: Orange Mantra
*/

class PKR_CatImportExport_Adminhtml_ImportController extends Mage_Adminhtml_Controller_Action {
	
	protected $arrayCollection = array();
	
	protected function _initAction()
	{
		$this->_title($this->__('Import/Export'))
		->loadLayout()
		->_setActiveMenu('system/importexport');
	
		return $this;
	}
	
	public function indexAction() {
		$maxUploadSize = Mage::helper('importexport')->getMaxUploadSize();
		
        $this->_getSession()->addNotice(
            $this->__('Total size of uploadable files must not exceed %s', $maxUploadSize)
        );
        $this->_initAction()
            ->_title($this->__('Import'))
            ->_addBreadcrumb($this->__('Import'), $this->__('Import'));
        
		$this->renderLayout();
	}
	
	public function exportAction() {
		$this->_title(Mage::helper('catimportexport')->__('Export Categories'));
	
		$this->loadLayout()->_setActiveMenu('system/importexport');
		$this->renderLayout();
	}
	
	public function exportcategoriesAction() {
		$categories = $this->getRequest()->getParam('category');
		$this->arrayCollection[] = array('id', 'type', 'sku', 'position');
		
		foreach ($categories as $catId) {
			$category = Mage::getModel('catalog/category')->load($catId);
			
			$products = Mage::getModel('catalog/product')
			->getCollection()
			->addCategoryFilter($category)
			->load();
			
			foreach ($products as $product) {
				
				$this->arrayCollection[] = array($product['entity_id'], 
												$product['type_id'], 
												$product['sku'], 
												$product['cat_index_position']);
				
			}
			
		}
		$this->exportCsv($this->arrayCollection);
		return $this->getUrl("*/*/export");
	}
	
	public function importcategoriesAction(){ 
		
		$csv_mimetypes = array(
				'text/csv',
				'text/plain',
				'text/html',
				'application/csv',
				'text/comma-separated-values',
				'application/excel',
				'application/vnd.ms-excel',
				'application/vnd.msexcel',
				'text/anytext',
				'application/octet-stream',
				'application/txt',
		);
		
		if(($this->getRequest()->isPost()) && (in_array($_FILES['import_file']['type'],$csv_mimetypes))) {
			if ($_FILES["import_file"]["error"] > 0) {
				Mage::getSingleton("adminhtml/session")->addError($_FILES["import_file"]["error"]);
				$this->_redirect('*/*/');
			} else {
				$fileName = str_replace(".csv","",$_FILES['import_file']['name']).'_'.time().'.csv';
				$path = Mage::getBaseDir('var').DS.'import';

				if (!file_exists($path)) {
					mkdir($path, 0777);
				}
				 if(move_uploaded_file($_FILES["import_file"]["tmp_name"], $path.DS.$fileName)) {
				 	$handle = fopen($path.DS.$fileName,"r");
				 	
				 	//convert data into array
				 	$this->csv2Array($handle);
				 	
					$import = Mage::getModel('catimportexport/catimportexport');
					$dp=Magmi_DataPumpFactory::getDataPumpInstance("productimport");
					$dp->beginImportSession("default","update");

					
				 	foreach($this->arrayCollection as $category) {
				 		if(array_key_exists('sku', $category) && array_key_exists('category_ids', $category)) {
				 			
				 			$categoryArray = array();
				 			$categoryArray['sku'] =  $category['sku'];
							if(array_key_exists('position', $category)) {
								$categoryArray['category_ids'] =  $category['category_ids']."::".$category['position'];
							} else {
								$categoryArray['category_ids'] =  $category['category_ids'];
							}
							
							$product = Mage::getModel('catalog/product')->loadByAttribute('sku',$category['sku']);
							$cats = $product->getCategoryIds();
							
							foreach ($cats as $category_id) {
								if($category['category_ids'] == $category_id) {
									continue;
								}
								$productCategories = $this->getCategory($category_id,$category['sku']);
								$catArray = $productCategories->getData();
								$categoryArray['category_ids'] = $categoryArray['category_ids'].','.$category_id.'::'.$catArray[0]['cat_index_position'];
							}
							
							//echo $categoryArray['category_ids'];die('kk');
							//echo $products->getSelect()->__toString();die;
							
							
				 			if(array_key_exists('store', $category)) {
				 				$categoryArray['store'] = $category['store'];
				 			} else {
				 				$categoryArray['store'] = 'admin';
				 			}
				 			
				 			if(array_key_exists('websites', $category)) {
				 				$categoryArray['websites'] = $category['websites'];
				 			} else {
				 				$categoryArray['websites'] = 'base';
				 			}
				 			//Mage::log($category['sku'].'-----'.$category['category_ids']);
				 			//pr($categoryArray);die;
				 			//magmi update is defined in coming soon cron model.

				 			$import->magmiCategoryImport($categoryArray, $dp);
				 			
				 		} else {
				 			Mage::getSingleton("adminhtml/session")->addError($this->__('unable to find sku or category_ids in csv'));
				 			$this->_redirect('*/*/');
				 		}
				 		
				 	}
				 	
					$dp->endImportSession();
					
				 	Mage::getSingleton("adminhtml/session")->addSuccess($this->__("%s product(s) successfully assigned to their category.", count($this->arrayCollection)));
				 	
				 	$deleteCsv = $this->getRequest()->getParam('keep_file');
				 	if($deleteCsv) {
				 		unlink($path.DS.$fileName);
				 		Mage::getSingleton("adminhtml/session")->addSuccess($this->__("Csv is successfully deleted"));
				 	}
				 	
				 	$this->_redirect('*/*/');
				 } else {
				 	Mage::getSingleton("adminhtml/session")->addError($this->__('unable to move file in '.$path));
				 	$this->_redirect('*/*/');
				 }
			}
		} else {
			Mage::getSingleton("adminhtml/session")->addError($this->__('Invalid csv file'));
			$this->_redirect('*/*/');
		}
		
	}
	
	public function exportCsv($data,$filename = "export.csv") {
		header('Content-Type: application/csv');
		header('Content-Disposition: attachement; filename="'.$filename.'";');
		
		$header = true;
		$fp = fopen('php://output', 'w');
		foreach ($data as $fields) {
			fputcsv($fp, $fields);
		}
		
		fclose($fp);
		return true;
	}
	
	/**
	 * @param opened file $handle
	 * @param string $header
	 */
	
	public function csv2Array($handle, $header = true, $key = array()) {

		while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
			if($header) {
				$key = $data;
				$header = false;
			} else {
				if(empty($key))
					$this->arrayCollection[] = $data;
				else
					$this->arrayCollection[] = array_combine($key, $data);
				
				unset($data);
			}
		}
		fclose($handle);
		return $this->arrayCollection;
	}
}