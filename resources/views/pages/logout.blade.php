<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded shadow text-center">
        <h2 class="text-xl font-bold mb-4">Logout</h2>
        <button id="logoutBtn"
            class="bg-red-600 text-white px-6 py-2 rounded hover:bg-red-700 font-semibold">Logout</button>
    </div>
    <form id="logoutForm" method="POST" action="{{ route('logout.submit') }}" style="display:none;">
        @csrf
    </form>
    <script>
        document.getElementById('logoutBtn').addEventListener('click', function() {
            if (confirm('Apakah Anda yakin ingin logout?')) {
                document.getElementById('logoutForm').submit();
            }
        });
    </script>
</body>

</html>
