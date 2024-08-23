<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Auth;

use App\Helpers\CartManagement;
use App\Models\Order;
use App\Models\Address;
use App\Models\Customer;

use Illuminate\Support\Facades\Redirect;

#[Title('Checkout | Urbnly')]
class CheckOut extends Component
{

    public $isAuthenticated;
    public $user;

    public $first_name;
    public $last_name;
    public $phone;
    public $street_address;
    public $city;
    public $payment_method = null;
    public $shipping_method = null;

    public function mount(){
        $this->payment_method = 'place_holder';
        $this->shipping_method = 'place_holder';

        $this->isAuthenticated = session()->has('login_customers_59ba36addc2b2f9401580f014c7f58ea4e30989d');
        if ($this->isAuthenticated) {
            $userId = session()->get('login_customers_59ba36addc2b2f9401580f014c7f58ea4e30989d'); // Assuming user ID is stored in session
            $this->user = Customer::find($userId); // Assuming user information is stored in the database
        }
    }

    public function placeOrder(){

        if(!$this->user) {
            return redirect('/Error');
        }

        $this->validate([
            'payment_method' => 'required',
            'shipping_method' => 'required'
        ]);

        $cart_items = CartManagement::getCartItemsFromCookie();

        $line_items = [];

        foreach($cart_items as $item) {
            $line_items = [
                'price_data' => [
                    'currency' => 'php',
                    'unit_amount' => $item['unit_amount'] * 100,
                    'product_data' => [
                        'name' => $item['name'],
                    ]
                ],
                'quantity' => $item['quantity'],
            ];
        }

        $order = new Order();
        $order->customer_id = $this->user->id;
        $order->grand_total = CartManagement::calculateGrandTotal($cart_items);
        $order->payment_method = $this->payment_method;
        $order->payment_status = 'pending';
        $order->status = 'new';
        $order->shipping_amount = 0;
        $order->shipping_method = $this->shipping_method;
        $order->notes = 'Order Placed by '. $this->user->name;

        $address = new Address();
        $address->first_name = $this->user->name;
        $address->last_name = $this->last_name;
        $address->phone = $this->user->contact;
        $address->street_address = $this->street_address;
        $address->city = $this->city;

        $redirect_url = '/Success';

        $order->save();
        $address->order_id = $order->id;
        $address->save();
        $order->orderItem()->createMany($cart_items);
        CartManagement::clearCartItems();

        return redirect($redirect_url);
    }

    public function render()
    {

        $cart_items = CartManagement::getCartItemsFromCookie();
        $grand_total = CartManagement::calculateGrandTotal($cart_items);

        return view('livewire.check-out', [
            'cart_items' => $cart_items,
            'grand_total' => $grand_total
        ]);
    }
}
