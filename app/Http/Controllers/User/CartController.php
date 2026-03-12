<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
// app/Http/Controllers/User/CartController.php

// app/Http/Controllers/User/CartController.php
public function show(Request $request)
{
        $links = [
        [
            'title' => 'Home',
            'url' => route('home')
        ],
        [
            'title' => 'Keranjang Belanja',
            'url' => '' // kosong karena ini halaman aktif
        ]
    ];
    $cart = $request->user()->cart()->with('items.product')->first();
    
    // Jika cart kosong atau tidak ada
    if (!$cart || $cart->items->isEmpty()) {
        return view('user.cart.show', [
            'cart' => [],
            'subtotal' => 0,
            'ppn' => 0,
            'total' => 0,
            'links' => $links
        ]);
    }
    
    // Hitung total
    $subtotal = 0;
    foreach ($cart->items as $item) {
        $subtotal += $item->product->price * $item->quantity;
    }
    
    $ppn = $subtotal * 0.12;
    $total = $subtotal + $ppn;
    
    return view('user.cart.show', compact('cart', 'subtotal', 'ppn', 'total', 'links'));
}

public function add(Request $request, Product $product)
{
    $request->validate([
        'quantity' => 'required|integer|min:1'
    ]);

        if ($request->quantity > $product->stock) {
   return response()->json([
    'success' => false,
    'message' => 'Stock tidak mencukupi.'
], 422);
    }

    $cart = $request->user()->cart()->firstOrCreate([]);

    $item = $cart->items()->where('product_id', $product->id)->first();

    if ($item) {

        $newQty = $item->quantity + $request->quantity;

        if ($newQty > $product->stock) {
         return response()->json([
    'success' => false,
    'message' => 'Stock tidak mencukupi.'
], 422);
        }

        $item->update(['quantity' => $newQty]);

    } else {

        $cart->items()->create([
            'product_id' => $product->id,
            'quantity' => $request->quantity
        ]);
    }

return response()->json([
    'success' => true,
    'message' => 'Produk ditambahkan ke keranjang.'
]);
}

// app/Http/Controllers/User/CartController.php

public function remove(Request $request, $id)
{
    $user = $request->user();
    $cart = $user->cart()->first();
    
    if (!$cart) {
        return response()->json(['success' => false, 'message' => 'Cart tidak ditemukan'], 404);
    }
    
    // Cari item berdasarkan product_id
    $item = $cart->items()->where('product_id', $id)->first();
    
    if (!$item) {
        return response()->json(['success' => false, 'message' => 'Item tidak ditemukan'], 404);
    }
    
    $item->delete();

    // Hitung ulang total setelah penghapusan
    $cart = $user->cart()->with('items.product')->first();
    $subtotal = 0;
    foreach ($cart->items as $cartItem) {
        $subtotal += $cartItem->product->price * $cartItem->quantity;
    }
    $ppn = $subtotal * 0.12;
    $total = $subtotal + $ppn;
    
    return response()->json([
        'success' => true,
        'subtotal' => $subtotal,
        'ppn' => $ppn,
        'total' => $total,
        'cart_empty' => $cart->items->isEmpty()
    ]);
}

    public function checkout(Request $request)
    {
        $cart = $request->user()->cart()->with('items.product')->first();

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.show');
        }

        $message = "Halo Admin, saya ingin memesan:\n\n";

        $total = 0;

        foreach ($cart->items as $item) {
            $subtotal = $item->product->price * $item->quantity;
            $total += $subtotal;

            $message .= "- {$item->product->name} ({$item->quantity} pcs) = Rp " . number_format($subtotal, 0, ',', '.') . "\n";
        }

        $message .= "\nTotal: Rp " . number_format($total, 0, ',', '.');

        $phone = "6281110058788"; 

        return redirect("https://wa.me/{$phone}?text=" . urlencode($message));
    }

  // app/Http/Controllers/User/CartController.php

// app/Http/Controllers/User/CartController.php

public function update(Request $request, $id)
{
    // CARI CART ITEM BERDASARKAN PRODUCT ID UNTUK USER YANG LOGIN
    $user = $request->user();
    $cart = $user->cart()->first();
    
    if (!$cart) {
        return response()->json(['message' => 'Cart tidak ditemukan'], 404);
    }
    
    // Cari item di cart berdasarkan product_id
    $item = $cart->items()->where('product_id', $id)->first();
    
    if (!$item) {
        return response()->json(['message' => 'Item tidak ditemukan di cart'], 404);
    }
    
    $product = $item->product;
    $newQty = $request->quantity;

    // Validasi stock
    if ($newQty > $product->stock) {
        return response()->json([
            'message' => 'Stock tidak mencukupi. Stock tersedia: ' . $product->stock
        ], 422);
    }

    if ($newQty < 1) {
        // Hapus item jika quantity < 1
        $item->delete();
        
        // Hitung ulang total setelah penghapusan
        $cart = $user->cart()->with('items.product')->first();
        $subtotal = 0;
        foreach ($cart->items as $cartItem) {
            $subtotal += $cartItem->product->price * $cartItem->quantity;
        }
        $ppn = $subtotal * 0.12;
        $total = $subtotal + $ppn;
        
        return response()->json([
            'removed' => true,
            'subtotal' => $subtotal,
            'ppn' => $ppn,
            'total' => $total,
            'cart_empty' => $cart->items->isEmpty()
        ]);
    }

    // Update quantity
    $item->update(['quantity' => $newQty]);

    // Hitung ulang semua total
    $cart = $user->cart()->with('items.product')->first();
    $subtotal = 0;
    foreach ($cart->items as $cartItem) {
        $subtotal += $cartItem->product->price * $cartItem->quantity;
    }
    
    $ppn = $subtotal * 0.12;
    $total = $subtotal + $ppn;

    return response()->json([
        'success' => true,
        'itemSubtotal' => $product->price * $newQty,
        'itemName' => $product->name,
        'itemQty' => $newQty,
        'subtotal' => $subtotal,
        'ppn' => $ppn,
        'total' => $total,
        'cart_empty' => $cart->items->isEmpty()
    ]);
}
}