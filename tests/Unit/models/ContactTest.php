<?php

namespace Tests\Unit;

use App\Contact;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ContactTest extends TestCase
{
    use DatabaseMigrations;

    public function test_can_create_contacts()
    {
        $contacts = factory(Contact::class, 5)->create();

        $this->assertInstanceOf(Contact::class, $contacts->first());
        $this->assertCount(5, $contacts);
    }

    public function test_user_relationship()
    {
        $user = factory(User::class)->create();

        $contact = factory(Contact::class)->create(['owner_id' => $user->id]);

        $this->assertInstanceOf(Contact::class, $contact);
        $this->assertInstanceOf(User::class, $contact->user);
        $this->assertEquals($user->id, $contact->user->id);
    }

    public function test_contact_first_name()
    {
        $contact = factory(Contact::class)->create();
        $fullName =$contact->title . ' ' . $contact->first_name . ' ' . $contact->last_name;

        $this->assertInstanceOf(Contact::class, $contact);
        $this->assertEquals($fullName, $contact->getFullName());
    }
}
