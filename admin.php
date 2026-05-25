<?php
include 'components/header.php';

if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'ADMIN') {
    echo "<div class='text-center text-red-500 font-mono p-10 bg-red-500/5 rounded-xl border border-red-500/20 my-6'>🛑 ACCESS DENIED: Privilese Tidak Mencukupi!</div>";
    include 'components/footer.php';
    exit();
}

// BACA DATA DARI FOLDER 'database/'
$users = json_decode(file_get_contents('database/database_users.json'), true) ?? [];
$logs = json_decode(file_get_contents('database/database_logs.json'), true) ?? [];
$attempts = json_decode(file_get_contents('database/database_attempts.json'), true) ?? [];

$totalUniqueUsers = count($users);
$totalBlockedAccounts = 0;
foreach($attempts as $at) { if(($at['count'] ?? 0) >= 3) $totalBlockedAccounts++; }
?>

<div class="space-y-10 font-mono text-xs my-4 animate-fade-in">
    <header class="flex items-center justify-between border-b border-red-500/20 pb-4">
        <div>
            <span class="text-red-400 font-bold uppercase tracking-widest text-[10px]">👑 MASTER SECURITY INTERCEPTOR v4</span>
            <h1 class="text-xl font-semibold text-white tracking-tight mt-0.5">Fortress Control Station</h1>
        </div>
        <div class="text-[10px] text-zinc-500 bg-zinc-900 border border-zinc-800 px-2 py-1 rounded font-bold animate-pulse text-emerald-400">
            ● SERVER PERSISTENT ACTIVE
        </div>
    </header>

    <section class="space-y-3">
        <h3 class="text-white font-medium text-[11px] uppercase tracking-wider">📡 Termux Node Hardware Diagnostics</h3>
        <div class="grid grid-cols-3 gap-3 text-center">
            <div class="bg-white/[0.01] border border-white/[0.04] p-3 rounded-lg">
                <p class="text-zinc-500 text-[9px] uppercase">Engine Performance</p>
                <p class="text-sm font-bold text-emerald-400 mt-1">98.4% <span class="text-[9px] font-normal text-zinc-600">STABLE</span></p>
            </div>
            <div class="bg-white/[0.01] border border-white/[0.04] p-3 rounded-lg">
                <p class="text-zinc-500 text-[9px] uppercase">Storage Allocation</p>
                <p class="text-sm font-bold text-cyan-400 mt-1">1.2 GB <span class="text-[9px] font-normal text-zinc-600">USED</span></p>
            </div>
            <div class="bg-white/[0.01] border border-white/[0.04] p-3 rounded-lg">
                <p class="text-zinc-500 text-[9px] uppercase">Response Latency</p>
                <p class="text-sm font-bold text-yellow-400 mt-1">12 ms <span class="text-[9px] font-normal text-zinc-600">EXCELLENT</span></p>
            </div>
        </div>
    </section>

    <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
        <div class="bg-[#0e0e11] border border-white/[0.06] p-4 rounded-xl space-y-1">
            <span class="text-zinc-500 text-[10px] uppercase">Registered Identities</span>
            <p class="text-2xl font-bold text-white tracking-tight"><?php echo $totalUniqueUsers; ?></p>
        </div>
        <div class="bg-[#0e0e11] border border-white/[0.06] p-4 rounded-xl space-y-1">
            <span class="text-zinc-500 text-[10px] uppercase">Brute-Force Lock</span>
            <p class="text-2xl font-bold text-red-400 tracking-tight"><?php echo $totalBlockedAccounts; ?></p>
        </div>
        <div class="bg-[#0e0e11] border border-white/[0.06] p-4 rounded-xl space-y-1 col-span-2 sm:col-span-1">
            <span class="text-zinc-500 text-[10px] uppercase">Total Logs Audit</span>
            <p class="text-2xl font-bold text-cyan-400 tracking-tight"><?php echo count($logs); ?></p>
        </div>
    </div>

    <section class="space-y-3">
        <h3 class="text-white font-medium flex items-center gap-2 text-[11px] uppercase tracking-wider">
            <span class="w-1.5 h-1.5 rounded-full bg-red-500 animate-ping"></span> Live Security Logs Stream
        </h3>
        <div class="border border-white/[0.06] bg-[#070709] rounded-xl p-3 h-48 overflow-y-auto space-y-2 text-[11px] text-zinc-400">
            <?php 
            if(empty($logs)) { echo "<div class='text-zinc-600 text-center py-16'>[system] Empty logs.</div>"; } else {
                foreach(array_reverse($logs) as $l) {
                    $color = "text-emerald-400";
                    if(strpos($l['status'], 'FAILED') !== false) $color = "text-yellow-500";
                    if($l['status'] === "BRUTE_FORCE_LOCKOUT") $color = "text-red-500 font-bold animate-pulse";
                    echo "<div class='border-b border-white/[0.02] pb-1.5 leading-relaxed'><span class='text-zinc-600'>[{$l['date']} - {$l['time']}]</span> <span class='text-white font-medium'>{$l['email']}</span> -> <span class='text-zinc-300'>{$l['action']}</span> status: <span class='{$color}'>[{$l['status']}]</span></div>";
                }
            }
            ?>
        </div>
    </section>

    <section class="space-y-3">
        <h3 class="text-white font-medium text-[11px] uppercase tracking-wider">Identity Database (With Live Firewall Controls)</h3>
        <div class="border border-white/[0.06] bg-[#0e0e11] rounded-xl overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead><tr class="bg-white/[0.02] border-b border-white/[0.06] text-zinc-500 text-[10px]"><th class="p-3 pl-4">EMAIL ACCOUNT</th><th class="p-3">STATUS FIREWALL</th><th class="p-3 text-right pr-4">COMMAND ACTION</th></tr></thead>
                <tbody class="divide-y divide-white/[0.04] text-zinc-400">
                    <?php foreach($users as $u): $statusUser = isset($u['status']) ? $u['status'] : 'ACTIVE'; ?>
                    <tr class="<?php echo $u['role'] === 'ADMIN' ? 'bg-red-500/[0.02] text-white' : 'hover:bg-white/[0.01]'; ?>">
                        <td class="p-3 pl-4 font-medium <?php echo $u['role'] === 'ADMIN' ? 'text-red-400' : ''; ?>"><?php echo htmlspecialchars($u['email']); ?><span class="text-[9px] text-zinc-600 block">Signed: <?php echo $u['registered_at'] ?? 'Unknown'; ?></span></td>
                        <td class="p-3"><span class="<?php echo $statusUser === 'ACTIVE' ? 'text-emerald-400 bg-emerald-500/10' : 'text-red-500 bg-red-500/10 font-bold'; ?> px-1.5 py-0.5 rounded text-[10px]"><?php echo $statusUser; ?></span></td>
                        <td class="p-3 text-right pr-4">
                            <?php if($u['email'] !== 'dimas@gmail.com'): ?>
                                <button onclick="toggleBan('<?php echo $u['email']; ?>')" class="<?php echo $statusUser === 'ACTIVE' ? 'bg-red-500/10 border border-red-500/30 text-red-400 hover:bg-red-500/20' : 'bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 hover:bg-emerald-500/20'; ?> px-2 py-1 rounded transition text-[10px] font-bold cursor-pointer"><?php echo $statusUser === 'ACTIVE' ? '🔨 BAN_USER' : '🔓 UNBAN_USER'; ?></button>
                            <?php else: ?><span class="text-zinc-600 text-[10px] font-bold italic">OWNER_IMMUNE</span><?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>
</div>

<script>
function toggleBan(email) {
    if(confirm("Ubah status firewall akses untuk " + email + "?")) {
        const params = new URLSearchParams(); params.append('action', 'toggle_ban'); params.append('target_email', email);
        fetch('auth.php', { method: 'POST', headers: { 'Content-Type': 'application/x-www-form-urlencoded' }, body: params.toString() })
        .then(res => res.json()).then(data => { if(data.status === 'success') { window.location.reload(); } else { alert(data.message); } });
    }
}
</script>
<?php include 'components/footer.php'; ?>
