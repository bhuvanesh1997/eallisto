<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Invoice;

class DataController extends Controller
{
    public function index() {
        return response()->json([
            'customers' => Customer::all(),
            'invoices' => Invoice::with('customer')->get()
        ]);
    }

    public function save(Request $request) {
        if ($request->type === 'customer') {
            $data = $request->validate([
                'id' => 'nullable|exists:customers,id',
                'name' => 'required',
                'phone' => 'nullable',
                'email' => 'nullable|email',
                'address' => 'nullable'
            ]);

            $customer = Customer::updateOrCreate(['id' => $data['id'] ?? null], $data);
            return response()->json(['customer' => $customer]);

        } elseif ($request->type === 'invoice') {
            $data = $request->validate([
                'id' => 'nullable|exists:invoices,id',
                'customer_id' => 'required|exists:customers,id',
                'date' => 'required|date',
                'amount' => 'required|numeric',
                'status' => 'required|in:Unpaid,Paid,Cancelled'
            ]);

            $invoice = Invoice::updateOrCreate(['id' => $data['id'] ?? null], $data);
            return response()->json(['invoice' => $invoice]);
        }
    }
}