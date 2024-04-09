@extends('layouts.app')

@section('content')
    <main class="container">
        <h1>Lista dei progetti</h1>

        <a class="btn btn-primary" href=" {{ route('dashboardprojects.create') }} ">Create</a>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr class=" text-center">
                        <th scope="col">Thumb</th>
                        <th scope="col">Id</th>
                        <th scope="col">Title</th>
                        <th scope="col">Description</th>
                        <th scope="col">Language</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($projects as $item)
                    <tr class=" text-center">
                        <td>
                            {{ $item->thumb }}
                        </td>
                        <td>{{ $item->id }}</td>
                        <td>
                            <a href="{{ route('dashboardprojects.show', $item->slug)}}">
                                {{ $item->title }}
                            </a>
                        </td>
                        <td>{{ $item->descriptions }}</td>
                        <td>{{ $item->languages }}</td>
                        {{-- <td>{{ $item->slug }}</td> --}}
                        <td>
                            <a class="btn btn-primary" href=" {{ route('dashboardprojects.edit', $item->slug ) }} ">
                                Modifica
                            </a>

                            <form method="POST" action=" {{route( 'dashboardprojects.destroy', $item->slug )}} ">

                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger">Delete</button>

                            </form>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>


    </main>
@endsection