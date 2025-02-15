<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_task()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/tasks', [
            'title' => 'Test Task'  // Changed from 'name' to 'title'
        ]);

        $response->assertRedirect('/tasks');
        $this->assertDatabaseHas('tasks', [
            'title' => 'Test Task',  // Changed from 'name' to 'title'
            'user_id' => $user->id
        ]);
    }

    public function test_user_cannot_create_task_with_invalid_name()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/tasks', [
            'title' => ''  // Changed from 'name' to 'title'
        ]);

        $response->assertSessionHasErrors('title');  // Changed from 'name' to 'title'
    }

    public function test_user_can_view_their_tasks()
    {
        $user = User::factory()->create();
        $task = Task::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->get('/tasks');

        $response->assertStatus(200);
        $response->assertSee($task->title);  // Changed from 'name' to 'title'
    }

    public function test_user_cannot_view_others_tasks()
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        $task = Task::factory()->create(['user_id' => $user2->id]);

        $response = $this->actingAs($user1)->get('/tasks');

        $response->assertStatus(200);
        $response->assertDontSee($task->title);  // Changed from 'name' to 'title'
    }
}
