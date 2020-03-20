<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{

    public function __construct(Book $model)
    {
        $this->book = $model;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = $this->book->getBook();
        // return $data;

        if (count($data) > 0) {
            $res['message'] = 'success!';
            $res['values'] = $data;
            return response($res);
        } else {
            $res['message'] = 'failed!';
            return response($res);
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
        $book = $this->book;
        $book->title = $request->get('title');
        $book->description = $request->get('description');
        $book->qty = $request->get('qty');
        $book->publisher = $request->get('publisher');
        if ($book->save()) {
            $res['message'] = 'Success!';
            $res['values'] = $book;
            return response($res, 201);
        } else {
            $res['message'] = 'failed to insert data!';
            return response($res);
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
        //
        $data = $this->book->getBookId($id);
        if (count($data) > 0) {
            $res['message'] = 'success!';
            $res['values'] = $data;
            return response($res);
        } else {
            $res['message'] = 'data not found!';
            return response($res, 404);
        }
        // return $data;
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
        $book = $this->book::find($id);
        $book->title = $request->get('title');
        $book->description = $request->get('description');
        $book->qty = $request->get('qty');
        $book->publisher = $request->get('publisher');
        if ($book->save()) {
            $res['message'] = 'Success! Datas has been updated.';
            $res['values'] = $book;
            return response($res, 200);
        } else {
            $res['message'] = 'failed to update data!';
            return response($res);
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
        $book = $this->book;
        $book->id = $request->get('id');
        $data = DB::table('books')->where('id', $book->id)->delete();

        if ($data) {
            $res['message'] = "Success! Data has been deleted.";
            $res['value'] = "$data";
            return response($res);
        } else {
            $res['message'] = "Failed!";
            return response($res);
        }
    }
}
