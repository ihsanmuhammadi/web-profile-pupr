<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <style>
        body { font-family: sans-serif; margin: 0; }
        .container { display: flex; min-height: 100vh; }
        .sidebar {
            width: 200px;
            background: #f4f4f4;
            padding: 20px;
            border-right: 1px solid #ddd;
        }
        .sidebar a {
            display: block;
            margin-bottom: 10px;
            color: #333;
            text-decoration: none;
        }
        .sidebar a:hover {
            text-decoration: underline;
        }
        .content {
            flex: 1;
            padding: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="sidebar">
        <h3>📋 Menu</h3>
        <a href="{{ route('guidances.index') }}">Guidances</a>
        <a href="#">Users</a>
        <a href="#">Reports</a>
        <a href="#">Settings</a>
        <a href="#">Notifications</a>
        <a href="#">Analytics</a>
        <a href="#">Support</a>
    </div>
    <div class="content">
        @yield('content')
    </div>
</div>
</body>
</html>
