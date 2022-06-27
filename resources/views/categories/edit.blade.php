<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <div class="container justify-content-center">
            <h2>Edit Name Category:</h2>
                   <form method="POST" action="{{ route('categories.update',$category) }}">
                    @method('PUT')
                    @csrf
                    <br />

                    <input type="text" 
                           name="title"
                           class="form-control" 
                           value="{{ $category->title }}" required/>

                    <br />
                    
                    <button type="submit" 
                            class="btn btn-success">Save</button>
                   </form>

    </div>            

</x-app-layout>
