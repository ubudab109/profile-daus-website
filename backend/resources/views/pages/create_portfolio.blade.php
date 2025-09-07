@extends('master')
@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Create Portfolio</h1>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form id="submit_portfolio">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="">Title</label>
                            <input type="text" required name="title" id="title" placeholder="ex: Ecommerce"
                                class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Company/Client</label>
                            <input type="text" name="company" id="company" placeholder="ex: PT.XYZ" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Category</label>
                            <input type="text" required name="category" id="category" placeholder="ex: Website Application"
                                class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Stack</label>
                            <input type="text" name="stack" id="stack" placeholder="ex: PHP, Javascript"
                                class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">URL</label>
                            <input type="text" name="url" id="url" placeholder="ex: PHP, Javascript"
                                class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Start Date</label>
                            <input type="date" required name="start_date" id="start_date" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">End Date (Let it blank if present)</label>
                            <input type="date" name="end_date" id="end_date" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Description</label>
                            <textarea class="form-control summernote" name="desc" id="summernote"></textarea>
                        </div>
                        <div class="form-group">
                            <div class="file-loading">
                                <input id="input-705" name="files" type="file" accept="image/*" multiple>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <a href="{{route('portfolio')}}" class="btn btn-secondary">Back</a>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    tinymce.init({
        selector: '.summernote',
        plugins: 'preview importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap quickbars emoticons',
        menubar: 'file edit view insert format tools table help',
        toolbar: 'undo redo | bold italic underline strikethrough | fontfamily fontsize blocks | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
    });
    let imagesData = [];
    var $fileInput = $("#input-705").fileinput({
        theme: 'fa',
        allowedFileExtensions: ['jpg', 'png', 'gif'],
        uploadUrl: "/upload",
        uploadExtraData: function() {
            return {
                _token: $("input[name='_token']").val(),
            };
        },
        uploadAsync: true,
        deleteUrl: "/delete-image",
        ajaxDeleteSettings: {
            headers : {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        },
        showUpload: false, // hide upload button
        overwriteInitial: false, // append files to initial preview
        minFileCount: 1,
        maxFileCount: 5,
        browseOnZoneClick: true,
        initialPreviewAsData: true,
        fileActionSettings: {
            showDownload: false,
        }
    }).on("filebatchselected", function(event, files) {
        $fileInput.fileinput("upload");
    }).on('fileuploaded', function(event, data) {
        imagesData.push(data.response);
    }).on('filedeleted', function(event, data) {
        for(let i = 0; i < imagesData.length; i++) {
            if (imagesData[i]['key'] === data) {
                imagesData.splice([i], 1);
            }
        }
    });

    $("#submit_portfolio").submit(e => {
        e.preventDefault();
        let formBody = {
            title: $("#title").val(),
            category: $("#category").val(),
            url: $("#url").val(),
            images: imagesData,
            stack: $("#stack").val().split(","),
            start_date: $("#start_date").val(),
            end_date: $("#end_date").val(),
            company: $("#company").val(),
            description: tinymce.get("summernote").getContent(),
        }
        $.ajax({
            url: "{{route('store.portfolio')}}",
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: formBody,
            success: res => {
                alert('Success');
                window.location.reload();
            },
            error: err => {
                alert('Error');
            }
        })
    });
</script>
@endsection