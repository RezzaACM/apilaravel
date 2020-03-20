<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Book extends Model
{
    //

    public function getBook()
    {
        $sql = DB::select('select * from books');
        return $sql;
    }

    public function getBookId($id)
    {
        $sql = DB::select('select * from books where id ='.$id);
        return $sql;
    }
}
