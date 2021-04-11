<div>
    <style>
        nav svg {
            height: 20px;
        }

        nav .hidden {
            display: block !important;
        }
    </style>
    <div class="container" style="padding: 30px 0">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">All Coupons</div>
                            <div class="col-md-6">
                                <a href="{{route('admin.coupon.add')}}"
                                   class="btn btn-success pull-right">Add New </a>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Code</th>
                                <th>Type</th>
                                <th>Value</th>
                                <th>Cart Value</th>
                                <th>Date</th>
                                <th>Expiry Date</th>
                                <th>Update</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tbody>

                            @forelse($coupons as $coupon)
                                <tr>
                                    <td>{{$coupon->id}}</td>
                                    <td>{{$coupon->code}}</td>
                                    <td>{{$coupon->type}}</td>

                                    <td>{{$coupon->value}}@if($coupon->type == 'fixed')$@else%@endif</td>
                                    <td>{{$coupon->cart_value}}$</td>
                                    <td>{{$coupon->created_at->diffForHumans()}}</td>
                                    <td>{{$coupon->expiry_date}}</td>
                                    <td><a href="{{route('admin.coupon.edit',$coupon->id)}}"><i
                                                class="fa fa-edit fa-2x text-info"></i></a></td>
                                    <td><a href=""
                                           onclick="window.confirm('Confirm Deleting this Coupon') || event.stopImmediatePropagation()"
                                           wire:click.prevent="deleteCoupon({{$coupon->id}})"><i
                                                class="fa fa-trash-o fa-2x text-danger"></i></a></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9">No Coupons Yet</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                        {{$coupons->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
