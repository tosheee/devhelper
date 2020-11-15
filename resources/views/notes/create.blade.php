@extends('layouts.app')

@section('content')
    <script>//$('.sidebar-menu').toggleClass('sidebar-menu-closed');</script>

    <div class="container-fluid">
        <div class="row">

            <br/>

            <div class="col-9">
                <form method="POST" id="form_node" action="/notes" accept-charset="UTF-8" enctype="multipart/form-data">

                    {{ csrf_field() }}
                    <div class="">
                        <div class="input-group-append">
                            <a id="btn-create"   class="btn btn-xs btn-info" href="/notes"> Back</a>
                            <a id="btn-create"   class="btn btn-xs btn-success" href="/notes/create"> Add New</a>
                            <a id="btn-show"     class="btn btn-xs btn-info" href="/notes/{{ $note->id ?? '' }}"> Show </a>
                            <input type="submit" class="btn btn-xs btn-primary" name="commit" value="Update">
                        </div>
                        <br/>

                        <input class="note-input" id="note_name"  name="note_name"     value="{{ $note->name ?? '' }}"     type="text"   placeholder="Note name">
                        <input class="note-input" id="note_level" name="note_level"    value="{{ $note->level ?? '' }}"    type="number" placeholder="Level" >
                        <input class="note-input" id="note_book"  name="note_bookmark" value="{{ $note->bookmark ?? '' }}" type="number" placeholder="Level">
                        <input class="note-input" id="note_id"    name="note_id"       value="{{ $note->id ?? '' }}"       type="number" placeholder="ID">

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
