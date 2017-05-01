<?php

namespace Tests\Browser;

use App\User;
use Faker\Factory;
use Illuminate\Support\Facades\DB;
use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class RegistrationTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_can_register()
    {
        $faker = Factory::create();

        $this->browse(function($browser) use ($faker) {
            $password = $faker->password(9);

            $browser->visit('/register')
                ->assertSee('Register')
                ->type('name', $faker->name)
                ->type('email', $faker->safeEmail)
                ->type('password', $password)
                ->type('password_confirmation', $password)
                ->press('Register')
                ->assertPathIs('/home');
        });
    }
}
