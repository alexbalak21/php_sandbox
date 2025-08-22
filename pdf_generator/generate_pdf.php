<?php
require_once __DIR__ . '/vendor/autoload.php';

use Dompdf\Dompdf;

$dompdf = new Dompdf();

$htmlContent = '<h1>Sample PDF</h1><p>This is a sample PDF generated from HTML content.</p>';

$dompdf->loadHtml($htmlContent);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

$dompdf->stream('sample.pdf', ['Attachment' => true]);
