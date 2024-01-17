<?php

namespace App\Repositories;

class LessonRepository
{
    protected $entity;

    public function __contruct(Lesson $lesson)
    {
        $this->entity = $lesson;
    }
}
