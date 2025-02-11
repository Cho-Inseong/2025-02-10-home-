<?php
session_start(); // 세션을 시작하는 함수, 사용자의 정보를 서버에 유지, 이 코드가 없으면 $_SESSION변수를 사용할 수 없음

$request = $_SERVER['REQUEST_URI']; // 사용자가 요청한 URL을 가져오는 코드, 도메인 이후의 전체 URL 경로를 포함
$path = explode("?", $request); // "?"을 기준으로 $request를 나눔눔
$path[1] = isset($path[1]) ? $path[1] : null; // isset(): 괄호안에 있는 변수나 배열에 값이 있으면 true 삼항 연산자: 예)$result = (조건) ? 값1 : 값2;, 조건이 true이면 값1을 반환
$resource = explode("/", $path[0]); 

$pages = ''; 
switch ($resource[1]) { //$resource[1]에 값이 있으면 switch case문 실행
    case '':
        $pages = './views/dashboard.php';
        break;
    default:
        echo "경로가 잘못됨";
        break;   
};
include($pages);

?>