@extends('layouts.app')

@section('content')
    <script>$('.sidebar-menu').toggleClass('sidebar-menu-closed');</script>

    <div class="container-fluid">
        <div class="row">

            <div class="col-2">
                <style>

                    .sidebar-menu {
                        width: 250px;
                        max-height: 600px;
                        transition: width ease 0.1s;
                        overflow: auto;
                    }



                </style>


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

            </div>

            <div class="col-10">
                <form method="POST" id="form_node" action="/notes" accept-charset="UTF-8" enctype="multipart/form-data">

                    {{ csrf_field() }}

                    <input type="number" name="note_id" id="note_id" value="{{ $note->id ?? '' }}"/>

                    <input type="text" name="note_name" id="note_name" value="{{ $note->name ?? '' }}"/>

                    <input type="number" name="note_level" id="note_level" value="{{ $note->level ?? '' }}"/>

                    <input type="submit" name="commit" value="Submit" class="btn btn-success btn-sm">

                    <a class="btn btn-primary btn-sm" id="btn-clean" href="#"> Clean </a>

                    <textarea class="form-control" id="code_preview" name="note_content" rows="20" cols="50"style="">{{ $note->content ?? '' }}</textarea>

                    <div class="actions">
                        <input name="_method" type="hidden" value="POST" id="input_method">
                    </div>

                </form>

            </div>
        </div>

        <script>
            function enter_form(node_id)
            {
                var nodes_data = {!! json_encode($notes) !!};

                for(var i=0; i < nodes_data.length; i++)
                {
                    if (node_id == nodes_data[i].id)
                    {
                        $('#note_id').val(nodes_data[i].id);
                        $('#note_level').val(nodes_data[i].level);
                    }
                }
            }

            $( document ).ready(function()
            {
                $('a.button-vertical-menu').on('click', function(e)
                {
                    e.preventDefault();
                    var note_id_val = $('input#note_id');

                    if (note_id_val.val() !== '')
                    {
                        var select_id = "#"+note_id_val.val();
                        $(select_id).css('color', '#20c997');
                    }

                    $(this).css('color', '#FC7753');

                    enter_form($(this).attr('id'));
                });

                $('a#btn-clean').on('click', function(e)
                {
                    e.preventDefault();
                    $('#note_id').val('');
                    $('#note_level').val('');
                });

            });
        </script>
    </div>
@endsection
