<?php

class Playlist
{
    public $name;
    public $songs;

    public function __construct($name, $songs) {
        $this->name =  $name;
        $this->songs = $songs;
    }

    public function random() {
        shuffle($this->songs);
    }
}

$myPlaylist = new Playlist("80's Power", [
    'China in Your Hand',
    'I Need a Hero',
    'Wuthering Heights',
    'The Power of Love',
]);

$myPlaylist->random();

die(var_dump($myPlaylist));