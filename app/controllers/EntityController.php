<?php

namespace app\controllers;

use app\models\Category;
use app\models\Currency;
use app\models\Entity;
use League\Flysystem\Exception;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

/** @property Entity $model */
class EntityController extends AppController
{


    public function pdfweekAction()
    {





        $data = $_POST;

        $expenses = $this->model->loadExpense($data);



        $sOutFile = 'out-w.xlsx';
        $oSpreadsheet_Out = new Spreadsheet();

        $oSpreadsheet_Out->getProperties()->setCreator('Cистема учета расходов')
            ->setLastModifiedBy('Maarten Balliauw')
            ->setTitle('Office 2007 XLSX Test Document')
            ->setSubject('Office 2007 XLSX Test Document')
            ->setDescription('')
            ->setKeywords('')
            ->setCategory('')
        ;

        $i = 1;
            $oSpreadsheet_Out->setActiveSheetIndex(0)
                ->setCellValue('A'.$i, 'Сумма')
                ->setCellValue('B'.$i, 'Категория')
                ->setCellValue('C'.$i, 'Неделя')
                ->setCellValue('D'.$i, 'Месяц')
                ->setCellValue('E'.$i, 'Год')
            ;
            $sum = 0;
            foreach ($expenses as $expense){
                $sum = $sum + $expense['sum'];
                $i++;
                $oSpreadsheet_Out->setActiveSheetIndex(0)
                    ->setCellValue('A'.$i, $expense['sum'])
                    ->setCellValue('B'.$i, $expense['name'])
                    ->setCellValue('C'.$i, $expense['week'])
                    ->setCellValue('D'.$i, $expense['month'])
                    ->setCellValue('E'.$i, $expense['year'])
                ;
            }





        // Add some data


        $oWriter = IOFactory::createWriter($oSpreadsheet_Out, 'Xlsx');
        $oWriter->save($sOutFile);
        //$oWriter->save('php://output');
        //header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        //header('Content-Disposition: attachment; filename="'. urlencode($sOutFile).'"');
        //$oWriter->save('php://output');

        echo true;
        die();

    }




    public function pdfAction()
    {

        logger($_POST);
        /*
        $_POST['company_id'] => 1
    [category] => 1
    [year] => 2023
    [month] => 1
    [week] => 6


        $data['entity'] = 1;
        $data['category'] = 1;
        $data['year'] = 2022;
        $data['month'] = 1;
        $data['week'] = 6;
         */

        $data = $_POST;

        $expenses = $this->model->loadExpense($data);

        usort($expenses, function($a, $b) {
            return $a['week'] - $b['week'];
        });

        $array = [];
        foreach($expenses as $expense){
            $array[$expense['name']][] = $expense;
        }
        //debug($array);
        $sortexpenses = $array;

        debug($sortexpenses);

        $sOutFile = 'out.xlsx';
        $oSpreadsheet_Out = new Spreadsheet();

        $oSpreadsheet_Out->getProperties()->setCreator('Maarten Balliauw')
            ->setLastModifiedBy('Maarten Balliauw')
            ->setTitle('Office 2007 XLSX Test Document')
            ->setSubject('Office 2007 XLSX Test Document')
            ->setDescription('Test document for Office 2007 XLSX, generated using PHP classes.')
            ->setKeywords('office 2007 openxml php')
            ->setCategory('Test result file')
        ;

        $i = 1;
        foreach ($sortexpenses as $key => $expenses){
            $oSpreadsheet_Out->setActiveSheetIndex(0)
                ->setCellValue('A'.$i, $key)
            ;
            $i++;
            $oSpreadsheet_Out->setActiveSheetIndex(0)
                ->setCellValue('A'.$i, 'Сумма')
                ->setCellValue('B'.$i, 'Неделя')
                ->setCellValue('C'.$i, 'Месяц')
                ->setCellValue('D'.$i, 'Год')
            ;
            $sum = 0;
            foreach ($expenses as $expense){
                $sum = $sum + $expense['sum'];
                $i++;
                $oSpreadsheet_Out->setActiveSheetIndex(0)
                    ->setCellValue('A'.$i, $expense['sum'])
                    ->setCellValue('B'.$i, $expense['week'])
                    ->setCellValue('C'.$i, $expense['month'])
                    ->setCellValue('D'.$i, $expense['year'])
                ;
            }

            $i++;
            $oSpreadsheet_Out->setActiveSheetIndex(0)
                ->setCellValue('A'.$i, 'Итого: '.$sum)
            ;

            $i++;
        }

        // Add some data


        $oWriter = IOFactory::createWriter($oSpreadsheet_Out, 'Xlsx');
        $oWriter->save($sOutFile);
        //$oWriter->save('php://output');
        //header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        //header('Content-Disposition: attachment; filename="'. urlencode($sOutFile).'"');
        //$oWriter->save('php://output');

        echo true;
        die();

    }




