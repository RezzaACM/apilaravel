<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    //

    public function __construct(Order $order, OrderDetail $orderDetail)
    {
        $this->order = $order;
        $this->order_detail = $orderDetail;
    }

    public function transaction(Request $request)
    {
        $genInvoice = $this->order->generateInvoice();
        // dump($genInvoice);
        $transaction = $this->order;
        $transaction->no_invoice = $genInvoice;
        $transaction->customer_id = $request->get('customer_id');
        $transaction->discount = $request->get('discount');
        $transaction->total_price = $request->get('total_price');
        $transaction->user_id = $request->get('user_id');

        $trx_detail = array();
        $book_id = $request->get('book_id');
        $amount = $request->get('order_amount');
        $sub_total = $request->get('sub_total');
        $trx_detail['transaction_detail'] = $request->get('transaction_detail');

        $amount = 0;
        foreach ($trx_detail['transaction_detail'] as $row) {
            $transaction_detail = $this->order_detail;
            $transaction_detail->no_invoice = $genInvoice;
            $transaction_detail->book_id = $row['book_id'];
            $transaction_detail->order_amount = $row['order_amount'];
            $transaction_detail->sub_total = $row['sub_total'];

            $sub_total += $transaction_detail->sub_total * $transaction_detail->order_amount;
            $sql =  DB::table('orders_details')->insert(
                array(
                    'no_invoice' => $transaction_detail->no_invoice,
                    'book_id' => $transaction_detail->book_id,
                    'order_amount' =>  $transaction_detail->order_amount,
                    'sub_total' => $sub_total,
                    'created_at' => Carbon::now()->toDateTimeString(),
                    'updated_at' => Carbon::now()->toDateTimeString(),
                )
            );
        }



        // $transaction_detail = array();
        // $transaction_detail = $this->order_detail;
        // $transaction_detail->no_invoice = $genInvoice;
        // $transaction_detail->book_id = $request->get('book_id');
        // $transaction_detail->order_amount = $request->get('order_amount');
        // $transaction_detail->sub_total = $request->get('sub_total');

        if ($transaction->save()) {
            $res['status'] = true;
            $res['message'] = 'Success! New Customer Has Been Created';
            $res['transaction_detail'] = $transaction;
            return response($res, 200);
        }
    }
}
