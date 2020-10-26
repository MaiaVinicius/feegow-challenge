<?php

$getPost = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (empty($getPost) || empty($getPost['action'])):
    die('Acesso Negado!');
endif;

$strPost = array_map('strip_tags', $getPost);
$POST = array_map('trim', $strPost);

$Action = $POST['action'];
unset($POST['action']);

$jSON = null;

usleep(2000);

require '../../../_app/Config.inc.php';
$Read = new Read;
$Create = new Create;
$Update = new Update;
$Delete = new Delete;

switch ($Action):
    case 'create_schedule':
        $CreateSchedule = [
            'specialty_id' => $POST['specialty_id'],
            'professional_id' => $POST['professional_id'],
            'name' => $POST['name'],
            'source_id' => $POST['source_id'],
            'birthdate' => Check::Nascimento($POST['birthdate']),
            'cpf' => $POST['cpf'],
            'date_time' => date('Y-m-d H:i:s'),
        ];

        $Create->ExeCreate(DB_SCHEDULES, $CreateSchedule);

        $jSON['send'] = $POST['name'];
        break;
endswitch;

echo json_encode($jSON);
