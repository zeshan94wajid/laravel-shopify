<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * <p> Returns all customers for this app </p>
     *
     * @return JsonResponse
     */
    public function index()
    {
        $customers = Customer::all();
        $message = count($customers) . ' found';

        return $this->sendResponse($customers, $message);
    }

    /**
     * <p> Updates the Customer tables with data from Shopify </p>
     *
     */
    public function syncShopifyCustomers()
    {
        
    }
}
