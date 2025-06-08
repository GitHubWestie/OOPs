<?php

class Subscription
{
    public function __construct(protected BillingPortal $billingPortal)
    {
        // 
    }

    public function create()
    {
        $this->billingPortal->getCustomer();
    }

    public function cancel()
    {

    }

    public function swap(string $newPlan)
    {

    }

    public function invoice()
    {

    }
}

interface BillingPortal
{
    public function getCustomer();
    public function getSubscription();
}

class StripeBillingPortal implements BillingPortal
{
    public function newSubscription()
    {

    }

    public function getCustomer()
    {
        
    }

    public function getSubscription()
    {
        
    }
}

class PaypalBillingPortal implements BillingPortal
{
    public function getCustomer()
    {
        
    }

    public function getSubscription()
    {
        
    }
}

$stripeBillingPortal = new Subscription(new StripeBillingPortal);
$stripeBillingPortal->create();
$stripeBillingPortal->cancel();