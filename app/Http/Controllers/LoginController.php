<?php

namespace App\Http\Controllers;

use App\LoginModel;
use Illuminate\Http\Request;

class LoginController extends Controller
{


    public function __construct(LoginModel $model)
    {
        //Do your magic here
        $this->middleware('basicAuth');
        $this->loginModel = $model;
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
        // 
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

    public function loginAct(Request $request)
    {
        // 
        $data = $this->loginModel;
        $data->email = $request->get('email');
        $data->password = md5($request->get('password'));
        
        $check = $this->loginModel->check_login($data->email, $data->password);
        if($check){
            $res['message'] = 'Success!';
            $res['values'] = $check;
            return response($res, 200);
        }else{
            $res['message'] = 'Incorrect email or password!';
            return response($res, 401);
        }
        // $animal = "test";

        // echo 'ini string '."\"$animal\"";


    }
}
