@extends('admin.layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Add New Role</h1>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-8">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Role: {{ $role->name }}
                            <a href="{{ route('role.index') }}" class="btn btn-primary float-end">Back</a>
                        </h5>

                        <!-- General Form Elements -->
                        <form action="{{ route('role.update-permission', $role) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <div class="col-sm-12">
                                    <input type="text"  name="name" value="{{$role->name }}" class="form-control" required>
                                </div>
                            </div>
                            <label for="inputText" class="col-sm-12 col-form-label">Permissions</label>
                            <div class="row">
                                @foreach($permissions as $permission)
                                    <div class="row mb-3">
                                        <div class="col-sm-10 offset-sm-2">
                                            <div class="form-check">
                                                <input
                                                    class="form-check-input"
                                                    name="permission[]"
                                                    type="checkbox"
                                                    value="{{ $permission->name }}"
                                                     {{ in_array($permission->id , $rolePermissions) ? 'checked' : ''}}
                                                    id="gridCheck1">
                                                <label class="form-check-label" for="gridCheck1">
                                                    {{ $permission->name }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                @endforeach
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
