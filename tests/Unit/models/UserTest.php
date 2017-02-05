<?php

namespace Tests\Unit;

use App\Contact;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UserTest extends TestCase
{
    use DatabaseMigrations;

    public function test_can_create_user()
    {
        $users = factory(User::class, 5)->create();

        $this->assertInstanceOf(User::class, $users->first());
        $this->assertCount(5, User::all());
    }

    public function test_contacts_relationship()
    {
        $user = factory(User::class)->create();

        factory(Contact::class)->create(['owner_id' => $user->id]);

        $this->assertInstanceOf(Contact::class, $user->contacts->first());
        $this->assertEquals($user->id, $user->contacts->first()->id);
    }
}
