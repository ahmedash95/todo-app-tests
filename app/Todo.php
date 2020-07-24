<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    const STATUS_PENDING = 'pending';
    const STATUS_DONE = 'done';

    protected $guarded = [];

    public function scopeBeforeNow($q)
    {
        return $q->where('created_at', '<', now());
    }

    public function scopePending($q)
    {
        return $q->where('status', self::STATUS_PENDING);
    }
}
