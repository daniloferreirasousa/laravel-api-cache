<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\Lesson;
use App\Models\Module;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LessonTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_get_all_modules_by_course(): void
    {
        $module = Module::factory()->create();

        Lesson::factory()->count(10)->create([
            'module_id' => $module->id,
        ]);

        $response = $this->getJson("/modules/{$module->uuid}/lessons");

        $response->assertStatus(200)
                    ->assertJsonCount(10, 'data');
    }

    public function test_notfound_lessons_by_module(): void
    {
        $response = $this->getJson("/modules/fake_value/lessons");

        $response->assertStatus(404);
    }


    public function test_get_lesson_by_module(): void
    {
        $module = Module::factory()->create();

        $lesson = lesson::factory()->create([
            'module_id' => $module->id,
        ]);

        $response = $this->getJson("/modules/{$module->uuid}/lessons/{$lesson->uuid}");

        $response->assertStatus(200);
    }

    public function test_validations_create_lesson_by_module(): void
    {
        $module = Module::factory()->create();

        $response = $this->postJson("/modules/{$module->uuid}/lessons", []);

        $response->assertStatus(422);
    }

    public function test_create_lesson_by_module(): void
    {
        $module = Module::factory()->create();

        $response = $this->postJson("/modules/{$module->uuid}/lessons", [
            'module'  => $module->uuid,
            'name'  => 'Mod 001',
            'video' => 'video01.video',
            'description' => 'descrição qualquer para este video',
        ]);

        $response->assertStatus(201);
    }

    public function test_validations_update_lesson_by_module(): void
    {
        $module = Module::factory()->create();
        $lesson = Lesson::factory()->create();

        $response = $this->putJson("/modules/{$module->uuid}/lessons/{$lesson->uuid}", []);

        $response->assertStatus(422);
    }

    public function test_update_lesson_by_module(): void
    {
        $module = Module::factory()->create();
        $lesson = Lesson::factory()->create([
            'module_id' => $module->id,
        ]);

        $response = $this->putJson("/modules/{$module->uuid}/lessons/{$lesson->uuid}", [
            'module'    => $module->uuid,
            'name'      => 'Module Updated',
            'video'     => 'video021k.video',
            'description'   => 'Descrição qualquer para cá',
        ]);

        $response->assertStatus(200);
    }

    public function test_404_delete_lesson_by_module(): void
    {
        $response = $this->deleteJson("/modules/fake_course/lessons/fake_lesson");

        $response->assertStatus(404);
    }

    public function test_delete_leson_by_module(): void
    {
        $module = Module::factory()->create();
        $lesson = Lesson::factory()->create();

        $response = $this->deleteJson("/modules/{$module->uuid}/lessons/{$lesson->uuid}");

        $response->assertStatus(204);
    }
}
