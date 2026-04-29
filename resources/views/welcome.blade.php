<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EmpManager — Smart Employee Management</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-gray-800 font-sans antialiased">

<!-- Navbar -->
<nav class="fixed top-0 w-full z-50 bg-white/80 backdrop-blur border-b border-gray-100 shadow-sm">
    <div class="max-w-6xl mx-auto px-6 py-4 flex items-center justify-between">
        <span class="text-xl font-bold text-blue-600">⚡ EmpManager</span>
        <div class="flex items-center gap-4">
            <a href="/login" class="text-sm text-gray-600 hover:text-blue-600 transition">Login</a>
            <a href="/register" class="text-sm bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">Get Started</a>
        </div>
    </div>
</nav>

<!-- Hero -->
<section class="min-h-screen flex items-center bg-gradient-to-br from-blue-50 via-white to-indigo-50 pt-20">
    <div class="max-w-6xl mx-auto px-6 grid md:grid-cols-2 gap-12 items-center">
        <div>
            <span class="inline-block bg-blue-100 text-blue-700 text-xs font-semibold px-3 py-1 rounded-full mb-4">🚀 Modern HR Solution</span>
            <h1 class="text-5xl font-extrabold text-gray-900 leading-tight mb-5">
                Manage Your <span class="text-blue-600">Employees</span><br>Smarter & Faster
            </h1>
            <p class="text-gray-500 text-lg mb-8 leading-relaxed">
                A powerful, clean, and intuitive employee management system built for modern teams. Track, manage, and grow your workforce effortlessly.
            </p>
            <div class="flex gap-4">
                <a href="/register" class="bg-blue-600 text-white px-6 py-3 rounded-xl font-semibold hover:bg-blue-700 transition shadow-md">Get Started Free</a>
                <a href="/login" class="border border-gray-200 text-gray-700 px-6 py-3 rounded-xl font-semibold hover:bg-gray-50 transition">Login →</a>
            </div>
            <!-- Stats -->
            <div class="flex gap-8 mt-10">
                <div>
                    <p class="text-2xl font-bold text-gray-900">500+</p>
                    <p class="text-sm text-gray-400">Companies</p>
                </div>
                <div class="border-l border-gray-200 pl-8">
                    <p class="text-2xl font-bold text-gray-900">10k+</p>
                    <p class="text-sm text-gray-400">Employees Managed</p>
                </div>
                <div class="border-l border-gray-200 pl-8">
                    <p class="text-2xl font-bold text-gray-900">99%</p>
                    <p class="text-sm text-gray-400">Satisfaction</p>
                </div>
            </div>
        </div>
        <!-- Hero Visual -->
        <div class="hidden md:flex justify-center">
            <div class="bg-white rounded-2xl shadow-2xl p-6 w-full max-w-sm border border-gray-100">
                <div class="flex items-center justify-between mb-4">
                    <span class="font-semibold text-gray-700">Employee Overview</span>
                    <span class="text-xs bg-green-100 text-green-600 px-2 py-1 rounded-full">● Live</span>
                </div>
                <div class="space-y-3">
                    <div class="flex items-center gap-3 p-3 rounded-lg bg-gray-50">
                        <div class="w-9 h-9 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold text-sm flex-shrink-0">J</div>
                        <div class="flex-1"><p class="text-sm font-medium text-gray-800">John Smith</p><p class="text-xs text-gray-400">Software Engineer</p></div>
                        <span class="text-xs bg-blue-50 text-blue-600 px-2 py-1 rounded-full">Tech</span>
                    </div>
                    <div class="flex items-center gap-3 p-3 rounded-lg bg-gray-50">
                        <div class="w-9 h-9 rounded-full bg-purple-600 text-white flex items-center justify-center font-bold text-sm flex-shrink-0">S</div>
                        <div class="flex-1"><p class="text-sm font-medium text-gray-800">Sara Ahmed</p><p class="text-xs text-gray-400">Product Manager</p></div>
                        <span class="text-xs bg-purple-50 text-purple-600 px-2 py-1 rounded-full">Product</span>
                    </div>
                    <div class="flex items-center gap-3 p-3 rounded-lg bg-gray-50">
                        <div class="w-9 h-9 rounded-full bg-green-600 text-white flex items-center justify-center font-bold text-sm flex-shrink-0">R</div>
                        <div class="flex-1"><p class="text-sm font-medium text-gray-800">Rahim Khan</p><p class="text-xs text-gray-400">UI/UX Designer</p></div>
                        <span class="text-xs bg-green-50 text-green-600 px-2 py-1 rounded-full">Design</span>
                    </div>
                </div>
                <div class="mt-4 pt-4 border-t flex justify-between text-sm text-gray-500">
                    <span>Total: <strong class="text-gray-800">3 employees</strong></span>
                    <span class="text-blue-600 cursor-pointer">View all →</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features -->
<section class="py-24 bg-white">
    <div class="max-w-6xl mx-auto px-6">
        <div class="text-center mb-14">
            <h2 class="text-3xl font-bold text-gray-900 mb-3">Everything You Need</h2>
            <p class="text-gray-400 text-lg">Powerful features to manage your team with ease</p>
        </div>
        <div class="grid md:grid-cols-3 gap-8">
            <div class="p-6 rounded-2xl border border-gray-100 hover:shadow-lg transition">
                <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-xl flex items-center justify-center text-2xl mb-4">👥</div>
                <h3 class="font-semibold text-gray-800 mb-2">Employee CRUD</h3>
                <p class="text-gray-400 text-sm">Add, edit, view and delete employees with a clean and intuitive interface.</p>
            </div>
            <div class="p-6 rounded-2xl border border-gray-100 hover:shadow-lg transition">
                <div class="w-12 h-12 bg-green-100 text-green-600 rounded-xl flex items-center justify-center text-2xl mb-4">📊</div>
                <h3 class="font-semibold text-gray-800 mb-2">Live Dashboard</h3>
                <p class="text-gray-400 text-sm">Real-time stats on salary, positions, and headcount at a glance.</p>
            </div>
            <div class="p-6 rounded-2xl border border-gray-100 hover:shadow-lg transition">
                <div class="w-12 h-12 bg-purple-100 text-purple-600 rounded-xl flex items-center justify-center text-2xl mb-4">🔒</div>
                <h3 class="font-semibold text-gray-800 mb-2">Secure Auth</h3>
                <p class="text-gray-400 text-sm">Built-in authentication with Laravel Breeze to keep your data safe.</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="py-20 bg-blue-600">
    <div class="max-w-3xl mx-auto px-6 text-center">
        <h2 class="text-3xl font-bold text-white mb-4">Ready to Get Started?</h2>
        <p class="text-blue-100 mb-8">Join hundreds of companies managing their teams with EmpManager.</p>
        <a href="/register" class="bg-white text-blue-600 font-semibold px-8 py-3 rounded-xl hover:bg-blue-50 transition shadow-md">Create Free Account</a>
    </div>
</section>

<!-- Footer -->
<footer class="bg-gray-900 text-gray-400 py-8 text-center text-sm">
    © 2026 EmpManager. Built with ❤️ using Laravel & Vue.js
</footer>

<div id="app" style="display:none"></div>

<script>
// Simple inline Vue for the hero demo card (no build needed for static data)
</script>

</body>
</html>
