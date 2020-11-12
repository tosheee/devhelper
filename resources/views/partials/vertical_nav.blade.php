

<?php

function makeTree($note_menu, $type_list = '<ul class="nav lt" >') {

    $tree = $type_list;


    foreach ($note_menu as $id => $menuItem) {

        if(!empty($menuItem['children']))
        {

            $tree .= '<li class=""><a href="#" class="button-vertical-menu" id="'.$id.'"> <i class="fa fa-angle-right"></i> <span>'. $menuItem['text']  . '</span></a>';

        }
        else
        {
            $tree .= '<li class=""><a href="#" class="button-vertical-menu" id="'.$id.'"><i class="fa fa-angle-right"></i><span>' . $menuItem['text'];
        }

        if (!empty($menuItem['children']))
        {
            $tree .= makeTree($menuItem['children'], '<ul class="nav lt">');
        }

        $tree .= '</span></a></li>';
    }

    return $tree . '</ul>';
}
if (isset($note_menu))
{
    echo makeTree($note_menu);
}
?>


<script>
    var toggler = document.getElementsByClassName("caret-vertical-nav");
    var i;

    for (i = 0; i < toggler.length; i++)
    {
        toggler[i].addEventListener("click", function() {
            this.parentElement.querySelector(".nested").classList.toggle("active");
            this.classList.toggle("caret-down");
        });
    }
</script>