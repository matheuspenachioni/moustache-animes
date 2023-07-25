{{-- inherit from view base --}}
@extends('base')

{{-- create a section to specific code --}}
@section('content')
    @if (!is_null($status))
        <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
        <!-- DataTable 1.12.1 CSS + JS -->
        <link href="https://nightly.datatables.net/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
        <script src="https://nightly.datatables.net/js/jquery.dataTables.js"></script>
        <script src="https://cdn.datatables.net/plug-ins/1.12.1/i18n/pt-BR.json"></script>
        <script>
            $(document).ready(function () {
                $('#tabelaStatus').DataTable({
                    language: {
                        url: '//cdn.datatables.net/plug-ins/1.12.1/i18n/pt-BR.json'
                    }
                });
            });
        </script>
        <table id="tabelaStatus" class="table table-striped" style="padding-top: 10px;">
            <thead>
                <tr class="table-dark">
                    <th colspan="4" class="text-center">Status</th>
                    <th colspan="3" class="text-center">Opções</th>
                </tr>
                <tr>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th class="text-center">Detalhes</th>
                    <th class="text-center">Editar</th>
                    <th class="text-center">Deletar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($status as $status)
                    <tr>
                        <td class="align-middle">{{ $status->name }}</td>
                        <td class="align-middle">{{ $status->description }}</td>
                        <td class="align-middle text-center">
                            <a href="{{ route('status.show', $status->id) }}"><i class="fa-solid fa-circle-info text-info"></i></a>
                        </td>
                        <td class="align-middle text-center">
                            <a href="{{ route('status.edit', $status->id) }}"><i class="fa-solid fa-pen-to-square text-primary"></i></a>
                        </td>
                        <td class="align-middle text-center">
                            <form action="{{ route('status.destroy', $status->id) }}" method="post">
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
        <h3>No status was found!</h3>
    @endif
@endsection