@extends('admin.layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Edit User</h1>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-8">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                            Edit  User
                            <a href="{{ route('user.index')  }}" class="btn btn-primary float-end">Back</a>
                        </h5>

                        <!-- General Form Elements -->
                        <form action="{{ route('user.update', $user) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-12 col-form-label">Name</label>
                                <div class="col-sm-12">
                                    <input type="text"  name="name"  value="{{ $user->name }}" class="form-control" required>
                                    @error('name') <span class="text-danger"><{{ $message }}/span> @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-12 col-form-label">Email</label>
                                <div class="col-sm-12">
                                    <input type="email"  name="email" readonly value="{{ $user->email }}" class="form-control" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-12 col-form-label">Password</label>
                                <div class="col-sm-12">
                                    <input type="password"  name="password" class="form-control">
                                    @error('password') <span class="text-danger"><{{ $message }}/span> @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Roles</label>
                                <div class="col-sm-4">
                                    <select class="form-select" name="roles[]" aria-label="Default select example" multiple>
                                        <option value="">Select Role</option>
                                        @foreach($roles as $role)
                                            <option
                                                value="{{ $role }}"
                                                {{ in_array($role , $userRoles) ? 'selected' : '' }}
                                            >{{$role}}</option>
                                        @endforeach
                                    </select>
                                    @error('roles') <span class="text-danger"><{{ $message }}/span> @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-12" >
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>

                        </form><!-- End General Form Elements -->

                    </div>
                </div>

            </div>

        </div>
    </section>
@endsection
