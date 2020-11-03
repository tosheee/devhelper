@extends('layouts.app')

@section('content')
    <script>//$('.sidebar-menu').toggleClass('sidebar-menu-closed');</script>

    <div class="container-fluid">
        <div class="row">

            <div class="col-2 sidebar-menu">
                @include('partials.vertical_nav')
            </div>


            <div class="col-9">
                <div class="top-content">
                    <form method="POST" id="form_node" action="/notes/{{ $note->id ?? '' }}" class="form-actions" accept-charset="UTF-8" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="input-group">
                            <input id="note_name"  type="text" class="form-control" placeholder="Note name">
                            <input id="note_level" type="number" class="form-control" placeholder="Level">
                            <input id="note_id"    type="number" class="form-control" placeholder="ID">

                            <div class="input-group-append">
                                <a id="btn-edit"     class="btn btn-outline-secondary" href="/notes/{{ $note->id ?? '' }}/edit"> Edit </a>
                                <a id="btn-show"     class="btn btn-outline-secondary" href="/notes/{{ $note->id ?? '' }}"> Show </a>
                                <a id="btn-create"   class="btn btn-outline-secondary" href="/notes/create"> Create </a>
                                <input id="btn-delete" class="btn btn-outline-secondary" type="submit" name="commit" value="Delete">
                            </div>
                        </div>

                        <input name="_method" type="hidden" value="DELETE" id="input_method">
                    </form>
                </div>

                <br/>

                <textarea id="summernote" name="note_content">{{ $note->content ?? '' }}</textarea>

                <script>
                    $('#summernote').summernote({
                        placeholder: 'Enter note',
                        tabsize: 10,
                        //height: 400
                        minHeight: 350,
                        maxHeight: 500
                    });
                </script>

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
                        $('#note_id').val(nodes_data[i].id);
                        $('#note_name').val(nodes_data[i].name);
                        $('#note_level').val(nodes_data[i].level);

                        $('#summernote').summernote('code', nodes_data[i].content);
                        $('#btn-edit').attr('href', '/notes/'+ nodes_data[i].id +'/edit');
                        $('#btn-show').attr('href', '/notes/'+ nodes_data[i].id);
                        $('#btn-create').attr('href', '/notes/create');
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
