<?php

class Vehicle
{
    public function accelerate()
    {
        echo('Accelerating');
    }
}

class Cart extends Vehicle
{
    public function accelerate()
    {
        echo('Rolling');
    }
}

(new Cart)->accelerate();

