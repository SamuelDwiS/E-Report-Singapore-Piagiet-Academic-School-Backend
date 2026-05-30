@extends('base')
@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="card-title">List Mentors</h4>
                    <a href="{{ route('admin.dashboard.index') }}" class="text-dark text-decoration-none" title="Go to Dashboard">
                        <i class="mdi mdi-arrow-left"></i> Dashboard
                    </a>
                </div>
                <p class="card-description">Create Mentor:
                    <a href="{{ route('admin.mentors.create') }}">Add Form</a>
                </p>
                {{-- Form Search --}}
                <form action="{{ route('admin.mentors.index') }}" class="d-flex col-md-4">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Search mentors..."
                            id="searchInput" value="{{ request('search') }}">
                        <button class="btn btn-primary"><i class="fa fa-search"></i> Search</button>
                    </div>
                </form>

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="table-responsive">
                    <table class="table table-striped text-center">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th> Mentor Name </th>
                                <th> Email </th>
                                <th>Phone Number</th>
                                <th> Assigned Class Level </th>
                                <th> Actions </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($mentors as $mentor)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $mentor->name_mentor }}</td>
                                    <td>{{ $mentor->user->email ?? '-' }}</td>
                                    <td>{{ $mentor->phone_number }}</td>
                                    <td>
                                        @forelse ($classes->where('mentor_id', $mentor->mentor_id) as $class)
                                            {{ $class->level_class }}
                                        @empty
                                            -
                                        @endforelse
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="{{ route('admin.mentors.edit', $mentor->mentor_id) }}"
                                                class="btn btn-warning text-white">Edit</a>
                                            <form action="{{ route('admin.mentors.destroy', $mentor->mentor_id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete mentor {{ $mentor->name_mentor }}?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger text-white">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">No mentors found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $mentors->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
