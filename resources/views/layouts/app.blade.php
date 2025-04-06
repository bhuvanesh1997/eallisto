<!DOCTYPE html>
<html>
<head>
    <title>Eallisto Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">

	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
	@yield('scripts')

</head>
<body>
    <div class="d-flex">
        @if(Auth::check())
        	<nav class="bg-dark text-white p-3" style="width: 200px; height: 100vh;">
	            <ul class="nav flex-column">
	                <li class="nav-item"><a class="nav-link text-white" href="/dashboard">Dashboard</a></li>
	                <li class="nav-item"><a class="nav-link text-white" href="/customers">Customers</a></li>
	                <li class="nav-item"><a class="nav-link text-white" href="/invoices">Invoices</a></li>
	                <li class="nav-item"><a class="nav-link text-white" href="/logout">Logout</a></li>
	            </ul>
        	</nav>
        @endif
        <main class="p-4 flex-grow-1">
            @yield('content')
        </main>
    </div>

    @yield('scripts')
</body>
</html>