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

use Illuminate\Support\Facades\Auth;
use App\Models\Customer;

#[Title('Store Profile | Urbnly')]
class StoreProfilePage extends Component
{

    public $isAuthenticated;
    public $user;

    public function mount(){

        $this->isAuthenticated = session()->has('login_customers_59ba36addc2b2f9401580f014c7f58ea4e30989d');
        if ($this->isAuthenticated) {
            // Get the User from the session stored in browser
            $userId = session()->get('login_customers_59ba36addc2b2f9401580f014c7f58ea4e30989d');
            // Find the current User ID in the database, and transfer in variable
            $this->user = Customer::find($userId);

        }
    }

    public function render()
    {
        return view('livewire.store-profile-page');
    }
}
