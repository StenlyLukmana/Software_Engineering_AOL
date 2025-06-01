@extends('layouts.main')

@section('container')

<div class="container col-md-8" style="padding-top: 20px">
    <div class="card shadow">
        <div class="card-header text-center">{{ __($material->title) }} </div>
        <div class="card-body">
            
            @php
                $mediaPath = $material->media ? 'storage/media/' . $material->media : null;
                $extension = $material->media ? pathinfo($material->media, PATHINFO_EXTENSION) : null;
                $isVideo = $extension ? in_array(strtolower($extension), ['mp4', 'webm', 'ogg']) : false;
                $isImage = $extension ? in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif']) : false;
            @endphp

            {{-- Only show media if it exists --}}
            @if($material->media)
                @if($isImage)
                    <img src="{{ asset($mediaPath) }}" alt="Image" style="max-width: 100%; height: auto;" class="mb-3">
                @elseif($isVideo)
                    <video controls style="max-width: 100%; height: auto;" class="mb-3">
                        <source src="{{ asset($mediaPath) }}" type="video/{{ $extension }}">
                        Your browser does not support the video tag.
                    </video>
                @else
                    <p>Unsupported media type.</p>
                @endif
            @endif

            <p>{{ $material->content }}</p>
        </div>
    </div>
</div>

@endsection
