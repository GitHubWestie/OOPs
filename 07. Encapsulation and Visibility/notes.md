# Encapsulation and Visibility
In programming terms encapsulation might be defined like this:

*"Restriction of access to an objects internals"*

Consider this example of a Person class.

```php
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
        echo $this->name . 'is afraid of dying';
    }

    public function getFears()
    {
        return $this->thingsThatKeepUpAtNight();
    }
}

$bob = new Person('Bob');
var_dump($bob->name);
echo($bob->getFears());
```

In this class the person has a protected function. Because it is protected it cannot be accessed on an instance of the class.

## Visibility
A simple rule of thumb for visibility is to default to protected and expand to public or reduce to private if necessary.

Some prefer to default to private and open up visibility as much as is necessary. As usual there are no rules so consider what makes the most sense.

While there are no rules for the scope of visibility it will often be dictated by the class implementation itself. So when creating classes and methods be mindful visibility. Consider if the method you're writing *needs* to be public? Or *should* be public. If it needs to be accessed by an instance of the class then make it public. If it's a method that is used internally by the class itself though and not intended to be used on an instance, then protected would make more sense.


|Keyword|Access Level|
|-------|------------|
|public	|Accessible from anywhere|
|private|	Accessible only inside the class|
|protected|	Accessible inside the class and its subclasses|

## Getters
Sometimes it will be necessary to access a protected property. It is best practice to do this in a controlled way and this is done by using a `getter`.

A `getter` is simply a method that exists within the class and is able to retrieve a protected property and expose it. This might seem confusing and contradictory. Why protect a property and then expose it anyway? Why not just make it public?

Having a `getter` means that if any point in the future something needs to be changed about how that property is retrieved the `getter` can simply be updated. Whereas if the property is being accessed directly and in multiple locations across the codebase, each reference to that would need to be updated too.

In fact many developers tend to default to protected properties with getters rather than making properties public.

```php
class User {
    private string $email;

    public function __construct(string $email) {
        $this->email = $email;
    }

    public function getEmail(): string {
        return $this->email;
    }
}

$user = new User('user@example.com');
echo $user->getEmail(); // Outputs: user@example.com
```
*Uses a getter method to retrieve the users email*