@extends('admin.layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Roles</h1>

    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-md-12">
                @include('message._message')
                <div class="card">
                    <div class="card-header">
                        <h4>Image Crud</h4>
                        <a href="{{ route('student.create') }}" class="btn btn-primary float-end">Add Student</a>
                    </div>
                    <div class="card-body">

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

