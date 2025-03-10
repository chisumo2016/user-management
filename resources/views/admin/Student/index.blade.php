@extends('admin.layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Roles</h1>

    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Image Crud</h4>
                        <a href="{{ route('student.create') }}" class="btn btn-primary float-end">Add Student</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-stripped">
                            <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Course</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                            </thead>
                            <tbody>
                            @foreach($students as  $student)
                                <tr>
                                    <td>{{ $student->id }}</td>
                                    <td>{{ $student->name }}</td>
                                    <td>{{ $student->email }}</td>
                                    <td>{{ $student->course}}</td>
                                    <td>
                                        <img src="{{ asset('uploads/students/' . $student->avatar)  }}" alt="" width="75px" height="75px">
                                    </td>
                                    <td>
                                        <a href="{{ route('student.edit', $student) }}" class="btn btn-primary btn-sm">edit</a>
                                        <form action="{{ route('student.destroy', $student->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this student?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection







