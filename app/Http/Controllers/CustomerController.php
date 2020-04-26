<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Mail\EmailVerification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class CustomerController extends Controller
{
    public function __construct(Customer $model)
    {
        $this->customer = $model;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //get inputs from frontend
        $customer = $this->customer;
        $customer->name = $request->get('name');
        $customer->email = $request->get('email');
        $customer->phone_number = $request->get('phone_number');
        $customer->password =  md5($request->get('password'));
        $customer->remember_token =  Str::random(60);
        // checking if email has been using show status false
        $checkMail = $this->customer->checkEmail($customer->email);
        if ($checkMail == true) {
            if ($customer->save()) {
                $res['status'] = true;
                $res['message'] = 'Success! New Customer Has Been Created';
                $res['data'] = $customer;
                Mail::to($customer->email)->send(new EmailVerification($customer));
                return response($res, 201);
            } else {
                $res['status'] = false;
                $res['message'] = 'Failed to Created New Customer';
                return response($res, 400);
            }
        } else { //if email not yet using before let save
            $res['status'] = false;
            $res['message'] = 'Email has been using.';
            return response($res);
        }


        // return $customer;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    // this function to verify email
    public function verifySuccess(Request $request, $token)
    {

        $check = $this->customer->check_token($token);
        // dump(Carbon::now()->toDateTimeString());
        if ($check) {
            if ($check[0]->email_verified_at !== null) {
                $res['message'] = 'Youre e-mail has been verify';
                return response($res, 200);
            } else {
                $id = $check[0]->id;
                $customer = $this->customer::find($id);
                $customer->email_verified_at = Carbon::now()->toDateTimeString();
                if ($customer->save()) {
                    $res['status'] = true;
                    $res['message'] = 'Success! youre e-mail is verified.';
                    $res['data'] = $customer;
                    return response($res, 200);
                }
                $res['status'] = false;
                $res['message'] = 'Failed! your email cannot be identified.';
                return response($res);
            }
        } else {
            $res['status'] = false;
            $res['message'] = 'Token was invalid. Please resend email verification.';
            return response($res, 404);
        }
    }

    public function customerAuth(Request $request)
    {
        $login = $this->customer;
        $login->email = $request->get('email');
        $login->password = md5($request->get('password'));
        $null = '';

        $check = $this->customer->checkLogin($login->email, $login->password);
        // dd($check);

        if($check){
            $res['status'] = true;
            $res['message'] = 'Login Customer Success!';
            $res['data'] = $check;
            return response($res, 200);
        }else{
            $res['status'] = false;
            $res['message'] = 'Email or Password Incorrect';
        return response($res, 404);
        }
    }
}
