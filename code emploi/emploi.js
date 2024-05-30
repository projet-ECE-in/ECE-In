function applyJob(jobTitle) {
    alert('Vous avez postulé pour le poste de ' + jobTitle);
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