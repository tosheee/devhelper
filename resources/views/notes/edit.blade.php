@extends('layouts.app')

@section('content')
    <script>$('.sidebar-menu').toggleClass('sidebar-menu-closed');</script>

    <div class="container-fluid">
        <div class="row">

            <div class="col-12">
                <form method="POST" id="form_node" action="/notes/{{ $note->id ?? '' }}" accept-charset="UTF-8" enctype="multipart/form-data">

                    {{ csrf_field() }}

                    <label>
                        <span>ID:</span>
                        <input type="number" name="note_id" id="note_id" value="{{ $note->id ?? '' }}" readonly/>
                    </label>

                    <label>
                        <span>Name:</span>
                        <input type="text" name="note_name" id="note_name" value="{{ $note->name ?? '' }}"/>
                    </label>

                    <label>
                        <span>Level:</span>
                        <input type="number" name="note_level" id="note_level" value="{{ $note->level ?? '' }}"/>
                    </label>

                    <label>
                        <span>Bookmark:</span>
                        <input type="number" name="note_bookmark" id="note_level" value="{{ $note->bookmark ?? '' }}"/>
                    </label>

                    <label>

                        <input type="submit" name="commit" value="Submit" class="btn btn-success btn-sm">
                    </label>

                    <textarea class="form-control" id="note_content" name="note_content" rows="20" cols="50"style="">{{ $note->content ?? '' }}</textarea>



                    <div class="actions">
                        <input name="_method" type="hidden" value="PUT" id="input_method">
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
