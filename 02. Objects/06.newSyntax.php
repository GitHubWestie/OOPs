<?php

class Playlist
{
    // Declare visibility directly on parameters
    public function __construct(public $name, public $songs) {
        // No need to manually assign here
    }

    public function random() {
        shuffle($this->songs);
    }
}

$myPlaylist = new Playlist('UK Hardcore', [
    'Dreamscape 26',
    'Dreamscape 28',
    'HTID',
    'Bonkers',
]);

$myPlaylist->random();

die(var_dump($myPlaylist));