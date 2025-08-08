@extends('layouts.app')

@section('content')

                    <form id="propertyForm" method="POST" action="{{ route('property.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Title</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" required autocomplete="name" autofocus>

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="description" class="col-md-4 col-form-label text-md-end">Description</label>

                            <div class="col-md-6">
                                <textarea id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" required autocomplete="name" autofocus></textarea>

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                         <div class="row mb-3">
                            <label for="type" class="col-md-4 col-form-label text-md-end">Type</label>

                            <div class="col-md-6">
                               <select name="type" id="type">
                                <option value="rent">rent</option>
                                <option value="sale">sale</option>
                               </select>

                                @error('type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Price</label>

                            <div class="col-md-6">
                                <input id="price" type="text" class="form-control @error('price') is-invalid @enderror" name="price" required autocomplete="name" autofocus>

                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                         <div class="row mb-3">
                            <label for="location" class="col-md-4 col-form-label text-md-end">location</label>

                            <div class="col-md-6">
                                <input id="location" type="text" class="form-control @error('location') is-invalid @enderror" name="location" required autocomplete="name" autofocus>

                                @error('location')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                            <div class="row mb-3">
                            <label for="region_id " class="col-md-4 col-form-label text-md-end">Region </label>

                            <div class="col-md-6">
                               <select name="region_id" id="region_id"  class="form-control">
                                 <option value="">Select</option>
                               @foreach ($region as $regions )
                                <option value="{{$regions->id}}">{{$regions->title}}</option>
                               @endforeach
                               


                               </select>

                                @error('region_id ')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                          <div class="row mb-3">
                            <label for="Image " class="col-md-4 col-form-label text-md-end">Image </label>

                            <div class="col-md-6">
                              <input type="file" name="featured_image[]" id="featured_image">
                              <div id="image-preview"></div>

                                @error('featured_image ')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                         <div class="row mb-3 justify-content-center">
                             <div class="col-md-3">
                               <button type="submit" class="form-control btn btn-primary">Save</button>
                        </div>
                        </div>
                    </form>

                    <script>
                        $(document).ready(function() {
                            $('#propertyForm').on('submit', function(e) {
                                e.preventDefault(); 
                                var formData = new FormData(this); 

                                $.ajax({
                                    url: '{{ route("property.store") }}', 
                                    type: 'POST',
                                    data: formData,
                                    processData: false,
                                    contentType: false, 
                                    success: function(response) {
                                        if(response.success) {
                                            $('#successMessage').html('<div class="alert alert-success">' + response.success + '</div>');
                                            
                                        }
                                    },
                                    error: function(xhr) {
                                        
                                        var errors = xhr.responseJSON.errors;
                                        var errorMessages = '<div class="alert alert-danger"><ul>';
                                        $.each(errors, function(key, value) {
                                            errorMessages += '<li>' + value[0] + '</li>';
                                        });
                                        errorMessages += '</ul></div>';
                                        $('#errorMessages').html(errorMessages);
                                    }
                                });
                            });
                        });

                    </script>




        <script>
        document.addEventListener('DOMContentLoaded', function () {
            const imageInput = document.getElementById('featured_image');
            const imagePreview = document.getElementById('image-preview');
            let imageFiles = [];

            imageInput.addEventListener('change', function (e) {
                const files = Array.from(e.target.files);

                files.forEach((file) => {
                    if (!file.type.startsWith('image/')) return;

                    const reader = new FileReader();
                    reader.onload = function (e) {
                        const imgContainer = document.createElement('div');
                        imgContainer.classList.add('position-relative');
                        imgContainer.style.width = '100px';

                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.classList.add('img-thumbnail');
                        img.style.width = '100%';

                        const closeBtn = document.createElement('button');
                        closeBtn.innerHTML = '&times;';
                        closeBtn.classList.add('btn', 'btn-danger', 'btn-sm');
                        closeBtn.style.position = 'absolute';
                        closeBtn.style.top = '0';
                        closeBtn.style.right = '0';

                        closeBtn.addEventListener('click', () => {
                            const index = imageFiles.indexOf(file);
                            if (index > -1) {
                                imageFiles.splice(index, 1);
                            }
                            imgContainer.remove();
                            updateInputFiles();
                        });

                        imgContainer.appendChild(img);
                        imgContainer.appendChild(closeBtn);
                        imagePreview.appendChild(imgContainer);

                        imageFiles.push(file);
                        updateInputFiles();
                    };

                    reader.readAsDataURL(file);
                });

                imageInput.value = '';
            });

            function updateInputFiles() {
                const dataTransfer = new DataTransfer();
                imageFiles.forEach(file => dataTransfer.items.add(file));
                imageInput.files = dataTransfer.files;
            }

        });
        </script>
@endsection