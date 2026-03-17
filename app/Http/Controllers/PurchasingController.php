<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $products = Product::latest()->get();
        return view('purchasing_pages.product', compact('products'));
    }
    public function viewPurchase()
    {
        // $purchases = Purchase::all();
        $purchases = Purchase::join('suppliers', 'purchases.supplier_id', '=', 'suppliers.id')
            ->join('products', 'purchases.product_id', '=', 'products.id')
            ->select('purchases.*', 'suppliers.company_name as supplierName', 'products.product_name as productName')
            ->latest()
            ->get();

        return view('purchasing_pages.purchase', compact('purchases'));
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

    public function viewAddProduct()
    {
        return view('purchasing_pages.addProduct');
    }

    public function addProduct(Request $request)
    {
        Product::create([
            'product_type' => $request->productType,
            'product_name' => $request->productName,
            'product_brand' => $request->productBrand,
            'product_code' => $request->productCode,
            'unit' => $request->unit,
        ]);

        return redirect()->to('/purchasing/product')->with('success', 'Product saved successfully!');
    }

    public function viewAddPurchase()
    {
        $suppliers = Supplier::where('status', 'active')->get();
        $products = Product::where('status', 'active')->get();

        return view('purchasing_pages.addPurchase', compact('suppliers', 'products'));
    }

    public function addPurchase(Request $request)
    {
        Purchase::create([
            'supplier_id' => $request->supplier,
            'product_id' => $request->product,
            'user_id' => Auth::id(),
            'quantity' => $request->quantity,
            'unit_price' => $request->unitPrice,
            'total_price' => $request->totalPrice,
            'tax_percent' => $request->taxtPercent,
            'tax' => $request->tax,
            'grand_total' => $request->grandTotal,
            'purchase_date' => $request->purchaseDate,
            'status' => 'pending',
        ]);

        return redirect()->to('/purchasing/purchase')->with('success', 'Purchase saved successfully!');
    }

    public function editPurchaseView($id)
    {
        $purchase = Purchase::join('suppliers', 'purchases.supplier_id', '=', 'suppliers.id')
            ->join('products', 'purchases.product_id', '=', 'products.id')
            ->select('purchases.*', 'suppliers.company_name as supplierName', 'products.product_name as productName', 'suppliers.id as supplierID', 'products.id as productID')->find($id);

        $suppliers = Supplier::where('status', 'active')->get();
        $products = Product::where('status', 'active')->get();

        return view('purchasing_pages.editPurchase', compact('purchase', 'suppliers', 'products'));
    }

    public function updatePurchase(Request $request, $id)
    {
        $purchase = Purchase::find($id);
        if (!$purchase) {
            return redirect()->back()->with('error', 'Purchase not found!');
        }

        // Store old status before update
        $oldStatus = $purchase->status;

        $purchase->update([
            'supplier_id' => $request->supplier,
            'product_id' => $request->product,
            'quantity' => $request->quantity,
            'unit_price' => $request->unitPrice,
            'total_price' => $request->totalPrice,
            'tax_percent' => $request->taxtPercent,
            'tax' => $request->tax,
            'grand_total' => $request->grandTotal,
            'purchase_date' => $request->purchaseDate,
            'status' => $request->status,
        ]);

        if ($oldStatus !== 'stocked' && $request->status === 'stocked') {

            $product = Product::find($request->product);

            if ($product) {
                $product->quantity += $request->quantity;
                $product->save();
            }
        }

        return redirect()->to('/purchasing/purchase')->with('success', 'Purchase updated successfully!');
    }
}
