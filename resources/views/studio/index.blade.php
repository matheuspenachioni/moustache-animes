{{-- inherit from view base --}}
@extends('base')

{{-- create a section to specific code --}}
@section('content')
    @if (!is_null($studios))
        <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
        <!-- DataTable 1.12.1 CSS + JS -->
        <link href="https://nightly.datatables.net/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
        <script src="https://nightly.datatables.net/js/jquery.dataTables.js"></script>
        <script src="https://cdn.datatables.net/plug-ins/1.12.1/i18n/pt-BR.json"></script>
        <script>
            $(document).ready(function () {
                $('#tabelaStudios').DataTable({
                    language: {
                        url: '//cdn.datatables.net/plug-ins/1.12.1/i18n/pt-BR.json'
                    }
                });
            });
        </script>
        <table id="tabelaStudios" class="table table-striped" style="padding-top: 10px;">
            <thead>
                <tr class="table-dark">
                    <th colspan="4" class="text-center">Studio</th>
                    <th colspan="3" class="text-center">Options</th>
                </tr>
                <tr>
                    <th>Logo</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Established</th>
                    <th class="text-center">Details</th>
                    <th class="text-center">Edit</th>
                    <th class="text-center">Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($studios as $studio)
                    <tr>
                        <td><img src="{{ url("storage/{$studio->image}") }}" class="img-fluid rounded-circle border border-1" style="width: 6rem; height: auto;"></td>
                        <td class="align-middle">{{ $studio->name }}</td>
                        <td class="align-middle">{{ $studio->description }}</td>
                        <td class="align-middle">{{ $studio->established }}</td>
                        <td class="align-middle text-center">
                            <a href="{{ route('studios.show', $studio->id) }}"><i class="fa-solid fa-circle-info text-info"></i></a>
                        </td>
                        <td class="align-middle text-center">
                            <a href="{{ route('studios.edit', $studio->id) }}"><i class="fa-solid fa-pen-to-square text-primary"></i></a>
                        </td>
                        <td class="align-middle text-center">
                            <form action="{{ route('studios.destroy', $studio->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button style="outline: none; padding: 5px; border: 0px; box-sizing: none; background-color: transparent;" type="submit">
                                    <i class="fa-solid fa-trash text-danger"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <h3>No studio was found!</h3>
    @endif
@endsection