{{-- resources/views/partials/vite.blade.php --}}
@php
    $devServer = 'http://localhost:5173';
@endphp

@if (app()->environment('local'))
    <script type="module" src="{{ $devServer }}/@vite/client"></script>
    <script type="module" src="{{ $devServer }}/resources/js/app-v2.js"></script>
@else
    @php
        $manifest = json_decode(file_get_contents(public_path('build/manifest.json')), true);
        $js = $manifest['resources/js/app-v2.js']['file'];
        $css = $manifest['resources/js/app-v2.js']['css'][0] ?? null;
    @endphp

    @if ($css)
        <link rel="stylesheet" href="{{ asset('build/' . $css) }}">
    @endif
    <script type="module" src="{{ asset('build/' . $js) }}"></script>
@endif