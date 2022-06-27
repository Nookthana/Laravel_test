<style type="text/css">
    .pointer {cursor: pointer;}
    </style>
    <x-app-layout>
        <x-slot name="header">
        </x-slot>
    
        <div class="container pt-3">
            <form method="post" action="{{ route('UploadImageOnCategory',$categoryID) }}" id="form_image_upload"
                  enctype="multipart/form-data">
              @csrf
              @method('POST')
              <div class="image">
                <label><h4><i class="fa-solid fa-circle-plus"></i>&nbsp; Add New Image</h4></label>
                <input type="file" id="imgCategory" name="imgCategory" class="form-control" required />
              </div>
              <br/>
              <div>
                <button type="submit" class="btn btn-success">Upload</button>
              </div>
            </form>
        </div>
        
      
          <div class="container pt-2">
    
                <div class="container">
                    <div class="row">
                      <div class="col-sm">
    
                        <h2 class="vc_custom_heading ico_header"><i class="fa-solid fa-image"></i> &nbsp;View Image</h2>
                          <hr>                  
                        <ul class="nav justify-content-center">
                          <li class="nav-item">
                            <a class="nav-link" href="{{ route('showType', ['link' => 'all','Category' => $categoryID]) }}">All ( <span class="text-danger">{!! $countImageAll !!} </span>) </a>
                          </li>
                          
                          @foreach($linkType  as $key => $link)
                          <li class="nav-item">
                            <a class="nav-link" href="{{ route('showType', ['link' => $link->mine,'Category' => $categoryID]) }}">{{ Str::upper($link->mine) }}  ( <span class="text-danger"> {{ $ResultCountType[$key] }} </span> )</a>
                          </li>
                          @endforeach
                        </ul>
                       
    
                        @foreach($ImagesType->chunk(3) as $chunk)
                        <div class="container justify-content-center">
                            <div class="row">
                                @foreach ($chunk as $key => $photo )

                                
                                    <div class="card col-md-4 pt-4">
                                        <div align="center">
                                            <img  src="{{ asset('uploads/'.Auth::user()->email.'/'.'images/'.$categoryID.'/'.$photo->src) }}" class="card-img-top"  style="width:150px;height:150px;">  
                                        </div><br>                               
                                        <div class="card-body">
                                          <h6 class="card-title"><strong>Name:</strong>&nbsp;{{ $photo->src }}</h6>
                                          <p class="card-text"><strong>Size:</strong>&nbsp;{{$photo->size}}</p>
                                          <p class="card-text"><strong>Mine:</strong>&nbsp;{{$photo->mine}}</p>
                                          <p class="card-text"><strong>Created:</strong>&nbsp;{{$photo->created_at}}</p>
                                          <div class="container">
                                            <div class="row">
                                              <div class="col">
                                                <button type="button" id="btn-ImageEdit" class="btn btn-primary" data-target-id="{{ $photo->id }}" data-bs-toggle="modal" data-bs-target="#ImageEdit">
                                                    <i class="fa-solid fa-pen-to-square"></i>&nbsp;Edit
                                                  </button>
                                              </div>
                                              <div class="col">
                                                <form method="POST" action="{{ url('destroyImageInCategory') }}">                   
                                                    @csrf
                                                    @method('DELETE')
                                                      <input type="hidden" name="gallery" id="gallery" value="{{$categoryID }}" />
                                                      <input type="hidden" name="photo_id" id="photo_id" value="{{$photo->id }}" />
                                                        <button type="submit" 
                                                                class="btn btn-danger" 
                                                                onclick="return confirm('Are you sure?')"><i class="fa-solid fa-trash-can"></i>&nbsp;Delete</button>          
                                                  </form> 
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                  
                    
                       @endforeach
                    </div>
                </div>
                       @endforeach


                      
    
                  <!-- Modal -->
                  <div class="modal fade" id="ImageEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel"><i class="fa-solid fa-pen-to-square" align="center"></i>&nbsp;Edit Image</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        
                          <form method="POST" action="{{ route('update') }}" id="form_image_edit" 
                                enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="image">
                              <input type="file" id="Image_category_edit" name="Image_category_edit" class="form-control" required name="image">
                              <input type="hidden" id="ImageOldID" name="ImageOldID" class="form-control" />
                            </div>
                            <br/>
                            
                          </form>
                      
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="Close_modal">Close</button>
                          <button type="submit" class="btn btn-success" form="form_image_edit">Upload</button>
                        </div>
                      </div>
                    </div>
                  </div>
    
        </div>
    
    
    <!--Footer-->
        <div class="container-fluid text-center footer pt-4 pb-2">
            <strong class="font-weight-bold">Category&nbsp;<span class="text-danger">&#10086;</span></strong>
    
        </div> 
        <br/>
    
            
    
    
    
    
    </x-app-layout>
  
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
    
    
    // drap and drop
    let columns = document.querySelectorAll('.card');
    let draggingClass = 'dragging';
    let dragSource;
    
    Array.prototype.forEach.call(columns, function (col) {
      col.addEventListener('dragstart', handleDragStart, false);
      col.addEventListener('dragenter', handleDragEnter, false)
      col.addEventListener('dragover', handleDragOver, false);
      col.addEventListener('dragleave', handleDragLeave, false);
      col.addEventListener('drop', handleDrop, false);
      col.addEventListener('dragend', handleDragEnd, false);
    });
    
    function handleDragStart (evt) {
      dragSource = this;
      evt.target.classList.add(draggingClass);
      evt.dataTransfer.effectAllowed = 'move';
      evt.dataTransfer.setData('text/html', this.innerHTML);
    }
    
    function handleDragOver (evt) {
      evt.dataTransfer.dropEffect = 'move';
      evt.preventDefault();
    }
    
    function handleDragEnter (evt) {
      this.classList.add('over');
    }
    
    function handleDragLeave (evt) {
      this.classList.remove('over');
    }
    
    function handleDrop (evt) {
      evt.stopPropagation();
      
      if (dragSource !== this) {
        dragSource.innerHTML = this.innerHTML;
        this.innerHTML = evt.dataTransfer.getData('text/html');
      }
      
      evt.preventDefault();
    }
    
    function handleDragEnd (evt) {
      Array.prototype.forEach.call(columns, function (col) {
        ['over', 'dragging'].forEach(function (className) {
          col.classList.remove(className);
        });
      });
    }
    
    
    // check type image
    $("#image_category").change(function () {
    
        const validExtensions = ["jpg","jpeg","gif","png"];
        const file = $(this).val().split('.').pop();
        const file_detail = this.files[0];
        
            if (validExtensions.indexOf(file) == -1) {
    
                alert("อนุญาตเฉพาะรูปแบบไฟล์นามสกุล : "+validExtensions.join(', ')+" เท่านั้น");
                document.getElementById("form_image_upload").reset();
    
            }
    
    
    });
    
    
    // check type image update
    $("#Image_category_edit").change(function () {
    
    const validExtensions = ["jpg","jpeg","gif","png"];
    const file = $(this).val().split('.').pop();
    const file_detail = this.files[0];
    
        if (validExtensions.indexOf(file) == -1) {
    
            alert("อนุญาตเฉพาะรูปแบบไฟล์นามสกุล : "+validExtensions.join(', ')+" เท่านั้น");
            document.getElementById("form_image_edit").reset();
    
        }
    
            
    
    
    });
    //close_modal_and reset form input
    $("#Close_modal").click(function() {
    
      document.getElementById("form_image_edit").reset();
    
    
    });
    // pass value imageedit input
    $(document).ready(function () {
    
           $("#ImageEdit").on("show.bs.modal", function (e) {
               var id = $(e.relatedTarget).data('target-id');
               $('#ImageOldID').val(id);
           });
    
       });
    
    </script>
    