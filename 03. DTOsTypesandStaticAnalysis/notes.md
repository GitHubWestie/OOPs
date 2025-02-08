## DTOs, Types, and Static Analysis

### Types
When building a constructor a type can be specified along with the expected parameters. This approach ensures that the data type is consistent. 

```php
class Playlist
{
    public function __construct(public string $name, public array $songs) {
        //
    }
}
```
Attempting to pass the constructor a type other than what it has been told to expect will result in an error.

```
PHP Fatal error:  Uncaught TypeError: Playlist::__construct(): Argument #2 ($songs) must be of type array
```

---

### DTO's - Data Transfer Objects
A data transfer object is essentially an object that is used to pass data around. For example the `$songs` data could be extracted into it's own class. This way more data can be stored in the object containing things like artist, album, release date etc.

```php
class Songs
{
    public function __construct(public string $title, public string $artist) {
        // 
    }
}
```
Then the Songs class can be instantiated with the expected data.

```php
$songs[] = new Songs("My Heart Will Go On", "Celine Dion");
```

And finally passed into the Playlist object. This works as expected as the variable still contains an array type that the playlist constructor expects.

```php
$myPlaylist = new Playlist("90's Movie Soundtracks", $songs);
```

### Static Analysis
Unfortunately there aren't currently any native support for generics. This means that although the type is specified in the class there's no way of enforcing that what ends up in, for example an array is what is expected to be in the array. In this case an array of songs should be an array of strings but there is no way of enforcing that. 

One tool that can be used is a static analyzer. One example is [PHP psalm](https://psalm.dev/). This is like a code checker that will inspect the code and throw an error if it sees, for example an incorrect type being used where it shouldnt be or code vulnerabilities such as `var_dump()` in the codebase.