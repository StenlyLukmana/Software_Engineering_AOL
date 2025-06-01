<?php

namespace App\Models;

use App\Models\Subject;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Material extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'media',
        'subject_id',   
    ];

    public function subject(){
        return $this->belongsTo(Subject::class);
    }

}
