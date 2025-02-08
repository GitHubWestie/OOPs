## Objects

Objects are the instances of classes. Objects can contain properties as defined by their class. Properties are basically variables. Visibility of these properties can also be controlled using keywords such as `Public`.

---

### Using Properties

These properties can be set after an instance of the class has been made using arrow syntax:

```php
$myPlaylist->name = "Mega mosh";
```

Or they can be defined at the time of instantation using the `__construct` constructor. The constructor will be run immediately whenever an instance of the class is created.

```php
public function __construct($name) {
    $this->name = $name
}

$myPlaylist = new Playlist('Nu-metal Motivation!');
```

---
### Adding More Properties
To add more properties just add the property to the class and tell the constructor to expect it.

```php
class Playlist
{
    public $name;
    public $songs;

    public function __construct($name, $songs) {
        $this->name = $name;
        $this->songs = $songs;
    }
}
```

---

### Adding Methods
Php has a built in shuffle method that can be used to quickly shuffle the playlist by adding it as a class method.

```php
public function random() {
    shuffle($this->songs);
}
```

Then it can be called on the class instance.

```php
$myPlaylist->random();
```

---

### New Syntax in PHP 8.0
PHP 8.0 introduced a new syntax for creating classes with constructors, allowing visibility to be declared in the __contstruct parameters, thereby reducing the verbosity of the code.

This by no means replaces the methods used here and they are not deprecated. It is simply a more concise way to achieve the same thing.

```php
class Playlist
{
    // Properties assigned in parameters
    public function __construct(public $name, public $songs) {
        // No need to assign here
    }
}
```