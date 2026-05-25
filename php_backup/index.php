<?php include 'components/header.php'; ?>
<div class="space-y-12 my-6">
    
    <div class="space-y-3 animate-fade-in">
        <div class="w-full aspect-video rounded-xl overflow-hidden border border-white/[0.06] bg-[#0e0e11] relative group shadow-lg">
            <video id="mainVideoPlayer" autoplay muted loop playsinline class="w-full h-full object-cover opacity-50 transition duration-700">
                <source id="videoSourceFile" src="public/video/galaxy.mp4" type="video/mp4">
            </video>
            <div class="absolute inset-0 bg-gradient-to-t from-[#0a0a0c] via-transparent to-transparent"></div>
            <div class="absolute bottom-4 left-4 right-4 flex justify-between items-end">
                <div>
                    <span class="text-[9px] font-mono uppercase tracking-widest text-cyan-400 bg-cyan-500/[0.05] border border-cyan-500/[0.15] px-2 py-0.5 rounded animate-pulse">Live Feed</span>
                    <h2 id="videoTitleText" class="text-sm font-medium text-white tracking-tight mt-1.5 font-mono">01_galaxy_core.mp4</h2>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-2 text-xs font-mono">
            <button onclick="switchVideo('public/video/galaxy.mp4', '01_galaxy_core.mp4', this)" class="vid-btn border border-cyan-500/30 bg-cyan-500/5 text-cyan-400 p-2.5 rounded-lg text-left transition cursor-pointer">
                <span class="block text-[9px] text-zinc-500">CHANNEL 01</span> 🌌 Cosmic Nebula
            </button>
            <button onclick="switchVideo('public/video/video.mp4', '02_legacy_reel.mp4', this)" class="vid-btn border border-white/[0.06] bg-white/[0.01] text-zinc-400 p-2.5 rounded-lg text-left transition hover:border-white/[0.15] hover:text-white cursor-pointer">
                <span class="block text-[9px] text-zinc-500">CHANNEL 02</span> 📼 Legacy Asset
            </button>
        </div>
    </div>

    <div class="max-w-xl space-y-4">
        <h1 class="text-3xl font-normal tracking-tight text-white sm:text-4xl">Dimas Abdurahman</h1>
        <p class="text-[#a1a1aa] text-sm leading-relaxed">
            Siswa SMK jurusan <span class="text-white font-medium">Pengembangan Perangkat Lunak dan Gim (PPLG)</span>. Berfokus pada pemecahan logika pemrograman, perancangan antarmuka minimalis, dan eksplorasi seni digital langsung dari perangkat mobile.
        </p>
    </div>

    <section class="space-y-4 pt-4 border-t border-white/[0.04]">
        <div class="flex items-center justify-between">
            <h3 class="text-xs font-mono text-zinc-400 uppercase tracking-wider">Commit Activity Graph</h3>
            <span class="text-[9px] font-mono text-emerald-400 bg-emerald-500/10 px-2 py-0.5 rounded">1,024 Commits</span>
        </div>
        <div class="border border-white/[0.06] bg-[#0e0e11] rounded-xl p-4 overflow-hidden">
            <div class="flex flex-wrap gap-1 max-w-full justify-center opacity-80 hover:opacity-100 transition duration-500">
                <?php 
                // Ngarang kotak-kotak hijau cyan ala github
                $colors = ['bg-white/[0.03]', 'bg-white/[0.03]', 'bg-cyan-900/40', 'bg-cyan-700/60', 'bg-cyan-500/80', 'bg-cyan-400'];
                for($i=0; $i<140; $i++) {
                    $randColor = $colors[array_rand($colors)];
                    echo "<div class='w-2.5 h-2.5 rounded-[2px] {$randColor}'></div>";
                }
                ?>
            </div>
            <div class="mt-3 flex justify-between items-center text-[9px] font-mono text-zinc-600">
                <span>Jan</span><span>Feb</span><span>Mar</span><span>Apr</span><span>May</span>
                <div class="flex items-center gap-1 ml-auto">
                    <span>Less</span>
                    <div class="w-2 h-2 rounded-[1px] bg-white/[0.03]"></div>
                    <div class="w-2 h-2 rounded-[1px] bg-cyan-900/40"></div>
                    <div class="w-2 h-2 rounded-[1px] bg-cyan-500/80"></div>
                    <div class="w-2 h-2 rounded-[1px] bg-cyan-400"></div>
                    <span>More</span>
                </div>
            </div>
        </div>
    </section>

    <section class="space-y-4 pt-4 border-t border-white/[0.04]">
        <h3 class="text-xs font-mono text-zinc-400 uppercase tracking-wider">Development Roadmap 2026-2027</h3>
        <div class="border border-white/[0.06] bg-[#0e0e11] rounded-xl p-5 relative">
            <div class="absolute left-6 top-5 bottom-5 w-px bg-white/[0.1]"></div> <div class="space-y-6">
                <div class="relative pl-6">
                    <div class="absolute left-[-4px] top-1.5 w-2 h-2 rounded-full bg-cyan-400 shadow-[0_0_8px_rgba(34,211,238,0.8)]"></div>
                    <h4 class="text-white text-xs font-bold uppercase tracking-wider">CyberX Portfolio v4.0</h4>
                    <p class="text-[10px] text-zinc-500 font-mono mt-0.5">STATUS: DEPLOYED (CURRENT)</p>
                    <p class="text-xs text-zinc-400 mt-1">Implementasi PHP Native, Sistem Login BCRYPT Banned Node, & AI Integration di Termux.</p>
                </div>
                <div class="relative pl-6 opacity-70 hover:opacity-100 transition">
                    <div class="absolute left-[-4px] top-1.5 w-2 h-2 rounded-full border border-cyan-500 bg-black"></div>
                    <h4 class="text-white text-xs font-bold uppercase tracking-wider">Project "Nebula": E-Commerce Mockup</h4>
                    <p class="text-[10px] text-zinc-500 font-mono mt-0.5">STATUS: IN PROGRESS</p>
                    <p class="text-xs text-zinc-400 mt-1">Membangun website penjualan sayuran organik (terinspirasi usaha keluarga) dengan integrasi payment gateway fiktif.</p>
                </div>
                <div class="relative pl-6 opacity-40 hover:opacity-100 transition">
                    <div class="absolute left-[-4px] top-1.5 w-2 h-2 rounded-full border border-zinc-600 bg-black"></div>
                    <h4 class="text-white text-xs font-bold uppercase tracking-wider">Advanced C++ Machine Learning Logic</h4>
                    <p class="text-[10px] text-zinc-500 font-mono mt-0.5">STATUS: PLANNED (Q4 2026)</p>
                    <p class="text-xs text-zinc-400 mt-1">Eksplorasi algoritma percabangan lanjutan dan efisiensi memori program C++ tanpa GUI.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="space-y-4 pt-4 border-t border-white/[0.04]">
        <h3 class="text-xs font-mono text-zinc-400 uppercase tracking-wider">Dev Execution Sandbox</h3>
        <div class="border border-zinc-800 bg-[#070709] rounded-xl p-4 font-mono text-xs space-y-4 shadow-inner">
            <div class="flex gap-2 text-[11px]">
                <button onclick="runTerminalCmd('init')" class="bg-white/[0.03] border border-white/[0.08] hover:text-cyan-400 px-3 py-1.5 rounded transition cursor-pointer">/sys_init</button>
                <button onclick="runTerminalCmd('compile')" class="bg-white/[0.03] border border-white/[0.08] hover:text-emerald-400 px-3 py-1.5 rounded transition cursor-pointer">/g++_compile</button>
                <button onclick="runTerminalCmd('clear')" class="bg-white/[0.03] border border-white/[0.08] hover:text-red-400 px-3 py-1.5 rounded transition cursor-pointer">/clear</button>
            </div>
            <div id="terminalScreen" class="h-28 overflow-y-auto bg-black/40 rounded-lg p-3 text-zinc-500 border border-white/[0.02] space-y-1 text-[11px]">
                <div>[system] Terminal ready. Silakan pilih command eksekusi di atas...</div>
            </div>
        </div>
    </section>

