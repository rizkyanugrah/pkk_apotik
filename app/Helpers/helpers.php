<?php

/**
 * Format tanggal menjadi indonesia, parameter berdasarkan date dari database
 *
 * @param  date $date
 * @return date
 */
function indonesian_date($date)
{
    return date('d-m-Y', strtotime($date));
}

/**
 * Pengecekan jika obat telah kadaluarsa atau tidak, parameter dari kolom is_expired database
 *
 * @param  mixed $medicine
 * @return string
 */
function is_expired($medicine)
{
    return $medicine->is_expired === 1 ? 'Ya' : 'Tidak';
}
