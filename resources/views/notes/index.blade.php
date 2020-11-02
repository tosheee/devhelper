@extends('layouts.app')

@section('content')
    <script>$('.sidebar-menu').toggleClass('sidebar-menu-closed');</script>

    <div class="container-fluid">
        <div class="row">

            <div class="col-3">
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



            <div class="col-9">
                <div class="top-content">
                    <form method="POST" id="form_node" action="/notes/{{ $note->id ?? '' }}" class="form-actions" accept-charset="UTF-8" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="submit" name="commit" value="Delete" class="btn btn-danger btn-sm">
                        <input name="_method" type="hidden" value="DELETE" id="input_method">

                        <a class="btn btn-primary btn-sm" id="btn-edit" href="/notes/{{ $note->id ?? '' }}/edit"> Edit </a>
                        <a class="btn btn-primary btn-sm" id="btn-show" href="/notes/{{ $note->id ?? '' }}"> Show </a>
                        <a class="btn btn-primary btn-sm" id="btn-create" href="/notes/create"> Create </a>
                    </form>

                    <strong id="name_node" style="font-size: 1.5em;"> {{ $note->name ?? '' }} </strong>
                    ID:    <strong id="node_id">{{ $note->id ?? '' }}</strong>
                    Level: <strong id="level_node">{{ $note->level ?? '' }}</strong>

                </div>



                <textarea class="form-control" id="note_content" name="note_content" rows="20" cols="50"style="">{{ $note->content ?? '' }}</textarea>

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
                        $('#form_node').attr('action', '/notes/'+ nodes_data[i].id);
                        $('#input_method').val('DELETE');
                        $('#node_id').text(nodes_data[i].id);
                        $('#name_node').text(nodes_data[i].name);
                        $('#level_node').text(nodes_data[i].level);
                        $('#code_preview').val(nodes_data[i].content);

                        $( "#btn-edit" ).remove();
                        var btnEditNote = '<a class="btn btn-primary btn-sm" id="btn-edit" href="/notes/'+ nodes_data[i].id +'/edit"> Edit </a>';
                        $( ".form-actions" ).append(btnEditNote);

                        $( "#btn-show" ).remove();
                        var btnShowNote = '<a class="btn btn-primary btn-sm" id="btn-show" style="margin-left: 5px;" href="/notes/'+ nodes_data[i].id +'"> Show </a>';
                        $( ".form-actions" ).append(btnShowNote);

                        $( "#btn-create" ).remove();
                        var btnCreateNote = '<a class="btn btn-primary btn-sm" id="btn-create" style="margin-left: 5px;" href="/notes/create"> Create </a>';
                        $( ".form-actions" ).append(btnCreateNote);
                    }
                }
            }

            $( document ).ready(function()
            {

                $('a.button-vertical-menu').on('click', function(e)
                {
                    e.preventDefault();
                    var nn_val = $('input#node_id');

                    if (nn_val.val() !== '')
                    {
                        var select_id = "#"+nn_val.val();
                        $(select_id).css('color', '#20c997');
                    }

                    $(this).css('color', '#FC7753');
                    enter_form($(this).attr('id'));
                });
            });
        </script>
    </div>
@endsection
