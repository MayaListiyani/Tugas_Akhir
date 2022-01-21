<?php
include_once("koneksi.php");
$db = new koneksiDB();
$koneksi = $db->getKoneksi();
$request = $_SERVER['REQUEST_METHOD'];
$uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri_segment = explode('/', $uri_path);

switch ($request) {
    case 'GET':
        if (!empty($uri_segment[4])) {
            $id = intval($uri_segment[4]);
            get_Monitoring($id);
        } else {
            get_Monitoring();
        }
        break;

    default:
        header("HTTP/1.0 405 Method Tidak Terdaftar");
        break;
}

function get_Monitoring()
{
    global $koneksi;
    $query = "SELECT * FROM deteksi_sensor";
    $respon = array();
    $result = mysqli_query($koneksi, $query);
    $i = 0;
    while ($row = mysqli_fetch_array($result)) {
        $respon[] = $row;
    }
    header('Content-Type: application/json');
    echo json_encode($respon);
}
