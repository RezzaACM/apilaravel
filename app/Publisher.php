<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Publisher extends Model
{
    //
    protected $table = 'publishers';

    public function _getPublisher()
    {
        $sql = DB::select('SELECT * FROM publishers');
        return $sql;
    }

    public function _getPublisherId($id)
    {
        $sql = DB::select('SELECT a.id, a.name, a.address, a.phone_number FROM publishers a
        WHERE a.id =' . $id);
        return $sql;
    }
}
