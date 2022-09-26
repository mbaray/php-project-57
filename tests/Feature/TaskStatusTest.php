<?php

namespace Tests\Feature;

use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskStatusTest extends TestCase
{
    use RefreshDatabase;

    private TaskStatus $taskStatus;
    private User $user;
    private array $data;

    protected function setUp(): void
    {
        parent::setUp();

        $this->taskStatus = TaskStatus::factory()->create();
        $this->user = User::factory()->create();
        $this->data = ['name' => 'newTestStatus'];
    }

    public function testIndex(): void
    {
        $response = $this->get(route('task_statuses.index'));
        $response->assertOk();
    }

    public function testCreateWithoutAuth(): void
    {
        $this->get(route('task_statuses.create'))
            ->assertStatus(403);
    }

    public function testCreateWithAuth(): void
    {
        $this->actingAs($this->user)
            ->get(route('task_statuses.create'))
            ->assertSessionHasNoErrors()
            ->assertOk();
    }

    public function testStoreWithoutAuth(): void
    {
        $this->post(route('task_statuses.store'), $this->data)
            ->assertStatus(403);

        $this->assertDatabaseMissing('task_statuses', $this->data);
    }

    public function testStoreWithAuth(): void
    {
        $this->actingAs($this->user)
            ->post(route('task_statuses.store'), $this->data)
            ->assertRedirect(route('task_statuses.index'))
            ->assertSessionHasNoErrors();

        $this->assertDatabaseHas('task_statuses', $this->data);
    }

    public function testEditWithoutAuth()
    {
        $this->get(route('task_statuses.edit', $this->taskStatus))
            ->assertStatus(403);
    }

    public function testEditWithAuth()
    {
        $this->actingAs($this->user)
            ->get(route('task_statuses.edit', $this->taskStatus))
            ->assertOk()
            ->assertSessionHasNoErrors();
    }

    public function testUpdateWithoutAuth()
    {
        $this->patch(route('task_statuses.update', $this->taskStatus), $this->data)
            ->assertStatus(403);

        $this->assertDatabaseMissing('task_statuses', $this->data);
    }

    public function testUpdateWithAuth()
    {
        $this->actingAs($this->user)
            ->patch(route('task_statuses.update', $this->taskStatus), $this->data)
            ->assertRedirect(route('task_statuses.index'))
            ->assertSessionHasNoErrors();

        $this->assertDatabaseHas('task_statuses', $this->data);
        $this->assertDatabaseMissing('task_statuses', $this->taskStatus->toArray());
    }

    public function testDestroyWithoutAuth()
    {
        $this->delete(route('task_statuses.destroy', $this->taskStatus))
            ->assertStatus(403);

        $this->assertDatabaseHas('task_statuses', $this->taskStatus->toArray());
    }

    public function testDestroyWithAuth()
    {
        $this->actingAs($this->user)
            ->delete(route('task_statuses.destroy', $this->taskStatus))
            ->assertRedirect(route('task_statuses.index'))
            ->assertSessionHasNoErrors();

        $this->assertDatabaseMissing('task_statuses', $this->taskStatus->toArray());
    }
}
