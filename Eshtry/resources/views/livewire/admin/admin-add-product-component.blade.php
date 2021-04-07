<div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">Add Product</div>
                            <div class="col-md-6">
                                <a href="{{route('admin.products')}}"
                                   class="btn btn-success pull-right">
                                    All Products
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        @if(\Illuminate\Support\Facades\Session::has('message'))
                            <div class="alert alert-success"
                                 role="alert">{{\Illuminate\Support\Facades\Session::get('message')}}</div>
                        @endif
                        <form wire:submit.prevent="storeProduct()"
                              class="form-horizontal"
                              enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="productName"
                                       class="col-md-4 control-label">
                                    Product Name
                                </label>
                                <div class="col-md-4">
                                    <input type="text"
                                           wire:model="name"
                                           wire:keyup="generateSlug()"
                                           id="productName"
                                           class="form-control input-md">
                                    <span class="text-danger">@error('name'){{ $message }} @enderror</span>
                                </div>
                            </div>
                            {{--<div class="form-group">
                                <label for="productSlug"
                                       class="col-md-4 control-label">
                                    Product Slug
                                </label>
                                <div class="col-md-4">
                                    <input type="text"
                                           wire:model="slug"
                                           id="productSlug"
                                           class="form-control input-md">
                                    <span class="text-danger">@error('slug'){{ $message }} @enderror</span>
                                </div>
                            </div>--}}
                            <div class="form-group">
                                <label for="short_description"
                                       class="col-md-4 control-label">
                                    Short Description
                                </label>
                                <div class="col-md-4" wire:ignore>
                                    <textarea type="text"
                                              wire:model="short_description"
                                              class="form-control input-md"
                                              id="short_description"></textarea>
                                    <span class="text-danger">@error('short_description'){{ $message }} @enderror</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description"
                                       class="col-md-4 control-label">
                                    Description
                                </label>
                                <div class="col-md-4" wire:ignore>
                                    <textarea type="text"
                                              wire:model="description"
                                              id="description"
                                              class="form-control input-md"></textarea>
                                    <span class="text-danger">@error('description'){{ $message }} @enderror</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="price"
                                       class="col-md-4 control-label">
                                    Product Price
                                </label>
                                <div class="col-md-4">
                                    <input type="number"
                                           wire:model="price"
                                           id="price"
                                           class="form-control input-md">
                                    <span class="text-danger">@error('price'){{ $message }} @enderror</span>

                                </div>
                            </div>
                            <div class="form-group">
                                <label for="salePrice"
                                       class="col-md-4 control-label">
                                    Sale Price
                                </label>
                                <div class="col-md-4">
                                    <input type="number"
                                           wire:model="sale_price"
                                           id="salePrice"
                                           class="form-control input-md">
                                    <span class="text-danger">@error('sale_price'){{ $message }} @enderror</span>

                                </div>
                            </div>
                            <div class="form-group">
                                <label for="stock"
                                       class="col-md-4 control-label">
                                    Stock Status
                                </label>
                                <div class="col-md-4">
                                    <select name="stock" id="stock" wire:model="stock_status" class="form-control">
                                        <option value="instock">In Stock</option>
                                        <option value="outofstock">Out Of Stock</option>
                                    </select>
                                    <span class="text-danger">@error('stock_status'){{ $message }} @enderror</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="featured"
                                       class="col-md-4 control-label">
                                    Featured
                                </label>
                                <div class="col-md-4">
                                    <select name="featured" id="featured" wire:model="featured" class="form-control">
                                        <option value="0">No</option>
                                        <option value="1">Yes</option>
                                    </select>
                                    <span class="text-danger">@error('featured'){{ $message }} @enderror</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="quantity"
                                       class="col-md-4 control-label">
                                    Quantity
                                </label>
                                <div class="col-md-4">
                                    <input type="number"
                                           wire:model="quantity"
                                           id="quantity"
                                           class="form-control input-md">
                                    <span class="text-danger">@error('quantity'){{ $message }} @enderror</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="image"
                                       class="col-md-4 control-label">
                                    Image
                                </label>
                                <div class="col-md-4">
                                    <input type="file"
                                           wire:model="image"
                                           id="image"
                                           class="input-file">
                                    <span class="text-danger">@error('image'){{ $message }} @enderror</span>
                                    @if($image)
                                        <img src="{{$image->temporaryUrl()}}"
                                             alt="product image"
                                             width="100">
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="category"
                                       class="col-md-4 control-label">
                                    Category
                                </label>
                                <div class="col-md-4">
                                    <select name="category" id="category" wire:model="category_id" class="form-control">
                                        <option value="">Select Category</option>
                                        @forelse($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @empty
                                            <option value="">No Categories Found</option>
                                        @endforelse
                                    </select>
                                    <span class="text-danger">@error('category_id'){{ $message }} @enderror</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label"></label>
                                <div class="col-md-4">
                                    <button class="btn btn-primary "
                                            type="submit">
                                        Submit
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
            tinymce.init({
                selector: '#short_description',
                setup: function (editor) {
                    editor.on('change', function (e) {
                        tinyMCE.triggerSave();
                        sd_data = $('#short_description').val();
                    @this.set('short_description', sd_data);
                    });
                }
            });
            tinymce.init({
                selector: '#description',
                setup: function (editor) {
                    editor.on('change', function (e) {
                        tinyMCE.triggerSave();
                        d_data = $('#description').val();
                    @this.set('description', d_data);
                    });
                }
            });
        });
    </script>
@endpush
