<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Party;
use App\Models\GstBill;
use Illuminate\Support\Facades\DB;

class GstBillController extends Controller
{
    public function index()
    {
        $bills = GstBill::where('is_deleted', 0)->with('party')->orderBy('id', 'desc')->get();
        return view("gst-bill.index", compact('bills'));
    }

public function addGstBill()
{
    // Fetch all parties ordered by id ascending
    $data['parties'] = Party::orderBy('id', 'asc')->get();

    // Generate next invoice number
    $lastInvoice = GstBill::orderBy('id', 'desc')->first();
    $nextNumber = $lastInvoice ? $lastInvoice->id + 1 : 1;
    $data['invoice_no'] = 'INV-' . str_pad($nextNumber, 5, '0', STR_PAD_LEFT);

    return view('gst-bill.add', $data);
}


    //create GstBill
        public function createGstBill(Request $request)
    {
        // Valildation
        $request->validate([
            'party_id' => 'required|exists:parties,id',
            'invoice_date' => 'required|date',
            'invoice_no' => 'required|string|max:255',
            'item_description' => 'required|max:250',
            'total_amount' => 'required|numeric',
            'cgst_rate' => 'nullable|min:0|max:100',
            'cgst_amount' => 'numeric|min:0',
            'sgst_rate' => 'nullable|min:0|max:100',
            'sgst_amount' => 'numeric|min:0',
            'igst_rate' => 'nullable|min:0|max:100',
            'igst_amount' => 'numeric|min:0',
            'tax_amount' => 'numeric|min:0',
            'net_amount' => 'required|numeric|min:0',
        ]);

        $param = $request->all();

        // Remove token from post data before inserting
        unset($param['_token']);
        $bill = GstBill::create($param);

        // Redirect to manage bills
        return redirect()->route('print-gst-bill', $bill->id)->withStatus("Bill created successfully");
    }

public function print($id, $currency = null)
{
    $bill = GstBill::with('party')->findOrFail($id);

    $cgstRate = $bill->cgst_rate ?? 0;
    $sgstRate = $bill->sgst_rate ?? 0;
    $igstRate = $bill->igst_rate ?? 0;

    $bill->cgst_amount = $bill->total_amount * ($cgstRate / 100);
    $bill->sgst_amount = $bill->total_amount * ($sgstRate / 100);
    $bill->igst_amount = $bill->total_amount * ($igstRate / 100);

    $bill->tax_amount = $bill->cgst_amount + $bill->sgst_amount + $bill->igst_amount;
    $bill->net_amount = $bill->total_amount + $bill->tax_amount;

    return view("gst-bill.print", [
        'currency' => $currency ?? 'bdt',
        'bill' => $bill,
    ]);
}



}
