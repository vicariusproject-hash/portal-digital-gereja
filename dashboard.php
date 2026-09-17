<?php
require_once 'config.php';
require_login();

$ann = $pdo->query("SELECT * FROM announcements ORDER BY published_at DESC LIMIT 5")->fetchAll();
$events = $pdo->query("SELECT * FROM events ORDER BY event_date ASC, event_time ASC LIMIT 5")->fetchAll();
$worship = $pdo->query("SELECT * FROM worship_services WHERE service_date >= CURDATE() ORDER BY service_date ASC LIMIT 1")->fetch();
$service = $pdo->query("SELECT * FROM service_schedules WHERE service_date >= CURDATE() ORDER BY service_date ASC LIMIT 5")->fetchAll();
?>
<!doctype html>
<html lang="id"><head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Dashboard - <?= e(APP_NAME) ?></title><link rel="stylesheet" href="assets/style.css">
</head><body>
<?php include 'partials/nav.php'; ?>
<main class="container">
<section class="hero"><div><span class="eyebrow">SELAMAT DATANG</span><h2><?= e($_SESSION['user']['name']) ?></h2><p>Semua informasi gereja dalam satu tempat.</p></div><div class="cross">✝</div></section>

<div class="grid cards">
<div class="card stat"><span>📢</span><strong><?= count($ann) ?></strong><small>Pengumuman terbaru</small></div>
<div class="card stat"><span>📅</span><strong><?= count($events) ?></strong><small>Kegiatan terdekat</small></div>
<div class="card stat"><span>🎤</span><strong><?= count($service) ?></strong><small>Jadwal pelayanan</small></div>
<div class="card stat"><span>📖</span><strong><?= $worship ? 'Tersedia' : '-' ?></strong><small>Tata ibadah berikutnya</small></div>
</div>

<div class="two-col">
<section class="card">
<div class="section-head"><h3>📢 Pengumuman</h3><a href="announcements.php">Lihat semua</a></div>
<?php foreach($ann as $a): ?>
<article class="list-item"><div><b><?= e($a['title']) ?></b><p><?= e(mb_strimwidth($a['content'],0,130,'...')) ?></p></div><time><?= e(date('d/m/Y', strtotime($a['published_at']))) ?></time></article>
<?php endforeach; ?>
<?php if (!$ann): ?><p class="muted">Belum ada pengumuman.</p><?php endif; ?>
</section>

<section class="card">
<div class="section-head"><h3>📅 Kegiatan</h3><a href="events.php">Kalender</a></div>
<?php foreach($events as $ev): ?>
<article class="list-item"><div><b><?= e($ev['title']) ?></b><p>📍 <?= e($ev['location'] ?: '-') ?></p></div><time><?= e(date('d/m', strtotime($ev['event_date']))) ?></time></article>
<?php endforeach; ?>
<?php if (!$events): ?><p class="muted">Belum ada kegiatan.</p><?php endif; ?>
</section>
</div>
</main>
</body></html>
