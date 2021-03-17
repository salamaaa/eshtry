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
                            <div class="col-md-6">All Sliders</div>
                            <div class="col-md-6">
                                <a href="{{route('admin.homeslider.add')}}"
                                   class="btn btn-success pull-right">Add New </a>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Subtitle</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>Link</th>
                                <th>Date</th>
                                <th>Update</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tbody>

                            @forelse($sliders as $slider)
                                <tr>
                                    <td>{{$slider->id}}</td>
                                    <td><img src="{{asset('assets/images/sliders/'.$slider->image)}}"
                                             alt="{{$slider->title}}"
                                             width="100"></td>
                                    <td>{{$slider->title}}</td>
                                    <td>{{$slider->subtitle}}</td>
                                    <td>{{$slider->price}}</td>
                                    <td>{{$slider->status == 1 ? 'Active':'Inactive'}}</td>
                                    <td>{{$slider->link}}</td>
                                    <td>{{$slider->created_at->diffForHumans()}}</td>
                                    <td><a href="{{route('admin.homeslider.edit',$slider->id)}}"><i class="fa fa-edit fa-2x text-info"></i></a></td>
                                    <td><a href="" onclick="window.confirm('Confirm Deleting this Record') || event.stopImmediatePropagation()" wire:click.prevent="deleteSlider({{$slider->id}})"><i class="fa fa-trash-o fa-2x text-danger"></i></a></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9">No Sliders Yet</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                        {{$sliders->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
