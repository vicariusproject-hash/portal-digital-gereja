<?php
require_once 'config.php'; require_login();
$items=$pdo->query("SELECT * FROM announcements ORDER BY published_at DESC")->fetchAll();
?><!doctype html><html lang="id"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Pengumuman</title><link rel="stylesheet" href="assets/style.css"></head><body><?php include 'partials/nav.php'; ?><main class="container"><div class="page-title"><span class="eyebrow">INFORMASI</span><h2>Pengumuman Gereja</h2></div><?php foreach($items as $a): ?><section class="card announcement"><h3><?= e($a['title']) ?></h3><small><?= e(date('d F Y',strtotime($a['published_at']))) ?></small><p><?= nl2br(e($a['content'])) ?></p></section><?php endforeach; ?></main></body></html>
