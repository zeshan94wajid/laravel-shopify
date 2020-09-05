<?php

namespace App\Http\Controllers;

use App\Product;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    /**
     * <p> Returns all customers for this app </p>
     *
     * @return JsonResponse
     */
    public function index()
    {
        $products = Product::all();
        $message = count($products) . ' found';

        return $this->sendResponse($products, $message);
    }

    /**
     * <p> Update customer data from Shopify store </p>
     *
     * @return JsonResponse
     */
    public function update()
    {
        try {
            $products = $this->getShopifyProducts();

            foreach($products as $p) {
                $product = new Product();
                $product->update($p);
            }

            return $this->sendResponse(Product::all(), 'Products updates successfully.');

        } catch (\Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }

    /**
     * <p> Returns products data from Shopify store </p>
     *
     * @throws \Exception
     */
    private function getShopifyProducts()
    {
        $endpoint = 'products.json';
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

        return json_decode($api_response->getBody()->getContents(), true)['products'];
    }
}
