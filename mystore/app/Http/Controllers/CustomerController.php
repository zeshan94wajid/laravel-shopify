<?php

namespace App\Http\Controllers;

use App\Customer;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use http\Exception;
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


    public function update()
    {
        try {
            $customers = $this->getShopifyCustomers();
            

        } catch (\Exception $e) {
            return $this->sendError($e->getMessage());
        }

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
