<?php
session_start();
if (isset($_SESSION['user_logged'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cyber Deck Firewall | Login</title>
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <style>
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }
        .shake { animation: shake 0.3s ease-in-out; }
        ::-webkit-scrollbar { display: none; }
    </style>
</head>
<body class="bg-[#0a0a0c] text-zinc-400 font-mono min-h-screen flex items-center justify-center p-4">

    <div class="bg-[#0e0e11] border border-white/[0.05] p-8 rounded-2xl w-full max-w-md shadow-2xl relative overflow-hidden">
        <div class="text-center mb-8">
            <div class="w-12 h-12 bg-cyan-950/30 border border-cyan-500/30 rounded-xl flex items-center justify-center mx-auto mb-4 text-cyan-400">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
            </div>
            <h1 class="text-white text-xl font-bold tracking-widest">CYBER DECK FIREWALL v4</h1>
            <p class="text-[9px] uppercase tracking-widest text-zinc-500 mt-2">Permanent Session Core // AES-BCRYPT Active</p>
        </div>

        <div id="alertBox" class="hidden mb-4 p-3 rounded text-[11px] font-bold text-center border"></div>

        <div id="tabContainer" class="flex gap-2 mb-6 bg-black/40 p-1 rounded-lg border border-white/[0.05]">
            <button onclick="switchTab('login')" id="tabLogin" class="flex-1 py-2 text-xs font-bold rounded transition-all duration-300 bg-white/[0.05] text-white active:scale-95 cursor-pointer">SIGN IN</button>
            <button onclick="switchTab('register')" id="tabRegister" class="flex-1 py-2 text-xs font-bold rounded transition-all duration-300 text-zinc-500 hover:text-white active:scale-95 cursor-pointer">REGISTER</button>
        </div>

        <form id="formLogin" onsubmit="handleLogin(event)" class="space-y-4">
            <div class="space-y-1">
                <label class="text-[9px] uppercase tracking-widest text-zinc-500">Secure Email Network</label>
                <input type="email" id="loginEmail" required class="w-full bg-black/50 border border-white/[0.1] rounded px-3 py-2 text-sm text-white focus:outline-none focus:border-cyan-500/50 transition-colors">
            </div>
            <div class="space-y-1">
                <label class="text-[9px] uppercase tracking-widest text-zinc-500">Secret Access Key</label>
                <input type="password" id="loginPassword" required class="w-full bg-black/50 border border-white/[0.1] rounded px-3 py-2 text-sm text-white focus:outline-none focus:border-cyan-500/50 transition-colors">
            </div>
            <button type="submit" id="btnLogin" class="w-full bg-white text-black font-bold text-xs py-3 rounded hover:bg-cyan-400 hover:shadow-[0_0_15px_rgba(34,211,238,0.4)] transition-all duration-200 active:scale-95 mt-4 cursor-pointer">
                INITIALIZE CONNECTION
            </button>
            <div class="text-center mt-3">
                <button type="button" onclick="switchTab('reset')" class="text-[10px] text-zinc-500 hover:text-cyan-400 cursor-pointer transition-colors">>> Lupa Secret Access Key? Ganti Di Sini <<</button>
            </div>
        </form>

        <form id="formRegister" onsubmit="handleRegister(event)" class="space-y-4 hidden">
            <div class="space-y-1">
                <label class="text-[9px] uppercase tracking-widest text-zinc-500">Your Pseudonym / Nama</label>
                <input type="text" id="regName" required class="w-full bg-black/50 border border-white/[0.1] rounded px-3 py-2 text-sm text-white focus:outline-none focus:border-cyan-500/50 transition-colors">
            </div>
            <div class="space-y-1">
                <label class="text-[9px] uppercase tracking-widest text-zinc-500">Secure Email Network</label>
                <input type="email" id="regEmail" required class="w-full bg-black/50 border border-white/[0.1] rounded px-3 py-2 text-sm text-white focus:outline-none focus:border-cyan-500/50 transition-colors">
            </div>
            <div class="space-y-1">
                <label class="text-[9px] uppercase tracking-widest text-zinc-500">Secret Access Key</label>
                <input type="password" id="regPassword" required minlength="8" class="w-full bg-black/50 border border-white/[0.1] rounded px-3 py-2 text-sm text-white focus:outline-none focus:border-cyan-500/50 transition-colors">
            </div>
            <button type="submit" id="btnRegister" class="w-full bg-white text-black font-bold text-xs py-3 rounded hover:bg-cyan-400 hover:shadow-[0_0_15px_rgba(34,211,238,0.4)] transition-all duration-200 active:scale-95 mt-4 cursor-pointer">
                PRODUCE CRYPTO IDENTITY
            </button>
        </form>

        <form id="formReset" onsubmit="handleReset(event)" class="space-y-4 hidden">
            <div class="text-center mb-2 border-b border-white/[0.1] pb-2">
                <p class="text-xs text-yellow-500 font-bold">MODE OVERRIDE KEAMANAN</p>
                <p class="text-[9px] text-zinc-500">Masukkan email yang terdaftar untuk menimpa sandi lama.</p>
            </div>
            <div class="space-y-1">
                <label class="text-[9px] uppercase tracking-widest text-zinc-500">Target Email Network</label>
                <input type="email" id="resetEmail" required class="w-full bg-black/50 border border-white/[0.1] rounded px-3 py-2 text-sm text-white focus:outline-none focus:border-yellow-500/50 transition-colors">
            </div>
            <div class="space-y-1">
                <label class="text-[9px] uppercase tracking-widest text-zinc-500">New Secret Access Key</label>
                <input type="password" id="resetPassword" required minlength="8" class="w-full bg-black/50 border border-white/[0.1] rounded px-3 py-2 text-sm text-white focus:outline-none focus:border-yellow-500/50 transition-colors">
            </div>
            <button type="submit" id="btnReset" class="w-full bg-yellow-500 text-black font-bold text-xs py-3 rounded hover:bg-yellow-400 hover:shadow-[0_0_15px_rgba(234,179,8,0.4)] transition-all duration-200 active:scale-95 mt-4 cursor-pointer">
                OVERRIDE SANDI
            </button>
            <div class="text-center mt-3">
                <button type="button" onclick="switchTab('login')" class="text-[10px] text-zinc-500 hover:text-white cursor-pointer transition-colors">Batalkan & Kembali ke Login</button>
            </div>
        </form>

    </div>

    <script>
        function showAlert(message, type) {
            const box = document.getElementById('alertBox');
            box.classList.remove('hidden', 'bg-red-500/10', 'border-red-500/30', 'text-red-400', 'bg-emerald-500/10', 'border-emerald-500/30', 'text-emerald-400');
            
            if(type === 'error') {
                box.classList.add('bg-red-500/10', 'border-red-500/30', 'text-red-400', 'shake');
                setTimeout(() => box.classList.remove('shake'), 300);
            } else {
                box.classList.add('bg-emerald-500/10', 'border-emerald-500/30', 'text-emerald-400');
            }
            box.innerHTML = message;
        }

        function switchTab(tab) {
            const forms = ['formLogin', 'formRegister', 'formReset'];
            forms.forEach(f => document.getElementById(f).classList.add('hidden'));
            
            const tabContainer = document.getElementById('tabContainer');
            const tabLogin = document.getElementById('tabLogin');
            const tabRegister = document.getElementById('tabRegister');
            
            document.getElementById('alertBox').classList.add('hidden');

            if (tab === 'login' || tab === 'register') {
                tabContainer.classList.remove('hidden');
                if (tab === 'login') {
                    document.getElementById('formLogin').classList.remove('hidden');
                    tabLogin.classList.replace('text-zinc-500', 'text-white');
                    tabLogin.classList.replace('bg-transparent', 'bg-white/[0.05]');
                    tabRegister.classList.replace('text-white', 'text-zinc-500');
                    tabRegister.classList.replace('bg-white/[0.05]', 'bg-transparent');
                } else {
                    document.getElementById('formRegister').classList.remove('hidden');
                    tabRegister.classList.replace('text-zinc-500', 'text-white');
                    tabRegister.classList.replace('bg-transparent', 'bg-white/[0.05]');
                    tabLogin.classList.replace('text-white', 'text-zinc-500');
                    tabLogin.classList.replace('bg-white/[0.05]', 'bg-transparent');
                }
            } else if (tab === 'reset') {
                tabContainer.classList.add('hidden'); // Sembunyikan tab atas pas lagi mode reset
                document.getElementById('formReset').classList.remove('hidden');
            }
        }

        function handleReset(e) {
            e.preventDefault();
            const btn = document.getElementById('btnReset');
            const originalText = btn.innerHTML;
            
            btn.innerHTML = 'OVERRIDING...';
            btn.disabled = true;
            btn.classList.add('opacity-50', 'cursor-not-allowed');

            const params = new URLSearchParams();
            params.append('action', 'reset');
            params.append('email', document.getElementById('resetEmail').value);
            params.append('new_password', document.getElementById('resetPassword').value);

            fetch('auth.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: params.toString()
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    showAlert(data.message, 'success');
                    document.getElementById('formReset').reset();
                    setTimeout(() => switchTab('login'), 2000);
                } else {
                    showAlert(data.message, 'error');
                }
            })
            .catch(err => showAlert("Koneksi ke Engine Error!", 'error'))
            .finally(() => {
                btn.innerHTML = originalText;
                btn.disabled = false;
                btn.classList.remove('opacity-50', 'cursor-not-allowed');
            });
        }

        // Script untuk handleLogin dan handleRegister tetap sama seperti sebelumnya
        function handleRegister(e) {
            e.preventDefault();
            const btn = document.getElementById('btnRegister');
            const originalText = btn.innerHTML;
            btn.innerHTML = 'PROCESSING...';
            btn.disabled = true;
            btn.classList.add('opacity-50');

            const params = new URLSearchParams();
            params.append('action', 'register');
            params.append('name', document.getElementById('regName').value);
            params.append('email', document.getElementById('regEmail').value);
            params.append('password', document.getElementById('regPassword').value);

            fetch('auth.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: params.toString()
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    showAlert(data.message, 'success');
                    document.getElementById('formRegister').reset();
                    setTimeout(() => switchTab('login'), 2000);
                } else {
                    showAlert(data.message, 'error');
                }
            })
            .finally(() => {
                btn.innerHTML = originalText;
                btn.disabled = false;
                btn.classList.remove('opacity-50');
            });
        }

        function handleLogin(e) {
            e.preventDefault();
            const btn = document.getElementById('btnLogin');
            const originalText = btn.innerHTML;
            btn.innerHTML = 'AUTHENTICATING...';
            btn.disabled = true;
            btn.classList.add('opacity-50');

            const params = new URLSearchParams();
            params.append('action', 'login');
            params.append('email', document.getElementById('loginEmail').value);
            params.append('password', document.getElementById('loginPassword').value);

            fetch('auth.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: params.toString()
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    showAlert(data.message, 'success');
                    setTimeout(() => window.location.href = data.role === 'ADMIN' ? 'admin.php' : 'index.php', 1000);
                } else {
                    showAlert(data.message, 'error');
                }
            })
            .finally(() => {
                btn.innerHTML = originalText;
                btn.disabled = false;
                btn.classList.remove('opacity-50');
            });
        }
    </script>
</body>
</html>
