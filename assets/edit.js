// Newly uploaded file
var newFile = "";

function addMarkdown(id) {
	
$("#pageContent"+id).markdown({
    iconlibrary: 'fa',
    additionalButtons: [
        [{
                name: "groupCustom",
                data: [{
                        name: "cmdLink"+id,
                        title: "Add link",
                        icon: {glyph: 'glyphicon glyphicon-link', fa: 'fa fa-link', 'fa-3': 'icon-link'},
                        callback: function(e) {
                            newFile = "";
                            $('#addLinkModal'+id).modal('show');
                            $('#addLinkModalUploadForm'+id).show();
                            $('#addLinkTitle'+id).val(e.getSelection().text);

                            // FIXME @Struppi
                            if ($('#addLinkTitle'+id).val() == "") {
                                $('#addLinkTitle'+id).focus();
                            } else {
                                $('#addLinkTarget'+id).focus();
                            }

                            $('#addLinkButton'+id).off('click');
                            $('#addLinkButton'+id).on('click', function() {
                                chunk = "[" + $('#addLinkTitle'+id).val() + "](" + $('#addLinkTarget'+id).val() + ")";
                                selected = e.getSelection(), content = e.getContent(),
                                        e.replaceSelection(chunk);
                                cursor = selected.start;
                                e.setSelection(cursor, cursor + chunk.length);
                                $('#addLinkModal'+id).modal('hide')
                            });

                            $('#addLinkModal'+id).on('hide.bs.modal', function(ee) {
                                $('#addLinkTitle'+id).val("");
                                $('#addLinkTarget'+id).val("");
                            })
                        }
                    },
                    {
                        name: "cmdImg"+id,
                        title: "Add image/file",
                        icon: {glyph: 'glyphicon glyphicon-picture', fa: 'fa fa-picture-o', 'fa-3': 'icon-picture'},
                        callback: function(e) {
                            newFile = "";
                            $('#addImageModal'+id).modal('show');
                            $('#addImageModalUploadForm'+id).show();
                            $('#addImageModalProgress'+id).hide();
                            $('#addImageModal'+id).on('hide.bs.modal', function(ee) {
                            	
                                if (newFile != "") {
                                    if (newFile.mimeBaseType == "image") {
                                        chunk = "![" + newFile.name + "](file-guid-" + newFile.guid + ")";
                                    } else {
                                        chunk = "[" + newFile.name + "](file-guid-" + newFile.guid + ")";
                                    }
                                    selected = e.getSelection(), content = e.getContent(),
                                            e.replaceSelection(chunk);
                                    cursor = selected.start;
                                    e.setSelection(cursor, cursor + chunk.length);
                                }
                            })
                        }
                    },
                ]
            }]
    ],
    reorderButtonGroups: ["groupFont", "groupCustom", "groupMisc", "groupUtil"],
    onPreview: function(e) {
        $.ajax({
            type: "POST",
            url: window["previewUrl"+id],
            data: {
                markdown: e.getContent(),
            }
        }).done(function(previewHtml) {
            $('#markdownpreview'+id).html(previewHtml);
        });

        var previewContent = "<div id='markdownpreview"+id+"'>Please wait - loading the preview</div>";
        return previewContent;
    }
});

$('#fileUploadProgress'+id).hide();
$('#fileUploaderButton'+id).fileupload({
    dataType: 'json',
    done: function(e, data) {
        $.each(data.result.files, function(index, file) {
            if (!file.error) {
                newFile = file;

                hiddenValueField = $('#fileUploaderHiddenGuidField'+id);
                hiddenValueField.val(hiddenValueField.val() + "," + file.guid);

                $('#addImageModal'+id).modal('hide');
            } else {
                alert("file upload error");
            }
        });
    },
    progressall: function(e, data) {
        newFile = "";
        var progress = parseInt(data.loaded / data.total * 100, 10);
        $('#addImageModalUploadForm'+id).hide();
        $('#addImageModalProgress'+id).show();
        if (progress == 100) {
            $('#addImageModalProgress'+id).hide();
            $('#addImageModalUploadForm'+id).hide();
        }
    }
}).prop('disabled', !$.support.fileInput).parent().addClass($.support.fileInput ? undefined : 'disabled');
}