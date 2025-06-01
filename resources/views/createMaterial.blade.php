@extends('layouts.main')

@section('container')

<div class="container col-md-6" style="padding-top: 20px">
    <div class="card shadow">
        <div class="card-header text-center">{{ __('INPUT NEW MATERIAL') }} </div>
        <div class="card-body">
            <form action="/create-material" method="POST" enctype="multipart/form-data">

                @csrf

                <div class="mb-3">
                    <label for="" class="form-label">Title</label>
                    <input name="title" type="text" class="form-control" id="formGroupExampleInput" placeholder="" required>
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Content</label>
                    <input name="content" type="text" class="form-control" id="formGroupExampleInput" placeholder="" required>
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Media</label>
                    <input name="media" type="file" class="form-control" id="formGroupExampleInput" placeholder="">
                </div>
                
                <input name="subject_id" type="text" value="{{ $subject->id }}">

                <button type="submit" class="btn btn-success">Insert</button>

            </form>
        </div>
    </div>
</div>

@endsection