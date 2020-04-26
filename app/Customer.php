<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class Customer extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    //
    protected $table = 'customers';

    // check token valid
    public function check_token($token)
    {
        $sql = DB::select('SELECT * FROM customers WHERE remember_token =' . "\"$token\"");

        if (count($sql) > 0) {
            return $sql;
        } else {
            return false;
        }
    }

    // check email is not dupilicate
    public function checkEmail($email)
    {
        $sql = DB::select('SELECT * FROM customers WHERE email =' . "\"$email\"");

        if (count($sql) > 0) {
            return false;
        } else {
            return true;
        }
    }

    // auth login customer
    public function checkLogin($email, $password)
    {
        $sql = DB::select('SELECT a.* FROM customers a WHERE a.email =' . "\"$email\"" . 'AND password =' . "\"$password\"" . 'AND email_verified_at IS NOT NULL');

        if (count($sql) > 0) {
            return $sql;
        } else {
            return false;
        }
    }
}
