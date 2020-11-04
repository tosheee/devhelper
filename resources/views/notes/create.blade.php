@extends('layouts.app')

@section('content')
    <script>//$('.sidebar-menu').toggleClass('sidebar-menu-closed');</script>

    <div class="container-fluid">
        <div class="row">

            <div class="col-2 sidebar-menu">
                @include('partials.vertical_nav')
            </div>

            <div class="col-9">
                <form method="POST" id="form_node" action="/notes" accept-charset="UTF-8" enctype="multipart/form-data">

                    {{ csrf_field() }}
                    <div class="form-row">
                        <div class="input-group">
                            <input id="note_name"  name="note_name" type="text" class="form-control" placeholder="Note name">
                            <input id="note_level" name="note_level" type="number" class="form-control" placeholder="Level" >
                            <input id="note_id"    name="note_id" type="number" class="form-control" placeholder="ID">

                            <div class="input-group-append">
                                <a id="btn-show"  class="btn btn-outline-secondary" href="/notes"> Back </a>
                                <a id="btn-clean" class="btn btn-outline-secondary"  href="#"> Clean </a>
                                <input id="btn-input" class="btn btn-outline-secondary" type="submit" name="commit" value="Create" >
                            </div>
                        </div>
                    </div>

                    <br/>

                    <textarea id="summernote" name="note_content">{{ $note->content ?? '' }}</textarea>

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
