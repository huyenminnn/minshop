<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<!-- Latest compiled and minified CSS & JS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css">
	<style type="text/css">
	.dropzone{
		width: 60%;
		border-radius: 10px;
	}
</style>
</head>
<body>
	<form action="/upload-image" class="dropzone" id="myDropzone">
		@csrf
		<div class="fallback">
			<input name="file" type="file" multiple />
		</div>
	</form>
	
	
	
	<script src="//code.jquery.com/jquery.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
	<script type="text/javascript">
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

		// Dropzone.options.myDropzone = {
  //           url: '{{ asset("/upload-image") }}',
  //           autoProcessQueue: false,
  //           uploadMultiple: true,
  //           parallelUploads: 5,
  //           maxFiles: 10,
  //           maxFilesize: 5,
  //           acceptedFiles: ".jpeg,.jpg,.png,.gif",
  //           dictFileTooBig: 'Image is bigger than 5MB',
  //           addRemoveLinks: true,
  //           removedfile: function(file) {
  //            var name = file.name;    
  //            name =name.replace(/\s+/g, '-').toLowerCase();    /*only spaces*/
  //            $.ajax({
  //             // type: 'POST',
  //             type: 'delete',
  //             url: '{{ url('deleteImg') }}',
  //             headers: {
  //              'X-CSRF-TOKEN': '{!! csrf_token() !!}'
  //            },
  //            data: "id="+name,
  //            dataType: 'html',
  //            success: function(data) {
  //             $("#msg").html(data);
  //           }
  //         });
  //            var _ref;
  //            if (file.previewElement) {
  //             if ((_ref = file.previewElement) != null) {
  //               _ref.parentNode.removeChild(file.previewElement);
  //             }
  //           }
  //           return this._updateMaxFilesReachedClass();
  //         },
  //         previewsContainer: null,
  //         hiddenInputContainer: "body",
  //     }
  //     init: function() {
  //     var myDropzone = this;

  //     $('#btn-add').on("click", function() {
  //       myDropzone.processQueue(); 
  //     });

  //     myDropzone.on("sending", function(imageName, xhr, data) {
  //       $('.dropzone-image').append('<div class="col-md-3"><img style="width: 100%;height: 300px; background-color: #f4f4f4;" src="{{asset('assets/img/products')}}/'+imageName.name+'"><h5>'+imageName.name+'</h5></div>');
  //       console.log(imageName.name);
  //     });

  //   }
  

  Dropzone.options.myDropzone = {
    maxFileSize : 4,
    parallelUploads : 10,
    uploadMultiple: true,
    autoProcessQueue : false,
    addRemoveLinks : true,
    init: function() {
        var submitButton = document.querySelector("#add-images")
        myDropzone = this;
        submitButton.addEventListener("click", function() {
            myDropzone.processQueue(); 
        });
        
    },
};
	</script>
</body>
</html>