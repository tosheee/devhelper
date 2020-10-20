@extends('layouts.app')

@section('content')
    <script>$('.sidebar-menu').toggleClass('sidebar-menu-closed');</script>

    <div class="container-fluid">
        <div class="row">
            <div class="sidebar-menu">
                @include('partials.vertical_nav')
            </div>

            <div class="col">
                <form method="POST" id="form_node" action="" accept-charset="UTF-8" enctype="multipart/form-data">

                    {{ csrf_field() }}

                    <input type="number" name="node_id" id="node_id"/>

                    <input type="text" name="name_node" id="name_node"/>

                    <input type="number" name="level_node" id="level_node"/>

                    <button type="button" id="button_new" class="btn btn-primary btn-sm">New</button>

                    <input type="submit" name="commit" value="Submit" class="btn btn-success btn-sm">

                    <button type="submit" class="btn btn-danger btn-sm" id="btn_delete">Delete</button>

                    <textarea class="form-control" id="code_preview" name="txt_node" style=""></textarea>

                    <div class="actions">
                        <input name="_method" type="hidden" value="POST" id="input_method">
                    </div>

                </form>

            </div>
        </div>

        <script>
            $( document ).ready(function()
            {
                var nodes_data = {!! json_encode($nodes) !!};
                $("a.button-vertical-menu").on("click", function(e)
                {
                    e.preventDefault();
                    for(var i=0; i < nodes_data.length; i++)
                    {
                        $(this).css("background-color", "yellow");
                        if ($(this).attr('id') == nodes_data[i].id)
                        {
                            $("#form_node").attr('action', '/update/'+ nodes_data[i].id);
                            $("#btn_delete").attr('formaction', '/delete/'+ nodes_data[i].id);
                            $('#node_id').val(nodes_data[i].id);
                            $('#name_node').val(nodes_data[i].name);
                            $('#input_method').val('POST');
                            $('#level_node').val(nodes_data[i].level);
                            tinymce.activeEditor.setContent(nodes_data[i].txt);
                            tinymce.activeEditor.execCommand('mceAutoResize');
                        }
                    }
                });

                $("#button_new").on("click", function(e)
                {
                    e.preventDefault();
                    $("#form_node").attr('action', '/new/');
                    $('#name_node').val('');
                    $('#input_method').val('POST');
                    tinymce.activeEditor.setContent('');
                    tinymce.activeEditor.execCommand('mceAutoResize');
                });

                $("#btn_delete").on("click", function(e)
                {
                    var id = $('#node_id').val();
                    $('#input_method').val('POST');
                });


                var u_node_id = {{ $u_node_id ?? 0 }};
                if (u_node_id != 0)
                {
                    for(var i=0; i < nodes_data.length; i++)
                    {
                        console.log(u_node_id);
                        if (u_node_id == nodes_data[i].id)
                        {
                           //.css("background-color", "yellow");
                            $("#form_node").attr('action', '/create/'+ nodes_data[i].id);
                            $("#btn_delete").attr('formaction', '/delete/'+ nodes_data[i].id);
                            $('#node_id').val(nodes_data[i].id);
                            $('#name_node').val(nodes_data[i].name);
                            $('#input_method').val('PUT');
                            $('#level_node').val(nodes_data[i].level);
                            tinymce.activeEditor.setContent(nodes_data[i].txt);
                            tinymce.activeEditor.execCommand('mceAutoResize');
                        }
                    }
                }
            });
        </script>
    </div>
@endsection
