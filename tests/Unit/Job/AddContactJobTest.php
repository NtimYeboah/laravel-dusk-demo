<?php

namespace Tests\Unit;

use App\Contact;
use App\Jobs\AddContactJob;
use App\User;
use Illuminate\Http\Request;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AddContactJobTest extends TestCase
{
    use DatabaseMigrations;

    private $request;

    public function setUp()
    {
        parent::setUp();
        $this->request = new Request();
    }

    public function test_can_create_contact()
    {
        $this->setAuthUser();

        $this->request->merge(factory(Contact::class)->make()->toArray());

        $contact = dispatch(new AddContactJob($this->request, new Contact()));

        $this->assertInstanceOf(Contact::class, $contact);
        $this->assertCount(1, Contact::all());
        $this->assertInstanceOf(User::class, $contact->user);
    }

    public function test_can_update_contact()
    {
        $this->setAuthUser();

        $contact = factory(Contact::class)->create();

        $this->request->merge(factory(Contact::class)->make()->toArray());

        $updatedContact = dispatch(new AddContactJob($this->request, $contact));

        $this->assertInstanceOf(Contact::class, $updatedContact);
        $this->assertCount(1, Contact::all());
        $this->assertInstanceOf(User::class, $updatedContact->user);
    }

    private function setAuthUser()
    {
        $this->request->setUserResolver(function() {
            return factory(User::class)->create();
        });
    }
}
