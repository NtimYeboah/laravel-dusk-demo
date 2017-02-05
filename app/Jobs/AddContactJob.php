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
    public function __construct(Request $request, Contact $contact)
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

    public function createOrUpdateContact(): Contact
    {
        if (null === $this->contact) {
            $this->contact = new Contact();
        }

        foreach($this->contact->getFillable() as $fillable) {
            if ($this->request->has($fillable)) {
                $this->contact->{$fillable} = $this->request->get($fillable);
            }
        }

        if ( $this->contact->owner_id === null) {
            $this->contact->user()->associate($this->request->user());
        }

        $this->contact->save();

        return $this->contact;
    }
}
