<?php include 'components/header.php'; ?>
<div class="space-y-10">
    <header class="space-y-1">
        <span class="text-xs font-mono text-[#71717a] uppercase tracking-wider">02 / Media Visual & Karya</span>
        <h1 class="text-2xl font-semibold text-white tracking-tight">Visual Archive</h1>
    </header>

    <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
        <?php
        // Loop otomatis biar kodingan lu bersih & gak paul (pake gaya perulangan array PHP)
        $fotos = [
            ['file' => 'foto.png', 'title' => 'Core Identity Avatar'],
            ['file' => 'foto1.png', 'title' => 'Dark Design Entry'],
            ['file' => 'foto2.png', 'title' => 'Manga Illustration Log'],
            ['file' => 'foto3.png', 'title' => 'Anime Concept Plate'],
            ['file' => 'foto4.png', 'title' => 'Expression Fragment'],
            ['file' => 'foto5.png', 'title' => 'Character Sketch Archive'],
            ['file' => 'foto6.png', 'title' => 'Terminal Shadow Aspect']
        ];

        foreach ($fotos as $f) {
            echo '
            <div onclick="openLightbox(\'public/foto/'.$f['file'].'\', \''.$f['title'].'\')" class="border border-white/[0.06] bg-[#0e0e11] rounded-xl overflow-hidden group cursor-zoom-in hover:border-cyan-500/30 transition duration-300">
                <div class="aspect-square w-full bg-zinc-950 overflow-hidden">
                    <img src="public/foto/'.$f['file'].'" class="w-full h-full object-cover grayscale group-hover:grayscale-0 group-hover:scale-105 transition duration-500" alt="'.$f['title'].'" onerror="this.parentElement.innerHTML=\'<div class=\\\'w-full h-full flex items-center justify-center text-[10px] text-zinc-600\\\'>'.$f['file'].'</div>\'">
                </div>
                <div class="p-3 text-[11px]">
                    <span class="text-white font-medium block truncate group-hover:text-cyan-400 transition">'.$f['title'].'</span>
                    <span class="text-[#52525b] font-mono text-[9px]">public/foto/'.$f['file'].'</span>
                </div>
            </div>';
        }
        ?>
    </div>
</div>

<div id="lightbox" onclick="closeLightbox()" class="fixed inset-0 z-50 bg-black/80 backdrop-blur-md opacity-0 pointer-events-none transition-all duration-300 flex flex-col items-center justify-center p-4">
    <div class="relative max-w-3xl w-full flex flex-col items-center justify-center" onclick="event.stopPropagation()">
        <button onclick="closeLightbox()" class="absolute -top-10 right-0 text-zinc-400 hover:text-white font-mono text-xs tracking-widest uppercase cursor-pointer">✕ CLOSE</button>
        <img id="lightbox-img" class="max-h-[75vh] max-w-full rounded-lg border border-white/[0.1] shadow-2xl scale-95 transition-transform duration-300 object-contain" src="" alt="">
        <p id="lightbox-caption" class="text-xs font-mono text-zinc-400 mt-4 tracking-wide text-center"></p>
    </div>
</div>

<script>
    function openLightbox(src, title) {
        const modal = document.getElementById('lightbox');
        const img = document.getElementById('lightbox-img');
        const caption = document.getElementById('lightbox-caption');
        
        img.src = src;
        caption.innerText = title;
        
        modal.classList.remove('opacity-0', 'pointer-events-none');
        setTimeout(() => {
            img.classList.remove('scale-95');
        }, 10);
    }

    function closeLightbox() {
        const modal = document.getElementById('lightbox');
        const img = document.getElementById('lightbox-img');
        
        img.classList.add('scale-95');
        modal.classList.add('opacity-0', 'pointer-events-none');
    }

    // Tutup pake tombol ESC di keyboard
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') closeLightbox();
    });
</script>
<?php include 'components/footer.php'; ?>
