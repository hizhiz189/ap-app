<?php
$pageTitle = 'Dashboard';
$permissions = $_SESSION['permissions'] ?? [];
$user = AuthMiddleware::getUser();

$content = <<<HTML
<div class="min-h-screen bg-gray-50">
    <!-- Navbar -->
    <nav class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0 flex items-center">
                        <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center mr-3">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                        </div>
                        <span class="text-xl font-bold text-gray-900">AP App</span>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <!-- User Info -->
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <div class="hidden md:block">
                            <p class="text-sm font-medium text-gray-900">{$user['name']}</p>
                            <p class="text-xs text-gray-500">{$user['role']}</p>
                        </div>
                    </div>
                    <!-- Logout Button -->
                    <a href="{$_ENV['APP_URL']}/logout" 
                        class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        Đăng xuất
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="px-4 py-6 sm:px-0">
            <!-- Welcome Card -->
            <div class="bg-white rounded-2xl shadow-sm p-6 mb-6">
                <h1 class="text-2xl font-bold text-gray-900 mb-2">
                    Xin chào, {$user['name']}!
                </h1>
                <p class="text-gray-600">
                    Chào mừng bạn đến với trang quản lý AP App. Vai trò của bạn: 
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                        {$user['role']}
                    </span>
                </p>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <!-- Card 1 -->
                <div class="bg-white rounded-2xl shadow-sm p-6">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Tổng quan</p>
                            <p class="text-2xl font-semibold text-gray-900">Dashboard</p>
                        </div>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="bg-white rounded-2xl shadow-sm p-6">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Trạng thái</p>
                            <p class="text-2xl font-semibold text-gray-900">Hoạt động</p>
                        </div>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="bg-white rounded-2xl shadow-sm p-6">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Thời gian</p>
                            <p class="text-2xl font-semibold text-gray-900">{$user['role_name']}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Permissions Info -->
            <div class="bg-white rounded-2xl shadow-sm p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Quyền hạn của bạn</h2>
                <div class="flex flex-wrap gap-2">
HTML;

foreach ($permissions as $perm) {
    $content .= '<span class="px-3 py-1 bg-gray-100 text-gray-700 rounded-lg text-sm">' . $perm . '</span>';
}

$content .= <<<HTML
                </div>
            </div>

            <!-- Menu by Role -->
            <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
HTML;

// Admin Menu
if (in_array('users', $permissions)) {
    $content .= <<<HTML
                <div class="bg-white rounded-2xl shadow-sm p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Quản lý</h3>
                    <ul class="space-y-3">
                        <li>
                            <a href="#" class="flex items-center text-gray-600 hover:text-blue-600 transition">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                </svg>
                                Quản lý người dùng
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center text-gray-600 hover:text-blue-600 transition">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                Cài đặt hệ thống
                            </a>
                        </li>
                    </ul>
                </div>
HTML;
}

// Reports Menu
if (in_array('reports', $permissions)) {
    $content .= <<<HTML
                <div class="bg-white rounded-2xl shadow-sm p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Báo cáo</h3>
                    <ul class="space-y-3">
                        <li>
                            <a href="#" class="flex items-center text-gray-600 hover:text-blue-600 transition">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                Xem báo cáo
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center text-gray-600 hover:text-blue-600 transition">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                </svg>
                                Xuất báo cáo
                            </a>
                        </li>
                    </ul>
                </div>
HTML;
}

$content .= <<<HTML
            </div>
        </div>
    </main>
</div>
HTML;
