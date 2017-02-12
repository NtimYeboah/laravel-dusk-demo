<?php

namespace Tests\Browser;

use App\User;
use Faker\Factory;
use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CreateContactTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function test_can_create_contact()
    {
        $faker = Factory::create();

        $this->browse(function ($browser) use($faker) {
            $browser->loginAs(factory(User::class)->create())
                ->visit('/home')
                ->click('.create-contact-btn')
                ->waitFor('#create-contact-modal', 1)
                ->assertSee('Create contact')
                ->select('title', 'Mrs.')
                ->type('first_name', $faker->firstName)
                ->type('last_name', $faker->lastName)
                ->radio('gender', 'Female')
                ->type('contact_number', $faker->phoneNumber)
                ->type('email', $faker->safeEmail)
                ->type('address', $faker->address)
                ->press('Save')
                ->assertSee('Contact successfully created');
        });
    }
}
