<div>
    <div class="container" style="padding: 30px 0">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    @if(\Illuminate\Support\Facades\Session::has('message'))
                        <div class="alert alert-success"
                             role="alert">{{\Illuminate\Support\Facades\Session::get('message')}}</div>
                    @endif
                    <div class="panel-heading">Sale Settings</div>
                    <div class="panel-body">
                        <form class="form-horizontal" wire:submit.prevent="updateSale()">
                            <div class="form-group">
                                <label for="status" class="col-md-4">Status</label>
                                <div class="col-md-4">
                                    <select id="status" class="form-control" wire:model="status">
                                        <option value="0">Inactive</option>
                                        <option value="1">Active</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="date" class="col-md-4">Sale Date</label>
                                <div class="col-md-4">
                                    <input type="text"
                                           id="date"
                                           placeholder="YYYY/MM/DD HH:MM:SS"
                                           class="form-control input-md"
                                           wire:model="sale_date">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="submit" class="col-md-4"></label>
                                <div class="col-md-4">
                                    <button type="submit"
                                            class="btn btn-primary">
                                        Update
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
    <script>
        $(function () {
            $('#date').datetimepicker({
                format: 'Y-MM-DD h:m:s',
            })
                .on('dp.change', function (ev) {
                    var data = $('#date').val();
                    @this.set('sale_date',data)
                });
        });
    </script>
@endpush
