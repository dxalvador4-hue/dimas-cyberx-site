        </main>
        <footer class="border-t border-white/[0.04] pt-6 flex flex-col sm:flex-row items-center justify-between gap-4 text-[11px] font-mono text-[#52525b]">
            <p>&copy; 2026 Dimas Abdurahman. SMK 1 Karang Tengah - PPLG.</p>
            <div class="flex gap-4"><span class="text-emerald-500">● Core Node Secured</span></div>
        </footer>
    </div>

    <script>
        const audio = document.getElementById('cyberCoreMusic');
        const toggleBtn = document.getElementById('musicToggleBtn');
        const eqBars = [ document.getElementById('eqBar1'), document.getElementById('eqBar2'), document.getElementById('eqBar3'), document.getElementById('eqBar4') ];

        function toggleCyberMusic() {
            if (audio.paused) {
                audio.play().then(() => { localStorage.setItem('cyber_music_state', 'playing'); updateAudioUI(true); });
            } else {
                audio.pause(); localStorage.setItem('cyber_music_state', 'paused'); updateAudioUI(false);
            }
        }

        function changeCyberVolume(vol) { audio.volume = vol; localStorage.setItem('cyber_music_volume', vol); }

        // FUNGSI GANTI LAGU BARU
        function changeTrack(url) {
            audio.src = url;
            audio.play().then(() => {
                localStorage.setItem('cyber_music_state', 'playing');
                localStorage.setItem('cyber_music_track', url);
                updateAudioUI(true);
            });
        }

        function updateAudioUI(isPlaying) {
            if (isPlaying) {
                toggleBtn.innerText = "PAUSE"; toggleBtn.className = "bg-cyan-500 text-black font-bold px-2 py-0.5 rounded text-[10px] hover:bg-cyan-400 transition cursor-pointer uppercase";
                eqBars.forEach(bar => bar.classList.remove('paused-anim'));
            } else {
                toggleBtn.innerText = "PLAY"; toggleBtn.className = "bg-white text-black font-bold px-2 py-0.5 rounded text-[10px] hover:bg-cyan-400 transition cursor-pointer uppercase";
                eqBars.forEach(bar => bar.classList.add('paused-anim'));
            }
        }

        window.addEventListener('DOMContentLoaded', () => {
            const savedVolume = localStorage.getItem('cyber_music_volume');
            if (savedVolume !== null) { audio.volume = savedVolume; document.getElementById('volumeControl').value = savedVolume; }
            
            // Simpan track lagu terakhir yang dimainkan
            const savedTrack = localStorage.getItem('cyber_music_track');
            if (savedTrack) {
                audio.src = savedTrack;
                const selector = document.getElementById('trackSelector');
                if (selector) selector.value = savedTrack;
            }

            const savedState = localStorage.getItem('cyber_music_state');
            if (savedState === 'playing') { audio.play().then(() => { updateAudioUI(true); }).catch(() => { updateAudioUI(false); }); } 
            else { updateAudioUI(false); }
        });
    </script>
    <script src="//code.tidio.co/rsw42xxqx6eojw5wbvbbxxrkmwotxmdm.js" async></script>
</body>
</html>
