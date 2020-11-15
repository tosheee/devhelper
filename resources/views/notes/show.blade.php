@extends('layouts.app')

@section('content')
    <script>//$('.sidebar-menu').toggleClass('sidebar-menu-closed');</script>
    <script type="text/javascript">

        $(document).ready(function() {
            document.title = "{{ $note->name ?? 'MemoTree' }}";
        });

    </script>

    <div class="col-xs-12">
        <div class="top-content" >
            <form method="POST" id="form_node" action="/notes/{{ $note->id ?? '' }}" class="form-actions" accept-charset="UTF-8" enctype="multipart/form-data">
                {{ csrf_field() }}

                <br/>
                <div class="input-group" style="display:inline-block; vertical-align: middle;">

                    <div class="input-group-append">
                        <a id="btn-edit"     class="btn btn-xs btn-primary" href="/notes/{{ $note->id ?? '' }}/edit"> Edit </a>
                        <a id="btn-show"     class="btn btn-xs btn-info" href="/notes/{{ $note->id ?? '' }}"> Show </a>
                        <a id="btn-create"   class="btn btn-xs btn-success" href="/notes/create"> Add New</a>
                        <a id="btn-create"   class="btn btn-xs btn-success" href="/notes"> Back</a>
                        <input id="btn-delete" class="btn btn-xs btn-danger" type="submit" name="commit" value="Delete">
                    </div>

                    <p>
                    <p>
                        Level: <strong id="note_level" style="font-size: 1em">{{ $note->level ?? '' }}</strong>
                        ID: <strong id="note_id" style="font-size: 1em">{{ $note->id ?? '' }}</strong>
                    </p>
                    <strong id="note_name" style="font-size: 2.5em">{{ $note->name ?? '' }}</strong>
                    </p>
                </div>

                <input name="_method" type="hidden" value="DELETE" id="input_method">
            </form>
        </div>

        <br/>


        <div id="note-content">{!! $note->content ?? '' !!}</div>

    </div>
@endsection
