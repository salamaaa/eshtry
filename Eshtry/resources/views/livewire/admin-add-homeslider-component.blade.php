<div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">Add Slider</div>
                            <div class="col-md-6">
                                <a href="{{route('admin.homeslider')}}"
                                   class="btn btn-success pull-right">All Sliders</a>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        @if(\Illuminate\Support\Facades\Session::has('message'))
                            <div class="alert alert-success"
                                 role="alert">{{\Illuminate\Support\Facades\Session::get('message')}}</div>
                        @endif
                        <form wire:submit.prevent="storeSlider()"
                              class="form-horizontal"
                              enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="title"
                                       class="col-md-4 control-label">
                                    Title
                                </label>
                                <div class="col-md-4">
                                    <input type="text"
                                           wire:model="title"
                                           id="title"
                                           class="form-control input-md">
                                    <span class="text-danger">@error('title'){{ $message }} @enderror</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="subtitle"
                                       class="col-md-4 control-label">
                                    Subtitle
                                </label>
                                <div class="col-md-4">
                                    <input type="text"
                                           wire:model="subtitle"
                                           id="subtitle"
                                           class="form-control input-md">
                                    <span class="text-danger">@error('subtitle'){{ $message }} @enderror</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="price"
                                       class="col-md-4 control-label">
                                    Price
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
                                <label for="link"
                                       class="col-md-4 control-label">
                                    Link
                                </label>
                                <div class="col-md-4">
                                    <input type="text"
                                           wire:model="link"
                                           id="link"
                                           class="form-control input-md">
                                    <span class="text-danger">@error('link'){{ $message }} @enderror</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="status"
                                       class="col-md-4 control-label">
                                    Status
                                </label>
                                <div class="col-md-4">
                                    <select name="status" id="status" wire:model="status" class="form-control">
                                        <option value="1">In Stock</option>
                                        <option value="0">Out Of Stock</option>
                                    </select>
                                    <span class="text-danger">@error('status'){{ $message }} @enderror</span>
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
                                             alt="slider image"
                                             width="100">
                                    @endif
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
