<?php

namespace App\Services;

use App\Interfaces\Newsletter;

class MailchimpNewsletter implements Newsletter
{

    public function __construct(protected \MailchimpMarketing\ApiClient $client)
    {
    }
    public function subscribe(string $email, $list = null)
    {
        $list ??= config('services.mailchimp.lists.subscribers');

        return $this->client->lists->addListMember($list, [
            'email_address' => $email,
            'status' => 'subscribed'
        ]);
    }

    public function notifySubscribers()
    {
    }
}
