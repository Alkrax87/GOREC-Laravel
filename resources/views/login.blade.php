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
			background-color: #000;
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
		.register-direction {
			color: #72081f;
			text-decoration: none;
		}
		@media (max-width: 991.98px) {
			.cascading-left {
				margin-right: 0;
			}
		}
	</style>

	<body>
		@if ($errors->any())
			<div>
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif
		<header>

		</header>
		<main>
			<section class="text-center text-lg-start">
				<div class="container py-4">
					<div class="row g-0 align-items-center center-items">
						<!-- Left  -->
						<div class="col-lg-6 mb-5 mb-lg-0">
							<img src="{{ asset('images/gorec-bg.jpg') }}" class="w-100 rounded-4 shadow-4" alt="gorec-bg" />
						</div>
						<!-- Right  -->
						<div class="col-lg-4 mb-5 mb-lg-0">
							<div class="card cascading-left bg-body-tertiary" style="backdrop-filter: blur(30px);">
								<div class="card-body pt-5 px-5 text-start">
									<h2 class="fw-bold text-center">Iniciar Sesión</h2>
									<div class="mt-5">
										<form action="{{ route('login') }}" method="POST">
											@csrf
											<!-- Email input -->
											<div class="form-outline mb-4">
												<label class="form-label">Email</label>
												<input type="email" name="email" id="email" class="input-auth" placeholder="Joe@gmail.com" required/>
											</div>
											<!-- Password input -->
											<div class="form-outline mb-4">
												<label class="form-label">Contraseña</label>
												<input type="password" name="password" id="password" class="input-auth" placeholder="********" required/>
											</div>
											<!-- Button -->
											<div class="text-center">
												<button type="submit" class="btn btn-gorec btn-block mb-4">Iniciar Sesión</button>
											</div>
										</form>
										<div class="center-items pt-3">
											<p>No tienes una cuenta? <a class="register-direction" href="{{ route('register') }}">Regístrate aquí</a>.</p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
		</main>
		<footer>

		</footer>

		<!-- Bootstrap JavaScript Libraries -->
		<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
	</body>
</html>