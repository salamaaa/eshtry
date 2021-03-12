<div>
    <style>
        nav svg {
            height: 20px;
        }

        nav .hidden {
            display: block !important;
        }
    </style>
    <div class="container" style="padding:30px 0;">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">All Products</div>
                    <div class="panel-body">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Stock</th>
                                <th>Price</th>
                                <th>Date</th>
                                <th rowspan="2">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($products as $product)
                                <tr>
                                    <td>{{$product->id}}</td>
                                    <td><img height="50px"
                                             width="50px"
                                             src="{{asset('assets/images/products/'.$product->image)}}"
                                             alt="{{$product->name}}">
                                    </td>
                                    <td>{{$product->name}}</td>
                                    <td>{{$product->category->name}}</td>
                                    <td>{{$product->stock_status}}</td>
                                    <td>{{$product->regular_price}}</td>
                                    <td>{{$product->created_at->diffForHumans()}}</td>
                                    <td><a href="#"><i class="fa-edit fa-2x"></i></a></td>
                                    <td><a href="#"><i class="fa-trash-o fa-2x text-red-600"></i></a></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9">No Products Found</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                        {{$products->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
