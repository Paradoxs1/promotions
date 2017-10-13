<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Cookie\CookieJar;


class ContactController extends Controller
{
    public function show()
    {
        return view('contact')->withTitle('promotions | contact');
    }

    public function formHandler(Request $request)
    {
        $request->flash();
        if ($request->isMethod('post')) {
            $rules = [
                'name' => 'bail|required|max:100|alpha',
                'phone' => 'max:20',
                'email' => 'required|email',
                'comment' => 'required|max:5000|alpha_num'
            ];
            $this->validate($request, $rules);

//            if ($request->email == Cookie::get('email')) {
//                Applicant::updateApplicant($request);
//            } elseif ($request->email != ($oldApplicant->email ?? 'no')) {
//                Applicant::addApplicant($request);
//                $cookieJar->queue(cookie('email', $request->email, 5256000));
//            }

            return redirect()->route('promotions')->withTitle('promotions');
        }

    }
}
