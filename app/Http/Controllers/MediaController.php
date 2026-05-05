<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Gallery;
use App\Models\Video;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function events(Request $request)
    {
        $events = Event::published()->orderBy('start_date', 'desc')->paginate(12);
        return view('frontend.media.events', compact('events'));
    }

    public function eventDetail(Event $event)
    {
        return view('frontend.media.event-detail', compact('event'));
    }

    public function gallery(Request $request)
    {
        $category  = $request->get('kategori', 'semua');
        $query     = Gallery::published();

        if ($category !== 'semua') {
            $query->where('category', $category);
        }

        $gallery    = $query->paginate(20);
        $categories = Gallery::where('is_published', true)->distinct()->pluck('category');

        return view('frontend.media.gallery', compact('gallery', 'categories', 'category'));
    }

    public function videos()
    {
        $videos   = Video::published()->latest()->paginate(12);
        $featured = Video::published()->where('is_featured', true)->first();
        return view('frontend.media.videos', compact('videos', 'featured'));
    }
}
