<?php

class Playlist
{
    // Define the property
    public $name;

    // Define constructor. Takes value given at instantiation and assigns to $name property
    public function __construct($name) {
        $this->name = $name;
    }
}

// Instantiate class and pass name to constructor method
$myPlaylist = new Playlist('Monster Mash!');

// Dump and die myPlaylist object
die(var_dump($myPlaylist));