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
        <a href="{{ route('news.index') }}">News</a>
        <a href="{{ route('categories.index') }}">Category</a>
        <a href="{{ route('data-programs.index') }}">Data & Program</a>
        <a href="{{ route('works.index') }}">Works & Internship</a>
        <a href="#">Application</a>
        <a href="#">Complaints</a>
        <form method="POST" action="{{ route('logout') }}" style="margin-top: 20px;">
            @csrf
            <button type="submit" style="font-size:25px;background:none;border:none;padding:0;color:#333;cursor:pointer;text-align:left;">
                Logout
            </button>
        </form>
    </div>
    <div class="content">
        @yield('content')
    </div>
</div>
</body>
</html>
