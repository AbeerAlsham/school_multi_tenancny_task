<?php

namespace App\Services\V1;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Subject;
use App\Models\User;

class CartService
{
    public function getCart(User $student)
    {

        $cart = Cart::firstOrCreate(
            ['student_id' => $student->id],
        );

        return $cart->load('items.subject');
    }

    public function addItem(User $student, int $subjectId, int $quantity = 1)
    {
        $cart = $student->cart()->firstOrCreate();

        if (! Subject::find($subjectId)) {
            throw new \Exception('Subject not found.');
        }

        $item = $cart->items()->Create(
            ['subject_id' => $subjectId],
            ['quantity' =>  $quantity]
        );

        return $cart->load('items.subject');
    }

    public function updateItem(User $student, int $quantity, $cart_item)
    {
        $cart = $this->getCart($student);

        $item = $cart->items()->findOrFail($cart_item->id);
        //  $newQuantity = $item->quantity + $data['quantity'];

        if ($quantity <= 0) {
            $item->delete();
        } else {
            $item->update(['quantity' => $quantity]);
        }
        return  $cart->load('items.subject');
    }

    public function removeItem(User $student,  CartItem $item)
    {
        $cart = $this->getCart($student);

        $cart->items()->where('id', $item->id)->delete();
        
    }
}
