<?php

namespace App\Http\Livewire;
use App\Models\HomeSlider;
use Livewire\Component;

use App\Models\Product;
use App\Models\HomeCategory;
use App\Models\Category;
use App\Models\Sale;
use Illuminate\Support\Facades\Auth;
use Cart;
class HomeComponent extends Component
{
    public function render()
    {
        $slider = HomeSlider::where('status',1)->get();
        $lproducts = Product::orderBy('created_at', 'DESC')->get()->take(8);
        $category = HomeCategory::find(1);
        $cats = explode(',',$category->sel_categories);
        $categories = Category::wherein('id', $cats)->get();
        $no_of_products = $category->no_of_products;
        $sproducts = Product::where('sale_price','>',0)->inRandomOrder()->get()->take(8);
        $sale = Sale::find(1);
        if(Auth::check())
        {
            Cart::instance('cart')->restore(Auth::user()->email);
            Cart::instance('wishlist')->restore(Auth::user()->email);
        }
        return view('livewire.home-component',['slider'=>$slider,'lproducts'=>$lproducts,'categories'=>$categories,'no_of_products'=>$no_of_products, 'sproducts'=>$sproducts, 'sale'=>$sale])->layout("layouts.base");
        
    }
   
}
