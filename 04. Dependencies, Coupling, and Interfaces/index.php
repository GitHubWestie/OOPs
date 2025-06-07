<?php

class User
{

}

class Newsletter
{
    public function __construct(public NewsletterProvider $provider)
    {
        // 
    }

    public function subscribe(User $user)
    {
        $this->provider->addToList('default', $user->email);

        $user->update(['subscribed' => true]);

        return true;
    }
}

interface NewsletterProvider {
    public function addToList(string $list, string $email): void;
}

class CampaignMonitorProvider implements NewsletterProvider
{
    public function addToList(string $list, string $email): void
    {
        // Psuedo code for interacting with Campaign Monitor API
        $cm = new CampaignMonitorAPI();

        $cm->addApiKey('fakeAPIkey');

        $list = $cm->lists->find($list);

        $list->addToList($email);
    }
}

class PostmarkProvider implements NewsletterProvider
{
    public function addToList(string $list, string $email): void
    {
        // Psuedo code for interacting with Campaign Monitor API
        $cm = new PostmarkAPI('fakeApiKey');

        $list = $cm->addToDefaultList($list);
    }
}

$newsletter = new Newsletter(
    new PostmarkProvider()
);

$newsletter->subscribe(new User);