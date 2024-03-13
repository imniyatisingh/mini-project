<?php
function showAlert($msg, $type)
{
    echo '<div class="alert">
    <div class="line '.$type.'"></div>
    '.$msg.'
                <span>X</span>
    </div>
    <script>
    setTimeout(() => {
        document.querySelector(".alert").style.display="none";
    }, 2000);
    </script>
    ';
}
                // <i class="uil close uil-times"  onClick="hideAlert()"></i>

?>
