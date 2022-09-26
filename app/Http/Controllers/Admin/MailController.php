<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\MailReply;
use App\Models\Mail;
use App\Models\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail as FacadesMail;

class MailController extends Controller
{

    public function index() {
        $data['mails'] = Mail::all()->reverse();
        return view('admin.pages.mail.index', $data);
    }

    public function store(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'content' => 'required|min: 8',
        ]);

        $mail = new Mail();
        $mail->name = $request->name;
        $mail->email = $request->email;
        $mail->content = $request->content;
        $mail->save();

        return redirect()->route('main.home')->with('success', 'Masukan berhasil terkirim!');
    }

    public function show($id) {
        $data['mail'] = Mail::find($id);
        return view('admin.pages.mail.detail', $data);
    }

    public function reply(Request $request, $id) {
        $this->validate($request, [
            'reply_content' => 'required',
        ]);
        $mail = Mail::find($id);

        $reply = new Reply();
        $reply->title = "Balasan terkait masukan pada ".$mail->created_at;
        $reply->content = $request->reply_content;
        $reply->mail_id = $mail->id;
        $reply->save();

        $data['mail'] = $mail;
        $data['reply'] = $reply;
        FacadesMail::to($mail->email)->send(new MailReply($data));

        return redirect()->route('mail')->with('success', 'Balasan berhasil terkirim');
    }

    public function destroy($id) {
        $mail = Mail::find($id);
        if ($mail) {
            $mail->delete();

            return redirect()->route('mail')->with('success', 'Mail berhasil dihapus');
        }
        return redirect()->route('mail')->with('failed', 'Mail gagal dihapus');
    }
}
