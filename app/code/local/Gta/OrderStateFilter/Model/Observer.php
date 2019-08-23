<?php
    class Gta_OrderStateFilter_Model_Observer
    {
        public function PutStateFilterOnOrder($Observer)
        {
            // get order 
            $order = $Observer->getEvent()->getOrder();
            $items = $order->getAllItems();

            foreach($items as $item)
            {
		$sku = $item->getSku();
                $name= $item->getName();
                $qty = $item->getQtyOrdered();
                $price = $item->getPrice();

                // get shipping state
                $shipping_state = $Observer->getEvent()->getOrder()->getShippingAddress()->getRegion();

                if($shipping_state == 'Chicago')
                {
                    $order_details = ['sku' => $sku, 'name' => $name, 'qty' => $qty, 'price' => $price, 'shipping_state' => $shipping_state ];
                    Mage::log(json_encode(print_r($order_details, true)), null, 'order_from_chicago.log', true);
                }
            }
            ### start test observer ###
            // $order = $Observer->getEvent();
            // Mage::log($order->getName(),null,'event.log');
            ### end test observer ###
        } 
    } 
?>
