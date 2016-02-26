<?php
namespace App;

class Product {
    
    protected $name;
    protected $cost;
    
    public function __construct($name, $cost = 10) {
        $this->name = $name;
        $this->cost = $cost;
    }
    
    public function name() {
        return $this->name;
    }
    
    public function cost() {
        return $this->cost;
    }
    
}