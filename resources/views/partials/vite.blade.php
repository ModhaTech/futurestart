{{-- resources/views/partials/vite.blade.php --}}
@php
    $devServer = 'http://localhost:5173';
    $hotFile = public_path('hot');
@endphp

@if (file_exists($hotFile))
    <script type="module" src="{{ $devServer }}/@vite/client"></script>
    <script type="module" src="{{ $devServer }}/resources/js/app-v2.js"></script>
@else
    @php
        $manifest = json_decode(file_get_contents(public_path('build/.vite/manifest.json')), true);
        $js = $manifest['resources/js/app-v2.js']['file'];
        $css = $manifest['resources/js/app-v2.js']['css'][0] ?? null;
    @endphp

    @if ($css)
        <link rel="stylesheet" href="{{ asset('build/' . $css) }}">
    @endif
    <script type="module" src="{{ asset('build/' . $js) }}"></script>
@endif