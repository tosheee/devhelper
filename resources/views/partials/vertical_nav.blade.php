<style>
    .cf:before, .cf:after {
        content: " ";
        /* 1 */
        display: table;
        /* 2 */
    }
    .cf:after {
        clear: both;
    }
    .cf {
        *zoom: 1;
    }
    .form-control {
        outline: none;
        border-color: none !important;
    }
    body {
        color: #f9f9f9;
    }
    .title {
        text-align: center;
    }
    .sidebar-menu {
        width: 250px;
        background-color: #0f1726;
        transition: width ease 0.1s;
    }
    .sidebar-menu ul {
        padding: 0px;
        margin: 0px;
        list-style: none;
    }
    .sidebar-menu ul li {
        padding: 0;
        margin: 0;
    }
    .sidebar-menu a {
        margin: 0;
        color: #ccc;
        text-decoration: none;
        padding: 10px 15px;
        display: block;
        transition: all ease 0.1s;
        border-bottom: 1px solid #070b12;
        position: relative;
    }
    .sidebar-menu a:hover {
        color: #f9f9f9;
        background-color: #023059;
    }
    .menu-toggle {
        display: block;
    }
    .menu-toggle-btn {
        text-align: center;
        vertical-align: bottom;
        float: right;
        width: 38px;
        height: 38px;
        background: #023059;
        cursor: pointer;
        line-height: 2.7;
    }
    .menu-toggle-btn:hover {
        background: #033e73;
    }
    .sidebar-search {
        display: block;
        margin-left: 15px !important;
        margin-right: 15px !important;
        margin-top: 15px !important;
        margin-bottom: 15px !important;
    }
    .sidebar-search .form-control {
        box-shadow: none !important;
        border-radius: 100px !important;
        outline: none;
    }
    .sidebar-search input[placeholder] {
        color: #ccc;
    }
    .sidebar-submenu {
        display: none;
    }
    .sidebar-menu-closed {
        width: 38px;
    }
    .sidebar-menu-closed .title {
        position: absolute;
        top: 0;
        left: 0;
        margin-left: 40px;
        background-color: #0f1726;
        padding: 10px;
        display: none;
    }
    .sidebar-menu-closed .sidebar-icon {
        margin-left: -6px;
    }
    .sidebar-menu-closed #sidebar-search {
        margin-left: -9px;
    }
    .sidebar-menu-closed #sidebar-search:focus {
        width: 180px;
    }


</style>


<?php

function makeTree($menu, $type_list = '<ul id="myUL" ><li class="menu-toggle cf"><div class="menu-toggle-btn"><i class="fa fa-bars"></i></div>') {

    $tree = $type_list;

    foreach ($menu as $id => $menuItem) {

        if(!empty($menuItem['children']))
        {
            $tree .= '<li><span class="caret"><a href="#" class="button-vertical-menu title" id="'.$id.'">' . $menuItem['text'] . '</a></span>';
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

echo makeTree($menu);

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



