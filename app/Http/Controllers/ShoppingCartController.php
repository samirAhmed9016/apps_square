<?php

namespace App\Http\Controllers;

use App\Interfaces\ShoppingCartRepositoryInterface;
use App\Models\ShoppingCart;
use App\Transformers\ShoppingCartTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ShoppingCartController extends Controller
{
    protected $shoppingCartRepository;

    public function __construct(ShoppingCartRepositoryInterface $shoppingCartRepository)
    {
        $this->shoppingCartRepository = $shoppingCartRepository;
    }

    public function index()
    {
        $cartItems = $this->shoppingCartRepository->getUserCart(Auth::id());
        return fractal()
            ->item($cartItems)
            ->transformWith([ShoppingCartTransformer::class, 'transformCollection'])
            ->respond();
        // return fractal($cartItems, new ShoppingCartTransformer())->respond();
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $this->shoppingCartRepository->addToCart(Auth::id(), $request->product_id, $request->quantity);
        return response()->json(['message' => 'Product added to cart']);
    }

    public function update(Request $request, $id)
    {
        $request->validate(['quantity' => 'required|integer|min:1']);
        $this->shoppingCartRepository->updateCartItem(Auth::id(), $id, $request->quantity);
        return response()->json(['message' => 'Cart item updated']);
    }

    public function destroy($id)
    {
        $this->shoppingCartRepository->removeFromCart(Auth::id(), $id);
        return response()->json(['message' => 'Product removed from cart']);
    }
}
