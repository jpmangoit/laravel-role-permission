<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    <div x-data="{ sidebarOpen: true }" class="min-h-screen">
        <!-- Sidebar -->
        <div :class="{'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen}"
             class="fixed top-0 left-0 z-30 w-64 h-screen transition-transform bg-gray-900 transform duration-300 ease-in-out">
            <div class="flex items-center justify-between p-4 text-white">
                <h1 class="text-xl font-bold">Admin Panel</h1>
                <button @click="sidebarOpen = false" class="lg:hidden">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <nav class="mt-4">
                <a href="{{ route('admin.dashboard') }}" 
                   class="flex items-center px-6 py-3 text-white hover:bg-gray-800 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-800' : '' }}">
                    <i class="fas fa-tachometer-alt w-6"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('admin.users.index') }}" 
                   class="flex items-center px-6 py-3 text-white hover:bg-gray-800 {{ request()->routeIs('admin.users.*') ? 'bg-gray-800' : '' }}">
                    <i class="fas fa-users w-6"></i>
                    <span>Users</span>
                </a>
                <a href="{{ route('admin.roles.index') }}" 
                   class="flex items-center px-6 py-3 text-white hover:bg-gray-800 {{ request()->routeIs('admin.roles.*') ? 'bg-gray-800' : '' }}">
                    <i class="fas fa-user-shield w-6"></i>
                    <span>Roles</span>
                </a>
            </nav>
        </div>

        <!-- Main Content -->
        <div :class="{'ml-64': sidebarOpen}" class="transition-margin duration-300 ease-in-out">
            <!-- Top Navigation -->
            <header class="bg-white shadow">
                <div class="flex items-center justify-between px-4 py-3">
                    <button @click="sidebarOpen = !sidebarOpen" class="text-gray-500 hover:text-gray-600">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div class="flex items-center">
                        <span class="mr-3">{{ auth()->user()->name }}</span>
                        <form action="{{ route('admin.logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="text-red-600 hover:text-red-700">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="p-6">
                @if(session('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                        {{ session('error') }}
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    @stack('scripts')
</body>
</html>
