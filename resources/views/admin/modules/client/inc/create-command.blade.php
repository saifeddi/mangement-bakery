@foreach($clients as $client)
<div class="modal fade" id="createCommandModal-{{$client->id}}" tabindex="-1" aria-labelledby="createCommandModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('pass.command',$client) }}" method="POST">
            @csrf
            <input type="hidden" name="client_id" value="{{ $client->id }}">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createCommandModalLabel">Create Command for {{ $client->name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        @foreach($client->clientProducts as $clientProduct)
                        <div class="col-md-6 mb-2">
                            <div class="form-check">
                                <input
                                    class="form-check-input product-checkbox"
                                    type="hidden"
                                    name="product_ids[]"
                                    value="{{ $clientProduct->product_id }}"
                                    id="product_{{ $client->id }}_{{ $clientProduct->product_id }}">

                                <label class="form-check-label" for="product_{{ $client->id }}_{{ $clientProduct->product_id }}">
                                    {{ $clientProduct->product->name }} —
                                    <small>{{$clientProduct->price}}</small>
                                </label>

                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <input
                                type="number"
                                class="form-control product-quantity"
                                name="quantities[{{ $clientProduct->product_id }}]"
                                placeholder="Quantity for {{ $clientProduct->product->name }}"
                                value="0"
                                >
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save Command</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endforeach