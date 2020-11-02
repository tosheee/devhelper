@extends('layouts.app')

@section('content')
    <script>$('.sidebar-menu').toggleClass('sidebar-menu-closed');</script>

    <div class="container-fluid">
        <div class="row">

            <div class="col-3">

            </div>



            <div class="col-9">
                <div class="top-content">
                    <form method="POST" id="form_node" action="/notes/{{ $note->id ?? '' }}" class="form-actions" accept-charset="UTF-8" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="submit" name="commit" value="Delete" class="btn btn-danger btn-sm">
                        <input name="_method" type="hidden" value="DELETE" id="input_method">

                        <a class="btn btn-primary btn-sm" id="btn-edit" href="/notes/{{ $note->id ?? '' }}/edit"> Edit </a>
                    </form>

                    <strong id="name_node" style="font-size: 1.5em;"> {{ $note->name ?? '' }} </strong>
                    ID:    <strong id="node_id">{{ $note->id ?? '' }}</strong>
                    Level: <strong id="level_node">{{ $note->level ?? '' }}</strong>

                </div>


                <textarea class="form-control" id="note_content" name="note_content" rows="20" cols="50"style="">{{ $note->content ?? '' }}</textarea>


            </div>
        </div>

    </div>
@endsection
