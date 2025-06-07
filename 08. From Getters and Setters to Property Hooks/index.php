<?php

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