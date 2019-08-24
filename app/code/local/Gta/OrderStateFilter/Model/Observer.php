<?php
    class Gta_OrderStateFilter_Model_Observer
    {
        public function putstatefilteronorder($Observer)
        {
            $order = $Observer->getEvent()->getOrder();
            $items = $order->getAllItems();

            foreach($items as $item){
		        $sku = $item->getSku();
                $name= $item->getName();
                $qty = $item->getQtyOrdered();
                $price = $item->getPrice();
                $shipping_state = $Observer->getEvent()->getOrder()->getShippingAddress();
                if($shipping_state->getRegion() == 'Illinois' && $shipping_state->getCity() == 'Chicago')
                {
                   $loggerInfo = ['sku' => $sku, 'name' => $name, 'qty' => $qty, 'price' => $price, 'shipping_state' => $shipping_state->getRegion(), 'shipping_city' => $shipping_state->getCity() ];
                    Mage::log(json_encode(print_r($loggerInfo, true)), null, 'order_from_chicago.log', true);
                }
            }
            ### start test observer ###
            // $order = $Observer->getEvent();
            // Mage::log($order->getName(),null,'event.log');
            ### end test observer ###
        } 
    } 
?>
