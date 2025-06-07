# Dependencies, Coupling, and Interfaces

The example used in this lesson is of a newsletter mailing list and the classes to support them. For example a user would enter their details to sign up for a newsletter, their email would be added to a mailing list etc. Most of this is psuedo code and doesnt work but is good enough to illustrate the underlying principals.

One question asked is how to approach the implementation of the newsletter provider. Initially the setup is such that the newsletter provider is coupled to the newsletter class which could become problematic in the future should someon decide that they want to change newsletter provider. 

As usual the solution to this is to extract the references to the newsletter provider into its own class. This way we own it and have control of it. We can build and use our own functions using the providers API functions.

```php
class CampaignMonitorProvider
{
    public function addToList(string $list, string $email)
    {
        // Psuedo code for interacting with Campaign Monitor API
        $cm = new CampaignMonitorAPI();

        $cm->addApiKey('fakeAPIkey');

        $list = $cm->lists->find($list);

        $list->addToList($email);
    }
}
```

The class above simply instantiates CampaignMonitor within a function that we own and wraps up all the required code for adding a user to a list into one class method `addToList()`. This means that when a user is added to a mailing list all that needs to be called is `addToList()`. 

```php
class Newsletter
{
    public function subscribe(User $user)
    {
        $cm = new CampaignMonitor();

        $cm->addToList('default', $user->email);

        $user->update(['subscribed' => true]);
    }
}
```

Furthermore, it means that if needed, CampaignMonitor can be easily swapped out for another newsletter provider.

## Interfaces
An interface is like an agreement or a set of rules. When an interface is in place it dictates how a class must behave in order to be able to interact with our app.

```php
interface NewsletterProvider {
    public function addToList(string $list, string $email);
}
```

It's important to note that the interface is not defining a method. It is simply stating that this method definition MUST exist in any class it is implemented on. If it's implemented on a class then that class MUST provide a method called addToList that accepts two string arguments, list and email. Any deviation from that will cause an error and the class it's implemented on simply wont be recognised.

The interface is implemented like so:

```php 
class CampaignMonitorProvider implements NewsletterProvider
{
    public function addToList(string $list, string $email)
    {
        // Psuedo code for interacting with Campaign Monitor API
        $cm = new CampaignMonitorAPI();

        $cm->addApiKey('fakeAPIkey');

        $list = $cm->lists->find($list);

        $list->addToList($email);
    }
}
```

# Laracasts Notes

Imagine you have a `Newsletter` class that handles subscribing users to a newsletter. Typically, a user submits their email through a form, and the controller delegates this task to the newsletter class.

You might have a method like this:

```php
$newsletter = new Newsletter();
$newsletter->subscribe($user);
```

Here, `subscribe` depends on a `User` object to function properly. This is an example of a dependency: the `subscribe` method depends on a user.

## Coupling and Dependencies
In real life, you probably use a third-party newsletter provider like Campaign Monitor or Postmark. The code to interact with these services might be placed inside the subscribe method. For example, you might have pseudocode like:

```php
$campaignMonitor = new CampaignMonitor();
$campaignMonitor->setApiKey('your-api-key');
$list = $campaignMonitor->findList('default');
$list->addToList($user->email);
$user->subscribed = true;
return true;
```

However, this tightly couples your Newsletter class to both the User class and the specific provider (Campaign Monitor). Coupling means these classes are linked and cannot function independently.

Whether this coupling is acceptable depends on your project's size, complexity, and need for flexibility.

## Reducing Coupling with Abstraction
To reduce coupling, you can extract provider-specific code into its own class:

```php
class CampaignMonitorProvider {
    public function addToList(string $listName, string $email): void {
        // SDK interaction here
    }
}
```

Now, your Newsletter class no longer contains Campaign Monitor code directly. Instead, it calls this provider's method.

## Introducing Interfaces
To further decouple, define an interface that all newsletter providers must implement:

```php
interface NewsletterProvider {
    public function addToList(string $listName, string $email): void;
}
```

This interface acts as a contract: any class implementing it must provide the addToList method.

Now, CampaignMonitorProvider implements this interface:

```php
class CampaignMonitorProvider implements NewsletterProvider {
    public function addToList(string $listName, string $email): void {
        // Implementation details
    }
}
```

If the class does not implement the method as defined, you'll get errors, ensuring contract compliance.

## Using Dependency Injection
### Method Injection
You can inject the provider dependency directly into the subscribe method:

```php
public function subscribe(User $user, NewsletterProvider $provider): void {
    $provider->addToList('default', $user->email);
}
```

This way, the Newsletter class depends on the interface, not a concrete provider.

### Constructor Injection
Alternatively, inject the provider into the Newsletter class constructor:

```php
class Newsletter {
    public function __construct(public NewsletterProvider $provider) {}

    public function subscribe(User $user): void {
        $this->provider->addToList('default', $user->email);
    }
}
```

This makes the provider available to all methods within the class and simplifies method signatures.

## Benefits
* The Newsletter class no longer cares which provider it uses.
* You can swap providers (e.g., Campaign Monitor, Postmark) without changing Newsletter.
* Your code is more flexible, testable, and maintainable.

## Summary
* Dependencies are objects or services a class needs to function.
* Coupling tightly links classes, which can reduce flexibility.
* Extract provider-specific code into separate classes.
* Use interfaces as contracts to enforce consistent APIs.
* Inject dependencies via methods or constructors to decouple classes.