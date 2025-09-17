@php
    $faviconSetting = \App\Models\Setting::where('key', 'favicon')->first();
    $faviconPath = $faviconSetting ? '/' . $faviconSetting->value : null;
@endphp

@if ($faviconPath)
    <link rel="icon" href="{{ $faviconPath }}" type="image/x-icon">
@else
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
@endif
