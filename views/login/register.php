<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookMaster - Register</title>
    <!-- Include Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .library-bg {
            background-image: url('/Bookmaster/public/images/fondo.jpg');
            background-size: cover;
            background-position: center;
        }
    </style>
</head>
<body class="h-screen library-bg">
    <div class="flex items-center justify-center h-full w-full bg-black/50">
        <div class="bg-gray-900/80 p-8 rounded-lg shadow-xl w-full max-w-md text-center backdrop-blur">
            <div class="mb-8">
                <div class="w-24 h-24 rounded-full bg-gray-200 mx-auto flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
            </div>
            
            <form class="space-y-6" method="post" action="/Bookmaster/index.php?view=register&action=register">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <input type="text" name="name" id="name" placeholder="NOMBRE COMPLETO" required
                        class="bg-gray-700/50 text-white pl-10 pr-4 py-2 border border-gray-600 rounded-md w-full placeholder-gray-400 focus:outline-none focus:border-blue-500">
                </div>
                
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <input type="email" name="email" id="email" placeholder="EMAIL ID" required
                        class="bg-gray-700/50 text-white pl-10 pr-4 py-2 border border-gray-600 rounded-md w-full placeholder-gray-400 focus:outline-none focus:border-blue-500">
                </div>
                
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <input type="password" name="password" id="password" placeholder="PASSWORD" required
                        class="bg-gray-700/50 text-white pl-10 pr-4 py-2 border border-gray-600 rounded-md w-full placeholder-gray-400 focus:outline-none focus:border-blue-500">
                </div>
                
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <input type="password" name="confirm_password" id="confirm_password" placeholder="CONFIRMAR PASSWORD" required
                        class="bg-gray-700/50 text-white pl-10 pr-4 py-2 border border-gray-600 rounded-md w-full placeholder-gray-400 focus:outline-none focus:border-blue-500">
                </div>
                
                <div>
                    <button type="submit" name="register" class="w-full bg-gray-800 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-md transition duration-300">
                        REGISTRARSE
                    </button>
                </div>

                <div class="text-gray-400 text-sm mt-4">
                    ¿Ya tienes cuenta? <a href="/Bookmaster/index.php?view=login" class="text-blue-500 hover:underline">Inicia sesión aquí</a>
                </div>
                
            </form>
        </div>
    </div>
</body>
</html>
