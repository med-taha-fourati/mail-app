<?php

namespace App\Http\Controllers;

use App\Models\Draft;
use Illuminate\Http\Request;
use App\Models\Mail;

class DraftController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Request $request, Mail $mail)
    {
        Draft::create([
            'user_id' => auth()->user()->id,
            'subject' => $mail['subject'],
            'content' => $mail['content'],
            'to' => $mail['to'],
            'from' => $mail['from'],
        ]);

        return to_route('mail.dashboard')->with('success', 'Mail saved as draft successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Draft $draft)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Draft $draft)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Draft $draft)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Draft $draft)
    {
        //
    }
}
