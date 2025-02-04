<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>ETLE - @yield('title')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
</head>
<body class="font-sans antialiased bg-[#0a0d0f] text-white w-full mx-auto max-w-7xl min-h-screen flex flex-col items-center justify-center py-4">
    <header class="bg-[#141719] rounded-sm flex flex-col gap-0 px-4 py-3 mb-4 w-full">
        <p class="m-0">Dashboard ETLE</p>
        <p class="text-2xl font-bold m-0">POLDA</p>
    </header>

    <div class="flex flex-col lg:flex-row justify-center gap-6 px-0 lg:px-0 w-full">
        <div class="w-full lg:w-3/4">
            @yield('content')
        </div>

        <div class="relative lg:w-1/2">
            <div id="risk_matrix" class="md:fixed text-center md:w-[30%] lg:w-[32%] xl:w-[35%] 2xl:w-[26%] bg-[#141719] rounded-sm px-4 py-8">
                <h1 class="text-2xl font-bold mb-4">Risk Matrix - Distribusi Kendaraan</h1>
                <div class="flex justify-center">
                    <div class="grid grid-cols-4 w-full max-w-4xl">
                        <p class="absolute left-[-10px] top-[45%] -translate-y-1/2 rotate-[-90deg] text-xl font-bold">
                            Likelihood
                        </p>

                        <p class="flex flex-col justify-center items-end mr-5">Low</p>
                        <div class="h-32 cursor-pointer bg-[#18bc3c] hover:bg-green-600 border-1 border-black flex flex-col justify-center text-base text-black">
                            <div class="flex flex-col">
                                <p class="m-0">
                                    X1Y3
                                </p>
                                <div class="border-1 border-black w-1/2 mx-auto m-0"></div>
                                <p class="m-0">2</p>
                            </div>
                        </div>
                        <div class="h-32 cursor-pointer bg-[#f1ec0c] hover:bg-yellow-600 border-1 border-black flex flex-col justify-center text-base text-black">
                            <div class="flex flex-col">
                                <p class="m-0">
                                    X2Y3
                                </p>
                                <div class="border-1 border-black w-1/2 mx-auto m-0"></div>
                                <p class="m-0">10</p>
                            </div>
                        </div>
                        <div class="h-32 cursor-pointer bg-[#ed0b07] hover:bg-red-600 border-1 border-black flex flex-col justify-center text-base text-white">
                            <div class="flex flex-col">
                                <p class="m-0">
                                    X3Y3
                                </p>
                                <div class="border-1 border-white w-1/2 mx-auto m-0"></div>
                                <p class="m-0">21</p>
                            </div>
                        </div>

                        <p class="flex flex-col justify-center items-end mr-5">Medium</p>
                        <div class="h-32 cursor-pointer bg-[#18bc3c] hover:bg-green-600 border-1 border-black flex flex-col justify-center text-base text-black">
                            <div class="flex flex-col">
                                <p class="m-0">
                                    X1Y2
                                </p>
                                <div class="border-1 border-black w-1/2 mx-auto m-0"></div>
                                <p class="m-0">9</p>
                            </div>
                        </div>
                        <div class="h-32 cursor-pointer bg-[#f1ec0c] hover:bg-yellow-600 border-1 border-black flex flex-col justify-center text-base text-black">
                            <div class="flex flex-col">
                                <p class="m-0">
                                    X2Y2
                                </p>
                                <div class="border-1 border-black w-1/2 mx-auto m-0"></div>
                                <p class="m-0">14</p>
                            </div>
                        </div>
                        <div class="h-32 cursor-pointer bg-[#f1ec0c] hover:bg-yellow-600 border-1 border-black flex flex-col justify-center text-base text-black">
                            <div class="flex flex-col">
                                <p class="m-0">
                                    X3Y2
                                </p>
                                <div class="border-1 border-black w-1/2 mx-auto m-0"></div>
                                <p class="m-0">10</p>
                            </div>
                        </div>

                        <p class="flex flex-col justify-center items-end mr-5">High</p>
                        <div class="h-32 cursor-pointer bg-[#18bc3c] hover:bg-green-600 border-1 border-black flex flex-col justify-center text-base text-black">
                            <div class="flex flex-col">
                                <p class="m-0">
                                    X1Y1
                                </p>
                                <div class="border-1 border-black w-1/2 mx-auto m-0"></div>
                                <p class="m-0">22</p>
                            </div>
                        </div>
                        <div class="h-32 cursor-pointer bg-[#18bc3c] hover:bg-green-600 border-1 border-black flex flex-col justify-center text-base text-black">
                            <div class="flex flex-col">
                                <p class="m-0">
                                    X2Y1
                                </p>
                                <div class="border-1 border-black w-1/2 mx-auto m-0"></div>
                                <p class="m-0">9</p>
                            </div>
                        </div>
                        <div class="h-32 cursor-pointer bg-[#f1ec0c] hover:bg-yellow-600 border-1 border-black flex flex-col justify-center text-base text-black">
                            <div class="flex flex-col">
                                <p class="m-0">
                                    X3Y1
                                </p>
                                <div class="border-1 border-black w-1/2 mx-auto m-0"></div>
                                <p class="m-0">2</p>
                            </div>
                        </div>

                        <div></div>
                        <p class="mt-3">Low</p>
                        <p class="mt-3">Medium</p>
                        <p class="mt-3">High</p>

                        <div></div>
                        <p></p>
                        <p class="font-bold text-xl -mt-1">Impact</p>
                        <p></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @stack('scripts')
</body>
</html>
