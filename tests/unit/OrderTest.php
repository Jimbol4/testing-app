<?php
use App\Product;
use App\Order;

class OrderTest extends PHPUnit_Framework_TestCase {
    
    protected function createOrderWithProducts() {
        $order = new Order;
       
       $product = new Product('Fallout 4', 59);
       $product2 = new Product('Pillars of Eternity', 30);
       
       $order->add($product);
       $order->add($product2);
       
       return $order;
    }
    
    /** @test */
    function an_order_consists_of_products() {
       $order = $this->createOrderWithProducts();
       
       $this->assertCount(2, $order->products());
    }
    
    /** @test */
    function an_order_can_determine_the_total_cost_of_all_its_products() {
       
       $order = $this->createOrderWithProducts();
        
       $this->assertEquals(89, $order->total()); 
    }
    
}