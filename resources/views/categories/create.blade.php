<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <div class="container justify-content-center">
        <br>
        <h4><i class="fa-solid fa-plus"></i>&nbsp;New Category</h4>
                   <form method="POST" action="{{ route('categories.store') }}"   enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <br />

                    <input type="text" 
                           name="title"
                           class="form-control" 
                           placeholder="Please Enter Your Name Category" required/>

                    <br /><br />
                    <div class="image">
                        <label><h4><i class="fa-solid fa-circle-plus"></i>&nbsp; Add New Image</h4></label>
                        <input type="file" id="imgCategory" name="imgCategory" class="form-control" required >
                      </div>
                      <br/>            
                    <button type="submit" 
                            class="btn btn-success">Save</button>
                   </form>
    </div>

</x-app-layout>
