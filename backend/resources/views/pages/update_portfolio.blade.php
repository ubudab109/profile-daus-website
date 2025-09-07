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
                        <input type="hidden" name="id" value="{{ $data->id }}" id="id_portfolio">
                        <div class="form-group">
                            <label for="">Title</label>
                            <input type="text" value="{{ $data->title }}" required name="title" id="title" placeholder="ex: Ecommerce"
                                class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Company/Client</label>
                            <input type="text" value="{{ $data->company }}" name="company" id="company" placeholder="ex: PT.XYZ" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Category</label>
                            <input type="text" value="{{ $data->category }}" required name="category" id="category" placeholder="ex: Website Application"
                                class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Stack</label>
                            <input type="text" value="{{ implode(",", json_decode($data->stack)) }}" name="stack" id="stack" placeholder="ex: PHP, Javascript"
                                class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">URL</label>
                            <input type="text" value="{{ $data->url }}" name="url" id="url" placeholder="ex: PHP, Javascript"
                                class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Start Date</label>
                            <input type="date" value="{{ $data->start_date }}" required name="start_date" id="start_date" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">End Date (Let it blank if present)</label>
                            <input type="date" value="{{ $data->end_date }}" name="end_date" id="end_date" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Description</label>
                            <textarea class="form-control summernote" name="desc" id="summernote">{!! $data->description !!}</textarea>
                        </div>
                        <div class="row" id="image-preview">
                        </div>
                        <div class="form-group">
                            <label for="">Add New Image</label>
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
    function getImages() {
        $.ajax({
            url: `/portfolio-images?id=${$("#id_portfolio").val()}`,
            type: 'GET',
            success: res => {
                const images = JSON.parse(res.images);
                let arrays;
                if (Array.isArray(images)) {
                    arrays = images;
                } else {
                    arrays = Object.values(images);
                }
                let html = '';
                arrays.forEach(data => {
                    html += `<x-image-overlay id="${data.key}" image="${data.initialPreview[0]}"></x-image-overlay>`
                });
                $("#image-preview").html(html);
            }
        })
    }
    $(document).ready(() => {
        getImages();
    });

    let imagesData = [];
    tinymce.init({
        selector: '.summernote',
        plugins: 'preview importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap quickbars emoticons',
        menubar: 'file edit view insert format tools table help',
        toolbar: 'undo redo | bold italic underline strikethrough | fontfamily fontsize blocks | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
    });
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
        let url = "{{ route('update.portfolio') }}";
        
        let formBody = {
            id: $("#id_portfolio").val(),
            title: $("#title").val(),
            category: $("#category").val(),
            url: $("#url").val(),
            stack: $("#stack").val().split(","),
            start_date: $("#start_date").val(),
            end_date: $("#end_date").val(),
            company: $("#company").val(),
            description: tinymce.get("summernote").getContent(),
        }
        if (imagesData.length > 0) {
            formBody.images = imagesData;
        }
        
        $.ajax({
            type: 'PUT',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url,
            data: formBody,
            success: () => {
                alert('success');
                window.location.reload();
            },
            error: () => {
                alert('error');
            }
        })
    })
    function destroy(imageId) {
        const url = "{{ route('delete.files') }}";
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url,
            type: 'POST',
            data: {
                key: imageId,
                idPortfolio: $("#id_portfolio").val(),
            },
            success: () => {
                alert('image deleted successfully');
                getImages();
            }
        })
    }
</script>
@endsection