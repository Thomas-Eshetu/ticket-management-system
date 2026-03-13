<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\User;
use Illuminate\Http\Request;

class PurchasingController extends Controller
{
    public function viewPurchaser()
    {
        $users = User::where('role', 'purchaser')->get();

        return view('purchasing_pages.purchaser', compact('users'));
    }

    public function viewSupplier()
    {
        $suppliers = Supplier::latest()->get();

        return view('purchasing_pages.supplier',  compact('suppliers'));
    }
    public function viewProduct()
    {
        return view('purchasing_pages.product');
    }
    public function viewPurchase()
    {
        return view('purchasing_pages.purchase');
    }

    public function viewAddSupplier()
    {

        return view("purchasing_pages.addSupplier");
    }

    public function addSupplier(Request $request)
    {
        //validate data
        $request->validate([
            'email'  => 'required|email|unique:suppliers,email',
            'phone'  => 'required|string|max:20|unique:suppliers,phone',
            'tinNo' => 'required|unique:suppliers,tin_no',
        ]);

        Supplier::create([
            'company_name' => $request->companyName,
            'trade_type' => $request->tradeType,
            'email' => $request->email,
            'phone' => $request->phone,
            'country' => $request->country,
            'city' => $request->city,
            'address' => $request->address,
            'tin_no' => $request->tinNo,
        ]);

        return redirect()->to('/purchasing/supplier')->with('success', 'Supplier saved successfully!');
    }
}
