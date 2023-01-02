<div>
    <style>
        nav svg{
            height: 20px;
        }
        nav .hidden{
            display: block;
        }
        td{
            text-align: center;
        }
        .card {
         box-shadow: 0 2px 6px 0 rgb(218 218 253 / 65%), 0 2px 6px 0 rgb(206 206 238 / 54%);
       }
    </style>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="/" rel="nofollow">Dashboard</a>
                    <span></span> All Products
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-4">
                                        All Products 
                                        <strong class="text-brand">{{ $products-> total()}}</strong>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" placeholder="Search..." wire:model="searchTerm">
                                    </div>
                                    <div class="col-md-4">
                                        <a href="{{route('admin.product.add')}}" class="btn btn-success float-end"> Add New Products
                                        </a>
                                    </div>
                                  </div>
                            </div>
                            <div class="card-body">
                                 @if(Session::has('massege'))
                                 <div class="alert alert-success" role="alert">{{Session::get('message')}}</div>
                                 @endif
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Stock</th>
                                            <th>Price</th>
                                            <th>Catogory</th>
                                            <th>featured</th>
                                            {{-- <th>Date</th> --}}
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = ($products->currentPage()-1)*$products->perPage();
                                        @endphp
                                        @foreach ($products as $product )
                                    <tr >
                                        <td>{{++$i}}</td>
                                        <td><img src="{{asset('assets/imgs/products')}}/{{$product->image}}" width="100px"></td>
                                        <td>{{$product->name}}</td>
                                        <td>{{$product->stock_status}}</td>
                                        <td>{{$product->regular_price}}</td>
                                        <td>{{$product->category->name }}</td>
                                        <td>{{$product->featured}}</td>
                                        {{-- <td>{{$product->created_at}}</td> --}}
                                        
                                        <td>
                                            <a href="{{route('admin.product.edit',['product_id'=>$product->id])}}" class="text-info">Edit</a>
                                            <a href="#" class="text-danger" onclick="deleteConfirmation({{$product->id}})"  style="margin-left: 20px">Delete</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {{$products->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>

<div class="modal" id="deleteConfirmation">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body pb-30 pt-30">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h4 class="pb-3">Do you want to delete this record ?</h4>
                        <div type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#deleteConfirmation">Cancel</div>
                        <div type="button" class="btn btn-danger" onclick="deleteProduct()">Delete</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function deleteConfirmation(id)
    {
        @this.set('product_id',id);
        $('#deleteConfirmation').modal('show');
    }

    function deleteProduct(){
        @this.call('deleteProduct');
        $('#deleteConfirmation').modal('hide');
    }
</script>

@endpush