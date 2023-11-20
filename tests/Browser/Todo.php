<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

use function PHPSTORM_META\type;

class Todo extends DuskTestCase
{

    use DatabaseMigrations;
    /**
     * A Dusk test example.
     *@test
     * @return void
     */
    public function testTodo()
    {

        User::factory()->create();

        //creat new todo
        $this->browse(function (Browser $browser) {
            $browser
                ->loginAs(User::find(1))
                ->visit("/dashboard")
                ->press("@create-new-todo")
                ->assertPathIs("/task")
                ->type("description", "new todo task")
                ->press("Add Task")
                ->assertPathIs("/dashboard")
                ->assertSeeIn('tbody tr:first-child', 'new todo task');




            // Edit Todo list
            $editedTodoText = "edited todo task";
            $browser
                ->visit("/dashboard")
                ->assertSeeIn('tbody tr:first-child', 'Edit')
                ->clickLink("Edit")
                ->assertPathIs("/task/1")
                ->assertSee('new todo task')
                ->type("description", "edited todo task")
                ->press("Update task")
                ->assertPathIs("/dashboard")
                ->assertSeeIn('tbody tr:first-child', 'edited todo task');

            // Delete Todo list
            $browser
                ->visit("/dashboard")
                ->assertSeeIn('tbody tr:first-child', 'Delete')
                ->press("Delete")
                ->assertDontSee($editedTodoText);
        });
    }
}
