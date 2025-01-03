<!doctype html>
<html lang="es">
	<head>
		<title>Iniciar Sesión</title>
		<link rel="icon" type="image/x-icon" href="{{ asset('images/favicon.png') }}">
		<!-- Required meta tags -->
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>

		<!-- Bootstrap CSS v5.2.1 -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"/>
	</head>

	<style>
		body {
			margin: 0;
			height: 100vh;
			display: flex;
			justify-content: center;
			align-items: center;
			position: relative;
			background: url('images/gorec-login-bg.jpg') no-repeat center center fixed;
			background-size: cover;
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
		.btn-cambio {
		
			width: 180px;
			height: 40px;
			background-color: #9C0C27;
			color: #fff;
			border-radius: 30px
			
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
		@media (max-width: 991.98px) {
			.cascading-left {
				margin-left: 0px;
			}
			section {
				margin-top: 0px;
			}
		}
	</style>

	<body>
		<header>

		</header>
		<main>
			<section class="text-center text-lg-start">
				<div class="container py-4">
					<div class="row g-0 align-items-center center-items">
						<!-- Left  -->
						<div class="col-lg-6 mb-5 mb-lg-0 shadow ">
							<img src="{{ asset('images/gorec.jpg') }}" class="w-100 rounded-4 shadow-4" alt="gorec" />
						</div>
						<!-- Right  -->
						<div class="col-lg-4 mb-5 mb-lg-0 shadow ">
							<div class="card cascading-left bg-body-tertiary" style="backdrop-filter: blur(30px);">
								<div class="card-body py-5 px-5 text-start">
									<h2 class="fw-bold text-center mb-4">Iniciar Sesión</h2>
									@if ($errors->any())
										<div class="alert alert-warning mb-4" role="alert">El usuario o la contraseña no son correctos</div>
									@endif
									<div class="">
										<form action="{{ route('login') }}" method="POST">
											@csrf
											<!-- Usuario input -->
											<div class="form-outline mb-4">
												<label class="form-label">Usuario</label>
												<input type="text" name="email" id="email" class="input-auth" placeholder="Ingrese Usuario" required/>
											</div>
											<!-- Password input -->
											<div class="form-outline mb-4">
												<label class="form-label">Contraseña</label>
												<input type="password" name="password" id="password" placeholder="Ingrese Password" class="input-auth" required/>
											</div>
											<!-- Button -->
											<div class="text-center">
												<button type="submit" class="btn btn-gorec btn-block mb-4">Iniciar Sesión</button>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
		</main>
		<!-- Modal para cambiar la contraseña -->
<div class="modal fade" id="passwordModal" tabindex="-1" aria-labelledby="passwordModalLabel" aria-hidden="true">
	<div class="modal-dialog">
	  <div class="modal-content">
		<div class="modal-header">
		  <h5 class="modal-title" id="passwordModalLabel">Cambiar Contraseña</h5>
		  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		</div>
		<form id="passwordChangeForm" action="{{ route('password.update') }}" method="POST">
		  @csrf
		  <div class="modal-body">
			<div class="mb-3">
			  <label for="new_password" class="form-label">Nueva Contraseña</label>
			  <input type="password" class="form-control" id="new_password" name="new_password" required>
			</div>
			<div class="mb-3">
			  <label for="new_password_confirmation" class="form-label">Confirmar Contraseña</label>
			  <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" required>
			</div>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-secondary" style="border-radius: 30px; width: 100px;
			height: 40px" data-bs-dismiss="modal">Cerrar</button>
			<button type="submit" class="btn btn-cambio">Cambiar Contraseña</button>
		  </div>
		</form>
	  </div>
	</div>
  </div>
  
		<footer>

		</footer>
		<!-- Bootstrap JavaScript Libraries -->
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
		<script>
			$(document).ready(function() {
				@if (session('showPasswordChangeModal'))
					// Abre el modal si la contraseña no ha sido cambiada
					$('#passwordModal').modal('show');
				@endif
		
				$('#passwordChangeForm').on('submit', function(e) {
					e.preventDefault(); // Evita el envío del formulario
		
					$.ajax({
						url: "{{ route('password.update') }}", // Ruta para actualizar la contraseña
						type: 'POST',
						data: $(this).serialize(), // Serializa los datos del formulario
						success: function(response) {
							// Maneja la respuesta de la solicitud AJAX
							alert('Contraseña actualizada exitosamente');
							$('#passwordModal').modal('hide'); // Cierra el modal
							window.location.href = "{{ url('/home') }}"; // Redirige a la página de inicio
						},
						error: function(response) {
							// Maneja errores de la solicitud AJAX
							alert('Error al actualizar la contraseña');
						}
					});
				});
			});
		</script>
		
	</body>
</html>