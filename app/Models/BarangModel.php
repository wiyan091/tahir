<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangModel extends Model
{
	protected $table = 'atk';
	protected $primaryKey = 'id';
	protected $allowedFields = [
		'nama', 'jumlah', 'keterangan', 'tanggal', 'status','username'
	];
}
