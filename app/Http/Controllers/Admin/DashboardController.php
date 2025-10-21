<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Partner;
use App\Models\Team;
use App\Models\Post;
use App\Models\Gallery;
use App\Models\Contact;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'services' => Service::count(),
            'partners' => Partner::count(),
            'team_members' => Team::count(),
            'posts' => Post::count(),
            'gallery_items' => Gallery::count(),
            'contacts' => Contact::count(),
            'recent_contacts' => Contact::latest()->take(5)->get(),
            'recent_posts' => Post::latest()->take(5)->get(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
