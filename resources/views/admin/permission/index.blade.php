@extends('admin.layouts.app')

@section('content')
    @include('admin.nav-link')

    <div class="pagetitle  mt-4">
        <h1>Permissions</h1>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="card-title">View Permission</h5>
                            </div>
                            <div class="col-md-6" style="text-align: right;">
                                <a href="{{ route('permission.create') }}" class="btn btn-primary" style="margin-top: 10px;">Add</a>
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
                            @foreach($permissions as $permission)
                                <tr>
                                    <th scope="row">{{ $permission->id }}</th>
                                    <td>{{ $permission->name }}</td>
                                    <td>{{ $permission->created_at }}</td>
                                    <td>
                                        @can('update-permission')
                                            <a href="{{ route('permission.edit', $permission) }}" class="btn btn-sm btn-primary">Edit</a>
                                        @endcan

{{--                                        <a href="{{ route('roles.destroy', $role) }}" class="btn btn-sm btn-danger">Delete</a>--}}

                                            @can('delete-permission')
                                                <form action="{{ route('permission.destroy', $permission) }}" method="POST" style="display:inline;"  onsubmit="confirmDelete(event)">
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

