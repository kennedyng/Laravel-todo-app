<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class Register extends DuskTestCase
{
    use DatabaseMigrations;
    /**
     * A Dusk test example.
     *@test
     * @return void
     */
    public function user_can_register()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                ->type("name", "kennedy ngosa")
                ->type("email", "kennedyngosa@gmail.com")
                ->type("password", "testingPassword")
                ->type("password_confirmation", "testingPassword")
                ->press("REGISTER")->assertPathIs("/dashboard");
        });
    }
}
