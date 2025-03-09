@extends('admin.layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Roles</h1>

    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="card-title">View Roles</h5>
                            </div>
                            <div class="col-md-6" style="text-align: right;">
                                <a href="{{ route('role.create') }}" class="btn btn-primary" style="margin-top: 10px;">Add</a>
                            </div>
                        </div>


                        <!-- Table with stripped rows -->
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Date</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($roles as $role)
                                <tr>
                                    <th scope="row">{{ $role->id }}</th>
                                    <td>{{ $role->name }}</td>
                                    <td>{{ $role->created_at }}</td>
                                    <td>
                                        <a href="{{ route('role.give-permission', $role->id) }}" class="btn btn-sm btn-primary">Add / Edit Role Permission</a>
{{--                                        <a href="{{ url('roles/'.$role->id .'/give-permission') }}" class="btn btn-sm btn-primary">Add / Edit Role Permission</a>--}}

                                        @can('update-role')
                                            <a href="{{ route('role.edit', $role) }}" class="btn btn-sm btn-primary">Edit</a>
                                        @endcan

{{--                                        <a href="{{ route('roles.destroy', $role) }}" class="btn btn-sm btn-danger">Delete</a>--}}

                                        @can('delete-role')
                                            <form action="{{ route('role.destroy', $role) }}" method="POST" style="display:inline;"  onsubmit="confirmDelete(event)">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