</div>

<script>
    function switchVideo(filePath, title, element) {
        const player = document.getElementById('mainVideoPlayer');
        const text = document.getElementById('videoTitleText');
        document.querySelectorAll('.vid-btn').forEach(btn => {
            btn.classList.remove('border-cyan-500/30', 'bg-cyan-500/5', 'text-cyan-400');
            btn.classList.add('border-white/[0.06]', 'bg-white/[0.01]', 'text-zinc-400');
        });
        element.classList.remove('border-white/[0.06]', 'bg-white/[0.01]', 'text-zinc-400');
        element.classList.add('border-cyan-500/30', 'bg-cyan-500/5', 'text-cyan-400');
        player.style.opacity = 0;
        setTimeout(() => { player.src = filePath; text.innerText = title; player.load(); player.play(); player.style.opacity = 0.5; }, 300);
    }
    function runTerminalCmd(type) {
        const screen = document.getElementById('terminalScreen');
        if (type === 'clear') { screen.innerHTML = "<div>[system] Console cleared.</div>"; return; }
        let newLog = type === 'init' ? `<div class="text-cyan-400">dimas@termux:~$ ./init_galaxy</div><div class="text-zinc-400">-> Loading components... [OK]</div><div class="text-emerald-400">-> System online.</div>` : `<div class="text-emerald-400">dimas@termux:~$ g++ core.cpp</div><div class="text-zinc-500">-> Zero Errors.</div><div class="text-cyan-400">-> Compiled.</div>`;
        screen.innerHTML += newLog; screen.scrollTop = screen.scrollHeight;
    }
</script>
<?php include 'components/footer.php'; ?>
