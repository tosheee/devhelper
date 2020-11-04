@extends('layouts.app')

@section('content')
    <script>//$('.sidebar-menu').toggleClass('sidebar-menu-closed');</script>

    <div class="container-fluid">
        <div class="row">
            <div class="col-1">

            </div>

            <div class="col-10">
                <form method="POST" id="form_node" action="/notes/{{ $note->id ?? '' }}" accept-charset="UTF-8" enctype="multipart/form-data">

                    {{ csrf_field() }}

                    <div class="input-group">
                        <input id="note_name"  name="note_name"     value="{{ $note->name ?? '' }}"     type="text"   class="form-control" placeholder="Note name">
                        <input id="note_level" name="note_level"    value="{{ $note->level ?? '' }}"    type="number" class="form-control" placeholder="Level" >
                        <input id="note_book"  name="note_bookmark" value="{{ $note->bookmark ?? '' }}" type="number" class="form-control" placeholder="Level">
                        <input id="note_id"    name="note_id"       value="{{ $note->id ?? '' }}"       type="number" class="form-control" placeholder="ID">

                        <div class="input-group-append">
                            <a id="btn-show"  class="btn btn-outline-secondary" href="/notes"> Back </a>
                            <a id="btn-create" class="btn btn-outline-secondary" href="/notes/create"> Create </a>
                            <input type="submit" class="btn btn-outline-secondary" name="commit" value="Update" class="btn btn-primary mb-2">
                        </div>
                    </div>

                    <br/>

                    <textarea id="summernote" name="note_content">{{ $note->content ?? '' }}</textarea>

                    <div class="actions">
                        <input name="_method" type="hidden" value="PUT" id="input_method">
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
