<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Natural Shop — @yield('title', 'Cosmétiques Naturels')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        sage: {
                            50:  '#f4f7f2',
                            100: '#e7efe3',
                            200: '#cfe0c8',
                            300: '#adc9a1',
                            400: '#84ad76',
                            500: '#5f9154',
                            600: '#4a7541',
                            700: '#3c5e35',
                            800: '#324c2d',
                            900: '#2a3f26',
                        },
                        cream: {
                            50:  '#fdfcf8',
                            100: '#faf7ef',
                            200: '#f4edda',
                            300: '#ebdebe',
                            400: '#dfc99a',
                        },
                        earth: {
                            500: '#8b6f47',
                            600: '#73593a',
                            700: '#5c4730',
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'ui-sans-serif', 'system-ui'],
                        serif: ['Georgia', 'ui-serif'],
                    }
                }
            }
        }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #fdfcf8; }
        .cart-badge { animation: pop 0.2s ease; }
        @keyframes pop { 0%,100%{transform:scale(1)} 50%{transform:scale(1.25)} }
    </style>
</head>
<body class="text-gray-800">

    @include('partials.navbar')

    {{-- Flash messages --}}
    @if(session('success'))
        <div id="flash-success" class="fixed top-20 right-4 z-50 bg-sage-600 text-white px-5 py-3 rounded-xl shadow-lg flex items-center gap-2 text-sm font-medium">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            {{ session('success') }}
        </div>
        <script>setTimeout(()=>{ const el=document.getElementById('flash-success'); if(el) el.style.opacity='0'; },3000);</script>
    @endif

    @if(session('error'))
        <div id="flash-error" class="fixed top-20 right-4 z-50 bg-red-500 text-white px-5 py-3 rounded-xl shadow-lg flex items-center gap-2 text-sm font-medium">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            {{ session('error') }}
        </div>
        <script>setTimeout(()=>{ const el=document.getElementById('flash-error'); if(el) el.style.opacity='0'; },3000);</script>
    @endif

    <main class="min-h-screen">
        @yield('content')
    </main>

    @include('partials.footer')

</body>
</html>