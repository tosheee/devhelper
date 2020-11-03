<?php

function makeTree($note_menu, $type_list = '<ul id="myUL" ><li class="menu-toggle cf"><div class="menu-toggle-btn"><i class="fa fa-bars"></i></div>') {

    $tree = $type_list;


    foreach ($note_menu as $id => $menuItem) {

        if(!empty($menuItem['children']))
        {

            $tree .= '<li><span class="caret"><a href="#" class="button-vertical-menu title" id="'.$id.'">' . $menuItem['text']  . '</a></span>';

        }
        else
        {
            $tree .= '<li><a class="button-vertical-menu title" id="'.$id.'">' . $menuItem['text'];
        }

        if (!empty($menuItem['children']))
        {
            $tree .= makeTree($menuItem['children'], '<ul class="nested">');
        }

        $tree .= '</a></li>';
    }

    return $tree . '</ul>';
}

echo makeTree($note_menu);

?>


<script>
    var toggler = document.getElementsByClassName("caret");
    var i;

    for (i = 0; i < toggler.length; i++)
    {
        toggler[i].addEventListener("click", function() {
            this.parentElement.querySelector(".nested").classList.toggle("active");
            this.classList.toggle("caret-down");
        });
    }
</script>