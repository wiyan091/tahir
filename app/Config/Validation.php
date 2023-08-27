<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Validation\StrictRules\CreditCardRules;
use CodeIgniter\Validation\StrictRules\FileRules;
use CodeIgniter\Validation\StrictRules\FormatRules;
use CodeIgniter\Validation\StrictRules\Rules;

class Validation extends BaseConfig
{
    // --------------------------------------------------------------------
    // Setup
    // --------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var string[]
     */
    public array $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public array $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    // --------------------------------------------------------------------
    // Rules
    // --------------------------------------------------------------------

    public $barang = [
        'nama' => [
            'rules' => 'required|min_length[3]',
            'errors' => [
                'required' => '{field} Harus Diisi',
                'min_length' => '{field} Minimal 3 Karakter',
            ],
        ],
        'jumlah' => [
            'rules' => 'required|integer',
            'errors' => [
                'required' => '{field} Harus Diisi',
                'integer' => '{field} Harus Angka',
            ],
        ],
        'keterangan' => [
            'rules' => 'required',
            'errors' => [
                'required' => '{field} Harus Diisi',
            ],
        ],
        'tanggal' => [
            'rules' => 'required|valid_date',
            'errors' => [
                'required' => '{field} Harus Diisi',
                'valid_date' => '{field} Tanggal tidak valid',
            ],
        ],
    ];
}
