<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            List All Users
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
                <div class="text-center mb-2">
                    <a href="{{ route('register') }} " class="btn btn-info">Create New Users</a>
                </div>

                <div class="card bg-dark ">
                    <div class="card-body bg-dark ">
                        <!-- Table with stripped rows -->
                        <table class="table datatable bg-dark table-dark">
                            <thead class="bg-dark">
                                <tr>
                                    <th>
                                        <b>#</b>
                                    </th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th colspan="3">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>

                                        <td><a href="{{ route('category.edit', $item->id) }}"><i
                                                    class="fa-solid fa-pen-to-square text-worning "></i></a>
                                        </td>
                                        <td><a href="{{ route('category.destroy', $item->id) }}"><i
                                                    class="fa-solid fa-trash text-danger "></i></a></td>
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
