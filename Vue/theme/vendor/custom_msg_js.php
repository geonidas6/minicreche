<?php /**
 * Created by geonidas on 12/06/2019.
 */
if (isset($_SESSION['message'])){
    $type =  $_SESSION['message']['type'];
    $text = $_SESSION['message']['text'];
    $title = $_SESSION['message']['title'];

    echo "
  <script src='Vue/theme/vendor/jquery/jquery.min.js'></script>
<script type='text/javascript'>

$(document).ready(function () {
    $('.ui-pnotify').remove();
  
    new PNotify({
        title: '$title',
        type: '$type',
        text: '$text',
        nonblock: {
            nonblock: true
        },
        styling: 'bootstrap3'
    });
});
</script>




";

    unset($_SESSION['message']);
}

