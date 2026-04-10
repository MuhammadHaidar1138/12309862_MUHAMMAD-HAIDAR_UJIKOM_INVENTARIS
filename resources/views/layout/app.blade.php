<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventaris App</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@7.0.96/css/materialdesignicons.min.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
        }

        #layout-menu {
            width: 250px;
            background: #ffffff;
            border-right: 1px solid #e5e7eb;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            overflow-y: auto;
            padding-bottom: 2rem;
            z-index: 1000;
        }

        .app-brand {
            padding: 20px;
            text-align: center;
        }

        .app-brand-text {
            font-weight: 700;
            color: #111827;
            font-size: 18px;
        }

        .menu-header {
            padding: 10px 20px;
            font-size: 11px;
            color: #9ca3af;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .menu-inner {
            padding: 0;
            margin: 0;
            list-style: none;
        }

        .menu-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 16px;
            margin: 4px 10px;
            border-radius: 8px;
            color: #374151;
            font-size: 14px;
            text-decoration: none;
            transition: all 0.2s;
        }

        .menu-link:hover {
            background: #f3f4f6;
            color: #111827;
        }

        .menu-icon {
            font-size: 18px;
        }

        /* Submenu Styling */
        .menu-sub {
            display: none;
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .menu-item.open>.menu-sub {
            display: block;
        }

        .menu-sub .menu-link {
            padding-left: 45px;
            font-size: 13px;
            color: #6b7280;
        }

        /* Active State Logic */
        .menu-item.active>.menu-link {
            background-color: #111827 !important;
            color: #ffffff !important;
        }

        .menu-item.active>.menu-link .menu-icon {
            color: #ffffff !important;
        }

        .dropdown-arrow {
            transition: transform 0.3s;
        }

        .menu-item.open .dropdown-arrow {
            transform: rotate(180deg);
        }

        .layout-content {
            margin-left: 250px;
            padding: 2rem;
            min-height: 100vh;
        }
    </style>
</head>

<body>
    <aside id="layout-menu">
        <div class="app-brand">
            <span class="app-brand-text">Inventaris</span>
        </div>

        <ul class="menu-inner">
            <li class="menu-header">Home</li>
            <li class="menu-item {{ Route::is('admin.dashboard') || Route::is('staff.dashboard') ? 'active' : '' }}">
                <a href="{{ auth()->user()->role === 'admin' ? route('admin.dashboard') : route('staff.dashboard') }}"
                    class="menu-link">
                    <i class="menu-icon mdi mdi-home-outline"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="menu-header">Data</li>

            @if (auth()->user()->role === 'admin')
                <li class="menu-item {{ Route::is('category.index') ? 'active' : '' }}">
                    <a href="{{ route('category.index') }}" class="menu-link">
                        <i class="menu-icon mdi mdi-tag-outline"></i>
                        <span>Categories</span>
                    </a>
                </li>

                <li class="menu-item {{ Route::is('item.index') ? 'active' : '' }}">
                    <a href="{{ route('item.index') }}" class="menu-link">
                        <i class="menu-icon mdi mdi-cube-outline"></i>
                        <span>Items</span>
                    </a>
                </li>
            @endif

            <li class="menu-item {{ Route::is('lending.index') ? 'active' : '' }}">
                <a href="{{ route('lending.index') }}" class="menu-link">
                    <i class="menu-icon mdi mdi-swap-horizontal"></i>
                    <span>Lendings</span>
                </a>
            </li>

            <li class="menu-item">
                <a href="#" class="menu-link menu-toggle">
                    <i class="menu-icon mdi mdi-account-group-outline"></i>
                    <span>Users</span>
                    <i class="mdi mdi-chevron-down ms-auto dropdown-arrow"></i>
                </a>
                <ul class="menu-sub">
                    @if (auth()->user()->role === 'admin')
                        <li class="menu-item {{ Route::is('admin-account.index') ? 'active' : '' }}">
                            <a href="{{ route('admin-account.index') }}" class="menu-link">
                                <span>Admin</span>
                            </a>
                        </li>
                    @endif
                    <li class="menu-item {{ Route::is('operator-account.index') ? 'active' : '' }}">
                        <a href="{{ route('operator-account.index') }}" class="menu-link">
                            <span>Operator</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </aside>

    @include('layout.navbar')

    <main class="layout-content">
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menuToggles = document.querySelectorAll('.menu-toggle');

            menuToggles.forEach(toggle => {
                toggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    const parentItem = this.closest('.menu-item');
                    parentItem.classList.toggle('open');
                });
            });
        });
    </script>
</body>

</html>
