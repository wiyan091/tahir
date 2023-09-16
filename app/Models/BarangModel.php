<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangModel extends Model
{
	protected $table = 'atk';
	protected $primaryKey = 'id';
	protected $allowedFields = [
		'nama', 'jumlah', 'keterangan', 'tanggal', 'status', 'username', 'id_user'
	];

	public function details()
	{
		// id-atk berasal dari tabel detail dan id berasal dari tabel atk
		return $this->hasMany(DetailModel::class, 'id_atk', 'id');
	}

	// Fungsi untuk mengambil data barang beserta detailnya dengan JOIN
	public function getBarangWithDetails()
	{
		$this->select('atk.*, detail.*');
		$this->join('detail', 'atk.id = detail.id_atk', 'left');
		return $this->findAll();
	}
}
