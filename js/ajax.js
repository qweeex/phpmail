$(document).ready(function () {
    /*
    *  .ajax-form = это класс для тега form
    * */

    $(".ajax-form").on('submit', function(){
        // Наши переменные
        var form = $(this);
        var error = false;
        // Небольшая проверка на пустоту
        form.find('input, textarea').each( function(){
            if ($(this).val() === '') {
                alert('Зaпoлнитe пoлe "'+$(this).attr('placeholder')+'"!');
                error = true;
            }
        });
        // Если все заполнено то будет выполняться этот скрипт
        if (!error) {
            var data = form.serialize();
            $.ajax({
                type: 'POST',
                url: '/php/smart.php',
                data: data,
                beforeSend: function(data) {
                    // Это событие перед отправкой
                    // тут можно например задать кнопке отправить
                    // состояние disabled чтобы пользователь сто раз не нажимал отправить
                },
                success: function(data){
                    console.log(data);
                    // Тут пишем что нужно сделать если отправка прошла
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    // Выводим ошибки если есть
                    console.log(xhr.status);
                    console.log(thrownError);
                }
            });
        }
        return false; // вырубaeм стaндaртную oтпрaвку фoрмы
    });
});