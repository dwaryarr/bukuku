<?php

function format_rupiah($angka)
{
    return 'Rp. ' . number_format($angka, 0, ',', '.');
}

function discount_price($price, $discount)
{
    return format_rupiah($price - ($price * $discount / 100));
}

function status_order($so, $sb)
{
    if ($so == 0) {
        if ($sb == 'pending') {
            return '<span class="badge bg-warning">Menunggu Pembayaran</span>';
        } else if ($sb == 'success') {
            return '<span class="badge bg-success">Terbayar</span>';
        } else {
            return '<span class="badge bg-danger">Dibatalkan</span>';
        }
    } else if ($so == 1) {
        return '<span class="badge bg-info">Diproses</span>';
    } else if ($so == 2) {
        return '<span class="badge bg-success">Selesai</span>';
    } else {
        return '<span class="badge bg-danger">Dibatalkan</span>';
    }
}
