<?php

namespace App\Http\Controllers;

use App\Http\Requests\UrlShortener\CreateRequest;
use App\Models\UrlShortener;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UrlShortenerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['urls'] = UrlShortener::where('user_id', Auth::user()->id)->get();
        return view('dashboard', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request)
    {
        try {
            UrlShortener::create([
                'long_url' => $request->long_url,
                'short_url' => $this->shortUrl(),
                'user_id' => Auth::user()->id,
            ]);
            return redirect()->back();
        } catch (\Exception $exception) {
            dd($exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(UrlShortener $urlShortener)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UrlShortener $urlShortener)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UrlShortener $urlShortener)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UrlShortener $urlShortener)
    {
        //
    }

    /**
     * shorter helper
     */
    public function shortUrl() {
        return Str::random(8);   
    }

    /**
     * click count
     */
    public function clickCount(UrlShortener $urlShortener) {
        $urlShortener->increment('count', 1);
        return redirect()->to($urlShortener->long_url);
    }

    /**
     * find and redirect 
     */
    public function redirectShortToLongPath ($shortPath) {
        return $this->clickCount(UrlShortener::where('short_url', $shortPath)->first());
    }
}
