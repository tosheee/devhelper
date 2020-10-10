@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-3">

                @include('partials.vertical_nav')

             </div>

            <div class="col-9">
                <div class="basic-grey">
                    <form method="POST" action="" accept-charset="UTF-8" enctype="multipart/form-data">

                        {{ csrf_field() }}

                        <textarea class="form-control" id="code_preview" name="" style=""></textarea>


                        <br/>

                        <div class="actions">
                            <input name="_method" type="hidden" value="PUT">
                            <input type="submit" name="commit" value="Обновяване" class="btn btn-success">
                        </div>


                    </form>
                </div>
            </div>

            <script>
                var app = <?php echo json_encode($nodes); ?>;
                $("a.button-vertical-menu").on("click", function(e)
                {
                    e.preventDefault();

                    for(var i=0; i < app.length; i++)
                    {
                        if ($(this).attr('id') == app[i].node_id)
                        {
                            tinymce.activeEditor.setContent(app[i].txt);
                            tinymce.activeEditor.execCommand('mceAutoResize');
                        }
                    }
                });

            </script>
        </div>
    </div>
@endsection
