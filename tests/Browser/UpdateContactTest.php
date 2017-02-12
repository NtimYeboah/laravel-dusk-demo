<?php

namespace Tests\Browser;

use App\Contact;
use App\User;
use Faker\Factory;
use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UpdateContactTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function test_can_update_contact()
    {
        $contacts = factory(Contact::class, 20)->create();
        $faker = Factory::create();

        $this->browse(function ($browser) use($contacts, $faker) {
            $browser->loginAs(factory(User::class)->create())
                ->visit('/home')
                ->clickLink($contacts->first()->getFullName())
                ->assertPathIs('/home/' . $contacts->first()->id)
                ->assertSee('Edit contact')
                ->select('title', 'Mr')
                ->type('first_name', $faker->firstName)
                ->type('last_name', $faker->lastName)
                ->radio('gender', 'Male')
                ->type('contact_number', $faker->phoneNumber)
                ->type('email', $faker->safeEmail)
                ->type('address', $faker->address)
                ->press('Save changes')
                ->assertSee('Contact successfully updated');
        });
    }
}
