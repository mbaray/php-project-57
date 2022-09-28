<?php

namespace Tests\Feature;

use App\Models\Label;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LabelTest extends TestCase
{
    use RefreshDatabase;

    private Label $label;
    private User $user;
    private array $data;

    protected function setUp(): void
    {
        parent::setUp();

        $this->label = Label::factory()->create();
        $this->user = User::factory()->create();
        $this->data = [
            'name' => 'newTestLabel',
            'description' => 'newTestDescription'
        ];
    }

    public function testIndex(): void
    {
        $response = $this->get(route('labels.index'));
        $response->assertOk();
    }

    public function testCreateWithoutAuth(): void
    {
        $this->get(route('labels.create'))
            ->assertStatus(403);
    }

    public function testCreateWithAuth(): void
    {
        $this->actingAs($this->user)
            ->get(route('labels.create'))
            ->assertSessionHasNoErrors()
            ->assertOk();
    }

    public function testStoreWithoutAuth(): void
    {
        $this->post(route('labels.store'), $this->data)
            ->assertStatus(403);

        $this->assertDatabaseMissing('labels', $this->data);
    }

    public function testStoreWithAuth(): void
    {
        $this->actingAs($this->user)
            ->post(route('labels.store'), $this->data)
            ->assertRedirect(route('labels.index'))
            ->assertSessionHasNoErrors();

        $this->assertDatabaseHas('labels', $this->data);
    }

    public function testEditWithoutAuth(): void
    {
        $this->get(route('labels.edit', $this->label))
            ->assertStatus(403);
    }

    public function testEditWithAuth(): void
    {
        $this->actingAs($this->user)
            ->get(route('labels.edit', $this->label))
            ->assertOk()
            ->assertSessionHasNoErrors();
    }

    public function testUpdateWithoutAuth(): void
    {
        $this->patch(route('labels.update', $this->label), $this->data)
            ->assertStatus(403);

        $this->assertDatabaseMissing('labels', $this->data);
    }

    public function testUpdateWithAuth(): void
    {
        $this->actingAs($this->user)
            ->patch(route('labels.update', $this->label), $this->data)
            ->assertRedirect(route('labels.index'))
            ->assertSessionHasNoErrors();

        $this->assertDatabaseHas('labels', $this->data);
        $this->assertDatabaseMissing('labels', [
            'name' => 'testLabel',
        ]);
    }

    public function testDestroyWithoutAuth(): void
    {
        $this->delete(route('labels.destroy', $this->label))
            ->assertStatus(403);

        $this->assertDatabaseHas('labels', [
            'name' => 'testLabel',
        ]);
    }

    public function testDestroyWithAuth(): void
    {
        $this->actingAs($this->user)
            ->delete(route('labels.destroy', $this->label))
            ->assertRedirect(route('labels.index'))
            ->assertSessionHasNoErrors();

        $this->assertDatabaseMissing('labels', [
            'name' => 'testLabel',
        ]);
    }

    public function testDestroyLinkedLabelWithAuth(): void
    {
        $task = Task::factory()->hasAttached($this->label)->create();

        $this->actingAs($this->user)
            ->delete(route('labels.destroy', $this->label));

        $this->assertDatabaseHas('labels', [
            'id' => $this->label->id,
            'name' => 'testLabel',
        ]);
    }
}
