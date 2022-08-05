<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\InvoiceDetail;
use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function index()
    {
        $roomType = RoomType::where('name', 'Room PS')->first();
        $openType = RoomType::where('name', 'Open PS')->first();
        $airType = RoomType::where('name', 'Air Hocky')->first();
        $billiardType = RoomType::where('name', 'Billiard')->first();
        $rooms = Room::where('room_type_id', $roomType->id)->get();
        $opens = Room::where('room_type_id', $openType->id)->get();
        $airs = Room::where('room_type_id', $airType->id)->get();
        $billiards = Room::where('room_type_id', $billiardType->id)->get();
        $data['room_cost'] = 0;
        $data['open_cost'] = 0;
        $data['air_cost'] = 0;
        $data['billiard_cost'] = 0;
        foreach ($rooms as $room) {
            $invoices = InvoiceDetail::with('invoice')->where('status', 'paid')->where('room_id', $room->id)->get();
            foreach ($invoices as $invoice) {
                $data['room_cost'] += $invoice->cost;
            }
        }
        foreach ($opens as $open) {
            $invoices_open = InvoiceDetail::where('room_id', $open->id)->get();
            foreach ($invoices_open as $invoice_open) {
                $data['open_cost'] += $invoice_open->cost;
            }
        }
        foreach ($airs as $air) {
            $invoices_air = InvoiceDetail::where('room_id', $air->id)->get();
            foreach ($invoices_air as $invoice_air) {
                $data['air_cost'] += $invoice_air->cost;
            }
        }
        foreach ($billiards as $billiard) {
            $invoices_billiard = InvoiceDetail::where('room_id', $billiard->id)->get();
            foreach ($invoices_billiard as $invoice_billiard) {
                $data['billiard_cost'] += $invoice_billiard->cost;
            }
        }
        return view('dashboard.Admin.reports.index')->with($data);
    }
}
