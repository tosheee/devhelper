tinymce.init({
    selector: "textarea",
    width: '100%',
    min_height: 400,
    plugins: "textcolor",
    plugins: 'link',
    toolbar: "forecolor backcolor",
    setup: function(editor) {
        editor.addButton('report_design', {
            type: 'menubutton',
            text: 'image here?',
            icon: false,
            menu: [
                {text:'Data', menu:[{text:'sub1'},{text:'sub2'}], onclick: function() {editor.insertContent('text');}}
            ]
        });
    },

    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | emoticons | forecolor backcolor | print | report_design "

});