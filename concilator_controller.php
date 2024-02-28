<?php
require_once("connection/connection.php");
require_once("concilator_model.php");
require_once "vendor/autoload.php";

use PhpOffice\PhpSpreadsheet\IOFactory;

if (isset($_POST['op'])) {
    $op = (isset($_POST['op'])) ? $_POST['op'] : '';
}
if (isset($_GET['op'])) {
    $op = (isset($_GET['op'])) ? $_GET['op'] : '';
}
$sheetexcel   = (isset($_POST['sheetexcel'])) ? $_POST['sheetexcel'] : '';
$confirmation = (isset($_POST['confirmation'])) ? $_POST['confirmation'] : '';
$codbank      = (isset($_POST['codbank'])) ? $_POST['codbank'] : '';

$codmov       = (isset($_POST['codmov'])) ? $_POST['codmov'] : '';
$ratemov      = (isset($_POST['ratemov'])) ? $_POST['ratemov'] : '';
$codcat       = (isset($_POST['codcat'])) ? $_POST['codcat'] : '';
$coditem      = (isset($_POST['coditem'])) ? $_POST['coditem'] : '';

$date         = (isset($_POST['date'])) ? $_POST['date'] : '';
$ratedate     = (isset($_POST['ratedate'])) ? $_POST['ratedate'] : '';

$payments = new Payments();

