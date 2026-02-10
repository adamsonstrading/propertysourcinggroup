<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Property;
use App\Models\WorkStep;
use App\Models\Faq;
use App\Models\Location;
use App\Models\TeamMember;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class FrontController extends Controller
{
    public function index()
    {
        // Cache homepage data for 1 hour
        $properties = Cache::remember('homepage_properties', 3600, function () {
            return Property::latest()->take(6)->get();
        });

        $services = Cache::remember('homepage_services', 3600, function () {
            return Service::all();
        });

        $workSteps = Cache::remember('homepage_worksteps', 3600, function () {
            return WorkStep::orderBy('sort_order')->get();
        });

        $faqs = Cache::remember('homepage_faqs', 3600, function () {
            return Faq::orderBy('sort_order')->get();
        });

        return view('welcome', compact('properties', 'services', 'workSteps', 'faqs'));
    }

    public function service($slug)
    {
        $service = Cache::remember("service_{$slug}", 3600, function () use ($slug) {
            return Service::where('slug', $slug)->with(['sections', 'faqs'])->firstOrFail();
        });

        $properties = Cache::remember('service_properties', 3600, function () {
            return Property::latest()->take(6)->get();
        });

        return view('service', compact('service', 'properties'));
    }

    public function locations()
    {
        $locations = Cache::remember('all_locations', 3600, function () {
            return Location::whereNull('parent_id')->with('children')->get();
        });

        return view('locations', compact('locations'));
    }

    public function location($slug)
    {
        $location = Cache::remember("location_{$slug}", 3600, function () use ($slug) {
            return Location::where('slug', $slug)->firstOrFail();
        });

        // Cache properties by location
        $properties = Cache::remember("location_{$slug}_properties", 1800, function () use ($location) {
            return Property::where('location', 'LIKE', '%' . $location->name . '%')
                ->latest()
                ->take(6)
                ->get();
        });

        return view('location', compact('location', 'properties'));
    }

    public function howItWorks()
    {
        return view('about.how-it-works');
    }

    public function whyChooseUs()
    {
        return view('about.why-choose-us');
    }

    public function meetTheTeam()
    {
        // Cache team members for 2 hours
        $teamData = Cache::remember('team_members', 7200, function () {
            return [
                'leadership' => TeamMember::where('category', 'Leadership Team')->orderBy('sort_order')->get(),
                'investment' => TeamMember::where('category', 'Investment Team')->orderBy('sort_order')->get(),
                'vendor' => TeamMember::where('category', 'Vendor Team')->orderBy('sort_order')->get(),
                'marketing' => TeamMember::where('category', 'Marketing Team')->orderBy('sort_order')->get(),
            ];
        });

        return view('about.meet-the-team', $teamData);
    }

    public function podcast()
    {
        return view('podcast');
    }

    public function becomeInvestor()
    {
        return view('investor');
    }

    public function properties()
    {
        // Use pagination with caching
        $properties = Property::latest()->paginate(12);
        return view('properties.index', compact('properties'));
    }

    public function investorEvent()
    {
        return view('investor-event');
    }

    public function news()
    {
        $articles = News::latest()->paginate(9);
        return view('news.index', compact('articles'));
    }

    public function newsShow($slug)
    {
        $article = Cache::remember("news_{$slug}", 3600, function () use ($slug) {
            return News::where('slug', $slug)->firstOrFail();
        });

        $recent = Cache::remember("news_recent_{$article->id}", 1800, function () use ($article) {
            return News::where('id', '!=', $article->id)->latest()->take(3)->get();
        });

        return view('news.show', compact('article', 'recent'));
    }

    public function contact()
    {
        return view('contact');
    }

    public function faq()
    {
        $faqs = Cache::remember('all_faqs', 3600, function () {
            return Faq::orderBy('sort_order')->get();
        });

        return view('faq', compact('faqs'));
    }
}
