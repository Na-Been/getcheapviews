<?php

namespace App\Http\Controllers;

use App\Models\Email;
use App\Models\EmailTemplate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function index()
    {
        $users = User::where('status', 0)->with('order')->get();
        $templates = EmailTemplate::all();
        return view('admin.mail.sendMail', compact('users', 'templates'));
    }

    public function sendMail(Request $request)
    {
        $this->validate($request, [
            'to' => 'required',
            'subject' => 'required',
            'message' => 'required'
        ]);
        try {
            DB::beginTransaction();
            $input = $request->all();
            $user = User::where('email', $request->to)->first();
            $input['user_id'] = $user->id;
            $to_email = $request->to;
            $name = config('mail.from.name');
            $subject = $request->subject;
            $messages = $request->message;
            Mail::send('admin.mail.emailView', compact('name', 'user', 'messages'), function ($mail) use ($to_email, $subject) {
                $mail->to($to_email)->subject($subject);
            });
            Email::create($input);
            DB::commit();
            return back()->with('success', 'Email Send Successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            return back()->with('failed', 'Cannot Send Email Something Went Wrong!!!');
        }

    }

    public function findEmailTemplate($id)
    {
        $template = EmailTemplate::whereId($id)->first();
        return response($template);
    }

    public function bulkMailPage()
    {
        $users = User::where('status', 0)->get();
        $templates = EmailTemplate::all();
        return view('admin.mail.sendBulkEmail', compact('users', 'templates'));
    }

    public function sendBulkEmail(Request $request)
    {
        $this->validate($request, [
            'to' => 'required',
            'subject' => 'required',
            'message' => 'required'
        ]);
        try {
            DB::beginTransaction();
            $input = $request->all();
            $emails = $request->to;
//            $results = explode(',', $email);
            foreach ($emails as $email) {
                $user = User::where('email', $email)->first();
                $input['to'] = $email;
                $input['user_id'] = $user->id;
                $to_email = $email;
                $name = config('mail.from.name');
                $subject = $request->subject;
                $messages = $request->message;
                Mail::send('admin.mail.emailView', compact('name', 'user', 'messages'), function ($mail) use ($to_email, $subject) {
                    $mail->to($to_email)->subject($subject);
                });
                Email::create($input);
            }
            DB::commit();
            return back()->with('success', 'Mass Email Send Successfully!!!');
        } catch (\Exception $exception) {
            DB::rollBack();
            return back()->with('failed', 'Cannot Send Mass Email. Something Went Wrong Please Try Again Later');
        }
    }

    public function emailTemplate()
    {
        $templates = EmailTemplate::all();
        return view('admin.mail.viewEmailTemplate', compact('templates'));
    }

    public function createEmailTemplate()
    {
        return view('admin.mail.emailTemplate');
    }

    public function storeEmailTemplate(Request $request)
    {
        $this->validate($request, [
            'subject' => 'required',
            'message' => 'required'
        ]);
        try {
            DB::beginTransaction();
            $input = $request->all();
            EmailTemplate::create($input);
            DB::commit();
            return redirect()->route('template.index')->with('success', 'Template Added Successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('failed', 'Template Cannot Be Added');
        }
    }

    public function editEmailTemplate($id)
    {
        $template = EmailTemplate::whereId($id)->first();
        return view('admin.mail.editEmailTemplate', compact('template'));
    }

    public function updateEmailTemplate(Request $request, $id)
    {
        $this->validate($request, [
            'subject' => 'required',
            'message' => 'required'
        ]);
        try {
            DB::beginTransaction();
            $template = EmailTemplate::whereId($id)->first();
            $input = $request->all();
            $template->update($input);
            DB::commit();
            return redirect()->route('template.index')->with('success', 'Email Template Updated Successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            return back()->with('failed', 'Cannot Update Template. Something Went Wrong');
        }
    }

    public function deleteEmailTemplate()
    {
        try {
            DB::beginTransaction();
            $template = EmailTemplate::whereId(\request()->template_id)->first();
            $template->delete();
            DB::commit();
            return redirect()->route('template.index')->with('success', 'Email Deleted Successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            return back()->with('failed', 'Cannot Delete Email');
        }
    }

    public function emailLogsPage()
    {
        $emails = Email::all();
        return view('admin.mail.emailLogs', compact('emails'));
    }

    public function viewSingleSendMail($id)
    {
        $email = Email::whereId($id)->with('user')->first();
        return view('admin.mail.viewEmail', compact('email'));
    }

    public function deleteSingleMail()
    {
        try {
            DB::beginTransaction();
            $email = Email::whereId(\request()->id)->first();
            $email->delete();
            DB::commit();
            return redirect()->route('emaillogs.index')->with('success', 'Email Deleted Successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('failed', 'Cannot Delete Email');
        }
    }

    public function viewSingleUserDetails($id)
    {
        $user = User::whereId($id)->first();
        return view('admin.mail.viewUser', compact('user'));
    }
}