    public function legalViewAction ()
        {
            $entities = $this->model->findAll('legal');

            $title = "Список юридических лиц";
            $this->set(compact('entities', 'title'));
            $this->setMeta($title);
        }

        public function physicalViewAction ()
        {

            $entities = $this->model->findAll('physical');

            $title = "Список физических лиц";
            $this->set(compact('entities', 'title'));
            $this->setMeta($title);
        }

    public function addAction()
    {
        $type = get('type', 's');

        if(!empty($_POST)) {
            if(!empty($_POST['name'])) {
                if ($this->model->add($_POST['name'], $type)) {
                    $_SESSION['success'] = "Новое лицо добавлено";
                } else {
                    $_SESSION['errors'] = "Ошибка!";
                }
            } else {
                $_SESSION['errors'] = "Ошибка!";
            }
            redirect();
        }

        if($type == 'legal'){
            $title = "Добавить новое юридическое лицо";
        } else {
            $title = "Добавить новое физическое лицо";
        }

        $this->set(compact( 'title'));
        $this->setMeta($title);
    }


    public function viewexpensesAction()
    {
        $id = $this->route['id'];

        if($_SESSION['user']['role'] == 'admin' OR $_SESSION['user']['role'] == 'user') {
            if($_SESSION['user']['company_id'] != $id){
                throw new \Exception('Такой страницы не существует', 404);
            }

        }


        $type = get('type');
        $expenses = [];
        $sortexpenses = [];
        $categoryname = '';
        $categorymodel = new Category();
        $categories = $categorymodel->findAll($type);



        if(!empty($_POST)) {

            $data = $_POST;
            $data['entity'] = $id;
            $categoryname = $categorymodel->findOne($data['category']);
            $categoryname = $categoryname[0]['name'];


            $expenses = $this->model->loadExpense($data);

            /*debug($expenses);*/


            if($_POST['week'] == 6) {

                //debug($expenses);

                usort($expenses, function($a, $b) {
                    return $a['week'] - $b['week'];
                });

                $array = [];
                foreach($expenses as $expense){
                    $array[$expense['name']][] = $expense;
                }
                //debug($array);
                $sortexpenses = $array;
            }

            $_SESSION['form_data'] = $data;
            if(count($expenses)) {
                    $_SESSION['success'] = "Данные загружены!";
                } else {
                    $_SESSION['errors'] = "Ничего не найдено";

            }


        }

        $entity = $this->model->findOne($id);
        $entity = $entity[0];

        $title = "Смотреть расходы для - {$entity['name']}";
        $this->set(compact('entity','categories', 'title', 'expenses', 'sortexpenses'));
        $this->setMeta($title);
    }


        public function addexpensesAction()
        {
            $id = $this->route['id'];
            $type = get('type');

            $categorymodel = new Category();
            $categories = $categorymodel->findAll($type);

            $currencymodel = new Currency();
            $currencies = $currencymodel->findAll();



            if(!empty($_POST)) {

                $data = $_POST;
                $data['week'] = isset($_POST['week']) ? $_POST['week'] : 0;
                $data['entity'] = $id;
                /*$data['period'] = $per;*/

                $_SESSION['form_data'] = $data;
                //debug($data);
                //die();


                if(!empty($_POST['sum'])) {
                    if ($this->model->saveExpense($data)) {
                        $_SESSION['success'] = "Расход добавлен";
                    } else {
                        $_SESSION['errors'] = "Ошибка! Расход не добавлен";
                    }
                } else {
                    $_SESSION['errors'] = "Ошибка! Cумма расхода не заполненаe";
                }

                redirect();
            }



            $entity = $this->model->findOne($id);
            $entity = $entity[0];

            $title = "Добавить расход для - {$entity['name']}";
            $this->set(compact('entity','categories', 'currencies', 'title'));
            $this->setMeta($title);


        }

    public function deleteexpensesAction()
    {
        $id = $this->route['id'];
        if($this->model->deleteExpense($id)){
            $_SESSION['success'] = "Запись удалена успешно";
        } else {
            $_SESSION['errors'] = "Ошибка при удалении записи";
        }
        redirect();


    }




        public function deleteAction()
        {
            $id = $this->route['id'];
            if($this->model->delete($id)){
                $_SESSION['success'] = "Страница удалена успешно";
            } else {
                $_SESSION['errors'] = "Ошибка при удалении страницы";
            }
            redirect();


        }
}