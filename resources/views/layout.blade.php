<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Quick Cleaners</title>
</head>

<body class="bg-gray-50">

    <nav class="w-full h-16 border-b-2 border-black px-6 grid grid-cols-6 items-center">
        <div class="col-span-2">
            <h1 class="text-2xl font-bold tracking-tight">Quick Cleaners</h1>
        </div>
        <div class="col-span-2 col-start-3">
            <div class="flex gap-2">
                <a href="{{ route('home') }}"
                    class="px-4 py-2 border-2 border-black hover:bg-black hover:text-white transition-colors">
                    Início
                </a>
                <a href="{{ route('find.cleaners') }}"
                    class="px-4 py-2 border-2 border-black hover:bg-black hover:text-white transition-colors">
                    Profissional da limpeza
                </a>
            </div>
        </div>
        <div class="col-span-2 col-start-5 flex justify-end items-center gap-4">
            @if (Auth::check())
                <span class="text-sm font-medium">Bem-vindo, {{ Auth::user()->name }}!</span>
                <a href="{{ route('user.logout') }}"
                    class="px-4 py-2 border-2 border-black hover:bg-black hover:text-white transition-colors">
                    Sair
                </a>
            @else
                <a href="{{ route('user.login') }}"
                    class="px-4 py-2 border-2 border-black font-bold hover:bg-black hover:text-white transition-colors">
                    Login
                </a>
            @endif
        </div>
    </nav>

    <main class="container mx-auto p-6">
        <div id="modal-overlay" class="fixed inset-0 z-40 bg-black opacity-30 hidden"></div>

        <div id="general-modal" class="fixed inset-0 z-50 flex items-center justify-center p-4 hidden">
            <div
                class="relative w-full max-w-md bg-white border-4 border-black p-6 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">

                <div class="flex items-center justify-between mb-4 border-b-2 border-black pb-2">
                    <h3 id="modal-title" class="text-xl font-black uppercase">Aviso</h3>
                    <button onclick="closeModal()" class="text-black hover:text-red-600 font-bold cursor-pointer">
                        [ FECHAR ]
                    </button>
                </div>

                <div id="modal-body" class="text-gray-700 mb-4">
                </div>
            </div>
        </div>

        @yield('content')

        <div id="toast-container" class="fixed bottom-5 right-5 z-[100] flex flex-col gap-4">
            @if(session('success'))
                <script> window.onload = () => showToast('{{ session('success') }}', 'success'); </script>
            @endif

            @if(session('error'))
                <script> window.onload = () => showToast('{{ session('error') }}', 'error'); </script>
            @endif
        </div>
    </main>
    <script>
        function openModal(title, content) {
            document.getElementById('modal-title').innerText = title;
            document.getElementById('modal-body').innerHTML = content;

            document.getElementById('modal-overlay').classList.remove('hidden');
            document.getElementById('general-modal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('modal-overlay').classList.add('hidden');
            document.getElementById('general-modal').classList.add('hidden');
        }

        document.getElementById('modal-overlay').onclick = closeModal;


        function showToast(message, type = 'success') {
            const container = document.getElementById('toast-container');
            const bgColor = type === 'success' ? 'bg-green-400' : 'bg-red-400';
            const toast = document.createElement('div');

            toast.className = `${bgColor} border-4 border-black p-4 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] flex items-center justify-between min-w-[300px] transform transition-all duration-300 translate-x-full`;

            toast.innerHTML = `
            <span class="font-bold uppercase text-black text-sm">${message}</span>
            <button onclick="this.parentElement.remove()" class="ml-4 font-black cursor-pointer hover:text-white">X</button>
        `;

            container.appendChild(toast);

            setTimeout(() => {
                toast.classList.remove('translate-x-full');
            }, 10);

            setTimeout(() => {
                toast.classList.add('translate-x-full');
                setTimeout(() => toast.remove(), 300);
            }, 5000);
        }
    </script>
</body>

</html>