<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseItems;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        $purchaseItems = PurchaseItems::join('products', 'purchase_items.product_id', '=', 'products.id')
            ->join('purchases', 'purchase_items.purchase_id', '=', 'purchases.id')
            ->join('suppliers', 'purchases.supplier_id', '=', 'suppliers.id')
            ->select(
                'purchase_items.*',
                'purchase_items.quantity as itemQuantity',
                'products.*',
                'suppliers.*',
                'purchases.purchase_date',
                'purchases.status'
            )->get();

        // $purchases = Purchase::join('suppliers', 'purchases.supplier_id', '=', 'suppliers.id')
        // ->join('purchase_items', 'purchases.id', '=', 'purchase_items.purchase_id')
        // ->join('products', 'products.id', '=', 'purchase_items.product_id')
        // ->select('purchases.*', 'suppliers.company_name as companyName', 'products.product_type as productType')->get();

        $purchases = Purchase::join('suppliers', 'purchases.supplier_id', '=', 'suppliers.id')
            ->join('purchase_items', 'purchases.id', '=', 'purchase_items.purchase_id')
            ->join('products', 'products.id', '=', 'purchase_items.product_id')
            ->select(
                'purchases.id',
                'purchases.purchase_date',
                'suppliers.company_name as companyName',
                'purchases.total_price',
                'purchases.tax',
                'purchases.grand_total',
                'purchases.status',

                DB::raw('GROUP_CONCAT(DISTINCT products.product_type) as productTypes')
            )
            ->groupBy(
                'purchases.id',
                'purchases.purchase_date',
                'suppliers.company_name',
                'purchases.total_price',
                'purchases.tax',
                'purchases.grand_total',
                'purchases.status'
            )
            ->get();

        return view('purchasing_pages.purchase', compact('purchaseItems', 'purchases'));
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
        ]);

        // Check if TIN number already exists
        $existingSupplier = Supplier::where('tin_no', $request->tinNo)->first();

        if ($existingSupplier) {
            return redirect()->back()
                ->with('error', 'Company already registered with this TIN number.');
        }

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
        // Step 1: Create purchase (header)
        $purchase = Purchase::create([
            'supplier_id' => $request->supplier,
            'user_id' => Auth::id(),
            'total_price' => $request->totalPrice,
            'tax' => $request->tax,
            'grand_total' => $request->grandTotal,
            'purchase_date' => $request->purchaseDate,
            'status' => 'pending',
        ]);

        // Step 2: Save items
        foreach ($request->product as $index => $productId) {

            $qty = $request->quantity[$index];
            $price = $request->unitPrice[$index];

            PurchaseItems::create([
                'purchase_id' => $purchase->id,
                'product_id' => $productId,
                'quantity' => $qty,
                'unit_price' => $price,
                'total_price' => $qty * $price,
            ]);
        }
        return redirect()->to('/purchasing/purchase')->with('success', 'Purchase saved successfully!');
    }

    public function editPurchaseView($id)
    {
        $purchase = Purchase::findOrFail($id);
        $purchaseItems = PurchaseItems::with('product')
            ->where('purchase_id', $id)
            ->get();

        $suppliers = Supplier::where('status', 'active')->get();
        $products = Product::where('status', 'active')->get();

        return view('purchasing_pages.editPurchase', compact('purchase', 'purchaseItems', 'suppliers', 'products'));
    }

    public function updatePurchase(Request $request, $id)
    {
        $purchase = Purchase::findOrFail($id);

        // Store old status before update
        $oldStatus = $purchase->status;

        // Step 1: Update purchase header
        $purchase->update([
            'supplier_id'   => $request->supplier,
            'user_id'       => Auth::id(),
            'total_price'   => $request->totalPrice,
            'tax'           => $request->tax,
            'grand_total'   => $request->grandTotal,
            'purchase_date' => $request->purchaseDate,
            'status'        => $request->status,
        ]);

        // Step 2: Delete old items and re-insert updated ones
        PurchaseItems::where('purchase_id', $id)->delete();

        foreach ($request->product as $index => $productId) {
            $qty   = $request->quantity[$index];
            $price = $request->unitPrice[$index];

            PurchaseItems::create([
                'purchase_id' => $id,
                'product_id'  => $productId,
                'quantity'    => $qty,
                'unit_price'  => $price,
                'total_price' => $qty * $price,
            ]);
        }

        // Step 3: Update product stock if status changed to 'stocked'
        if ($oldStatus !== 'stocked' && $request->status === 'stocked') {
            foreach ($request->product as $index => $productId) {
                $product = Product::find($productId);

                if ($product) {
                    $product->quantity += $request->quantity[$index];
                    $product->save();
                }
            }
        }

        return redirect()->to('/purchasing/purchase')->with('success', 'Purchase updated successfully!');
    }


    public function getPurchaseDetails($id)
    {
        // Purchase + Supplier
        $purchase = DB::table('purchases')
            ->join('suppliers', 'purchases.supplier_id', '=', 'suppliers.id')
            ->select(
                'purchases.*',
                'suppliers.company_name',
                'suppliers.trade_type',
                'suppliers.email',
                'suppliers.phone',
                'suppliers.country',
                'suppliers.city',
                'suppliers.address',
                'suppliers.tin_no'
            )
            ->where('purchases.id', $id)
            ->first();

        // Items
        $items = DB::table('purchase_items')
            ->join('products', 'purchase_items.product_id', '=', 'products.id')
            ->select(
                'products.product_type',
                'products.product_name',
                'products.product_brand',
                'purchase_items.quantity',
                'purchase_items.unit_price',
                'purchase_items.total_price'
            )
            ->where('purchase_items.purchase_id', $id)
            ->get();

        return response()->json([
            'purchase' => $purchase,
            'items' => $items
        ]);
    }
}
