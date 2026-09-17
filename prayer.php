<?php
require_once 'config.php'; require_login();
$msg='';
if($_SERVER['REQUEST_METHOD']==='POST'){
    $text=trim($_POST['request_text']??'');
    $private=isset($_POST['private'])?1:0;
    if($text){$st=$pdo->prepare("INSERT INTO prayer_requests (user_id,request_text,is_private) VALUES (?,?,?)");$st->execute([$_SESSION['user']['id'],$text,$private]);$msg='Permohonan doa berhasil dikirim.';}
}
?><!doctype html><html lang="id"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Permohonan Doa</title><link rel="stylesheet" href="assets/style.css"></head><body><?php include 'partials/nav.php'; ?><main class="container"><div class="page-title"><span class="eyebrow">PELayanan DOA</span><h2>Permohonan Doa</h2></div><section class="card form-card"><?php if($msg): ?><div class="alert success"><?= e($msg) ?></div><?php endif; ?><form method="post"><label>Permohonan doa</label><textarea name="request_text" rows="7" required placeholder="Tuliskan pokok doa Anda..."></textarea><label class="check"><input type="checkbox" name="private"> Rahasiakan identitas saya dari jemaat lain</label><button class="btn primary">Kirim Permohonan</button></form></section></main></body></html>
