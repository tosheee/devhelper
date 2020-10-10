@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">


<h1>alabala</h1>

            <div class="basic-grey">
                <form method="POST" action="" accept-charset="UTF-8" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <span>ala - bala</span>
                    <label>
                        @if(isset($descriptions['general_description']))
                            <textarea name="description[general_description]" id="editor-edit" >{!! $descriptions['general_description'] !!}</textarea>
                        @else
                            <textarea name="description[general_description]" id="editor-edit" ></textarea>
                        @endif
                    </label>
                    <br>



                    <div class="actions">
                        <input name="_method" type="hidden" value="PUT">
                        <input type="submit" name="commit" value="Обновяване" class="btn btn-success">
                    </div>
                </form>

            </div>


            <script src={{ asset('ckeditor/ckeditor.js')}}></script>
            <script> CKEDITOR.replace('editor-edit'); </script>


        </div>
    </div>
@endsection