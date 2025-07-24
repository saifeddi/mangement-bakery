<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCommandRequest;
use App\Models\Client;
use App\Models\Command;
use App\Models\CommandDetail;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
 use Illuminate\Support\Facades\DB ;

class CommandController extends Controller
{
    public function history()
    {
        $clients = Client::with('commands')->get();
        $details = CommandDetail::whereDate('created_at', Carbon::today())
    ->select('product_id', DB::raw('SUM(quantity) as total_quantity'))
    ->groupBy('product_id')
    ->with('product') 
    ->get();
        return view('admin.modules.command.today',['clients'=>$clients , 'details'=>$details]);
    }

    public function passCommand(CreateCommandRequest $request, Client $client)
{
    $data = $request->validated();

    $quantities = collect($data['quantities'] ?? [])
        ->filter(fn($qty) => $qty != 0);

    if ($quantities->isEmpty()) {
        return redirect()->route('client.index')
            ->with('error', 'Aucune quantité valide fournie.');
    }

    $productIds = $quantities->keys();
    
    $products = Product::whereIn('id', $productIds)->get()->keyBy('id');
    $clientPrices = $client->clientProducts()->whereIn('product_id', $productIds)->get()->keyBy('product_id');

    $command = $client->commands()->create([
        'status' => 'pending',
        'total'  => 0,
        'code'   => strtoupper(Str::uuid()),
    ]);

    $total = 0;

    foreach ($quantities as $productId => $quantity) {
        $product = $products->get($productId);
        $clientProduct = $clientPrices->get($productId);

        if (!$product || !$clientProduct) {
            continue; // Optionally log missing product or price
        }

        $subTotal = $clientProduct->price * $quantity;

        $command->details()->create([
            'product_id' => $product->id,
            'quantity'   => $quantity,
            'price'      => $clientProduct->price,
            'sub_total'  => $subTotal,
        ]);

        $total += $subTotal;
    }

    $command->update(['total' => $total]);

    return redirect()->route('client.index')
        ->with('success', 'Commande créée avec succès.');
}


    
}
