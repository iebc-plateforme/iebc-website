<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Partner;
use App\Models\Team;
use App\Models\Post;
use App\Models\Gallery;
use App\Models\Contact;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    /**
     * Display the services page.
     */
    public function services()
    {
        $services = Service::where('is_active', true)
            ->orderBy('order')
            ->get();

        return view('frontend.services', compact('services'));
    }

    /**
     * Display the blog listing page.
     */
    public function blog()
    {
        $posts = Post::where('is_published', true)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->with('user')
            ->latest('published_at')
            ->paginate(9);

        // Get categories for filter
        $categories = Post::where('is_published', true)
            ->whereNotNull('category')
            ->distinct()
            ->pluck('category');

        return view('frontend.blog', compact('posts', 'categories'));
    }

    /**
     * Display a single blog post.
     */
    public function blogShow($slug)
    {
        $post = Post::where('slug', $slug)
            ->where('is_published', true)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->with('user')
            ->firstOrFail();

        // Get related posts (same category)
        $relatedPosts = Post::where('is_published', true)
            ->where('id', '!=', $post->id)
            ->where('category', $post->category)
            ->latest('published_at')
            ->limit(3)
            ->get();

        return view('frontend.blog-show', compact('post', 'relatedPosts'));
    }

    /**
     * Display the team page.
     */
    public function team()
    {
        $teams = Team::where('is_active', true)
            ->orderBy('order')
            ->get();

        return view('frontend.team', compact('teams'));
    }

    /**
     * Display the gallery page.
     */
    public function gallery()
    {
        $galleries = Gallery::orderBy('is_featured', 'desc')
            ->orderBy('order')
            ->paginate(12);

        // Get categories for filter
        $categories = Gallery::whereNotNull('category')
            ->distinct()
            ->pluck('category');

        return view('frontend.gallery', compact('galleries', 'categories'));
    }

    /**
     * Display the partners page.
     */
    public function partners()
    {
        $partners = Partner::where('is_active', true)
            ->orderBy('order')
            ->get();

        return view('frontend.partners', compact('partners'));
    }

    /**
     * Display the contact form.
     */
    public function contactForm()
    {
        return view('frontend.contact');
    }

    /**
     * Submit contact form.
     */
    public function submitContact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:5000',
        ], [
            'name.required' => 'Le nom est obligatoire.',
            'email.required' => 'L\'email est obligatoire.',
            'email.email' => 'L\'email doit être valide.',
            'subject.required' => 'Le sujet est obligatoire.',
            'message.required' => 'Le message est obligatoire.',
        ]);

        Contact::create($validated);

        return redirect()->back()->with('success', 'Merci pour votre message ! Nous vous répondrons dans les plus brefs délais.');
    }

    /**
     * Display the about page.
     */
    public function about()
    {
        $teams = Team::where('is_active', true)
            ->orderBy('order')
            ->limit(6)
            ->get();

        return view('frontend.about', compact('teams'));
    }
}
