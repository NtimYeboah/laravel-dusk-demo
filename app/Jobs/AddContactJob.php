<?php

namespace App\Jobs;

use App\Contact;
use Illuminate\Http\Request;

class AddContactJob
{
    /**
     * @var Request
     */
    private $request;

    /**
     * @var Contact
     */
    private $contact;

    /**
     * Create a new job instance.
     *
     * @param Request $request
     * @param Contact $contact
     */
    public function __construct(Request $request, Contact $contact = null)
    {
        $this->request = $request;
        $this->contact = $contact;
    }

    /**
     * Execute the job.
     *
     * @return Contact
     */
    public function handle()
    {
        return $this->createOrUpdateContact();
    }

    /**
     * Create or update contact
     *
     * @return Contact
     */
    public function createOrUpdateContact(): Contact
    {
        if (null === $this->contact) {
            $this->contact = new Contact();
            $this->contact->user()->associate($this->request->user());
        }

        foreach($this->contact->getFillable() as $fillable) {
            if ($this->request->has($fillable)) {
                $this->contact->{$fillable} = $this->request->get($fillable);
            }
        }

        $this->contact->save();

        return $this->contact;
    }
}
