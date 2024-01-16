<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\CourseService;
use App\Http\Controllers\Controller;
use App\Http\Resources\CourseResource;
use App\Http\Requests\StoreUpdateCourse;

class CourseController extends Controller
{

    protected $courseService;

    public function __construct(CourseService $courseService)
    {
        $this->courseService = $courseService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = $this->courseService->getCourses();

        return CourseResource::collection($courses);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUpdateCourse $request)
    {
        $course = $this->courseService->createNewCourse($request->validated());

        return new CourseResource($course);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $identify)
    {
        $course = $this->courseService->getCourse($identify);

        return new CourseResource($course);
    }


    public function update(StoreUpdateCourse $request, string $identify)
    {
        $this->courseService->updateCourse($identify, $request->validated());

        return response()->json(['message' => 'updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $identify
     * @return void
     */
    public function destroy(string $identify)
    {
        $this->courseService->deleteCourse($identify);

        return response()->json([], 204);
    }
}
