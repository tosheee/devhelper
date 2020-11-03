@extends('layouts.app')

@section('content')
    <script>//$('.sidebar-menu').toggleClass('sidebar-menu-closed');</script>
    <script type="text/javascript">

        $(document).ready(function() {
            document.title = "{{ $note->name ?? 'MemoTree' }}";
        });

    </script>

    <div class="container-fluid">
        <div class="row">
            <div class="col-2">

            </div>

            <div class="col-9">
                <div class="top-content">
                    <form method="POST" id="form_node" action="/notes/{{ $note->id ?? '' }}" class="form-actions" accept-charset="UTF-8" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="input-group">
                            <input id="note_name"  value="{{ $note->name ?? '' }}" type="text" class="form-control" placeholder="Note name" aria-label="R" aria-describedby="basic-addon2">
                            <input id="note_level" value="{{ $note->level ?? '' }}" type="number" class="form-control" placeholder="Level" aria-label="R" aria-describedby="basic-addon2">
                            <input id="note_id"    value="{{ $note->id ?? '' }}" type="number" class="form-control" placeholder="ID" aria-label="R" aria-describedby="basic-addon2">

                            <div class="input-group-append">
                                <a id="btn-edit" class="btn btn-outline-secondary" href="/notes/{{ $note->id ?? '' }}/edit"> Edit </a>
                                <a id="btn-create" class="btn btn-outline-secondary" href="/notes/create"> Create </a>
                                <a id="btn-show" class="btn btn-outline-secondary" href="/notes"> Back </a>
                                <input type="submit" class="btn btn-outline-secondary" name="commit" value="Delete">
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

    </div>
@endsection
