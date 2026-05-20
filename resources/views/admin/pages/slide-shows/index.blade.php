@extends("admin.layouts.master")

@section("content")
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Slide Shows</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.slide-shows.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Add New Slide
                    </a>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible mx-3 mt-3">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{ session('success') }}
                </div>
            @endif

            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>Order</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Action Button</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($slideShows as $slideShow)
                            <tr>
                                <td>{{ $slideShow->order }}</td>
                                <td>
                                    <img src="{{ asset($slideShow->image) }}" alt="{{ $slideShow->title }}"
                                         class="img-thumbnail" style="max-height: 50px; max-width: 100px;">
                                </td>
                                <td>{{ $slideShow->title }}</td>
                                <td>{{ Str::limit($slideShow->description, 50) }}</td>
                                <td>
                                    @if($slideShow->enable_action_button)
                                        <span class="badge badge-success">
                                            <i class="fas fa-check"></i> Enabled
                                        </span>
                                        <br>
                                        <small>{{ $slideShow->action_button_text }}</small>
                                    @else
                                        <span class="badge badge-secondary">
                                            <i class="fas fa-times"></i> Disabled
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    @if($slideShow->is_active)
                                        <span class="badge badge-success">Active</span>
                                    @else
                                        <span class="badge badge-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.slide-shows.edit', $slideShow->id) }}"
                                       class="btn btn-sm btn-info">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.slide-shows.destroy', $slideShow->id) }}"
                                          method="POST" class="d-inline"
                                          onsubmit="return confirm('Are you sure you want to delete this slide?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No slide shows found. <a href="{{ route('admin.slide-shows.create') }}">Create one now</a></td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
