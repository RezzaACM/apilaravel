<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ResetPassword extends Model
{
    //
    protected $table = 'password_resets';

    public function check_token($token)
    {
        $sql = DB::select('SELECT * FROM password_resets WHERE token =' . "\"$token\"");

        if (count($sql) > 0) {
            return $sql;
        } else {
            return false;
        }
    }
}
