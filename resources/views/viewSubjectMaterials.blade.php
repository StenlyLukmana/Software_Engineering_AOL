@extends('layouts.main')

@section('container')

<a href="/create-material/{{ $subject->id }}"><button type="button" class="btn btn-success">Create Material</button></a>

<div class="container col-md-8" style="padding-top: 20px">
    <div class="card shadow">
        <div class="card-header text-center">{{ __('LIST OF MATERIALS') }} </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Material</th>
                            <th scope="col">View</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($subject->materials as $material)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $material->title }}</td>
                            <td>
                                <a href="/view/{{ $material->subject_id }}/{{ $material->id }}"><button type="button" class="btn btn-success">View</button></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
        </div>
    </div>
</div>

@endsection