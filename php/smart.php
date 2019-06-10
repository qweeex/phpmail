<?php
    // Файлы библиотеки phpmailer
    require 'PHPMailer.php';
    require 'Exception.php';
    require 'SMTP.php';
    use PHPMailer\PHPMailer\PHPMailer;


    // Получаем всю инфу
    $phone = $_POST['phone'];
    $message = '';
    foreach ($_POST as $k=>$v) {
        if ($k == 'phone'){
            $message .= 'Телефон: '.'<a href="tel:'.$phone.'">'.strip_tags($phone).'</a><br>'.PHP_EOL;
        } elseif ($k == 'name'){
            $message .= 'Имя: '.strip_tags($v).PHP_EOL.'<br>';
        }
        else{
            $message .= strip_tags($k).': '.strip_tags($v).PHP_EOL.'<br>';
        }
    }


    // Настройки
    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->CharSet = 'UTF-8'; // Кодировка для наших сообщений, лучше оставить как есть
    $mail->Host = 'smtp.yandex.ru'; // Тут хост яндекса так как для отправки используется яндекс
    $mail->SMTPAuth = true;
    $mail->Username = 'Логин'; // Ваш логин в Яндексе. Именно логин, без @yandex.ru
    $mail->Password = 'Пароль'; // Ваш пароль
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;
    $mail->setFrom('info@info.ru', 'Иван Иваныч'); // Ваш Email с которого будет отправлятся и Имя отправителя
    $mail->addAddress('info@info.ru'); // Email получателя


    // Письмо
    $mail->isHTML(true);
    $mail->Subject = 'Заявка с Сайта'; // Заголовок письма
    $mail->Body = $message; // Текст письма

    // Результат
    if(!$mail->send()) {
     echo 'Message could not be sent.';
     echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
     echo 'ok';
    }
