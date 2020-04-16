<?php

namespace App\Http\Controllers;

use App\Publisher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PublisherController extends Controller
{

    public function __construct(Publisher $model)
    {
        $this->middleware('basicAuth');
        $this->publisher = $model;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get book function
        $data = $this->publisher->_getPublisher();

        if (count($data) > 0) {
            $res['status'] = true;
            $res['message'] = 'success display data publisher';
            $res['data'] = $data;
            return response($res, 200);
        } else {
            $res['status'] = false;
            $res['message'] = 'failed display data publisher';
            return response($res, 404);
        }
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
        $publisher = $this->publisher;
        $publisher->name = $request->get('name');
        $publisher->address = $request->get('address');
        $publisher->phone_number = $request->get('phone_number');
        if ($publisher->save()) {
            $res['status'] = true;
            $res['message'] = 'success create new publisher';
            $res['data'] = $publisher;
            return response($res, 201);
        } else {
            $res['status'] = false;
            $res['message'] = 'failed create new publisher';
            return response($res, 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //get data byid
        $data = $this->publisher->_getPublisherId($id);
        // var_dump($data);
        if (count($data) > 0) {
            $res['status'] = true;
            $res['message'] = 'success display data publisher';
            $res['data'] = $data;
            return response($res, 200);
        } else {
            $res['status'] = false;
            $res['message'] = 'failed display data publisher';
            return response($res, 404);
        }
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
        $publisher = $this->publisher::find($id);
        $publisher->name = $request->get('name');
        $publisher->address = $request->get('address');
        $publisher->phone_number = $request->get('phone_number');
        if ($publisher->save()) {
            $res['status'] = true;
            $res['message'] = 'success update data publisher';
            $res['data'] = $publisher;
            return response($res, 200);
        } else {
            $res['status'] = false;
            $res['message'] = 'failed update data publisher';
            return response($res, 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        $publisher = $this->publisher;
        $publisher->id = $request->get('id');
        $data = DB::table('publishers')->where('id', $publisher->id)->delete();

        if ($data) {
            $res['status'] = true;
            $res['message'] = "Success! Data has been deleted.";
            $res['data'] = "$data";
            return response($res);
        } else {
            $res['status'] = false;
            $res['message'] = "Failed!";
            return response($res);
        }
    }
}
