<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class TodoCreation extends DuskTestCase
{

    use DatabaseMigrations;

    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    {

        User::factory()->create();


        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->visit("/dashboard")
                ->assertSee("Dashboard")
                ->clickLink("Add new Task")
                ->assertPathIs("/task")
                ->type("description", "Creating")
                ->press("Add Task")->assertPathIs("/dashboard")->assertSee("Creating");
        });
    }
}
