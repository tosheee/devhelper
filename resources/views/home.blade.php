@extends('layouts.app')

@section('content')
    <script>$('.sidebar-menu').toggleClass('sidebar-menu-closed');</script>

    <div class="container-fluid">
        <div class="row">
            <div class="sidebar-menu">
                @include('partials.vertical_nav')
            </div>

            <div class="col">
                <h5>{{ $u_node_id ?? '' }}</h5>

                <form method="POST" id="form_node" action="" accept-charset="UTF-8" enctype="multipart/form-data">

                    {{ csrf_field() }}

                    <input type="number" name="node_id" id="node_id"/>

                    <input type="text" name="name_node" id="name_node"/>

                    <input type="number" name="level_node" id="level_node"/>





                    <button type="button" id="button_new_note" class="btn btn-primary btn-sm">New note</button>

                    <button type="button" id="button_new_subnote" class="btn btn-primary btn-sm">Sub note</button>


                    <button type="button" class="btn btn-danger btn-sm" id="button_delete">Delete</button>







                    <input type="submit" name="commit" value="Submit" class="btn btn-success btn-sm">

                    <textarea class="form-control" id="code_preview" name="txt_node" style=""></textarea>

                    <div class="actions">
                        <input name="_method" type="hidden" value="" id="input_method">
                    </div>

                </form>

            </div>
        </div>

        <script>
            function enter_form(node_id)
            {
                var nodes_data = {!! json_encode($nodes) !!};

                for(var i=0; i < nodes_data.length; i++)
                {
                    if (node_id == nodes_data[i].id)
                    {
                        $('#form_node').attr('action', '/update/'+ nodes_data[i].id);
                        $('#input_method').val('PUT');
                        $('#node_id').val(nodes_data[i].id);
                        $('#name_node').val(nodes_data[i].name);
                        $('#level_node').val(nodes_data[i].level);
                        tinymce.activeEditor.setContent(nodes_data[i].txt);
                        tinymce.activeEditor.execCommand('mceAutoResize');
                    }
                }
            }

            $( document ).ready(function()
            {
                $('#button_new_note').on("click", function(e)
                {
                    e.preventDefault();
                    $('#form_node').attr('action', '/new');
                    $('#node_id').val('');
                    $('#name_node').val('');
                    $('#input_method').val('POST');
                    $('#level_node').val(0);
                    tinymce.activeEditor.setContent('');
                    tinymce.activeEditor.execCommand('mceAutoResize');
                });

                $('#button_new_subnote').on("click", function(e)
                {
                    e.preventDefault();
                    $('#form_node').attr('action', '/new');
                    $('#name_node').val('');
                    $('#input_method').val('POST');
                    tinymce.activeEditor.setContent('');
                    tinymce.activeEditor.execCommand('mceAutoResize');
                });

                $('#button_delete').on("click", function(e)
                {
                    e.preventDefault();
                    var nn_val = $('input#node_id');
                    $('#form_node').attr('action', '/delete/'+nn_val.val());
                    $('#input_method').val('DELETE');

                });

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

                var u_node_id = {{ $u_node_id ?? 0 }};

                if (u_node_id != 0)
                {
                    var list_item = $('a#' + u_node_id);
                    list_item.parents('ul').addClass('nested active');
                    console.log(list_item.parentNode);
                    list_item.css('color', '#FC7753');
                    enter_form(u_node_id);
                }
            });
        </script>
    </div>
@endsection
