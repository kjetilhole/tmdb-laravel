<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Movie Game' }}</title>

    @livewireStyles
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body>
    {{-- This is where the content of the page will be injected --}}
    {{ $slot }}

    @livewireScripts
    
</body>
</html>