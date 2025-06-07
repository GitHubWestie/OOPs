# From Getters and Setters to Property Hooks
Some concepts discussed in this lesson are only implemented in PHP 8.4 and above

## Constructor Property Promotion
Constructor property promotion is a means of automatically assigning values to variables as part of the constructor process.

*Without property promotion*
```php
class User
{
    public string $email;

    public function __construct(string $email)
    {
        // $this->email refers to the $email variable defined above this function
        $this->email = $email;
    }
}
```

*With property promotion*
```php
class User
{
    public function __construct(public string $email)
    {
        // 
    }
}
```
*The $email variable outside the constructor is no longer required. Nor is the varaible assignment inside the constructor.*

## Pre PHP 8.4
Before PHP 8.4 a class like this wouldn't really have a way of protecting itself from bad data. The expected type is there as `string`, so that prevents a user sending an `array` or something else through but there's no way of ensuring that the user actually provides an email address. 

To do this the developer would need to set the email property to private and then use `getters` and `setters` to intercept the data and then validate it.

```php
class User
{
    public function __construct(private string $email)
    {
        $this->setEmail($email);
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        if(!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            throw new Error('Yeah, nice try. That\'s not an email though, is it?');
        }
    }
}
```

## PHP 8.4 - Property Hooks
Property hooks remove the need for getters and setters completely. Sort of. But not really. Instead of using the constructor property promotion the property is declared outside of the constructor. But now the getter and setter is set explicitly *on* that property. 

```php
class User
{
    public string $email {
        get {
            return $this->email;
        }

        set {
            if(!filter_var($value, FILTER_VALIDATE_EMAIL))
            {
                throw new Error('Yeah, nice try. That\'s not an email though, is it?');
            }

            $this->email = $value;
        }
    }

    public function __construct(string $email)
    {
        $this->email = $email;
    }
}
```

## Asymmetric Visibility
The properties for getting and setting a property dont necessarily need to be the same. For example it might be assumed that a getter is public and that the data can be freely retrieved but maybe the setting of that property should be private. The new hooks allow for this.

```php
class User
{
    private(set) string $email {

        get => str_replace('@', 'at', $this->email);

    }

    public function __construct(string $email)
    {
        $this->email = $email;
    }
}
```

Then you would need to defer to the old approach to be able to set the property, by using a dedicated setter method.

```php
class User
{
    private(set) string $email {

        get => str_replace('@', 'at', $this->email);

    }

    public function __construct(string $email)
    {
        $this->email = $email;
    }

    public function updateEmail(string $email)
    {
        if(!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            throw new Error('Please provide a valid email address');
        }

        $this->email = $email;
    }
}

$user = new User('john@example.com');
$newEmail = $user->updateEmail('fvbnljndfkavnlkfd');
echo($user->email);
echo($newEmail);
```