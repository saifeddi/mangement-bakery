<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ProductHasPrice implements ValidationRule
{
    protected array $productIds;
    protected array $prices;

    public function __construct(array $productIds = [], array $prices = [])
    {
        $this->productIds = $productIds;
        $this->prices = $prices;
    }

    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed   $value
     * @param  \Closure(string, string): void  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        foreach ($this->productIds as $productId) {
            if (
                !isset($this->prices[$productId]) ||
                !is_numeric($this->prices[$productId]) ||
                $this->prices[$productId] <= 0
            ) {
                $fail("يجب إدخال سعر صالح لكل منتج محدد (المنتج رقم $productId).");
                return;
            }
        }
    }
}
