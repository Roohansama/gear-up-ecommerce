<!-- Sidebar: scrolls independently -->
<aside class="w-64 border-r overflow-y-auto select-none scrollbar-hide hidden md:block bg-white shadow">
    <div class="p-6">
        <!-- Admin User -->
        <div class="flex items-center space-x-4 text-lg text-text mb-8 mt-4 px-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                 stroke-width="1.5" stroke="currentColor" class="size-6 text-accent-500">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
            </svg>
            <span>Admin</span>
        </div>

        <nav class="space-y-2 text-sm">
            <!-- Dashboard -->
            <a href="#"
               class="flex items-center space-x-4 text-gray-700 transition-colors group rounded-md hover:bg-gray-100 px-3 py-2">
                <span class="text-accent opacity-70 group-hover:opacity-100">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                         stroke-width="1.5" stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M3 3h18v18H3V3z"/>
                    </svg>
                </span>
                <span class="group-hover:text-gray-900">Dashboard</span>
            </a>

            <!-- Products -->
            <div class="mt-4 mb-1 px-3 text-xs text-gray-400 uppercase">Products</div>
            <a href="#" class="flex items-center space-x-4 group text-gray-700 hover:bg-gray-100 rounded-md px-3 py-2">
                <span class="text-accent group-hover:opacity-100 opacity-70">
                    📦
                </span>
                <span>All Products</span>
            </a>
            <a href="{{route('product.add')}}" class="flex items-center space-x-4 group text-gray-700 hover:bg-gray-100 rounded-md px-3 py-2">
                <span class="text-accent group-hover:opacity-100 opacity-70">
                    ➕
                </span>
                <span>Add Product</span>
            </a>
            <a href="#" class="flex items-center space-x-4 group text-gray-700 hover:bg-gray-100 rounded-md px-3 py-2">
                <span class="text-accent group-hover:opacity-100 opacity-70">
                    🗂️
                </span>
                <span>Categories</span>
            </a>

            <!-- Orders -->
            <div class="mt-4 mb-1 px-3 text-xs text-gray-400 uppercase">Orders</div>
            <a href="#" class="flex items-center space-x-4 group text-gray-700 hover:bg-gray-100 rounded-md px-3 py-2">
                <span class="text-accent group-hover:opacity-100 opacity-70">
                    📋
                </span>
                <span>All Orders</span>
            </a>
            <a href="#" class="flex items-center space-x-4 group text-gray-700 hover:bg-gray-100 rounded-md px-3 py-2">
                <span class="text-accent group-hover:opacity-100 opacity-70">
                    ⏳
                </span>
                <span>Pending Orders</span>
            </a>

            <!-- Customers -->
            <div class="mt-4 mb-1 px-3 text-xs text-gray-400 uppercase">Customers</div>
            <a href="#" class="flex items-center space-x-4 group text-gray-700 hover:bg-gray-100 rounded-md px-3 py-2">
                <span class="text-accent group-hover:opacity-100 opacity-70">
                    👤
                </span>
                <span>Customer List</span>
            </a>

            <!-- Settings -->
            <div class="mt-4 mb-1 px-3 text-xs text-gray-400 uppercase">Settings</div>
            <a href="#" class="flex items-center space-x-4 group text-gray-700 hover:bg-gray-100 rounded-md px-3 py-2">
                <span class="text-accent group-hover:opacity-100 opacity-70">
                    ⚙️
                </span>
                <span>Store Settings</span>
            </a>

            <!-- Logout -->
            <form action="#" method="POST" class="mt-6">
                @csrf
                <button type="submit"
                        class="w-full flex items-center space-x-4 text-red-600 hover:bg-red-50 rounded-md px-3 py-2 transition-colors">
                    <span>🚪</span>
                    <span>Logout</span>
                </button>
            </form>
        </nav>
    </div>
</aside>
