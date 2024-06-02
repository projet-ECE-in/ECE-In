function applyJob(offerId) {
    $.ajax({
        type: 'POST',
        url: 'apply_offer.php',
        data: { offer_id: offerId },
        success: function(response) {
            const data = JSON.parse(response);
            if (data.status === 'success') {
                document.getElementById('offer-' + offerId).style.display = 'none';
            } else {
                alert(data.message);
            }
        },
        error: function() {
            alert('An error occurred. Please try again.');
        }
    });
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