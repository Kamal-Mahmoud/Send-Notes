<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Note extends Model
{
    use HasFactory, HasUuids;
    protected $guarded = ['id'];

    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function publishedUser(User $user)
    {
        return $this->where('user_id', $user->id)
            ->where('is_published', true)
            ->get();
    }
    protected $casts = [
        "is_published" => 'boolean'
    ];
}
