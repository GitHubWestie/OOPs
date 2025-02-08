<?php

class Playlist
{
    // Define multiple properties
    public $name;
    public $songs;

    // Tell constructor to expect multiple properties
    public function __construct($name, $songs) {
        $this->name = $name;
        $this->songs = $songs;
    }
}

// Instantiate class and pass in data
$myPlayist = new Playlist('Nu-metal faves', [
    'Faith',
    'Spit',
    'Spiders',
    'Bleed',
]);

die(var_dump($myPlayist));