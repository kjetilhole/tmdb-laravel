<!DOCTYPE html>
<html>
<head>
    <title>Random Movie</title>
</head>

<body>
    @if ($movie)
        <h1>{{ $movie['title'] }}</h1>
        <p><strong>Release Date:</strong> {{ $movie['release_date'] }}</p>
        <p><strong>Overview:</strong> {{ $movie['overview'] }}</p>
        <p><strong>Rating:</strong> {{ $movie['vote_average'] }}</p>
    @else
        <p>No movie found.</p>
    @endif
</body>
</html>