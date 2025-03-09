<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KasirPro - Sistem POS Modern</title>
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .product-card:hover {
            transform: translateY(-4px);
            transition: all 0.3s ease;
        }

        .category-pill:hover {
            background-color: rgba(59, 130, 246, 0.1);
            transition: all 0.3s ease;
        }

        .payment-method-button:hover {
            border-color: rgba(59, 130, 246, 0.5);
            transition: all 0.2s ease;
        }
    </style>
</head>

<body class="bg-gray-50 h-screen flex flex-col overflow-hidden">

    <!-- Header -->
    <header class="bg-gradient-to-r from-blue-600 to-blue-800 text-white shadow-lg">
        <div class="mx-auto px-4 py-3 flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z">
                    </path>
                </svg>
                <div>
                    <h1 class="font-bold text-xl">SellPoint</h1>
                </div>
            </div>

            <div class="flex items-center space-x-6">
                <div class="text-right mr-4">
                    <p class="text-sm">Toko Barokah Jaya</p>
                    <p class="text-xs text-blue-100">Jl. Merdeka No. 123</p>
                </div>

                <div class="flex items-center space-x-3">
                    <div class="relative">
                        <button class="text-white focus:outline-none">
                            <i class="fas fa-bell text-lg"></i>
                            <span
                                class="absolute -top-2 -right-2 bg-red-500 text-white text-xs font-bold rounded-full h-4 w-4 flex items-center justify-center">3</span>
                        </button>
                    </div>

                    <div class="flex items-center space-x-2">
                        <div
                            class="bg-white text-blue-800 rounded-full h-8 w-8 flex items-center justify-center font-bold shadow-md">
                            A
                        </div>
                        <div class="md:block hidden">
                            <p class="text-sm font-medium">Ahmad</p>
                            <p class="text-xs text-blue-100">Kasir</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    {{ $slot }}

</body>

</html>
