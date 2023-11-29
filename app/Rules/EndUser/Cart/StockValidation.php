<?php

namespace App\Rules\EndUser\Cart;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Contracts\Validation\Rule;

class StockValidation implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $product = Product::where([ ['id',request('product_id')], ['stock', '>=', $value] ])->first();
        if ($product) {
            $cart = Cart::where([ ['client_id',auth('client_api')->user()->id], ['product_id',$product->id] ])->first();

            if ($cart) {
                if (($cart->count + $value) <= $product->stock) {
                    return true;
                }
                return false;
            }
            return true;
        }
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Sorry The Count Of Product You Want Not Available';
    }
}
