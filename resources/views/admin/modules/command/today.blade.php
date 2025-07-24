@extends('admin.layouts.master')

@section('page-title')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Command List</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Product</a></li>
                    <li class="breadcrumb-item active">Product List</li>
                </ol>
                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif
            </div>

        </div>
    </div>
</div>
@endsection

@section('button')
<div class="row pb-4 gy-3">
    <div class="col-sm-4">
        <a class="btn btn-info" href="#" onclick="window.print(); return false;">Imprimer</a>
    </div>
</div>
@endsection
@section('content')



<div class="row">
    <div class="col-xl-6">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive table-card">
                    <table class="table table-nowrap align-middle mb-0">
                        <thead>
                            <tr class="text-muted text-uppercase">

                                <th scope="col" style="width: 500px;">Client</th>



                            </tr>
                        </thead>

                        <tbody>
                            @foreach($clients as $client)
                            <tr>


                                <td>{{$client->name}}
                                    @if($client->commandToday())
                                    @php $command = $client->commandToday() ;@endphp

                                    <ul>
                                        @foreach($command->details as $detail)
                                        <li> {{$detail->product->name ?? ''}} : {{$detail->quantity}} </li>
                                        @endforeach
                                    </ul>
                                    @endif
                                </td>



                            </tr>
                            @endforeach


                        </tbody><!-- end tbody -->
                    </table><!-- end table -->


                </div><!-- end table responsive -->


            </div>
        </div>



    </div>
    <div class="col-xl-6">
        <div class="card">
            <div class="card-body">


                <div class="table-responsive table-card">
                    <table class="table table-nowrap align-middle mb-0">
                        <thead>
                            <tr class="text-muted text-uppercase">

                                <th scope="col" style="width: 500px;">Product</th>



                            </tr>
                        </thead>

                        <tbody>
                            @foreach($details as $detail)
                            <tr>


                                <td> <b>{{$detail->product->name}} </b> : ({{$detail->total_quantity}}) 



                                </td>



                            </tr>
                            @endforeach


                        </tbody><!-- end tbody -->
                    </table><!-- end table -->


                </div><!-- end table responsive -->
            </div>
        </div>



    </div>
</div>

@endsection