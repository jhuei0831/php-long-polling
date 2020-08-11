/**
 * AJAX long-polling
 *
 * 1. sends a request to the server (without a timestamp parameter)
 * 2. waits for an answer from server.php (which can take forever)
 * 3. if server.php responds (whenever), put data_from_database into #response
 * 4. and call the function again
 *
 * @param timestamp
 */
function getContent(id)
{
    var queryString = {'id' : id};

    $.ajax(
        {
            type: 'GET',
            url: 'http://127.0.0.1/php-long-polling/server/server.php',
            // dataType: 'json',
            data: queryString,
            success: function(data){
                var obj = jQuery.parseJSON(data);
                var user = '';
                $.each(jQuery.parseJSON(obj.data_from_database), function(key, value){
                    user += '<tr>';
                    user += '<td>'+value.id+'</td>';
                    user += '<td>'+value.name+'</td>';
                    user += '<td>'+value.password+'</td>';
                    user += '</tr>';
                });
                $('#response').html(user);
                getContent(obj.id);
            }
        }
    );
}

// initialize jQuery
$(function() {
    getContent();
});
