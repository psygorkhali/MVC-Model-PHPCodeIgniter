<?php
//include the file that loads the PhpSpreadsheet classes
require_once 'spreadsheet/vendor/autoload.php';

//include the classes needed to create and write .xlsx file
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class DownloadSkillMatrix extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('downloadmodel');
        $this->load->helper('url');
    }


    public function createexcelsheet()
    {
        //fetching the data
        $userid = $this->uri->segment(3);
        $rating = $this->downloadmodel->getratingdata($userid);
        $skills = $this->downloadmodel->getcategorydata();
        $description = $skills->result();
        //object of the Spreadsheet class to create the excel data
        $spreadsheet = new Spreadsheet();

        $styleArray1 = [
            'font' => [
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
            ],
            'borders' => [
                'top' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR,
                'rotation' => 90,
                'startColor' => [
                    'argb' => 'FFA0A0A0',
                ],
                'endColor' => [
                    'argb' => 'FFFFFFFF',
                ],
            ],
        ];


        //COlUMN NAMES
        $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(1, 1, 'Skills' );
        $spreadsheet->getActiveSheet()->getStyle('B1')->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FF009688');
        $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(2, 1, 'Rating' );
        $spreadsheet->getActiveSheet()->getStyle('C1')->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FF009688');

        $index = 0;
        $row = 2;
        for ($c = 0; $c < $skills->num_rows(); $c++)
        {
            //getting the cell value
            $column1 = \PhpOffice\PhpSpreadsheet\Cell::stringFromColumnIndex(1);
            $cell = $column1.$row;
            $spreadsheet->getActiveSheet()->getStyle($cell)->applyFromArray($styleArray1);
            $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(1, $row, $rating[$index]->category );
            //background color
            $spreadsheet->getActiveSheet()->getStyle($cell)->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()->setARGB('FFE8E5E5');

            for ($s = 0; $s < $description[$c]->numskill; $s++)
            {
                $row++;


                if ($s % 2 == 0)
                {
                    //getting the cell value
                    $cell = $column1.$row;
                    $spreadsheet->getActiveSheet()->getStyle($cell)->applyFromArray($styleArray1);
                    $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(1, $row, $rating[$index]->description); 
                    //background color
                    $spreadsheet->getActiveSheet()->getStyle($cell)->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()->setARGB('FF58A7C4');



                    $column2 = \PhpOffice\PhpSpreadsheet\Cell::stringFromColumnIndex(2);
                    $cell = $column2.$row;
                    $spreadsheet->getActiveSheet()->getStyle($cell)->applyFromArray($styleArray1);
                    $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(2, $row, $rating[$index]->rating);
                    //background color
                    $spreadsheet->getActiveSheet()->getStyle($cell)->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()->setARGB('FF58A7C4');
                }

                else
                {
                    //getting the cell value
                    $cell = $column1.$row;
                    $spreadsheet->getActiveSheet()->getStyle($cell)->applyFromArray($styleArray1);
                    $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(1, $row, $rating[$index]->description);
                    //background color
                    $spreadsheet->getActiveSheet()->getStyle($cell)->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()->setARGB('FFB3CB8A');


                    $column2 = \PhpOffice\PhpSpreadsheet\Cell::stringFromColumnIndex(2);
                    $cell = $column2.$row;
                    $spreadsheet->getActiveSheet()->getStyle($cell)->applyFromArray($styleArray1);
                    $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(2, $row, $rating[$index]->rating);
                    //background color
                    $spreadsheet->getActiveSheet()->getStyle($cell)->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()->setARGB('FFB3CB8A');

                }


                $index++;


            }
            $row++;
        }

        //
        //        //set style for A1,B1,C1 cells
        //        $cell_st =[
        //            'font' =>['bold' => true],
        //            'alignment' =>['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
        //            'borders'=>['bottom' =>['style'=> \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM]]
        //        ];
        //        $spreadsheet->getActiveSheet()->getStyle('A1:C1')->applyFromArray($cell_st);
        //
        //set columns width
        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(16);
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(18);

        $spreadsheet->getActiveSheet()->setTitle('Simple'); //set a title for Worksheet

        //make object of the Xlsx class to save the excel file
        //        $writer = new Xlsx($spreadsheet);
        //        $fxls ='excel-file_1.xlsx';
        //        $writer->save($fxls);

        //check if excel created
        //        if(file_exists($fxls)) echo $fxls .' succesfully created';
        //        else echo 'Unable to write: '. $fxls;
        // redirect output to client browser
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="myfile.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');

        $spreadsheet->disconnectWorksheets();
        unset($spreadsheet);
    }

}
