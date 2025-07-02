<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Keuangan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="api-base-url" content="{{ $apiBaseUrl }}">
</head>

<body class="bg-gradient-to-br from-indigo-600 to-blue-400 min-h-screen flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-lg p-8 w-full max-w-md">
        <h2 class="text-2xl font-bold text-center text-indigo-500 mb-6">LOGIN KEUANGAN</h2>
        <form id="loginForm">
            <div class="mb-4">
                <label class="block text-gray-700 mb-2" for="email">Email</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <!-- Email Icon -->
                        <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <rect width="20" height="16" x="2" y="4" rx="2" />
                            <path d="M22 6l-10 7L2 6" />
                        </svg>
                    </span>
                    <input type="email" name="email" id="email" required autofocus
                        class="w-full pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400" />
                </div>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 mb-2" for="password">Password</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <!-- Lock Icon -->
                        <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <rect x="5" y="11" width="14" height="8" rx="2" />
                            <path d="M8 11V7a4 4 0 1 1 8 0v4" />
                        </svg>
                    </span>
                    <input type="password" name="password" id="password" required
                        class="w-full pl-10 pr-10 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400" />
                    <button type="button" onclick="togglePassword()"
                        class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-indigo-700 focus:outline-none">
                        <!-- Eye Icon (show/hide) -->
                        <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path id="eyeOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path id="eyeOpen2" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>
                </div>
            </div>
            <div class="mb-6 flex items-center justify-between">
                <label class="flex items-center gap-2">
                    <input type="checkbox" name="remember" class="form-checkbox text-indigo-600">
                    <span class="text-gray-700">Remember me</span>
                </label>
                <a href="#" class="text-indigo-600 hover:underline text-sm">Forgot Password?</a>
            </div>
            <button type="submit"
                class="w-full bg-indigo-700 hover:bg-indigo-800 text-white font-bold py-2 px-4 rounded-lg transition">
                Login
            </button>
        </form>
    </div>
    <script>
        function togglePassword() {
            const pw = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');
            if (pw.type === 'password') {
                pw.type = 'text';
                eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.956 9.956 0 012.293-3.95m3.249-2.383A9.956 9.956 0 0112 5c4.477 0 8.268 2.943 9.542 7a9.956 9.956 0 01-4.043 5.306M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 3l18 18" />
                `;
            } else {
                pw.type = 'password';
                eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                `;
            }
        }

        document.getElementById('loginForm').onsubmit = async function(e) {
            e.preventDefault();
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const apiBaseUrl = document.querySelector('meta[name="api-base-url"]').content;
            const response = await fetch(`${apiBaseUrl}/api/login`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    login: email,
                    password
                })
            });
            const data = await response.json();
            if (response.ok && data.token) {
                localStorage.setItem('token', data.token);
                window.location.href = '/';
            } else {
                alert(data.message || 'Login gagal');
            }
        }
    </script>
</body>

</html>
