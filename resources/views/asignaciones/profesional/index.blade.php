<div class="modal fade" id="ModalProfesional{{ $inversion->idInversion }}">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title"><i class="fas fa-user-tie"></i> Profesionales</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          <div class="row">
            <!-- Titulo -->
            <div class="col-12 py-2">
              <h2>{{ $inversion->nombreCortoInversion }}</h2>
              <h6>{{ $inversion->cuiInversion }}</h6>
            </div>
            <!-- Contenido -->
            <div class="col-12">
              <!-- Alert -->
              @if ($message = Session::get('profesional_message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <p class="alert-message mb-0"><i class="fas fa-check-circle"></i>&nbsp;&nbsp; {{ $message }}</p>
                </div>
              @endif
              <!-- Agregar -->
              <button class="btn btn-success mb-4" data-toggle="modal" data-target="#ModalCreate{{ $inversion->idInversion }}"><i class="fas fa-plus"></i>&nbsp;&nbsp; Agregar Profesional</button>
              <!-- Tabla -->
              <div class="table-responsive">
                <table id="profesionalesTable" class="table table-striped w-100">
                  <thead class="table-header">
                    <tr>
                      <th class="w-75"><i class="fas fa-user-tie"></i> Profesional</th>
                      <th class="text-center w-25">Opciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($profesionales as $profesional)
                      <tr>
                        <td>{{ $profesional->usuario->nombreUsuario . ' ' . $profesional->usuario->apellidoUsuario }}</td>
                        <td class="text-center" style="white-space: nowrap">
                          <a class="btn btn-danger" data-toggle="modal" data-target="#ModalDelete{{ $inversion->idInversion . '-' . $profesional->idUsuario }}"><i class="fas fa-trash-alt"></i></a>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
                @include('asignaciones.profesional.create', ['inversion' => $inversion ])
              </div>
            </div>
            <div class="col-12 pt-4 text-center">
              <button class="btn btn-primary mx-1" data-dismiss="modal"><i class="fas fa-undo-alt"></i>&nbsp;&nbsp; Volver</button>
              <button class="btn btn-dark mx-1" data-dismiss="modal"><i class="fas fa-print"></i>&nbsp;&nbsp; Imprimir</button>
            </div>
          </div>
        </div>
        @foreach ($profesionales as $profesional)
          @include('asignaciones.profesional.delete', ['profesional' => $profesional])
        @endforeach
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    $('#profesionalesTable').DataTable({
      responsive: true,
      language: {
        search: "Buscar:",
        lengthMenu: "Mostrar _MENU_ registros por página",
        zeroRecords: "No se encontraron resultados",
        info: "Mostrando página _PAGE_ de _PAGES_",
        infoEmpty: "No hay registros disponibles",
        infoFiltered: "(filtrado de _MAX_ registros totales)",
        paginate: {
          first: "Primero",
          last: "Último",
          next: "Siguiente",
          previous: "Anterior"
        }
      }
    });
  });
</script>

<style>
  body {
    background-color: #000;
  }
  section {
    margin-top: 100px;
  }
  /* Others */
  .center-items {
    display: flex;
    align-items: center;
    justify-content: center;
  }
  /* Card Style */
  .cascading-left {
    margin-left: -50px;
  }
  /* Input Style  */
  .input-auth {
    display: block;
    width: 100%;
    height: calc(1.5em + 0.75rem + 2px);
    padding: 0.375rem 0.75rem;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #495057;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
    transition: all 0.3s ease-in-out;
  }
  .input-auth:focus {
    border-color: #72081f;
    outline: none;
    box-shadow: 0 0 5px 2px rgba(255, 106, 133, 0.5);
  }
  .input-autht:focus::placeholder {
    color: transparent;
  }
  /* Btn Style  */
  .btn-gorec {
    width: 250px;
    height: 50px;
    background-color: #9C0C27;
    color: #fff;
    border-radius: 50px
  }
  .btn-gorec:hover {
    background-color: #72081f;
    color: #fff;;
  }
  /* Line */
  .line {
    border: 0;
    border-top: 1px solid #72081f;
    margin: 1rem 0;
    width: 50%;
  }
  /* Redirection */
  .login-direction {
    color: #72081f;
    text-decoration: none;
  }
  @media (max-width: 991.98px) {
    .cascading-left {
      margin-left: 0px;
    }
    section {
      margin-top: 0px;
    }
  }
</style>