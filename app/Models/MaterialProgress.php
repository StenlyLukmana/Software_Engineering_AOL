<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialProgress extends Model
{
    use HasFactory;

    protected $table = 'material_progress';

    protected $fillable = [
        'user_id',
        'material_id',
        'progress_percentage',
        'is_completed',
        'last_accessed'
    ];

    protected $casts = [
        'is_completed' => 'boolean',
        'last_accessed' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function material()
    {
        return $this->belongsTo(Material::class);
    }

    public static function updateProgress($userId, $materialId, $percentage = null)
    {
        $progress = self::firstOrCreate(
            ['user_id' => $userId, 'material_id' => $materialId],
            ['progress_percentage' => 0]
        );

        if ($percentage !== null) {
            $progress->progress_percentage = min(100, max(0, $percentage));
            $progress->is_completed = $progress->progress_percentage >= 100;
        }

        $progress->last_accessed = now();
        $progress->save();

        return $progress;
    }
}
