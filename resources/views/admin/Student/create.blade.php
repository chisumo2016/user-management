@extends('admin.layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Image Upload</h1>

    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Image Crud</h4>
                        <a href="{{ route('student.index') }}" class="btn btn-success float-end">Back</a>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('student.store')  }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="">Student Name</label>
                                <input type="text"  name="name" class="form-control">
                            </div>

                            <div class="form-group mb-3">
                                <label for="">Student Email</label>
                                <input type="email" name="email" class="form-control">
                            </div>

                            <div class="form-group mb-3">
                                <label for="">Course</label>
                                <input type="text" name="course" class="form-control">
                            </div>

                            <div class="form-group mb-3">
                                <label for="">Student Image</label>
                                <input type="file"  name="avatar" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <button  type="submit" class="btn btn-primary">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

