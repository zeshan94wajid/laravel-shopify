<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Order;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

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
     * <p> Update customer data from Shopify store </p>
     *
     * @return JsonResponse
     */
    public function update()
    {
        try {
            $customers = $this->getShopifyCustomers();

            foreach($customers as $c) {
                $customer = new Customer();
                $customer->update($c);
            }

            return $this->sendResponse(Customer::all(), 'Customers updates successfully.');

        } catch (\Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }

    /**
     * <p> Get average order value for a customer </p>
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function getOrderAverage(Request $request)
    {
        $customer = Customer::find($request->get('customer'));
        if (Order::where('customer_shopify_id', $customer->shopify_id)->get()->count() > 0) {

            return $this->sendResponse(Order::getAverageCustomerOrderValue($customer->shopify_id), 'Average order value');
        }

        return $this->sendError('This customer has not placed any order yet');
    }

    /**
     * <p> Returns customer data from Shopify store </p>
     *
     * @throws \Exception
     */
    private function getShopifyCustomers()
    {
        $endpoint = 'customers.json';
        $shop_url = env('SHOP_URL');
        $headers = [
            'Content-Type' => 'application/json',
        ];

        $client = new Client(['headers' => $headers]);

        try {
            $api_response = $client->request('GET', $shop_url . $endpoint);
        } catch (GuzzleException $e) {
            throw new \Exception($e->getMessage());
        }

        return json_decode($api_response->getBody()->getContents(), true)['customers'];
    }
}
