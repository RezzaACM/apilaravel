<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class LoginModel extends Model
{
    //

    protected $table = 'users';

    public function check_login($email, $pass){
        $sql = DB::select('
            SELECT * FROM users WHERE email = '."\"$email\"".' AND password ='."\"$pass\"");

        if(count($sql)>0){
            return $sql;
        }else{
            return false;
        }
    }
    
}
