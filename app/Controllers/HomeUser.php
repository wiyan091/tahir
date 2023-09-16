<?php

namespace App\Controllers;

use App\Models\BarangModel;
use Dompdf\Dompdf;
use Dompdf\Options;

class HomeUser extends BaseController
{
    protected $baranguser;

    function __construct()
    {
        helper('form');
        helper('number');
        $this->baranguser = new BarangModel();
        
    }
    public function index()
    {
        $username = session()->get('username'); // Mengambil username dari session
        
        // Mengambil status pemesanan hanya untuk akun yang sedang login
        $data['barangusers'] = $this->baranguser->where('username', $username)->findAll();

        return view('dashboard_user', $data);
    }

    public function generateuserPdf()
    {
        $username = session()->get('username'); // Mengambil username dari session
        // Load the dompdf library
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);

        // Load your HTML content from the view or create it directly here
        $data['barangusers'] = $this->baranguser->where('username', $username)->findAll();
        $html = view('printuser_pdf', $data); // Create a view named pdf_table_template.php

        // Load HTML to dompdf
        $dompdf->loadHtml($html);

        // (Optional) Set paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF
        $dompdf->stream('ATK_Humas.pdf', ['Attachment' => false]);
        exit();
    }
}
