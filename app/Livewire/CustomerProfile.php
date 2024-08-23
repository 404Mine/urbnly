<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Title;

use Illuminate\Support\Facades\Auth;
use App\Models\Customer;
use App\Models\Order;

#[Title('User Profile | Urbnly')]
class CustomerProfile extends Component
{

    public $isAuthenticated;
    public $user;
    public $orders;

    public function mount(){

        $this->isAuthenticated = session()->has('login_customers_59ba36addc2b2f9401580f014c7f58ea4e30989d');
        if ($this->isAuthenticated) {
            $userId = session()->get('login_customers_59ba36addc2b2f9401580f014c7f58ea4e30989d'); // Assuming user ID is stored in session
            $this->user = Customer::find($userId); // Assuming user information is stored in the database

            // Hide characters before "@" symbol in email
            $this->user->email = $this->hideEmailCharacters($this->user->email);
            // Show asterisks for all digits except the last four
            $this->user->contact = $this->hideContactDigits($this->user->contact);
            // Retrieve orders associated with the user
            $this->orders = Order::where('customer_id', $this->user->id)->get();
        }
    }

    private function hideEmailCharacters($email)
    {
        // Find the position of "@" symbol
        $atSymbolPosition = strpos($email, '@');
        
        // Hide characters before "@" symbol with asterisks
        $hiddenCharacters = str_repeat('*', $atSymbolPosition);
        
        // Get the domain part of the email
        $domain = substr($email, $atSymbolPosition);
        
        // Concatenate the hidden characters with the domain
        return $hiddenCharacters . $domain;
    }

    private function hideContactDigits($contact)
    {
        // Get the length of the contact number
        $length = strlen($contact);
        
        // Calculate the number of digits to hide
        $hiddenDigits = $length - 4;

        // Generate the asterisks string
        $asterisks = str_repeat('*', $hiddenDigits);

        // Get the last four digits of the contact number
        $lastFourDigits = substr($contact, -4);
        
        // Concatenate the asterisks with the last four digits
        return $asterisks . $lastFourDigits;
    }
}
