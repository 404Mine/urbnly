<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use App\Models\Store;
use App\Models\Category;
use App\Models\Sex;
use App\Models\BodyType;
use App\Models\Product;

use App\Helpers\CartManagement;
use Jantinnerezo\LivewireAlert\LivewireAlert;

use Illuminate\Support\Facades\Auth;
use App\Models\Customer;

use Illuminate\Support\Facades\Redirect;

#[Title('Store | Urbnly')]
class Storepage extends Component
{

    use LivewireAlert;

    #[Url]
    public $selected_categories = [];

    #[Url]
    public $selected_sexes = [];

    #[Url]
    public $selected_bodytypes = [];

    public $quantity = 1;

    public function increaseQty() {
        $this->quantity++;
    }

    public function decreaseQty() {
        if($this->quantity > 1) {
            $this->quantity--;
        }
    }

    public $isAuthenticated;
    public $user;

    public function mount(){

        $this->isAuthenticated = session()->has('login_customers_59ba36addc2b2f9401580f014c7f58ea4e30989d');
        if ($this->isAuthenticated) {
            $userId = session()->get('login_customers_59ba36addc2b2f9401580f014c7f58ea4e30989d'); // Assuming user ID is stored in session
            $this->user = Customer::find($userId); // Assuming user information is stored in the database
        }
    }

    public function addToCart($product_id) {
        $total_count = CartManagement::addItemToCartWithQty($product_id, $this->quantity);

        $this->alert('success', 'Product Added To Cart Successfully!', [
            'background' => 'black',
            'color' => 'white',
            'position' => 'bottom-end',
            'timer' => 3000,
            'toast' => true,
        ]);
    }

    
    
    public function render()
    {

        $productQuery = Product::query()->where('is_active', 1);
        if(!empty($this->selected_categories)) {
            $productQuery->whereIn('category_id', $this->selected_categories);
        }
        if(!empty($this->selected_sexes)) {
            $productQuery->whereIn('sex_id', $this->selected_sexes);
        }
        if(!empty($this->selected_bodytypes)) {
            $productQuery->whereIn('bodytype_id', $this->selected_bodytypes);
        }
        

        /**
         * This is to fetch the active stores
         */
        $store = Store::where('is_active', 1)->get();
        $category = Category::where('is_active', 1)->get();
        $sex = Sex::where('is_active', 1)->get();
        $bodytype = BodyType::where('is_active', 1)->get();
        $product = $productQuery->get();
        return view('livewire.storepage', [
            'store' => $store,
            'category' => $category,
            'sex' => $sex,
            'bodytype' => $bodytype,
            'product' => $product,
        ]);

    }
}
