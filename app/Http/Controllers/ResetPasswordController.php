<?php

namespace App\Http\Controllers;

use App\Customer;
use App\ResetPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{

    public function __construct(ResetPassword $reset, Customer $customer)
    {
        $this->reset = $reset;
        $this->customer = $customer;
    }
    //

    public function create(Request $request)
    {
        $reset = $this->reset;
        $reset->email = $request->get('email');
        $reset->token =  Str::random(60);

        // checking if email has been using show status false
        $checkMail = $this->customer->checkEmail($reset->email);
        if ($checkMail == false) {
            if ($reset->save()) {
                $res['status'] = true;
                $res['message'] = 'Success! Reset Password has been requested';
                $res['data'] = $reset;
                return response($res);
            } else {
                $res['status'] = False;
                $res['message'] = 'Faied to reques reset password';
                return response($res, 400);
            }
        } else {
            $res['status'] = false;
            $res['message'] = 'E-mail not found!';
            return response($res, 404);
        }
    }

    public function tokenSuccess($token)
    {

        $check = $this->reset->check_token($token);
        // if check token result is not false do it
        if ($check) {
            $res['status'] = true;
            $res['message'] = 'Success Request Reset Password!';
            $res['data'] = $check;
            return response($res);
        } else {
            $res['status'] = false;
            $res['message'] = 'Token has been Invalid. Please resend email.';
            return response($res, 404);
        }
    }

    public function resetPassowrd(Request $request)
    {
        $reset = $this->reset;
        $reset->email = $request->get('email');
        $reset->token = $request->get('token');

        $checkToken = $this->reset->check_token($reset->token);
        $checkMail = $this->customer->checkEmail($reset->email);
        if ($checkToken == false) {
            $res['status'] = false;
            $res['message'] = 'Token has been Invalid. Please resend email.';
            return response($res, 404);
        }

        if ($checkMail == true) {
            $res['status'] = false;
            $res['message'] = 'User with this e-mail not found!';
            return response($res, 404);
        }
        $customer = $this->customer::where('email',$request->email)->first();
        $customer->password =  bcrypt($request->get('password'));
        if ($customer->save()) {
            $res['status'] = true;
            $res['message'] = 'Success!';
            $res['data'] = $customer;
            return response($res);
        }
    }
}
