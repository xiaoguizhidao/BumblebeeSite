<?php
/**
@author: Pardeep Kumar <pardeep19@gmail.com>
@copyright: Orange Mantra
*/

class PKR_Catimportexport_Model_Catimportexport extends Mage_Core_Model_Abstract {
	
	public function __construct(){ 
		
		$this->magmi();
	}
	
	/**
	 * @method initialize magmi with seting include path.
	 */
	public function magmi() {
		$in=array();
		$in[]= Mage::getBaseDir() . DIRECTORY_SEPARATOR .'magmi';
		$in[]= Mage::getBaseDir() . DIRECTORY_SEPARATOR . 'magmi'. DIRECTORY_SEPARATOR .'inc';
		$in[]= Mage::getBaseDir() . DIRECTORY_SEPARATOR .'magmi'.DIRECTORY_SEPARATOR .'integration'.DIRECTORY_SEPARATOR .'inc';
		$in[]= Mage::getBaseDir() . DIRECTORY_SEPARATOR .'magmi'. DIRECTORY_SEPARATOR .'engines';
		$inpath = get_include_path();
		foreach ($in as $i){
			if($_SERVER['REMOTE_ADDR'] == '127.0.0.1')
				$inpath .= $i .';';
			else 
				$inpath .= $i .':';
		}
		$inpath .= '.';
		set_include_path($inpath);
		
		require_once("magmi_datapump.php");
	}
	
	
	
	/**
	 * @method To update product using magmi.
	 * @param array of options
	 */
	public function magmiCategoryImport($productArray, $dp) {
		try {
		
			$dp->ingest($productArray);
		
		} catch (Exception $e) {
			Mage::log('While updating sku '.$productArray['sku'].' has error '.$e->getMessage());
		}
		$productArray = null;
		unset($productArray);
		return true;
	}return true;
	}
	
			
	/**
	 * @method Do indexing
	 * @param array indexCode
	 * @example
	 * 	Process Name 			ID 	Code
	 *	Product Attributes 		1 	catalog_product_attribute
	 *	Product Prices 			2 	catalog_product_price
	 *	Catalog URL Rewrites 	3 	catalog_url
	 *	Product Flat Data 		4 	catalog_product_flat
	 *	Category Flat Data 		5 	catalog_category_flat
	 *	Category Products 		6 	catalog_category_product
	 *	Catalog Search Index 	7 	catalogsearch_stock
	 *	Stock Status 			8 	cataloginventory_stock
	 *	Tag Aggregation Data 	9 	tag_summary
	 */
	public function indexer($indexCodes){
		try {
			foreach ($indexCodes as $index) {
				$process = Mage::getModel('index/indexer')->getProcessByCode($index);
				$process->reindexAll();
			}
		} catch (Exception $e) {
			Mage::log('Indexing error = '. $e->getMessage());
			return false;
		}
		return true;
	}
}