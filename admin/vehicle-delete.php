<?php
require_once __DIR__ . '/auth.php';

$id = get_id();

if (!$id) {
    flash_set('error', 'Invalid vehicle.');
    header('Location: vehicles.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !csrf_ok()) {
    flash_set('error', 'Invalid delete request.');
    header('Location: vehicles.php');
    exit;
}

$st = $conn->prepare("SELECT image FROM vehicles WHERE id=? LIMIT 1");
$st->bind_param('i', $id);
$st->execute();
$row = $st->get_result()->fetch_assoc();
$st->close();

$st = $conn->prepare("DELETE FROM vehicles WHERE id=?");
$st->bind_param('i', $id);

if ($st->execute()) {
    if (!empty($row['image'])) {
        $path = __DIR__ . '/../assets/img/' . basename($row['image']);
        if (is_file($path)) @unlink($path);
    }
    flash_set('ok', 'Vehicle deleted.');
} else {
    flash_set('error', 'Could not delete vehicle.');
}
$st->close();

header('Location: vehicles.php');
exit;
