<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClientRequest;
use App\Models\Client;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::with('clientProducts')->paginate(20);

        return view('admin.modules.client.index', ['clients' => $clients]);
    }

    public function create()
    {
        $products = Product::get();
        return view('admin.modules.client.create', ['products' => $products]);
    }

    public function store(StoreClientRequest $request)
    {

        DB::transaction(function () use ($request) {
            $data = $request->validated();
            $dataProduct = $data['prices'];
            unset($data['prices']);

            $client = $this->saveClient($data);
            $this->saveProductClient($client, $dataProduct);
        });

        return redirect()->route('client.index')
            ->with('success', 'Client created successfully.');
    }

    public function edit(Client $client)
    {
        $products = Product::get();
        return view('admin.modules.client.edit', ['products' => $products, 'client' => $client]);
    }

    public function update(StoreClientRequest $request, Client $client)
    {
        $data = $request->validated();

        DB::transaction(function () use ($client, $data) {
            $clientData = $this->extractClientData($data);
            $productData = $this->extractProductData($data);

            $this->updateClient($client, $clientData);
            $this->updateClientProducts($client, $productData);
        });

        return redirect()->route('client.index')->with('success', 'Client updated successfully.');
    }

    private function extractClientData(array $data): array
    {
        return collect($data)->except(['product_ids', 'prices'])->toArray();
    }

    private function extractProductData(array $data): array
    {
        $productIds = $data['product_ids'] ?? [];
        $prices = $data['prices'] ?? [];

        return collect($productIds)->mapWithKeys(function ($productId) use ($prices) {
            return [$productId => $prices[$productId] ?? null];
        })->toArray();
    }

    private function updateClient(Client $client, array $data): void
    {
        $client->update($data);
    }

    private function updateClientProducts(Client $client, array $productData): void
    {
        $existing = $client->clientProducts()->pluck('id', 'product_id')->toArray();

        foreach ($productData as $productId => $price) {
            if (isset($existing[$productId])) {
                 $client->clientProducts()->where('product_id', $productId)->update(['price' => $price]);
            } else {
                 $client->clientProducts()->create([
                    'product_id' => $productId,
                    'price' => $price,
                ]);
            }
        }

         $toDelete = array_diff(array_keys($existing), array_keys($productData));
        if (!empty($toDelete)) {
            $client->clientProducts()->whereIn('product_id', $toDelete)->delete();
        }
    }



    private function saveClient($data)
    {
        return Client::create($data);
    }

    private function saveProductClient(Client $client, array $prices)
    {
        foreach ($prices as $productId => $price) {
            if ($price !== null && $price !== '') {
                $client->clientProducts()->create([
                    'product_id' => $productId,
                    'price' => $price,
                ]);
            }
        }
    }
}
