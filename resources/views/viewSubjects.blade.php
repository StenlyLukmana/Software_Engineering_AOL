@extends('layouts.main')

@section('container')

<div class="container col-md-8" style="padding-top: 20px">
    <div class="card shadow">
        <div class="card-header text-center">{{ __('LIST OF SUBJECTS') }} </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Subject</th>
                            <th scope="col">View</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($subjects as $subject)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $subject->name }}</td>
                            <td>
                                <a href="/view/{{ $subject->id }}"><button type="button" class="btn btn-success">View</button></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
        </div>
    </div>
</div>

@endsection