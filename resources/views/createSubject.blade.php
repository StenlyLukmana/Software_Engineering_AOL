@extends('layouts.main')

@section('container')

<div class="container col-md-6" style="padding-top: 20px">
    <div class="card shadow">
        <div class="card-header text-center">{{ __('INPUT NEW SUBJECT') }} </div>
        <div class="card-body">
            <form action="/create-subject" method="POST" enctype="multipart/form-data">

                @csrf

                <div class="mb-3">
                    <label for="" class="form-label">Subject Name</label>
                    <input name="name" type="text" class="form-control" id="formGroupExampleInput" placeholder="" required>
                </div>

                <button type="submit" class="btn btn-success">Insert</button>

            </form>
        </div>
    </div>
</div>

@endsection