<?php
require_once 'config.php'; require_login();
$items=$pdo->query("SELECT * FROM worship_services ORDER BY service_date DESC")->fetchAll();
?><!doctype html><html lang="id"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Tata Ibadah</title><link rel="stylesheet" href="assets/style.css"></head><body><?php include 'partials/nav.php'; ?><main class="container"><div class="page-title"><span class="eyebrow">IBADAH</span><h2>Tata Ibadah</h2></div><?php foreach($items as $w): ?><section class="card"><div class="section-head"><h3><?= e($w['title']) ?></h3><b><?= e(date('d/m/Y',strtotime($w['service_date']))) ?></b></div><p><?= nl2br(e($w['content'])) ?></p></section><?php endforeach; ?></main></body></html>
