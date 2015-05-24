<?php
class Quanbit_QBShippingAndPaymentFilters_Model_Observer_Filter
{
        public function getRulesFor($website_id, $method, $action, $method_type){            
             return Mage::getResourceModel("checkoutrule/rule_collection")->getRowsFor($website_id, $method, $action, $method_type);            
        }
        public function rulesMatch ($rules, $quote){
            if ($quote->isVirtual()){
                $address = $quote->getBillingAddress();
            } else {
                $address = $quote->getShippingAddress();
            }
            foreach ($rules as $rule){
                $rule->afterLoad();                
                try { 
		        if ($rule->validate($address)){
		            return true;
		        }
		} catch (Exception $e){
			Mage::logException($e);
		}
            }
            return false;
        }
        public function shouldCheck($event){
            return $event->getQuote()!=null;
        }
	/**
	 * Filters the payment method if it's not enabled
	 *
	 * @param Varien_Event_Observer $observer
	 */
        public function paymentMethods(Varien_Event_Observer $observer){
            $this->applyRules($observer, "payment", $this->getPaymentCode($observer));
        }
        public function getPaymentCode($observer){
            return $observer->getEvent()->getMethodInstance()->getCode();
        }
        /**
	 * Filters the shipping method if it's not enabled
	 *
	 * @param Varien_Event_Observer $observer
	 */
	public function shippingMethods(Varien_Event_Observer $observer)
	{
             $this->applyRules($observer, "shipping", $this->getShippingCode($observer));
	}
        public function getShippingCode($observer){
            return $observer->getEvent()->getCarrierCode();
        }
        public function applyRules($observer, $method_type, $method)
	{
             $event = $observer->getEvent();
             if (!$this->shouldCheck($event)) return;
             $data =  $event ->getData();
             $quote = $data["quote"];
             $quote->setQuote($quote);
             $website_id = $quote->getStore()->getWebsiteId();
             $result = $event->getResult();
             $rules = $this->getRulesFor($website_id, $method, "disable", $method_type);
             if ($this->rulesMatch($rules, $quote)){
                 $result->isAvailable=false;
             }
             $rules = $this->getRulesFor($website_id, $method, "enable", $method_type);
             if ($this->rulesMatch($rules, $quote)){
                 $result->isAvailable=true;
             }
	}
	
}
