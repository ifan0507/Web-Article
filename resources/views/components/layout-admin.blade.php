<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
    {{-- <link rel="stylesheet" href="{{ css('assets/css/style.css') }}"> --}}
    <script src="assets/js/jquery-3.7.1.js"></script>
    <script src="assets/js/sweetalert2.all.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>
    <script src="assets/js/myscript.js"></script>
    <title>Admin | {{ $title }}</title>
</head>

<body class="bg-white dark:bg-gray-900">
    <div class="antialiased bg-gray-50 dark:bg-gray-900">
        <x-nav-admin></x-nav-admin>
        <!-- Sidebar -->
        <x-sidebar></x-sidebar>

        <main class="p-4 md:ml-64 h-auto pt-16">

            {{-- <x-header-main-admin>{{ $title }}</x-header-main-admin> --}}
            {{-- <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
                <div class="border-2 border-dashed border-gray-300 rounded-lg dark:border-gray-600 h-32 md:h-64"></div>
                <div class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-32 md:h-64"></div>
                <div class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-32 md:h-64"></div>
                <div class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-32 md:h-64"></div>
            </div>
            <div class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-96 mb-4"></div>
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-72"></div>
                <div class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-72"></div>
                <div class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-72"></div>
                <div class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-72"></div>
            </div>
            <div class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-96 mb-4"></div>
            <div class="grid grid-cols-2 gap-4">
                <div class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-72"></div>
                <div class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-72"></div>
                <div class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-72"></div>
                <div class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-72"></div>
            </div> --}}
            {{ $slot }}
        </main>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
            var themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');
            var themeToggleBtn = document.getElementById('theme-toggle');

            // Function to apply the theme based on local storage
            function applyTheme() {
                var savedTheme = localStorage.getItem('color-theme');
                var prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

                if (savedTheme === 'dark' || (!savedTheme && prefersDark)) {
                    document.documentElement.classList.add('dark');
                    themeToggleDarkIcon.classList.add('hidden');
                    themeToggleLightIcon.classList.remove('hidden');
                } else {
                    document.documentElement.classList.remove('dark');
                    themeToggleDarkIcon.classList.remove('hidden');
                    themeToggleLightIcon.classList.add('hidden');
                }
            }

            // Apply the theme on page load
            applyTheme();

            // Event listener for the theme toggle button
            themeToggleBtn.addEventListener('click', function() {
                var isDarkMode = document.documentElement.classList.contains('dark');

                if (isDarkMode) {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('color-theme', 'light');
                    themeToggleDarkIcon.classList.remove('hidden');
                    themeToggleLightIcon.classList.add('hidden');
                } else {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('color-theme', 'dark');
                    themeToggleDarkIcon.classList.add('hidden');
                    themeToggleLightIcon.classList.remove('hidden');
                }
            });
        });
    </script>

</body>

</html>