switch ($op) {
    case 1:

        $Path = "bankstatements";
        $targetPath = $Path.'/'.$_FILES['sheetexcel']['name'];
        move_uploaded_file($_FILES['sheetexcel']['tmp_name'], $targetPath);

        $documento = IOFactory::load($targetPath);
        $sheetData = $documento->getActiveSheet()->toArray(null, true, true, true);
        unset($sheetData[1]);

        $data = Array();
        $data['confirmation'] = $confirmation;
        $i=2;

        foreach ($sheetData as $row) {
            $sub_array = array();

            $sub_array['line'] = $i;
            $datef = explode(" ", str_replace("de ", "", $row['A']));
            $anno = $datef[2];
            if ($datef[1]=='enero') {
                $mes = '01';
            }
            if ($datef[1]=='febrero') {
                $mes = '02';
            }
            if ($datef[1]=='marzo') {
                $mes = '03';
            }
            if ($datef[1]=='abril') {
                $mes = '04';
            }
            if ($datef[1]=='mayo') {
                $mes = '05';
            }
            if ($datef[1]=='junio') {
                $mes = '06';
            }
            if ($datef[1]=='julio') {
                $mes = '07';
            }
            if ($datef[1]=='agosto') {
                $mes = '08';
            }
            if ($datef[1]=='septiembre') {
                $mes = '09';
            }
            if ($datef[1]=='octubre') {
                $mes = '10';
            }
            if ($datef[1]=='novimbre') {
                $mes = '11';
            }
            if ($datef[1]=='diciembre') {
                $mes = '12';
            }
            $dia = $datef[0];
            $datet = $anno.'-'.$mes.'-'.$dia;
            $date = $sub_array['date'] = date('Y-m-d', strtotime($datet));
            $refenc = $sub_array['refenc'] = $row['B'];
            $descri = $sub_array['descri'] = $row['C'];
           
            $amount = $sub_array['amount'] = str_replace(",", ".", str_replace(".", "", $row['D']));
            $motion = $sub_array['motion']  = $row['F'];
            
            $entity = $op;
            
            if ($confirmation == 'true') {
                if ($amount > 0) {
                    $result = $payments->savemovements($date,$refenc,$descri,$amount,$motion,$entity);
                    if ($result) {
                        $sub_array['message']  = 'se guardo';
                    }else {
                        $sub_array['message']  = 'no se guardo';
                    }
                }
            }
            
            $i++;
            
            $data[] = $sub_array;

        }

        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        break;

    case 2:

        $Path = "bankstatements";
        $targetPath = $Path.'/'.$_FILES['sheetexcel']['name'];
        move_uploaded_file($_FILES['sheetexcel']['tmp_name'], $targetPath);

        $documento = IOFactory::load($targetPath);
        $sheetData = $documento->getActiveSheet()->toArray(null, true, true, true);
        unset($sheetData[1]);

        $data = Array();
        $data['confirmation'] = $confirmation;
        $i=2;

        foreach ($sheetData as $row) {
            $sub_array = array();

            $sub_array['line'] = $i;
            $datef = explode("/", $row['A']);
            $anno = $datef[2];
            $mes = $datef[1];
            $dia = $datef[0];
            $datet = $anno.'-'.$mes.'-'.$dia;
            $date = $sub_array['date'] = date('Y-m-d', strtotime($datet));
            $refenc = $sub_array['refenc'] = $row['B'];
            $descri = $sub_array['descri'] = $row['C'];
            if ($row['E'] <= 0) {
                $amount = $sub_array['amount'] = str_replace(",", ".", str_replace(".", "", $row['E']))*(-1);
                $motion = $sub_array['motion'] = 'Nota de Debito';
            }else {
                $amount = $sub_array['amount'] = str_replace(",", ".", str_replace(".", "", $row['E']));
                $motion = $sub_array['motion']  = 'Nota de Credito';
            }
            $entity = $op;
            
            if ($confirmation == 'true') {
                if ($amount > 0) {
                    $result = $payments->savemovements($date,$refenc,$descri,$amount,$motion,$entity);
                    if ($result) {
                        $sub_array['message']  = 'se guardo';
                    }else {
                        $sub_array['message']  = 'no se guardo';
                    }
                }
            }
            
            $i++;
            
            $data[] = $sub_array;

        }

        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        break;

    case 3:

        $Path = "bankstatements";
        $targetPath = $Path.'/'.$_FILES['sheetexcel']['name'];
        move_uploaded_file($_FILES['sheetexcel']['tmp_name'], $targetPath);

        $documento = IOFactory::load($targetPath);
        $sheetData = $documento->getActiveSheet()->toArray(null, true, true, true);
        unset($sheetData[1],$sheetData[2],$sheetData[3],$sheetData[4],$sheetData[5],$sheetData[6],$sheetData[7],$sheetData[8],$sheetData[9],$sheetData[10],$sheetData[11],$sheetData[12],$sheetData[13],$sheetData[14],$sheetData[15],$sheetData[16]);

        $data = Array();
        $data['confirmation'] = $confirmation;
        $i=17;

        foreach ($sheetData as $row) {
            $sub_array = array();

            $sub_array['line'] = $i;
            $datef = explode("/", $row['B']);
            $anno = $datef[2];
            $mes = $datef[1];
            $dia = $datef[0];
            $datet = $anno.'-'.$mes.'-'.$dia;
            $date = $sub_array['date'] = date('Y-m-d', strtotime($datet));
            $refenc = $sub_array['refenc'] = $row['M'];
            $descri = $sub_array['descri'] = $row['H'];
        
            if ($row['N'] < 0) {
                $amount = $sub_array['amount'] = str_replace(",", "", $row['N'])*(-1);
                $motion = $sub_array['motion'] = 'Nota de Debito';
            }
        
            if ($row['P'] > 0) {
                $amount = $sub_array['amount'] = str_replace(",", "", str_replace("+", "", $row['P']));
                $motion = $sub_array['motion'] = 'Nota de Credito';
            }

            $entity = $op;
            
            if ($confirmation == 'true') {
                if ($amount > 0) {
                    $result = $payments->savemovements($date,$refenc,$descri,$amount,$motion,$entity);
                    if ($result) {
                        $sub_array['message']  = 'se guardo';
                    }else {
                        $sub_array['message']  = 'no se guardo';
                    }
                }
            }
            
            $i++;
            $data[] = $sub_array;
        }  
              
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        break;

    case 4:

        $Path = "bankstatements";
        $targetPath = $Path.'/'.$_FILES['sheetexcel']['name'];
        move_uploaded_file($_FILES['sheetexcel']['tmp_name'], $targetPath);

        $documento = IOFactory::load($targetPath);
        $sheetData = $documento->getActiveSheet()->toArray(null, true, true, true);
        unset($sheetData[1],$sheetData[2],$sheetData[3],$sheetData[4],$sheetData[5],$sheetData[6],$sheetData[7],$sheetData[8],$sheetData[9],$sheetData[10],$sheetData[11],$sheetData[12],$sheetData[13],$sheetData[14],$sheetData[15]);

        $data = Array();
        $data['confirmation'] = $confirmation;
        $i=16;

        foreach ($sheetData as $row) {
            $sub_array = array();

            $sub_array['line'] = $i;
            $datef = explode("/", $row['A']);
            $anno = $datef[2];
            $mes = $datef[1];
            $dia = $datef[0];
            $datet = $anno.'-'.$mes.'-'.$dia;
            $date = $sub_array['date'] = date('Y-m-d', strtotime($datet));
            $refenc = $sub_array['refenc'] = str_replace("'", "",$row['D']);
            $descri = $sub_array['descri'] = $row['E'];
            if ($row['F'] < 0.01) {
                $amount = $sub_array['amount'] = str_replace(",", ".", str_replace(".", "", $row['F']))*(-1);
                $motion = $sub_array['motion'] = 'Nota de Debito';
            }else {
                $amount = $sub_array['amount'] = str_replace(",", ".", str_replace(".", "", $row['F']));
                $motion = $sub_array['motion'] = 'Nota de Credito';
            }
            $entity = $op;

            if ($confirmation == 'true') {
                if ($amount > 0) {
                    $result = $payments->savemovements($date,$refenc,$descri,$amount,$motion,$entity);
                    if ($result) {
                        $sub_array['message']  = 'se guardo';
                    }else {
                        $sub_array['message']  = 'no se guardo';
                    }
                }
            }

            $i++;
            $data[] = $sub_array;
            
        }

        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        break;

    case 5:
        
        $Path = "bankstatements";
        $targetPath = $Path.'/'.$_FILES['sheetexcel']['name'];
        move_uploaded_file($_FILES['sheetexcel']['tmp_name'], $targetPath);

        $documento = IOFactory::load($targetPath);
        $sheetData = $documento->getActiveSheet()->toArray(null, true, true, true);
        unset($sheetData[1],$sheetData[2],$sheetData[3],$sheetData[4],$sheetData[5],$sheetData[6],$sheetData[7],$sheetData[8],$sheetData[9],$sheetData[10],$sheetData[11],$sheetData[12],$sheetData[13],$sheetData[14],$sheetData[15],$sheetData[16],$sheetData[17]);
        unset($sheetData[18],$sheetData[19],$sheetData[20],$sheetData[21],$sheetData[22],$sheetData[23],$sheetData[24],$sheetData[25],$sheetData[26],$sheetData[27],$sheetData[28],$sheetData[29],$sheetData[30],$sheetData[31],$sheetData[32]);


        $data = Array();
        $data['confirmation'] = $confirmation;
        $i=2;

        foreach ($sheetData as $row) {
            $sub_array = array();

            $sub_array['line'] = $i;
            $datef = explode("/", $row['A']);
            $anno = $datef[2];
            $mes = $datef[1];
            $dia = $datef[0];
            $datet = $anno.'-'.$mes.'-'.$dia;
            $date = $sub_array['date'] = date('Y-m-d', strtotime($datet));
            $refenc = $sub_array['refenc'] = $row['B'];
            $descri = $sub_array['descri'] = $row['D'];
            if (!empty($row['E'])) {
                $amount = $sub_array['amount'] = str_replace(",", ".", str_replace(".", "", $row['E']));
                $motion = $sub_array['motion'] = 'Nota de Debito';
            }
            if (!empty($row['F'])) {
                $amount = $sub_array['amount'] = str_replace(",", ".", str_replace(".", "", $row['F']));
                $motion = $sub_array['motion'] = 'Nota de Debito';
            }
            $entity = $op;
            
            if ($confirmation == 'true') {
                if ($amount > 0) {
                    $result = $payments->savemovements($date,$refenc,$descri,$amount,$motion,$entity);
                    if ($result) {
                        $sub_array['message']  = 'se guardo';
                    }else {
                        $sub_array['message']  = 'no se guardo';
                    }
                }
            }
            
            $i++;
            
            $data[] = $sub_array;

        }

        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        break;

    case 'getbank':
        $data = $payments->getbank();
        $dato = Array();

        foreach ($data as $row) {
            $sub_array = array();
        
            $sub_array['CodEnt']        = $row['CodEnt'];
            $sub_array['DescripEntity'] = $row['DescripEntity'];

            $dato[] = $sub_array;
        }

        echo json_encode($dato, JSON_UNESCAPED_UNICODE); 
        break;

    case 'getmov':
        if ($codbank == '-') {
            $condition = '';
          }else {
            $condition = " WHERE CodEnt = '$codbank'";
          }

        $data = $payments->getmovements($condition);
        $dato = Array();

        foreach ($data as $row) {
            $sub_array = array();
        
            $sub_array['CodMov']     = $row['CodMov'];
            $sub_array['CodEnt']     = $row['CodEnt'];
            $sub_array['DateMov']    = $row['DateMov'];
            $sub_array['RefMov']     = $row['RefMov'];
            $sub_array['DescripMov'] = $row['DescripMov'];
            $sub_array['AmouMov']    = number_format($row['AmouMov'], 2, '.', '');
            $sub_array['RateMov']    = number_format($row['RateMov'], 2, '.', '');
            $sub_array['TipMov']     = $row['TipMov'];
            $sub_array['CodCat']     = $row['CodCat'];
            $sub_array['CodItem']    = $row['CodItem'];

            $dato[] = $sub_array;
        }

        echo json_encode($dato, JSON_UNESCAPED_UNICODE);
        break;
    
    case 'getcat':
        $data = $payments->getcat();
        $dato = Array();

        foreach ($data as $row) {
            $sub_array = array();
        
            $sub_array['CodCat']     = $row['CodCat'];
            $sub_array['DescripCat'] = $row['DescripCat'];

            $dato[] = $sub_array;
        }

        echo json_encode($dato, JSON_UNESCAPED_UNICODE);
        break;

    case 'getitem':
        $data = $payments->getitem();
        $dato = Array();

        foreach ($data as $row) {
            $sub_array = array();
        
            $sub_array['CodItem']    = $row['CodItem'];
            $sub_array['DescripPar'] = $row['DescripPar'];

            $dato[] = $sub_array;
        }

        echo json_encode($dato, JSON_UNESCAPED_UNICODE);
        break;

    case 'updatemove':
        $saved = $payments->updatemovements($codmov,$ratemov,$codcat,$coditem);

        if ($saved) {
            $output = [
                "mensaje" => "Guardado con Exito!",
                "icono"   => "success"
            ];
        } else {
            $output = [
                "mensaje" => "Ocurrió un error al Guardar!",
                "icono"   => "error",
            ];
        }

        echo json_encode($output);
        break;
    
    case 'getvaluecat':
        $data = $payments->getvaluecat($codcat);
        $dato = Array();

        foreach ($data as $row) {
            $sub_array = array();
        
            $sub_array['CodCat']     = $row['CodCat'];
            $sub_array['DescripCat'] = $row['DescripCat'];

            $dato[] = $sub_array;
        }

        echo json_encode($dato, JSON_UNESCAPED_UNICODE); 
        break;
    
    case 'getvalueitem':
        $data = $payments->getvalueitem($coditem);
        $dato = Array();

        foreach ($data as $row) {
            $sub_array = array();
        
            $sub_array['CodItem']    = $row['CodItem'];
            $sub_array['DescripPar'] = $row['DescripPar'];

            $dato[] = $sub_array;
        }

        echo json_encode($dato, JSON_UNESCAPED_UNICODE);
        break;

    case 'updrateday':
        $saved = $payments->updaterate($ratedate,$date);

        if ($saved) {
            $output = [
                "mensaje" => "Guardado con Exito!",
                "icono"   => "success"
            ];
        } else {
            $output = [
                "mensaje" => "Ocurrió un error al Guardar!",
                "icono"   => "error",
            ];
        }

        echo json_encode($output);
        break;

}

