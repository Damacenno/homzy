<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Homzy</title>
</head>

<body class="bg-[#f4f0ec] text-black min-h-screen antialiased">

    <nav class="w-full bg-white border-b-4 border-black px-6 py-4 grid grid-cols-6 items-center sticky top-0 z-30 shadow-[0_4px_0_0_rgba(0,0,0,1)]">
        <div class="col-span-2">
            <h1 class="text-3xl font-black tracking-tighter uppercase inline-block bg-[#facc15] border-2 border-black px-3 py-1 shadow-[4px_4px_0_0_rgba(0,0,0,1)]">
                Homzy
            </h1>
        </div>
        
        <div class="col-span-2 col-start-3">
            <div class="flex gap-3">
                <a href="{{ route('home') }}"
                    class="px-4 py-2 border-2 border-black font-bold bg-white shadow-[4px_4px_0_0_rgba(0,0,0,1)] active:translate-x-[4px] active:translate-y-[4px] active:shadow-none block text-center">
                    Início
                </a>
                <a href="{{ route('find.cleaners') }}"
                    class="px-4 py-2 border-2 border-black font-bold bg-white shadow-[4px_4px_0_0_rgba(0,0,0,1)] active:translate-x-[4px] active:translate-y-[4px] active:shadow-none block text-center">
                    Profissional da limpeza
                </a>
            </div>
        </div>
        
        <div class="col-span-2 col-start-5 flex justify-end items-center gap-4">
            @if (Auth::check())
                <span class="text-sm font-black uppercase bg-white border-2 border-black px-3 py-1">
                    👤 {{ Auth::user()->name }}
                </span>
                <a href="{{ route('user.logout') }}"
                    class="px-4 py-2 border-2 border-black font-bold bg-red-400 shadow-[4px_4px_0_0_rgba(0,0,0,1)] active:translate-x-[4px] active:translate-y-[4px] active:shadow-none">
                    Sair
                </a>
            @else
                <a href="{{ route('user.login') }}"
                    class="px-4 py-2 border-2 border-black font-black uppercase bg-[#facc15] shadow-[4px_4px_0_0_rgba(0,0,0,1)] active:translate-x-[4px] active:translate-y-[4px] active:shadow-none">
                    Login
                </a>
            @endif
        </div>
    </nav>

    <main class="container mx-auto p-6 mt-4">
        <div id="modal-overlay" class="fixed inset-0 z-40 bg-black/40 hidden"></div>

        <div id="general-modal" class="fixed inset-0 z-50 flex items-center justify-center p-4 hidden">
            <div class="relative w-full max-w-md bg-white border-4 border-black p-6 shadow-[12px_12px_0px_0px_rgba(0,0,0,1)]">

                <div class="flex items-center justify-between gap-2 mb-4 border-b-4 border-black pb-2 bg-amber-200 -mx-6 -mt-6 p-4">
                    <h3 id="modal-title" class="text-md font-black uppercase tracking-tight">Aviso</h3>
                    <button onclick="closeModal()" class="bg-white border-2 border-black px-2 py-1 font-black text-sm cursor-pointer shadow-[2px_2px_0_0_rgba(0,0,0,1)] active:translate-x-[2px] active:translate-y-[2px] active:shadow-none">
                        [ FECHAR ]
                    </button>
                </div>

                <div id="modal-body" class="text-black font-medium mt-4">
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
            const bgColor = type === 'success' ? 'bg-[#4ade80]' : 'bg-[#f87171]';
            const toast = document.createElement('div');

            toast.className = `${bgColor} border-4 border-black p-4 shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] flex items-center justify-between min-w-[320px] transform transition-transform duration-150 translate-x-[150%]`;

            toast.innerHTML = `
                <span class="font-black uppercase text-black text-sm tracking-tight">${message}</span>
                <button onclick="this.parentElement.remove()" class="ml-4 font-black border-2 border-black bg-white px-2 py-0.5 cursor-pointer shadow-[2px_2px_0_0_rgba(0,0,0,1)] active:translate-x-[2px] active:translate-y-[2px] active:shadow-none">X</button>
            `;

            container.appendChild(toast);

            setTimeout(() => {
                toast.classList.remove('translate-x-[150%]');
            }, 50);

            setTimeout(() => {
                toast.classList.add('translate-x-[150%]');
                setTimeout(() => toast.remove(), 150);
            }, 5000);
        }
    </script>
</body>

</html>