<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    //
    protected $table = 'orders';

    public function generateInvoice()
    {
        $sql = DB::table('orders')->max('no_invoice');
        $last_char = substr($sql, -1);
        $char = 'BS-';
        $date = Carbon::now()->toDateString();
        $dateNow = Carbon::now()->toDateString();
        if ($dateNow) {
            // $last_char = 0;
            $last_char++;
            $result = $char . $date . "-" . $last_char;
            return $result;
        } else {
            return false;
        }
    }
}
