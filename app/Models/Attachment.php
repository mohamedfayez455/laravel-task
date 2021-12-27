<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use HasFactory;

    protected $append = ['file_path'];

    protected $fillable = [
        'file',
        'post_id'
    ];

    public function post(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Post::class)->withDefault();
    }

    public function getFilePathAttribute(): string
    {
        return asset('uploads/posts/'.$this->file);
    }
}
