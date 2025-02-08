<?php

class Playlist
{
    public function __construct(public string $name, public array $songs) {

    }
}

$myPlaylist = new Playlist("90's Movie Soundtracks", [
    'My Heart Will Go On',
]);

// Access first array offset in object
echo $myPlaylist->songs[0];