<?php

namespace App\Controllers;

use App\Models\BarangModel;
use Dompdf\Dompdf;
use Dompdf\Options;

class Home extends BaseController
{
    public function index()
    {
        $barangModel = new BarangModel();
        $barang = $barangModel->findAll();
        $data['barangs'] = $barang;

        return view('dashboard', $data);
    }

    public function generatePdf()
    {
        $barangModel = new BarangModel();
        $barangs = $barangModel->findAll();

        // Load the dompdf library
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);

        // Load your HTML content from the view or create it directly here
        $data['barangs'] = $barangs;
        $html = view('print_pdf', $data); // Create a view named pdf_table_template.php

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
