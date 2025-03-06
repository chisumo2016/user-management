@extends('admin.layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Users</h1>

    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="card-title">View Users</h5>
                            </div>
                            <div class="col-md-6" style="text-align: right;">
                                <a href="{{ route('user.create') }}" class="btn btn-primary" style="margin-top: 10px;">Add</a>
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
                            @foreach($users as $user)
                                <tr>
                                    <th scope="row">{{ $user->id }}</th>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->created_at }}</td>
                                    <td>
                                        <a href="{{ route('user.edit', $user) }}" class="btn btn-sm btn-primary">Edit</a>
                                        {{--                                        <a href="{{ route('roles.destroy', $role) }}" class="btn btn-sm btn-danger">Delete</a>--}}

                                        <form action="{{ route('user.destroy', $user) }}" method="POST" style="display:inline;"  onsubmit="confirmDelete(event)">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
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

