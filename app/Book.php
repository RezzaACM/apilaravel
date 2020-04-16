<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Book extends Model
{
    //

    public function getBook()
    {
        $sql = DB::select('SELECT a.id, a.title, a.description, b.name AS publisher, a.qty, a.price FROM books a
        INNER JOIN publishers b ON b.id=a.publisher_id');
        return $sql;
    }

    public function getBookId($id)
    {
        $sql = DB::select('select * from books where id =' . $id);
        return $sql;
    }
}
