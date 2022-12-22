<?php

namespace App\Http\Controllers;

use App\Interfaces\Newsletter;
use App\Services\MailchimpNewsletter;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    protected MailchimpNewsletter $newsletterService;

    public function __construct(protected Newsletter $newsletter) {}

    public function __invoke()
    {
        request()->validate([
            'email' => 'required|email'
        ]);

        try {
            $this->newsletter
                ->subscribe(request('email'));
        } catch (\Exception $exception){
            throw \Illuminate\Validation\ValidationException::withMessages([
                'email' => 'This email could not be added.'
            ]);
        }

        return redirect('/')
            ->with('success', 'Your email is added to our contact list.');
    }
}
