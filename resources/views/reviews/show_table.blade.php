@extends('welcome_admin')

@section('content')
    <!-- Tabla para mostrar las reseñas -->
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Acciones</th> <!-- Nueva columna para las acciones -->
            </tr>
        </thead>
        <tbody>
            @forelse($reviews as $id_review => $review)
                <tr>
                    <td>{{ $id_review}}</td>
                    <td>{{ $review}}</td>
                    <td>
                        <!-- Agregar enlaces con íconos para editar y eliminar -->
                        <a href="{{ route('create_review_view', $id_review) }}" class="btn btn-primary">
                            <i class="bi bi-pencil"></i> Editar
                        </a>
                        <!-- Botón para mostrar el modal de confirmación de eliminación -->
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $id_review }}">
                            <i class="bi bi-trash"></i> Eliminar
                        </button>
                        <!-- Modal de confirmación de eliminación -->
                        <div class="modal fade" id="deleteModal{{ $id_review }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel">Confirmar Eliminación</h5>
                                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>¿Estás seguro de que deseas eliminar esta reseña?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        <!-- Formulario oculto para realizar la solicitud DELETE -->
                                        <form action="{{ route('reviews.delete', $id_review) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Eliminar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            {{-- El empty debe estar al nivel de endforelse --}}
            @empty
                <tr>
                    <td colspan="3">No hay reseñas disponibles.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
