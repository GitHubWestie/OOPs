<?php

class Playlist
{
    public function __construct(public string $name, public array $songs) {
        //
    }
}

class Songs
{
    public function __construct(public string $title, public string $artist) {
        //
    }
}

$songs[] = new Songs("My Heart Will Go On", "Celine Dion");

$myPlaylist = new Playlist("90's Movie Soundtracks", $songs);

echo $myPlaylist->name;

echo($myPlaylist->songs[0]->artist);
echo($myPlaylist->songs[0]->title);
die(var_dump($myPlaylist));

