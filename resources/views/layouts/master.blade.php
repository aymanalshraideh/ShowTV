<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.sections.head')
</head>
<body class="body">
    @include('layouts.sections.navbar')
    <!-- content -->
    @yield('content')
    <!-- end content -->
    @include('layouts.sections.footer')
    @include('layouts.sections.scripts')
</body>
</html>
