<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    private Task $task;
    private User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->task = Task::factory()->create();
    }


    public function testIndex(): void
    {
        $response = $this->get(route('tasks.index'));
        $response->assertOk();
    }

    public function testShow(): void
    {
        $this->get(route('tasks.show', $this->task))
            ->assertOk()
            ->assertSessionHasNoErrors();
    }

    public function testCreateWithoutAuth(): void
    {
        $this->get(route('tasks.create'))
            ->assertStatus(403);
    }

    public function testCreateWithAuth(): void
    {
        $this->actingAs($this->user)
            ->get(route('tasks.create'))
            ->assertSessionHasNoErrors()
            ->assertOk();
    }

    public function testStoreWithoutAuth(): void
    {
        $data = [
            'name' => 'test',
            'status_id' => $this->task->status->id
        ];

        $this->post(route('tasks.store'), $data)
            ->assertStatus(403);

        $this->assertDatabaseMissing('tasks', $data);
    }

    public function testStoreWithAuth(): void
    {
        $data = [
            'name' => 'test',
            'status_id' => $this->task->status->id
        ];

        $this->actingAs($this->user)
            ->post(route('tasks.store'), $data)
            ->assertRedirect(route('tasks.index'))
            ->assertSessionHasNoErrors();

        $this->assertDatabaseHas('tasks', $data);
    }

    public function testEditWithoutAuth()
    {
        $this->get(route('tasks.edit', $this->task))
            ->assertStatus(403);
    }

    public function testEditWithAuth()
    {
        $this->actingAs($this->user)
            ->get(route('tasks.edit', $this->task))
            ->assertOk()
            ->assertSessionHasNoErrors();
    }

    public function testUpdateWithoutAuth()
    {
        $data = [
            'name' => 'test',
            'status_id' => $this->task->status->id
        ];
        $this->patch(route('tasks.update', $this->task), $data)
            ->assertStatus(403);

        $this->assertDatabaseMissing('tasks', [
            'name' => 'test',
            'status_id' => $this->task->status->id
        ]);
    }

    public function testUpdateWithAuth()
    {
        $data = [
            'name' => 'test2',
            'status_id' => $this->task->status->id
        ];

        $this->actingAs($this->user)
            ->patch(route('tasks.update', $this->task), $data)
            ->assertRedirect(route('tasks.index'))
            ->assertSessionHasNoErrors();

        $this->assertDatabaseHas('tasks', [
            'name' => 'test2',
            'status_id' => $this->task->status->id
        ]);

//        $this->assertDatabaseMissing('tasks', [
//            'name' => 'test'
//        ]);
    }

    public function testDestroyWithoutAuth()
    {
        $this->delete(route('tasks.destroy', $this->task))
            ->assertStatus(403);

        $this->assertDatabaseHas('tasks', $this->task->toArray());
    }

    public function testDestroyWithAuth()
    {
        $this->actingAs($this->user)
            ->delete(route('tasks.destroy', $this->task))
            ->assertStatus(403);

        $this->assertDatabaseHas('tasks', $this->task->toArray());
    }

    public function testDestroyWithAuthFromTheOwner()
    {
        $this->actingAs($this->task->creator)
            ->delete(route('tasks.destroy', $this->task))
            ->assertRedirect(route('tasks.index'))
            ->assertSessionHasNoErrors();

//        $this->assertDatabaseMissing('tasks', $this->task->toArray());
    }
}
