const separator = document.querySelector('.separator');
const leftPanel = document.querySelector('.left-panel');
const rightPanel = document.querySelector('.right-panel');

let isDragging = false;

separator.addEventListener('mousedown', function(e) {
    isDragging = true;
    document.addEventListener('mousemove', onMouseMove);
    document.addEventListener('mouseup', onMouseUp);
});

function onMouseMove(e) {
    if (!isDragging) return;

    const containerRect = separator.parentElement.getBoundingClientRect();
    const newLeftWidth = e.clientX - containerRect.left;

    if (newLeftWidth < 50 || newLeftWidth > containerRect.width - 50) return;

    leftPanel.style.flex = `0 0 ${newLeftWidth}px`;
    rightPanel.style.flex = `1 1 ${containerRect.width - newLeftWidth - separator.clientWidth}px`;
}

function onMouseUp() {
    isDragging = false;
    document.removeEventListener('mousemove', onMouseMove);
    document.removeEventListener('mouseup', onMouseUp);
}
function contact_surpasse(){
    var contact = document.getElementById("contact");
    var contact_form = document.getElementById("contact_form");
    contact.style.display = "none";
    contact_form.style.display = "block";
}
$(document).ready(function(){
    $('.image-container img').hover(
        function() {
            $(this).css('transform', 'scale(1.1)');
            
        },
        function() {
            $(this).css('transform', 'scale(1)');
            
        }
    );
});
$(document).ready(function() {
    $('.nav-link').on('click', function(event) {
        event.preventDefault(); // Empêche le comportement par défaut du lien

        var url = $(this).attr('href'); // Obtient l'URL du lien

        $('#content').fadeOut(500, function() { // Fait disparaître le contenu actuel
            $.ajax({
                url: url,
                success: function(data) {
                    $('#content').html($(data).find('#content').html()); // Charge le nouveau contenu
                    $('#content').fadeIn(500); // Fait apparaître le nouveau contenu
                },
                error: function() {
                    alert('Erreur lors du chargement de la page.');
                }
            });
        });
    });
});
function turn(a,b){
    var photoDiv = document.getElementById('photo_conv');
    photoDiv.innerHTML = '<img src="' + b + '" class="image_contact">';
    document.getElementById('nom_conv').innerText = a;
    
}