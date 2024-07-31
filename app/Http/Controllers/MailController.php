<?php

namespace App\Http\Controllers;

use App\Models\Mail;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Trash;
use App\Models\Draft;

class MailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!auth()->check()) {
            return to_route('auth.login');
        }
        // get the id of the logged in user
        $user_id = auth()->user()->email;
        //dd($user_id);

        $mail = Mail::query()->orderBy('updated_at', 'desc')
            ->where('from', '=', $user_id)
            ->orWhere('to', '=', $user_id)
            ->get();

        $trash = Trash::query()->where('user_id', '=', auth()->user()->id)->get();
        $draft = Draft::query()->where('user_id', '=', auth()->user()->id)->get();
        
        //dd($mail);
        return view('mail.dashboard', [
            'mail' => $mail,
            'trash' => $trash,
            'draft' => $draft
        ]);
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
    public function store(Request $request)
    {
        $data = $request->validate([
            "to" => "string|required",
            "subject" => "string|required|max:200",
            "text" => "string|required|max:1000"
        ]);
        $user = User::find(auth()->user()->id);
        $data['from'] = $user['email'];
        //dd($data);
        $data['content'] = $data['text'];
        $data['user_id'] = auth()->user()->id;

        if (User::where('email', $data['to'])->first() == null) {
            return to_route('mail.dashboard')->with('error', 'User does not exist');
        }
        //$data['trash'] = false;
        $data['trash_id'] = null;

        switch ($request->input('action')) {
            case 'send':
                Mail::create($data);
                return to_route('mail.dashboard')->with('success', 'Mail sent successfully');
                break;
            case 'draft':
                Draft::create($data);
                return to_route('mail.dashboard')->with('success', 'Mail saved as draft successfully');
                break;
            default:
                return to_route('mail.dashboard')->with('error', 'Something went wrong');
                break;
        }
    }

    public function reply(Request $request, Mail $mail) {
        $data = $request->validate([
            "subject" => "string|required|max:200",
            "text" => "string|required|max:1000"
        ]);
        //dd($data);
        //dd($mail['content']);

        $data['content'] = "Replying To: \"".$mail['content']."\": ".$data['text'];
        $data['user_id'] = auth()->user()->id;
        //$data['trash'] = false;
        $data['mail_id'] = $mail['id'];
        $data['from'] = $mail['to'];
        $data['to'] = $mail['from'];
        //dd($data);
        Mail::create($data);
        return to_route('mail.dashboard')->with('success', 'Mail replied successfully');
    }

    public function forward(Request $request, Mail $mail) {
        $data = $request->validate([
            "subject" => "string|required|max:200",
            "to" => "required|email"
        ]);
        //dd($data);
        dd($mail['content']);
        //dd($mail);

        $data['content'] = "Forwarded: \"".$mail['content']."\"";
        $data['user_id'] = auth()->user()->id;
        //$data['trash'] = false;
        //$data['mail_id'] = $mail['id'];
        $data['from'] = auth()->user()->email;
        //dd($data);
        Mail::create($data);
        return to_route('mail.dashboard')->with('success', 'Mail forwarded successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Mail $mail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mail $mail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mail $mail)
    {
        //dd($mail['from']);
        $data = [];
        $data['user_id'] = auth()->user()->id;
        $data['from'] = $mail['from'];
        $data['to'] = $mail['to'];
        $data['subject'] = $mail['subject'];
        $data['content'] = $mail['content'];
        //dd($data);
        $trash = Trash::create($data);
        
        $mail->trash_id = $trash['id'];
        $mail->save();
        return to_route('mail.dashboard')->with('success', 'Mail moved to trash successfully');
    }

    public function restore(Request $request, Trash $trash)
    {
        Mail::query()->where('trash_id', '=', $trash->id)->update(['trash_id' => null]);
        $trash->delete();

        return to_route('mail.dashboard')->with('success', 'Mail has been restored successfully');
    }

    public function undraft(Request $request, Draft $draft)
    {
        Mail::create([
            'user_id' => $draft->user_id,
            'from' => $draft->from,
            'to' => $draft->to,
            'subject' => $draft->subject,
            'content' => $draft->content
        ]);
        Draft::query()->where('id', '=', $draft->id)->delete();

        return to_route('mail.dashboard')->with('success', 'Mail has been sent and undrafted successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mail $mail)
    {
        //
    }
}
