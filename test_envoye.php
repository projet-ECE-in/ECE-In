<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Chat Application</title>
    <script src="https://code.jquery.com/jquery-3.7.1.jss"></script>
    <script>
        function loadMessages() {
            $.ajax({
                url: 'load_message.php',
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#messageContainer').empty(); // Vide le conteneur de messages
                    data.forEach(function(message) {
                        $('#messageContainer').append(
                            '<div class="message">' +
                            '<p><strong>' + message+ ':</strong>' +
                            '</div>'
                        );
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Erreur lors du chargement des messages:', error);
                }
            });
        }

        $(document).ready(function() {
            loadMessages(); // Charge les messages au chargement de la page

            // Recharge les messages toutes les 5 secondes
            setInterval(loadMessages, 5000);
        });
    </script>
</head>
<body>
    <h1>Chat Application</h1>
    <div id="messageContainer">
        <!-- Les messages seront chargés ici -->
    </div>
</body>
</html>
