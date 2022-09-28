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
    private array $data;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->task = Task::factory()->create();
        $this->data = [
            'name' => 'newTestTask',
            'status_id' => $this->task->status_id
        ];
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
        $this->post(route('tasks.store'), $this->data)
            ->assertStatus(403);

        $this->assertDatabaseMissing('tasks', $this->data);
    }

    public function testStoreWithAuth(): void
    {
        $this->actingAs($this->user)
            ->post(route('tasks.store'), $this->data)
            ->assertRedirect(route('tasks.index'))
            ->assertSessionHasNoErrors();

        $this->assertDatabaseHas('tasks', $this->data);
    }

    public function testEditWithoutAuth(): void
    {
        $this->get(route('tasks.edit', $this->task))
            ->assertStatus(403);
    }

    public function testEditWithAuth(): void
    {
        $this->actingAs($this->user)
            ->get(route('tasks.edit', $this->task))
            ->assertOk()
            ->assertSessionHasNoErrors();
    }

    public function testUpdateWithoutAuth(): void
    {
        $this->patch(route('tasks.update', $this->task), $this->data)
            ->assertStatus(403);

        $this->assertDatabaseMissing('tasks', $this->data);
    }

    public function testUpdateWithAuth(): void
    {
        $this->actingAs($this->user)
            ->patch(route('tasks.update', $this->task), $this->data)
            ->assertRedirect(route('tasks.index'))
            ->assertSessionHasNoErrors();

        $this->assertDatabaseHas('tasks', $this->data);

        $this->assertDatabaseMissing('tasks', [
            'name' => $this->task->name
        ]);
    }

    public function testDestroyWithoutAuth(): void
    {
        $this->delete(route('tasks.destroy', $this->task))
            ->assertStatus(403);

        $this->assertDatabaseHas('tasks', [
            'name' => 'testTask',
            'description' => $this->task->description,
        ]);
    }

    public function testDestroyWithAuth(): void
    {
        $this->actingAs($this->user)
            ->delete(route('tasks.destroy', $this->task))
            ->assertStatus(403);

        $this->assertDatabaseHas('tasks', [
            'name' => 'testTask',
            'description' => $this->task->description,
        ]);
    }

    public function testDestroyWithAuthFromTheOwner(): void
    {
        $this->actingAs($this->task->creator)
            ->delete(route('tasks.destroy', $this->task))
            ->assertRedirect(route('tasks.index'))
            ->assertSessionHasNoErrors();

        $this->assertDatabaseMissing('tasks', [
            'name' => 'testTask',
            'created_by_id' => $this->task->creator->id
        ]);
    }
}
