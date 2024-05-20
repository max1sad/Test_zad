<?php
// Маршруты
// [маршрут => функция которая будет вызвана]
$routes = [
    '/list_obj' => 'fileManager'
];
// возвращает путь запроса
// вырезает router.php из пути
function getRequestPath() {
    $path = $_SERVER['REQUEST_URI'];
    return '/' . ltrim(str_replace($_SERVER['SCRIPT_NAME'], '', $path), '/');
}
// наш роутер, в который передаются маршруты и запрашиваемый путь
// возвращает функцию если маршшрут совпал с путем
// иначе возвращает функцию notFound
function getMethod(array $routes, $path) {
    // перебор всех маршрутов
    foreach ($routes as $route => $method) {
        // если маршрут сопадает с путем, возвращаем функцию
        if ($path === $route) {
            return $method;
        }
    }
    return 'notFound';
}
function getFile($path_dir, $dir){
    $results_catalog = '';
    $results_file = '';
    $files = scandir($path_dir);
    foreach($files as $value){
        if ($value === '.' || $value === '..'){continue;}
        if (is_dir($path_dir . '/' . $value)){
            $results_catalog .= "<a href=\"#\" class=\"cl-1\" type-item=\"catalog\" path=\"" . $dir . '/' . $value . "\"> 
                <img src=\"icon_dir.png\" width=\"25\" height=\"25\" /><span>" . $value . "</span></a> <br>";
        }
        if (is_file($path_dir . '/' . $value)){
            $results_file .= "<a href=\"#\" class=\"cl-1\" type-item=\"file\"> 
                <img src=\"icon_file.png\" width=\"25\" height=\"25\" /><span>" . $value . "</span></a> <br>";
        }
    }
    if (! empty($results_catalog) || ! empty($results_file)){
        return $results_catalog . $results_file;
    }else{
        return "not_obj";
    }
}
function fileManager(){
    $input_data = json_decode(file_get_contents('php://input').PHP_EOL,true);
    $results = 'not_obj';
    if ($input_data['operation'] == 'new'){
        $dir = '/home';
        $home_dir = __DIR__ . $dir;
        $results = getFile($home_dir, $dir);
    }
    if ($input_data['operation'] == 'data' && $input_data['tyle-item'] == 'catalog'){
        $dir = $input_data['path'];
        $home_dir = __DIR__ . $dir;
        $results = getFile($home_dir, $dir);
    }
    return $results;
}


// Роутер
// получаем путь запроса
$path = getRequestPath();
// получаем функцию обработчик
$method = getMethod($routes, $path);
if ($method == 'notFound'){
    echo $method;
}else{
    // отдаем данные клиенту
    echo $method();
}
?>