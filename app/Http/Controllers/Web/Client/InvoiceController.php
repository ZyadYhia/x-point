<?php

namespace App\Http\Controllers\Web\Client;

use App\Models\User;
use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\InvoiceDetail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class InvoiceController extends Controller
{
    public function index()
    {
        $data['invoices_holding'] = Invoice::where('status', 'holding')->orderBy('created_at', 'DESC')->get();
        $data['invoices_paid'] = Invoice::where('status', 'paid')->orderBy('created_at', 'DESC')->get();
        $data['invoices_unpaid'] = Invoice::where('status', 'unpaid')->orderBy('created_at', 'DESC')->get();
        return view('dashboard.invoice.index')->with($data);
    }
    public function showUser($id)
    {
        $invoice = Invoice::where('id', $id)->first();
        $user = $invoice->user;
        return;
    }
    static public function store($user_id, $room, $cost)
    {
        $invoice = Invoice::create([
            'name' => $room->name,
            'user_id' => $user_id,
        ]);
        InvoiceDetail::create([
            'invoice_id' => $invoice->id,
            'room_id' => $room->id,
            'cost' => $cost,
        ]);
    }
    static public function show(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            // 'email' => 'nullable|exists:users,email',
            'room' => 'required|exists:rooms,name'
        ]);
        if ($validator->failed()) {
            return back();
        }
        if ($request->username) {
            $user = User::where('user_name', $request->username)->first();
        } else if ($request->email) {
            $user = User::where('user_name', $request->username)->first();
        }
        if (!$user) {
            Session::flash('error', 'User Not Found');
            return back();
        }
        if (!Hash::check($request->password, $user->password)) {
            Session::flash('error', 'Password Incorrect');
            return back();
        }
        dd($user->rooms()->first());
        return;
    }
    public function pay($id)
    {
        $invoice = Invoice::where('id', $id)->first();
        $invoice->status = 'paid';
        $invoice->save();
        Session::flash('msg', 'Invoice Paied Successfuly');
        return back();
    }
    public function unpaid($id)
    {
        $invoice = Invoice::where('id', $id)->first();
        $invoice->status = 'unpaid';
        $invoice->save();
        Session::flash('msg', 'Invoice Paied Successfuly');
        return back();
    }
}
