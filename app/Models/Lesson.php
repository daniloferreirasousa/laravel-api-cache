<?php

namespace App\Models;

use App\Models\Module;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'module_id',
        'uuid',
        'name',
        'video',
        'description'
    ];

    public function module()
    {
        return $this->belongsTo(Module::class);
    }
}
