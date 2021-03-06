<div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">Edit Coupon</div>
                            <div class="col-md-6">
                                <a href="{{route('admin.coupons')}}"
                                   class="btn btn-success pull-right">All Coupons</a>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        @if(\Illuminate\Support\Facades\Session::has('coupon_message'))
                            <div class="alert alert-success"
                                 role="alert">{{\Illuminate\Support\Facades\Session::get('coupon_message')}}</div>
                        @endif
                        <form wire:submit.prevent="updateCoupon()"
                              class="form-horizontal">
                            <div class="form-group">
                                <label for="code"
                                       class="col-md-4 control-label">
                                    Code
                                </label>
                                <div class="col-md-4">
                                    <input type="text"
                                           wire:model="code"
                                           id="code"
                                           class="form-control input-md">
                                    <span class="text-danger">@error('code'){{ $message }} @enderror</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="value"
                                       class="col-md-4 control-label">
                                    Value
                                </label>
                                <div class="col-md-4">
                                    <input type="number"
                                           wire:model="value"
                                           id="value"
                                           class="form-control input-md">
                                    <span class="text-danger">@error('value'){{ $message }} @enderror</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="cart_value"
                                       class="col-md-4 control-label">
                                    Cart value
                                </label>
                                <div class="col-md-4">
                                    <input type="number"
                                           wire:model="cart_value"
                                           id="cart_value"
                                           class="form-control input-md">
                                    <span class="text-danger">@error('cart_value'){{ $message }} @enderror</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="expiry_date"
                                       class="col-md-4 control-label">
                                    Expiry Date
                                </label>
                                <div class="col-md-4" wire:ignore>
                                    <input type="text"
                                           wire:model="expiry_date"
                                           id="expiry_date"
                                           placeholder="YYYY/MM/DD"
                                           class="form-control input-md">
                                    <span class="text-danger">@error('expiry_date'){{ $message }} @enderror</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="type"
                                       class="col-md-4 control-label">
                                    Type
                                </label>
                                <div class="col-md-4">
                                    <select name="type" id="type" wire:model="type" class="form-control">
                                        <option value="">Select</option>
                                        <option value="fixed">Fixed</option>
                                        <option value="percent">Percent</option>
                                    </select>
                                    <span class="text-danger">@error('type'){{ $message }} @enderror</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label"></label>
                                <div class="col-md-4">
                                    <button class="btn btn-primary "
                                            type="submit">
                                        Edit
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>$(function () {
            $('#expiry_date').datetimepicker({
                format: 'Y-MM-DD',
            })
                .on('dp.change', function (ev) {
                    var data = $('#expiry_date').val();
                @this.set('expiry_date',data);
                });
        });</script>
@endpush
