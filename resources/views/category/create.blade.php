<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Create Categories
        </h2>
    </x-slot>
    <div class="container col-md-7 mt-3 bg-dark py-3">
        @if (Session::has('done'))
            <div class="alert alert-success">
                {{ session::get('done') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form class="row g-3" action="{{ route('category.store') }}" method="POST">
            @csrf
            <div class="col-md-12">
                <label for="title" class="form-label text-light">Enter Title</label>
                <input type="text" id="title"  name="title" class="form-control bg-dark text-white"
                    placeholder="Title">
            </div>
            <div class="col-md-12">
                <label for="description" class="form-label text-light">Enter Description</label>
                <input type="text" id="description" name="description" class="form-control bg-dark text-white"
                    placeholder="Description">
            </div>
            <div class="text-center">
                <button type="submit" name="send" class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-secondary">Reset</button>
            </div>
        </form><!-- End No Labels Form -->
    </div>
</x-app-layout>
