<?php
namespace App\Http\Controllers;

class PageController extends Controller
{
    public function dashboard() {
        return view('dashboard');
    }

    public function customers() {
        return view('customers.index');
    }

    public function invoices() {
        return view('invoices.index');
    }
}