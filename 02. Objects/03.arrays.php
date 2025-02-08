<?php

class Playlist
{
    public $name;

    public function __construct($name) {
        $this->name = $name;
    }
}

$myPlaylist = [];

$myPlaylist[] = new Playlist('Nu-metal');
$myPlaylist[] = new Playlist('Trance bangers');
$myPlaylist[] = new Playlist('OST Magic');

die(var_dump($myPlaylist));
