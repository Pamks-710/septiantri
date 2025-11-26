<?php
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    /**
     * Nama tabel yang terhubung dengan model ini.
     */
    protected $table = 'mahasiswa';

    /**
     * Kolom apa saja.
     */
    protected $fillable = ['npm', 'nama', 'jurusan'];

    /**
     * Menonaktifkan timestamp 'created_at' dan 'updated_at' bawaan Eloquent.
     * Kita set 'false' karena di tabelmu (dari screenshot) sepertinya 
     * 'created_at' diatur otomatis oleh MySQL dan kamu tidak punya 'updated_at'.
     */
    public $timestamps = false; 
}