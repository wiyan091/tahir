<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailModel extends Model
{
	protected $table = 'detail';
	protected $primaryKey = 'id';
	protected $allowedFields = [
		'id_user', 'id_atk','tanggal'
	];

	
}
