<x-app-layout>
    <x-slot name="header">
    </x-slot>

        <br>
        <div class="container">

                        <a href="{{ route('categories.create') }}">
                            <button class="btn btn-success"><i class="fa-solid fa-circle-plus"></i>&nbsp;Add New Category</button>
                        </a>
                        <br /><br />

                        <h3><i class="fa-solid fa-list"></i>&nbsp;Category List</h3>
                        <hr>       

                       
                            @php
                              $i = 0;
                            @endphp

                            @foreach ($categories->chunk(3) as $chunk)                
                                <div class="container justify-content-center">
                                    <div class="row">
                                        @foreach ($chunk as $category )
                                                  
                                        <div class="card col-md-4 ">
                                            <div align="center">
                                              <h2 class="card-title" align="center">{{ $category->title }} </h2>
                                                   <img  src="{{ asset('uploads/'.Auth::user()->email.'/'.'images/'.$category->id.'/'.$ResultCountImageLastInCategory[$i++]->src) }}" class="card-img-top"  style="width:150px;height:150px;">
                                                <br><br>
                                                <strong class="card-title" align="center">Created:&nbsp;</strong>{{ $category->created_at }} 
                                            </div>
                                            <div class="card-body">
                                                <br>
                                              <div class="container">
                                                <div class="row">
                                                  <div class="col">

                                                    <a href="{{ route('categories.edit', $category) }}">
                                                        <button class="btn btn-primary"><i class="fa-solid fa-pen-to-square"></i>&nbsp;Edit</button>
                                                      </a>

                                                  </div>
                                                  <div class="col">

                                                    <a href="{{ route('categories.show', $category) }}">
                                                        <button class="btn btn-warning"><i class="fa-solid fa-eye"></i>&nbsp;View</button>
                                                      </a>

                                                  </div>
                                                  <div class="col">

                                                    <form method="POST" action="{{ route('DeleteCategory') }}">                   
                                                        @csrf
                                                        @method('DELETE')
                                                        <input type="hidden" name="CategoryID" id="CategoryID" value="{{$category->id}}" />
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
                   
            </div>



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
</script>