<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\Course;
use App\Models\Module;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ModuleTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_get_all_modules_by_course(): void
    {
        $course = Course::factory()->create();

        Module::factory()->count(10)->create([
            'course_id' => $course->id,
        ]);

        $response = $this->getJson("/course/{$course->uuid}/modules");

        $response->assertStatus(200)
                    ->assertJsonCount(10, 'data');
    }

    public function test_notfound_modules_by_course(): void
    {
        $response = $this->getJson("/course/fake_value/modules");

        $response->assertStatus(404);
    }


    public function test_get_module_by_course(): void
    {
        $course = Course::factory()->create();

        $module = Module::factory()->create([
            'course_id' => $course->id,
        ]);

        $response = $this->getJson("/course/{$course->uuid}/modules/{$module->uuid}");

        $response->assertStatus(200);
    }

    public function test_vlidations_create_module_by_course(): void
    {
        $course = Course::factory()->create();

        $response = $this->postJson("/course/{$course->uuid}/modules", []);

        $response->assertStatus(422);
    }

    public function test_create_module_by_course(): void
    {
        $course = Course::factory()->create();

        $response = $this->postJson("/course/{$course->uuid}/modules", [
            'course'  => $course->uuid,
            'name'  => 'Mod 001',
        ]);

        $response->assertStatus(201);
    }

    public function test_validations_update_module_by_course(): void
    {
        $course = Course::factory()->create();
        $module = Module::factory()->create();

        $response = $this->putJson("/course/{$course->uuid}/modules/{$module->uuid}", []);

        $response->assertStatus(422);
    }

    public function test_update_module_by_course(): void
    {
        $course = Course::factory()->create();
        $module = Module::factory()->create();

        $response = $this->putJson("/course/{$course->uuid}/modules/{$module->uuid}", [
            'course'    => $course->uuid,
            'name'      => 'Module Updated',
        ]);

        $response->assertStatus(200);
    }

    public function test_404_delete_module_by_course(): void
    {
        $response = $this->deleteJson("/course/fake_course/modules/fake_module");

        $response->assertStatus(404);
    }

    public function test_delete_module_by_course(): void
    {
        $course = Course::factory()->create();
        $module = Module::factory()->create([
            'course_id' => $course->id,
        ]);

        $response = $this->deleteJson("/course/{$course->uuid}/modules/{$module->uuid}");

        $response->assertStatus(204);
    }

}
