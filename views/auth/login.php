<?php
$pageTitle = 'Đăng nhập';
$content = <<<HTML
<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <!-- Logo & Title -->
        <div class="text-center">
            <div class="mx-auto w-16 h-16 bg-blue-600 rounded-2xl flex items-center justify-center">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
            </div>
            <h2 class="mt-6 text-3xl font-bold text-gray-900">Đăng nhập</h2>
            <p class="mt-2 text-sm text-gray-600">
                Đăng nhập vào tài khoản của bạn
            </p>
        </div>

        <!-- Error Message -->
        HTML;

if (isset($error)) {
    $content .= <<<HTML
        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl relative" role="alert">
            <span class="block sm:inline">{$error}</span>
        </div>
    HTML;
}

$content .= <<<HTML
        <!-- Login Form -->
        <form class="mt-8 space-y-6" action="{$_ENV['APP_URL']}/login/process" method="POST">
            <div class="space-y-4">
                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input id="email" name="email" type="email" autocomplete="email" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 outline-none"
                        placeholder="nhập email của bạn">
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Mật khẩu</label>
                    <input id="password" name="password" type="password" autocomplete="current-password" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 outline-none"
                        placeholder="nhập mật khẩu">
                </div>
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit"
                    class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-200">
                    Đăng nhập
                </button>
            </div>
        </form>

        <!-- Demo Info -->
        <div class="mt-6 p-4 bg-gray-100 rounded-xl">
            <p class="text-sm text-gray-600 text-center">
                <strong>Tài khoản demo:</strong><br>
                Email: <code class="bg-white px-2 py-1 rounded">admin@example.com</code><br>
                Mật khẩu: <code class="bg-white px-2 py-1 rounded">admin123</code>
            </p>
        </div>
    </div>
</div>
HTML;
