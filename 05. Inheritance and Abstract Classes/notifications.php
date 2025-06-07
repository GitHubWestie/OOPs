<?php

/*
 * __construct requires a message.
 * $message must be public for child classes to have access to it.
 */
class Notification
{
    public function __construct(public string $message)
    {
        // 
    }

    public function send()
    {
        echo('Show pop-up flash message');
    }
}

class EmailNotification extends Notification
{
    public function send()
    {
        echo($this->message);
    }
}

class OsNotification extends Notification
{
    public function send()
    {
        echo($this->message);
    }
}

// From the parent
$notification = new Notification('Here is my message');
echo($notification->message);
$notification->send();

// From EmailNotification
(new EmailNotification('Your email notification'))->send();

// From OsNotification
(new OsNotification('YouTube would like to send you notifications'))->send();