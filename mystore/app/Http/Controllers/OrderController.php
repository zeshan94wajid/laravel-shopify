<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Order;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\JsonResponse;

class OrderController extends Controller
{
    /**
     * <p> Returns all orders for this app </p>
     *
     * @return JsonResponse
     */
    public function index()
    {
        $orders = Order::all();
        $message = count($orders) . ' found';

        return $this->sendResponse($orders, $message);
    }

    /**
     * <p> Update order data from Shopify store </p>
     *
     * @return JsonResponse
     */
    public function update()
    {
        try {
            $orders = $this->getShopifyOrders();

            foreach($orders as $o) {
                $order = new Order();
                $order->update($o);
            }

            return $this->sendResponse(Order::all(), 'Orders updated successfully.');

        } catch (\Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }

    /**
     * <p> Returns average order value </p>
     *
     * @return JsonResponse
     */
    public function getAverageOrderForAll()
    {
        return $this->sendResponse(Order::getTotalRevenue(), 'Average order value');
    }

    /**
     * <p> Returns orders data from Shopify store </p>
     *
     * @throws \Exception
     */
    private function getShopifyOrders()
    {
        $endpoint = 'orders.json';
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

        return json_decode($api_response->getBody()->getContents(), true)['orders'];
    }
}
