<?php

// Dummy user for the example
class User {};

abstract class Achievement
{
    public function __construct(public string $name, public string $description, public string $icon)
    {
        
    }

    // Enforces that a qualifier should be used in any child classes - Similar to an interface
    abstract public function qualifier(User $user);
}

class FirstPost extends Achievement
{
    public function qualifier(User $user)
    {
        // TODO: Implement qualifier method.
    }
}

class Talkative extends Achievement
{
    public function qualifier(User $user)
    {
        // $user->posts()->count() > 300
    }
}

$firstPost = new FirstPost('First Post!', 'Granted when you create your first post!', 'first-post.svg');
echo $firstPost->qualifier(new User) ? 'User qualifies for this award' : 'User does not qualify for this award';