<!DOCTYPE html>
<html lang="en">
<head>
    <title> @yield('title')</title>
    <meta charset="UTF-8">
</head>
<body>
@section('sidebar')
    this is sidebar
@show

<div class="container">
    @yield('content')
</div>
</body>
</html>
