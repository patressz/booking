$( document ).ready(function() {

    $('button.delete').on('click', function() {
        $('#alert').fadeOut();
    });

    $('#delete_confirm').on('click', function(event) {
        event.preventDefault();
        Swal.fire({
            title: 'Naozaj chcete vyzmazať tento termín?',
            text: "Túto akciu nebudete môcť vrátiť späť!",
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Zrusiť',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Áno, vymazať!'
          }).then((result) => {
            if (result.isConfirmed) {

              Swal.fire(
                'Zmazané!',
                'Termín bol úspešne zmazaný.',
                'success'
              )
              $('#delete_form').submit();

            }
          });
    });

    var button_add_new = $('#add_new');

    var field = "";
    field += '<div class="field is-size-2 is-grouped time-div">';
    field += '<div class="control is-expanded">';
    field += '<input type="time" class="input mb-2 time-input" name="time[]" value="09:00">';
    field += '</div>';
    field += '<a class="button is-danger is-outlined remove-button">';
    field += '<span class="icon is-small">';
    field += '<i class="fas fa-times"></i>';
    field += '</span>';
    field += '<span>Vymazať</span>';
    field += '</a>';
    field += '</div>';

    button_add_new.click(function(event) {
        event.preventDefault();
        $(field).insertAfter('.time-div:last');
    });

    $('form').on('click', '.remove-button', function(event) {
        event.preventDefault();
        $(this).parents('.time-div').remove();
    });

    $('#haircut').change(function() {
        $(this).hide();
        $('#back-1').fadeIn();
        $('#calendar').fadeIn();
    });

    $('#back-1').click( function() {
        $('#calendar').hide();
        $('.time').hide();
        $('#back-1').hide();
        $('#haircut').fadeIn();
        $('#haircut select').val('-- Výberte službu --');
    });



});
