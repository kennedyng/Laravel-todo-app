<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

use function PHPSTORM_META\type;

class Login extends DuskTestCase
{
    use DatabaseMigrations;
    /**
     * A Dusk test example.
     *@test
     * @return void
     */
    public function userCanLogin()
    {

        $user = User::factory()->create([
            "email" => "testing@gmail.com",
            "password" => "1234567890"
        ]);


        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/login')
                ->loginAs(User::Find(1))
                ->assertAuthenticated();
        });
    }
}
