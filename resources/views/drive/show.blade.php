<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Show Drive : {{ $drive->id }}
        </h2>
    </x-slot>

    <style>
        body {
            background-color: #1e1e2f;
            color: #ffffff;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .card {
            background-color: #2b2b3a;
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            margin-bottom: 18px;
            overflow: hidden;
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.4);
        }

        .card-title {
            font-size: 1.6rem;
            color: #f5f5f5;
        }

        .card-text {
            font-size: 1rem;
            color: #cfcfcf;
        }

        .btn-edit {
            background-color: #ffc107;
            border-color: #ffc107;
            color: #121212;
            transition: background-color 0.3s ease;
        }

        .btn-edit:hover {
            background-color: #e0a800;
            border-color: #e0a800;
        }

        .btn-delete {
            background-color: #dc3545;
            border-color: #dc3545;
            color: #ffffff;
            transition: background-color 0.3s ease;
        }

        .btn-delete:hover {
            background-color: #c82333;
            border-color: #c82333;
        }

        .btn-info {
            background-color: #0d6efd;
            border-color: #0d6efd;
            color: #ffffff;
            transition: background-color 0.3s ease;
        }

        .btn-info:hover {
            background-color: #0b5ed7;
            border-color: #0b5ed7;
        }

        .card img {
            width: 90%;
            height: 180px;
            /* Maximum height for the image */
            object-fit: cover;
            /* Ensures the image covers the entire container without distortion */
            border-bottom: 1px solid #444;
        }

        .card-body {
            padding: 20px;
        }

        .card-footer {
            background-color: #1e1e2f;
            border-top: 1px solid #444;
            padding: 10px 20px;
        }

        .card-footer .btn {
            font-size: 0.9rem;
            font-weight: bold;
            padding: 10px 20px;
            border-radius: 6px;
            margin-left: 10px;
        }
    </style>

    <div class="container col-md-5 mt-3">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="fw-light text-uppercase">Data Overview</h1>
            <a href="{{ route('drive.create') }}" class="btn btn-add btn-info">
                <i class="fas fa-plus-circle"></i> Add New Entry
            </a>
        </div>

        <!-- Card 1 -->
        <!-- Card 1 -->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">In consequat</h5>

                @if ($drive->file_extination == 'jpg')
                    <img src="{{ asset("upload/$drive->file") }}" alt="Image">
                @else
                    <img src="{{ asset('img/document-309065_640.webp') }}" alt="Document Placeholder">
                @endif

                <p class="card-text"><strong>Title: </strong>{{$drive->title}}</p>
                <p class="card-text"><strong>Description: </strong>{{$drive->description}}</p>
                <p class="card-text"><strong>Category Title: </strong> {{$drive->CategoryTitle}}</p>
                <p class="card-text"><strong>Created At: </strong>{{$drive->created_at}}</p>
                <p class="card-text"><strong>Updated At: </strong> {{$drive->updated_at}}</p>
            </div>
            <div class="card-footer d-flex justify-content-end">

                <a href="{{ route('drive.index') }}" class="btn btn-info me-2">
                    <i class="fa-solid fa-backward"></i> Back
                </a>
                <a href="{{route('drive.download',$drive->id)}}" class="btn btn-success me-2">
                    <i class="fa-solid fa-download"></i> Download
                </a>
                @if (Auth::user()->id == $drive->user_id )
                <a href="{{ route('drive.edit', $drive->id) }}" class="btn btn-edit me-2">
                    <i class="fas fa-edit"></i> Edit
                </a>
                <a href="{{ route('drive.destroy', $drive->id) }}" class="btn btn-delete">
                    <i class="fas fa-trash-alt"></i> Delete
                </a>
                @endif

            </div>
        </div>

    </div>



</x-app-layout>
