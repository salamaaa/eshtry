<div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">Add New Category</div>
                            <div class="col-md-6">
                                <a href="{{route('admin.categories')}}"
                                   class="btn btn-success pull-right">
                                    All Categories
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        @if(\Illuminate\Support\Facades\Session::has('message'))
                            <div class="alert alert-success" role="alert">{{\Illuminate\Support\Facades\Session::get('message')}}</div>
                        @endif
                        <form wire:submit.prevent="storeCategory()"
                              class="form-horizontal">
                            <div class="form-group">
                                <label for="categoryName"
                                       class="col-md-4 control-label">
                                    Category Name
                                </label>
                                <div class="col-md-4">
                                    <input type="text"
                                           wire:model="name"
                                           wire:keyup="generateSlug()"
                                           id="categoryName"
                                           class="form-control input-md">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="categorySlug"
                                       class="col-md-4 control-label">
                                    Category Slug
                                </label>
                                <div class="col-md-4">
                                    <input type="text"
                                           wire:model="slug"
                                           id="categorySlug"
                                           class="form-control input-md">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="categorySlug" class="col-md-4 control-label"></label>
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
