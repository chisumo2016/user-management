@extends('admin.layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>
            Add New Role
            <a href="{{ route('permission.index') }}" class="btn btn-primary float-end">Back</a>
        </h1>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-8">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Create Permission</h5>

                        <!-- General Form Elements -->
                        <form action="{{ route('permission.store') }}" method="POST">
                            @csrf
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-12 col-form-label">Permission Name</label>
                                <div class="col-sm-12">
                                    <input type="text"  name="name" class="form-control" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-12" >
                                    <button type="submit" class="btn btn-primary">Create</button>
                                </div>
                            </div>

                        </form><!-- End General Form Elements -->

                    </div>
                </div>

            </div>

        </div>
    </section>
@endsection
