# Inheritance and Abstract Classes

Similar to how humans inherit traits from parents, child classes in PHP inherit properties and methods from parent classes.

The *is a* relationship is fundamental to the concept, e.g., a Truck *is a* type of Vehicle, a Van *is a* type of vehicle.

**Example:**
```php
// Vehicle is the parent class
class Vehicle
{
    public function accelerate()
    {
        echo('Accelerating');
    }
}

// Cart is the child class and inherits from it's parent
class Cart extends Vehicle
{
    // 
}

// Therefore it inherits the methods from it's parent
(new Cart)->accelerate();
```

The child class can also have it's own unique methods or even override the parent methods if it needs to.

```php
class Cart extends Vehicle
{
    public function accelerate()
    {
        echo('Rolling');
    }
}

(new Cart)->accelerate();
```

## A More Practical Example
A more realistic example would be a notification class that sends messages to users. Jeffreys approach to naming these classes and methods is quite cool too. Speak out loud, follow the verbs.

## Abstract Classes
Used when the parent class should not be instantiated directly, enforcing consistency among child classes. This is very similar to the interface approach from the previous lesson and Jeffrey even suggests that this is another way of achieving that so they may be interchangable?

```php
abstract class Achievement
{
    public function __construct(public string $name, public string $description, public string $icon)
    {
        
    }

    // Enforces that a qualifier should be used in any child classes - Similar to an interface
    abstract public function qualifier(User $user);
}
```
*Abstract classes define methods that must be implemented by their subclasses.*

