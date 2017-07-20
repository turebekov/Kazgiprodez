<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['name'])) {
        $name = $_POST['name'];
    }
    if (isset($_POST['tel'])) {
        $tel = $_POST['tel'];
    }
    if (isset($_POST['organ'])) {
        $organ = $_POST['organ'];
    }
    if ($organ == null){
        $organ = 'Клиент не заполнил это поле, посчитал что это не обязательно )';
    }



    $subject = "Заявка с сайта";
    $message = "<h4>Имя клиента: $name</h4><h4>Телефон: $tel</h4><h4>Организация: $organ</h4>";


    require_once "SendMailSmtpClass.php"; // подключаем класс

    $mailSMTP = new SendMailSmtpClass('turebekov.areke@gmail.com', 'thousand', 'ssl://smtp.gmail.com', 'admin', 465);
// $mailSMTP = new SendMailSmtpClass('логин', 'пароль', 'хост', 'имя отправителя');

// заголовок письма
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=utf-8\r\n"; // кодировка письма
    $headers .= "From: Admin <admin@vk-book.ru>\r\n"; // от кого письмо
    $result = $mailSMTP->send('turebekov.areke@gmail.com', 'Заявка с сайта', $message, $headers); // отправляем письмо
// $result =  $mailSMTP->send('Кому письмо', 'Тема письма', 'Текст письма', 'Заголовки письма');
    if ($result === true) {
        echo '<script>alert(\'Ваше  сообщение успешно отправлено\')</script>   ';
    } else {
        echo "Письмо не отправлено. Ошибка: " . $result;
    }
}
?>