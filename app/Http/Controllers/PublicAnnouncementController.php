<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Inertia\Inertia;

class PublicAnnouncementController extends Controller
{
    public function index()
    {
        $announcements = Announcement::whereRaw('(now() between startDate and endDate)')
            ->whereActive(true)
            ->orderByDesc('created_at')
            ->paginate(5);
        return Inertia::render('Index', compact('announcements'));
    }
}
