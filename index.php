<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        function funcBefore(){
            $("#information").text("Ожидание данных...");
        }
        function funcSuccess(data){
            $("#information").text(data);
        }
        $(document).ready(function() {
            // Функция для отправки запроса на сервер и обновления истории выражений
            function updateExpressionsHistory() {
                $.ajax({
                    url: 'view_table.php',
                    method: 'GET',
                    success: function(data) {
                        $('#table-container').html(data);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            }

            // Первоначальное обновление истории выражений при загрузке страницы
            updateExpressionsHistory();

            // Обработчик нажатия кнопки "Проверить"
            $("#done").bind("click", function(){
                $.ajax({
                    url: "check_brackets.php",
                    type: "GET",
                    data: { expression: $("#expression").val() },
                    dataType: "html",
                    beforeSend: funcBefore,
                    success: function(data) {
                        funcSuccess(data);
                        // После успешной проверки выражения обновляем историю выражений
                        updateExpressionsHistory();
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>
</head>
<body>
    <div id="information"></div>
    <input type="text" id="expression" placeholder="Введите выражение">
    <input type="button" id="done" value="Проверить">
    <h1>История запросов</h1>
    <div id="table-container"></div>
</body>
</html>
