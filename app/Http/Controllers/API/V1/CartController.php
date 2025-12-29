<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddItemRequest;
use App\Http\Requests\UpdateQuantityItemRequest;
use App\Models\CartItem;
use App\Services\V1\CartService;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    protected  $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index()
    {
        Gate::authorize('viewAny', CartItem::class);
        $cart = $this->cartService->getCart(Auth::user());
        return $this->okResponse($cart, 'Cart retrieved successfully');
    }

    public function store(AddItemRequest $request)
    {
        Gate::authorize('create', CartItem::class);
        $cart = $this->cartService->addItem(Auth::user(), $request->subject_id, $request->quantity);
        return $this->createdResponse($cart, 'Item added to cart successfully');
    }

    public function update(UpdateQuantityItemRequest $request, CartItem $cart_item)
    {
        Gate::authorize('update', $cart_item);
        $cart = $this->cartService->updateItem(Auth::user(), $request->quantity, $cart_item);
        return $this->okResponse($cart, 'Item updated in cart successfully');
    }

    public function destroy(CartItem $item)
    {
        Gate::authorize('delete', $item);
        $this->cartService->removeItem(Auth::user(), $item);
        return $this->noContentResponse();
    }
}
