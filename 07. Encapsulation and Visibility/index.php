<?php

class Person
{
    public function __construct(public string $name)
    {
        
    }

    public function Job()
    {

    }

    public function favouriteTeam()
    {

    }

    protected function thingsThatKeepUpAtNight()
    {
        echo $this->name . ' is afraid of dying';
    }

    public function getFears()
    {
        return $this->thingsThatKeepUpAtNight();
    }
}

$bob = new Person('Bob');
echo($bob->getFears());