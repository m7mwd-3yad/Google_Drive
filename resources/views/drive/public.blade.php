<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            List All Public Categories
        </h2>
    </x-slot>




    <div class="container col-md-7 mt-3 ">
        @if (Session::has('done'))
            <div class="alert alert-success">
                {{ session::get('done') }}
            </div>
        @endif
        <div class="row bg-dark ">
            <div class="col-lg-12 bg-dark py-3 ">

                <div class="card bg-dark ">
                    <div class="card-body bg-dark ">
                        <!-- Table with stripped rows -->
                        <table class="table datatable bg-dark table-dark">
                            <thead class="bg-dark">
                                <tr>
                                    <th>
                                        <b>#</b>
                                    </th>
                                    <th>Title</th>
                                    <th>Description</th>

                                    <th colspan="2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($drive as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->title }}</td>
                                        <td>{{ $item->description }}</td>
                                        <td><a href="{{ route('drive.show', $item->id) }}"><i
                                            class="fa-solid fa-eye text-info"></i></a></td>
                                        @if (Auth::user()->id == $item->user_id)


                                                <td><a href="{{ route('drive.destroy', $item->id) }}"><i
                                                    class="fa-solid fa-trash text-warning "></i></a></td>
                                            @if ($item->status == 'public')
                                                <td><a href="{{ route('drive.cahngeStatus', $item->id) }}"><i
                                                            class="fa-solid fa-unlock text-success"></i></a>
                                                </td>
                                            @else
                                                <td><a href="{{ route('drive.cahngeStatus', $item->id) }}"><i
                                                            class="fa-solid fa-lock text-danger"></i></a>
                                                </td>

                                            @endif
                                        @endif


                                    </tr>
                                @empty
                                    <h1>No Data</h1>
                                @endforelse






                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->

                    </div>
                </div>

            </div>

        </div>

    </div>


</x-app-layout>
