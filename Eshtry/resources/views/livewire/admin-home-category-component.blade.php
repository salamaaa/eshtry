<div>
    <div class="container" style="padding: 30px 0">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    @if(\Illuminate\Support\Facades\Session::has('message'))
                        <div class="alert alert-success"
                             role="alert">{{\Illuminate\Support\Facades\Session::get('message')}}</div>
                    @endif
                    <div class="panel-heading">Manage Home Categories</div>
                    <div class="panel-body">
                        <form class="form-horizontal" wire:submit.prevent="updateHomeCategory()">
                            <div class="form-group">
                                <label for="selectCategory" class="col-md-4 control-label"></label>
                                <div class="col-md-4" wire:ignore>
                                    <select name="categories[]"
                                            id="selectCategory"
                                            multiple="multiple"
                                            class="form-control sel_categories"
                                            wire:model="select_categories">
                                        @forelse($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @empty
                                            <option value="">No Categories Found!</option>
                                        @endforelse

                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="products-number" class="col-md-4 control-label">Products no</label>
                                <div class="col-md-4">
                                    <input type="text"
                                           class="form-control input-md"
                                           wire:model="products_no">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="submit" class="col-md-4 control-label"></label>
                                <div class="col-md-4">
                                    <button type="submit"
                                            class="btn btn-primary">
                                        Save
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
        $(document).ready(function () {
            $('.sel_categories').select2();
        });
        $('.sel_categories').on('change', function (e) {
            var data = $('.sel_categories').select2("val");
        @this.set('select_categories', data);
        })
    </script>
@endpush
