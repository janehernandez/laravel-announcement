<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var string[]|bool
     */
    protected $guarded = ['id'];

    public static function boot()
    {
        parent::boot();
        $now = Carbon::now();

        static::saving(function ($announcement) use ($now) {
            $announcement->active = ($now >= $announcement->startDate) && ($now <= $announcement->endDate);
        });
    }
}
