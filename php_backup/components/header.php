<?php
if (session_status() === PHP_SESSION_NONE) session_start();

if (!isset($_SESSION['user_logged']) && isset($_COOKIE['remember_node_token'])) {
    $cookieToken = $_COOKIE['remember_node_token'];
    // JALUR DIUBAH KE database/database_users.json
    $usersDb = json_decode(file_get_contents('database/database_users.json'), true);
    if (!empty($usersDb)) {
        foreach ($usersDb as $u) {
            if (!empty($u['remember_token']) && $u['remember_token'] === $cookieToken) {
                if (isset($u['status']) && $u['status'] === 'BANNED') { setcookie('remember_node_token', '', time() - 3600, "/"); break; }
                $_SESSION['user_logged'] = true; $_SESSION['user_email'] = $u['email']; $_SESSION['user_name'] = $u['name']; $_SESSION['user_role'] = $u['role']; $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT']; break;
            }
        }
    }
}

if (!isset($_SESSION['user_logged']) && basename($_SERVER['PHP_SELF']) != 'login.php') { header("Location: login.php"); exit(); }
if (isset($_SESSION['user_logged']) && ($_SESSION['user_agent'] ?? $_SERVER['HTTP_USER_AGENT']) !== $_SERVER['HTTP_USER_AGENT']) { 
    session_unset(); 
    session_destroy(); 
    setcookie('remember_node_token', '', time() - 3600, "/"); 
    header("Location: login.php"); 
    exit(); 
}
?>
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dimas Cyber Deck | Enterprise Edition</title>
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <style>
        @keyframes soundWave { 0%, 100% { height: 4px; } 50% { height: 16px; } }
        .bar-anim { animation: soundWave 0.6s ease-in-out infinite; } .bar-2 { animation-delay: 0.15s; } .bar-3 { animation-delay: 0.3s; } .bar-4 { animation-delay: 0.45s; }
        .paused-anim { animation-play-state: paused !important; }
    </style>
</head>
<body class="bg-[#0a0a0c] text-[#a1a1aa] antialiased min-h-screen flex flex-col justify-between p-6 font-sans selection:bg-cyan-500/30 selection:text-white">
    
    <audio id="cyberCoreMusic" loop src="public/audio/Audio.mp3"></audio>

    <div id="audioDeckWidget" class="fixed bottom-6 left-6 z-50 font-mono text-[11px]">
        <div class="bg-[#0e0e11]/90 backdrop-blur-md border border-white/[0.08] p-3 rounded-xl shadow-2xl flex flex-col gap-2 transition-all hover:border-cyan-500/40 w-[200px]">
            
            <div class="flex items-center gap-4 border-b border-white/[0.05] pb-2">
                <div class="flex items-end gap-0.5 w-4 h-4 pb-0.5">
                    <div id="eqBar1" class="w-1 bg-cyan-400 bar-anim paused-anim"></div>
                    <div id="eqBar2" class="w-1 bg-cyan-400 bar-anim bar-2 paused-anim"></div>
                    <div id="eqBar3" class="w-1 bg-cyan-400 bar-anim bar-3 paused-anim"></div>
                    <div id="eqBar4" class="w-1 bg-cyan-400 bar-anim bar-4 paused-anim"></div>
                </div>

                <div class="flex flex-col gap-1 w-full">
                    <span class="text-white text-[9px] uppercase tracking-widest font-bold">CYBER_AUDIO</span>
                    <div class="flex items-center gap-2">
                        <button id="musicToggleBtn" onclick="toggleCyberMusic()" class="bg-white text-black font-bold px-2 py-0.5 rounded text-[10px] hover:bg-cyan-400 transition cursor-pointer uppercase">PLAY</button>
                        <input type="range" id="volumeControl" min="0" max="1" step="0.1" value="0.5" oninput="changeCyberVolume(this.value)" class="w-full h-1 bg-zinc-800 rounded-lg appearance-none cursor-pointer accent-cyan-400 outline-none">
                    </div>
                </div>
            </div>

            <select id="trackSelector" onchange="changeTrack(this.value)" class="bg-black/50 text-cyan-400 border border-zinc-800 rounded px-1 py-1 text-[9px] outline-none cursor-pointer hover:border-cyan-500/50 transition uppercase w-full">
                <option value="public/audio/Audio.mp3">Track 01 - Default</option>
                <option value="public/audio/Audio1.mp3">Track 02 - Audio 1</option>
                <option value="public/audio/space.mp3">Track 03 - Space</option>
            </select>

        </div>
    </div>

    <div class="max-w-xl w-full mx-auto space-y-12">
        <nav class="flex items-center justify-between border-b border-white/[0.04] pb-6">
            <div class="flex flex-col">
                <a href="index.php" class="text-white font-semibold tracking-tight text-base hover:opacity-80 transition">dimas<span class="text-cyan-500">.</span></a>
                <span class="text-[9px] font-mono text-zinc-600 uppercase">Active Identity: <?php echo htmlspecialchars($_SESSION['user_name'] ?? 'Guest'); ?></span>
            </div>
            <div class="flex items-center gap-4 text-xs font-medium">
                <a href="index.php" class="hover:text-white transition">Home</a>
                <a href="about.php" class="hover:text-white transition">About</a>
                <a href="gallery.php" class="hover:text-white transition">Gallery</a>
                <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'ADMIN'): ?>
                    <a href="admin.php" class="text-red-400 border border-red-500/20 bg-red-500/5 px-2 py-0.5 rounded text-[11px] font-mono hover:bg-red-500/10 transition">AdminPanel</a>
                <?php endif; ?>
                <a href="logout.php" class="text-red-500/70 hover:text-red-400 font-mono text-[11px] font-bold">/Exit</a>
            </div>
        </nav>
        <main>
