<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\LessonService;
use App\Http\Controllers\Controller;
use App\Http\Resources\LessonResource;
use App\Http\Requests\StoreUpdateLesson;

class LessonController extends Controller
{
    protected $lessonService;

    public function __construct(LessonService $lessonService)
    {
        $this->lessonService = $lessonService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(string $module)
    {
        $lessons = $this->lessonService->getLessonsByModule($module);

        return LessonResource::collection($lessons);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUpdateLesson $request, string $module)
    {
        $lesson = $this->lessonService->createNewLesson($request->validated());

        return new LessonResource($lesson);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $module, string $identify)
    {
        $lesson = $this->lessonService->getLessonByModule($module, $identify);

        return new LessonResource($lesson);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUpdateLesson $request, $module, string $identify)
    {
        $this->lessonService->updateLesson($identify, $request->validated());

        return response()->json(['message' => 'updated']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $identify, string $module)
    {
        $this->lessonService->deleteLesson($identify);

        return response()->json([], 204);
    }
}
