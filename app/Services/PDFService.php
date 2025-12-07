<?php

namespace App\Services;

use Mpdf\Config\ConfigVariables;
use Mpdf\Config\FontVariables;
use Mpdf\HTMLParserMode;

class PDFService
{
    protected $mpdf;

    public function __construct(protected $config = [])
    {
        $defaultConfig = (new ConfigVariables())->getDefaults();
        $fontDirs = $defaultConfig['fontDir'];

        $defaultFontConfig = (new FontVariables())->getDefaults();
        $fontData = $defaultFontConfig['fontdata'];

        $this->mpdf = new \Mpdf\Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4',
            'orientation' => 'P',
            'margin_left' => 10,
            'margin_right' => 10,
            'margin_top' => 10,
            'margin_bottom' => 10,
            'margin_header' => 20,
            'margin_footer' => 10,
            'fontDir' => array_merge($fontDirs, [
                public_path('assets/fonts'),
            ]),
            'fontdata' => $fontData + [
                    'arefruqaa' => [
                        'R' => 'Aref_Ruqaa/ArefRuqaa-Regular.ttf',
                        'B' => 'Aref_Ruqaa/ArefRuqaa-Bold.ttf',
                        'useOTL' => 0xFF,
                        'useKashida' => 75,
                    ],
                ],
            'default_font' => 'tajawal',
            ...$config
        ]);
    }

    public function writeHTML($html, $mode = HTMLParserMode::DEFAULT_MODE, $init = true, $close = true)
    {
        $this->mpdf->WriteHTML($html, $mode, $init, $close);
        return $this;
    }

    public function setHTMLHeader($html)
    {
        $this->mpdf->SetHTMLHeader($html);
        return $this;
    }

    public function setHTMLFooter($html)
    {
        $this->mpdf->SetHTMLFooter($html);
        return $this;
    }

    public function setDocTemplate($file = '', $continue = 0, $continue2pages = 0)
    {
        if (!file_exists($file)) {
            throw new \Exception("PDF file not found at path: {$file}");
        }

        $this->mpdf->SetDocTemplate($file, $continue, $continue2pages);
        return $this;
    }

    public function output($path, $type)
    {
        return $this->mpdf->Output($path, $type);
    }

    public function response($filename = '')
    {
        return $this->output($filename, 'I');
    }

    public function download($filename = '')
    {
        return $this->output($filename, 'D');
    }
}
