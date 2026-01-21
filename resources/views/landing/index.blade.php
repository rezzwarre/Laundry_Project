@extends('layouts.landing')

@section('title', 'Landing Page')

@section('content')

	<!-- header body -->
	<div class="overflow-hidden position-relative">
	   <img src="{{ asset('img/bg/bg1.jpg') }}" class="position-absolute z-n1 top-0 h-100 w-100 object-fit-cover" alt="Meeting">

	   <div class="overlay position-absolute z-n1 top-0 h-100 w-100 bg-dark"
	        style="opacity: 0.85; mix-blend-mode: multiply; filter: contrast(1.15) brightness(0.85);">
	    </div>

	    <div class="container">
	        <div class="min-vh-100 row align-items-center">
	        	<div class="col-12 col-xl-8">
		            <div class="pt-9 pt-md-10 pt-xl-11 pb-7 pb-md-8 pb-xl-9 max-w-2xl mx-auto mx-xl-0">
		                <div class="mt-4 pt-2">
		                    <div class="text-center text-xl-start">
		                        <h1 class="m-0 text-white tracking-tight text-6xl fw-bold" data-aos-delay="0" data-aos="fade" data-aos-duration="3000">
		                            Experience Ultimate Cleanliness
		                        </h1>
		                        <p class="m-0 mt-4 text-white text-lg leading-8" data-aos-delay="100" data-aos="fade" data-aos-duration="3000">
		                            No more worries about laundry! Let our professional crew at Freshen Laundry Service take the task off your hands.
		                        </p>
		                        <div class="mt-4 pt-3 d-flex align-items-center justify-content-center justify-content-xl-start column-gap-3">
		                            <a href="javascript:;" class="btn btn-lg btn-primary text-white text-sm fw-semibold" data-aos-delay="200" data-aos="fade" data-aos-duration="3000">
		                                Contact us
		                            </a>
		                            <a href="javascript:;" class="btn btn-lg text-white icon-link icon-link-hover bg-secondary-hover text-sm leading-6 fw-semibold" data-aos-delay="300" data-aos="fade" data-aos-duration="3000">
		                                Learn more 
		                                <span class="bi align-self-start left-to-right" aria-hidden="true">→</span>
		                                <span class="bi align-self-start right-to-left" aria-hidden="true">←</span>
		                            </a>
                                    {{-- Problem --}}
		                        </div>
		                    </div>
		                </div>
		            </div>
	            </div>
	        </div>
	    </div>
	</div> 



	<!-- Modal to embed vidoes!! -->
	{{-- <div class="modal fade" id="videoModal" tabindex="-1" aria-hidden="true">
		<div class="modal-dialog modal-xl modal-dialog-centered">
			<div class="modal-content border-0" style="border-radius: 0.75rem;">
				<div class="modal-header border-0 p-0">
					<button type="button" class="btn-close bg-white border position-absolute top-0 end-0 translate-middle me-n3 me-sm-n5 mt-n4 rounded-circle p-2" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body p-0">
					<div class="ratio ratio-16x9">
						<iframe class="embed-responsive-item iframeVideo" style="border-radius: 0.75rem;" allow="autoplay"></iframe>
					</div>
				</div>
				
			</div>
		</div>
	</div> --}}



	<!-- services -->
	<div class="overflow-hidden py-7 py-sm-8 py-xl-9 bg-body-tertiary">
	    <div class="container">
	        <div>
	            <div class="mx-auto max-w-2xl text-center">
					<h2 class="m-0 text-primary-emphasis text-base leading-7 fw-semibold">
						Our services
					</h2>
	                <p class="m-0 mt-2 text-body-emphasis text-4xl tracking-tight fw-bold">
	                    Convenient Laundry Services in NYC
	                </p>
	                <p class="m-0 mt-4 text-body text-lg leading-8">
	                    Experience the power of eco-friendly laundry with our premium detergents
	                </p>
	            </div>
	        </div>
	        <div>
	            <div class="row row-cols-1 row-cols-xl-3 gy-5 gx-xl-4 mt-1 justify-content-center justify-content-xl-between">
	                <div class="col pt-5 pt-xl-4">
	                    <div class="max-w-xl mx-auto mx-xl-0" data-aos-delay="0" data-aos="fade" data-aos-duration="1000">
                        	<div class="ratio" style="--bs-aspect-ratio: 66.66%;">
                                <img src="{{ asset('img/bg/bg2.jpg') }}" class="object-fit-cover rounded-3" alt="Service image" loading="lazy">
                            </div>

                            <h3 class="m-0 mt-4 text-body-emphasis text-lg leading-6 fw-semibold">
                                Eco-Friendly Dry Cleaning
                            </h3>

                            <!-- Remove line-clamp-2 if you need more lines or add line-clamp-3 -->
                            <p class="m-0 mt-3 text-body-secondary line-clamp-2 text-sm leading-6">
                                Safely clean your delicate garments with our eco-friendly dry cleaning services, leaving them fresh and free from harsh chemicals.
                            </p>
	                    </div>
	                </div>
      				
      				<div class="col pt-5 pt-xl-4">
	                    <div class="max-w-xl mx-auto mx-xl-0" data-aos-delay="100" data-aos="fade" data-aos-duration="1000">
                        	<div class="ratio" style="--bs-aspect-ratio: 66.66%;">
                                <img src="{{ asset('img/bg/bg3.jpg') }}" class="object-fit-cover rounded-3" alt="Service image" loading="lazy">
                            </div>

                            <h3 class="m-0 mt-4 text-body-emphasis text-lg leading-6 fw-semibold">
                                Wash & Fold Service
                            </h3>

                            <!-- Remove line-clamp-2 if you need more lines or add line-clamp-3 -->
                            <p class="m-0 mt-3 text-body-secondary line-clamp-2 text-sm leading-6">
                                Save time by letting us handle your laundry needs with our efficient wash & fold service, ensuring your clothes are clean and neatly folded.
                            </p>
	                    </div>
	                </div>

	                <div class="col pt-5 pt-xl-4">
	                    <div class="max-w-xl mx-auto mx-xl-0" data-aos-delay="200" data-aos="fade" data-aos-duration="1000">
                        	<div class="ratio" style="--bs-aspect-ratio: 66.66%;">
                                <img src="{{ asset('img/bg/bg4.jpg') }}" class="object-fit-cover rounded-3" alt="Service image" loading="lazy">
                            </div>

                            <h3 class="m-0 mt-4 text-body-emphasis text-lg leading-6 fw-semibold">
                                Same-Day Pickup & Delivery
                            </h3>

                            <!-- Remove line-clamp-2 if you need more lines or add line-clamp-3 -->
                            <p class="m-0 mt-3 text-body-secondary line-clamp-2 text-sm leading-6">
                                Forget about waiting – our same-day pickup and delivery service ensures your laundry is promptly picked up, cleaned, and returned to you on time.
                            </p>
	                    </div>
	                </div>
	            </div>
	        </div>

	        <div class="text-center pt-7">
	            <a href="javascript:;" class="btn btn-lg btn-primary text-white icon-link icon-link-hover text-sm leading-6 fw-semibold">
                    Learn more 
                    <span class="bi align-self-start left-to-right" aria-hidden="true">→</span>
                    <span class="bi align-self-start right-to-left" aria-hidden="true">←</span>
                </a>{{-- Problem --}}
	        </div>
	    </div>      
	</div>	



	<!-- About Us -->
	<div class="overflow-hidden py-7 py-sm-8 py-xl-9">
		<div class="container">
			<div class="row gy-5 align-items-center justify-content-between">
				<div class="col-12 col-xl-5 order-last">
					<div class="mx-auto max-w-2xl">
						<h2 class="m-0 text-primary-emphasis text-base leading-7 fw-semibold">
							About Us
						</h2>
						<p class="m-0 mt-2 text-body-emphasis text-4xl tracking-tight fw-bold">
							Making laundry a breeze, one clean garment at a time.
						</p>
						<p class="m-0 mt-4 text-body-secondary text-lg leading-8">
							Welcome to Freshen, your premier laundry service in New York, NY. We are dedicated to providing top-quality, convenient, and affordable laundry solutions to our valued customers.
						</p>
						<div class="mt-4">
							<a href="javascript:;" class="icon-link icon-link-hover text-decoration-none text-sm leading-6 fw-bold">
			                    Learn more 
			                    <span class="bi align-self-start left-to-right" aria-hidden="true">→</span>
			                    <span class="bi align-self-start right-to-left" aria-hidden="true">←</span>
			                </a>
                            {{-- Probblem --}}
						</div>
					</div>
				</div>

				<div class="col-12 col-xl-6">
					<div class="mx-auto max-w-2xl">
                        <div class="ratio ratio-4x3" data-aos-delay="0" data-aos="fade" data-aos-duration="3000">
                            <img src="{{ asset('img/bg/bg5.jpg') }}" class="object-fit-cover rounded-3" alt="about us" loading="lazy">
                        </div>
					</div>
				</div>
			</div>

			<!-- big image -->
		    <div class="ratio ratio-16x9 mt-7 mt-sm-8 mt-xl-9">
                <img src="{{ asset('img/bg/bg6.jpg') }}" class="object-fit-cover rounded-3" alt="presentation" loading="lazy">
            </div>
		</div>
	</div>



    <!-- Testimonials -->
    <div class="overflow-hidden py-7 py-sm-8 py-xl-9 bg-body-secondary">
        <div class="container">
            <div id="carouselExampleIndicators" class="carousel slide pb-5">
                <div class="carousel-indicators mb-0">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="mx-auto max-w-4xl text-center">
                            <img class="mx-auto" src="{{ asset('img/clients/logo1.png') }}" height="48" alt="Client Company" loading="lazy">
                            <figure class="m-0 mt-5">
                                <blockquote class="text-center fw-semibold text-body-emphasis text-2xl leading-9">
                                    <p class="m-0">
                                        “ Freshen is fantastic! Their laundry service is top-notch, and the staff is friendly and professional. I was impressed by the quality of their work and their attention to detail. Thank you, Freshen, for taking care of my laundry needs! ”
                                    </p>
                                </blockquote>

                                <figcaption class="m-0 mt-5">
                                    <img class="mx-auto rounded-circle" width="40" height="40" src="{{ asset('img/small-team/st1.jpg') }}" alt="Clinet Name" loading="lazy">
                                    <div class="mt-3 d-flex align-items-center justify-content-center text-base">
                                        <div class="fw-semibold text-body-emphasis">John Bond</div>
                                        <svg viewBox="0 0 2 2" width="3" height="3" aria-hidden="true" class="mx-3 text-body-emphasis" fill="currentColor">
                                            <circle cx="1" cy="1" r="1" />
                                        </svg>
                                        <div class="text-body-secondary">CEO of Aven</div>
                                    </div>
                                </figcaption>
                            </figure>
                        </div>
                    </div>

                    <div class="carousel-item">
                        <div class="mx-auto max-w-4xl text-center">
                            <img class="mx-auto" src="{{ asset('img/clients/logo2.png') }}" height="48" alt="Client Company" loading="lazy">
                            <figure class="m-0 mt-5">
                                <blockquote class="text-center fw-semibold text-body-emphasis text-2xl leading-9">
                                    <p class="m-0">
                                        “ Freshen is fantastic! Their laundry service is top-notch, and the staff is friendly and professional. I was impressed by the quality of their work and their attention to detail. Thank you, Freshen, for taking care of my laundry needs! ”
                                    </p>
                                </blockquote>

                                <figcaption class="m-0 mt-5">
                                    <img class="mx-auto rounded-circle" width="40" height="40" src="{{ asset('img/small-team/st2.jpg') }}" alt="Client name" loading="lazy">
                                    <div class="mt-3 d-flex align-items-center justify-content-center text-base">
                                        <div class="fw-semibold text-body-emphasis">Judith Bond</div>
                                        <svg viewBox="0 0 2 2" width="3" height="3" aria-hidden="true" class="mx-3 text-body-emphasis" fill="currentColor">
                                            <circle cx="1" cy="1" r="1" />
                                        </svg>
                                        <div class="text-body-secondary">CEO of Circle</div>
                                    </div>
                                </figcaption>
                            </figure>
                        </div>
                    </div>

                    <div class="carousel-item">
                        <div class="mx-auto max-w-4xl text-center">
                            <img class="mx-auto" src="{{ asset('img/clients/logo3.png') }}" height="48" alt="Client Company" loading="lazy">
                            <figure class="m-0 mt-5">
                                <blockquote class="text-center fw-semibold text-body-emphasis text-2xl leading-9">
                                    <p class="m-0">
                                        “ Freshen is fantastic! Their laundry service is top-notch, and the staff is friendly and professional. I was impressed by the quality of their work and their attention to detail. Thank you, Freshen, for taking care of my laundry needs! ”
                                    </p>
                                </blockquote>

                                <figcaption class="m-0 mt-5">
                                    <img class="mx-auto rounded-circle" width="40" height="40" src="{{ asset('img/small-team/st3.jpg') }}" alt="Client name" loading="lazy">
                                    <div class="mt-3 d-flex align-items-center justify-content-center text-base">
                                        <div class="fw-semibold text-body-emphasis">Alex Bond</div>
                                        <svg viewBox="0 0 2 2" width="3" height="3" aria-hidden="true" class="mx-3 text-body-emphasis" fill="currentColor">
                                            <circle cx="1" cy="1" r="1" />
                                        </svg>
                                        <div class="text-body-secondary">CEO of Amara</div>
                                    </div>
                                </figcaption>
                            </figure>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev d-none d-xl-inline" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon rtl-flip" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next d-none d-xl-inline" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                    <span class="carousel-control-next-icon rtl-flip" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>



	<!-- Client -->
	<div class="overflow-hidden py-6 py-sm-7 py-xl-8 bg-body-tertiary">
		<div class="container">
			<div class="max-w-2xl">
				<h2 class="m-0 text-primary-emphasis text-base leading-7 fw-semibold">
					Our Clients
				</h2>
				<div class="m-0 mt-2 text-body-emphasis text-4xl tracking-tight fw-bold">
					We're fortunate to have incredible clients.
				</div>
			</div>

			<div class="mt-4">
				<div class="glide glideHighLinear">
					<div class="glide__track" data-glide-el="track">
						<ul class="glide__slides align-items-center">
							<li class="glide__slide">
								<div class="p-5">
									<img src="{{ asset('img/clients/logo1.png') }}" class="img-fluid" alt="clients">
								</div>
							</li>
							<li class="glide__slide">
								<div class="p-5">
									<img src="{{ asset('img/clients/logo2.png') }}" class="img-fluid" alt="clients">
								</div>
							</li>
							<li class="glide__slide">
								<div class="p-5">
									<img src="{{ asset('img/clients/logo3.png') }}" class="img-fluid" alt="clients">
								</div>
							</li>
							<li class="glide__slide">
								<div class="p-5">
									<img src="{{ asset('img/clients/logo4.png') }}" class="img-fluid" alt="clients">
								</div>
							</li>
							<li class="glide__slide">
								<div class="p-5">
									<img src="{{ asset('img/clients/logo5.png') }}" class="img-fluid" alt="clients">
								</div>
							</li>
							<li class="glide__slide">
								<div class="p-5">
									<img src="{{ asset('img/clients/logo6.png') }}" class="img-fluid" alt="clients">
								</div>
							</li>
							<li class="glide__slide">
								<div class="p-5">
									<img src="{{ asset('img/clients/logo7.png') }}" class="img-fluid" alt="clients">
								</div>
							</li>
							<li class="glide__slide">
								<div class="p-5">
									<img src="{{ asset('img/clients/logo8.png') }}" class="img-fluid" alt="clients">
								</div>
							</li>
							<li class="glide__slide">
								<div class="p-5">
									<img src="{{ asset('img/clients/logo9.png') }}" class="img-fluid" alt="clients">
								</div>
							</li>		
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>



    <!-- Contact us -->
    <div id="contact-us" class="overflow-hidden py-7 py-sm-8 py-xl-9">
        <div class="container">
            <div class="row gy-5 gx-sm-5">
                <div class="col-12 col-xl-5 pt-4">
                    <div class="mx-auto max-w-2xl">
                        <h2 class="m-0 text-primary-emphasis text-base leading-7 fw-semibold">
                            Get in touch
                        </h2>
                        <p class="m-0 mt-2 text-body-emphasis text-3xl tracking-tight fw-bold">
                            Have any questions or need assistance? Contact us today!
                        </p>
                    </div>

                    <div class="mx-auto max-w-2xl mt-6">
                        <form class="row g-4 needs-validation" id="myForm" novalidate>
                            <div class="col-md-6">
                                <label for="nameForm" class="form-label text-sm">
                                    Full name
                                    <span class="text-danger-emphasis">*</span>
                                </label>
                                <input type="text" class="form-control form-control-sm" name="nameForm" id="nameForm" required>
                                <div class="invalid-feedback text-xs">
                                    Please enter your full name.
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="emailForm" class="form-label text-sm">
                                    Email address
                                    <span class="text-danger-emphasis">*</span>
                                </label>
                                <input type="email" class="form-control form-control-sm" name="emailForm" id="emailForm" required>
                                <div class="invalid-feedback text-xs">
                                    Please enter your email address.
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="phoneForm" class="form-label text-sm">
                                    Phone number
                                    <span class="text-danger-emphasis">*</span>
                                </label>
                                <input type="text" class="form-control form-control-sm" name="phoneForm" id="phoneForm" required>
                                <div class="invalid-feedback text-xs">
                                    Please enter your phone number.
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="subjectForm" class="form-label text-sm">
                                    Subject
                                    <span class="text-danger-emphasis">*</span>
                                </label>
                                <input type="text" class="form-control form-control-sm" name="subjectForm" id="subjectForm" required>
                                <div class="invalid-feedback text-xs">
                                    Please enter a subject for your message.
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="messageForm" class="form-label text-sm">
                                    Your message
                                    <span class="text-danger-emphasis">*</span>
                                </label>
                                <textarea class="form-control form-control-sm" name="messageForm" id="messageForm" rows="3" required></textarea>
                                <div class="invalid-feedback text-xs">
                                    Please enter a message.
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="gridCheck" required>
                                    <label class="form-check-label text-sm" for="gridCheck">
                                        I agree to the terms &amp; conditions and privacy policy
                                        <span class="text-danger-emphasis">*</span>
                                    </label>
                                    <div class="invalid-feedback text-xs">
                                        Please agree to the terms &amp; conditions and privacy policy.
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-12 text-center pt-3">
                                <button type="submit" class="btn btn-lg btn-primary text-white text-sm fw-semibold" id="sendMessage">
                                    Send message
                                </button>
                            </div>

                            <!-- Alert message  -->
                            <div class="col-12" id="yourMessageIsSent"></div>
                        </form>
                    </div>
                </div>

                <div class="d-none d-xl-block col-12 col-xl-7" data-aos-delay="0" data-aos="fade" data-aos-duration="3000">
                    <div class="h-100 position-relative ms-xxl-5">
                        <div class="position-absolute top-0 end-0 bottom-0 start-0 z-n1 rounded-5">
                            <img src="{{ asset('img/bg/bg7.jpg') }}" class="w-100 h-100 rounded-3 object-fit-cover" loading="lazy" alt="Image description">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



	<footer class="overflow-hidden py-6 py-sm-7 py-xl-8 bg-body-tertiary">
	    <div class="container">
	        <div class="row gy-5">
	            <div class="col-12 col-xl-6">
	                <div class="pb-3 max-w-lg position-relative">
	                    <form method="post" target="_blank" novalidate class="mc-embedded-subscribe-form">

	                        <h2 class="text-body-emphasis leading-6 text-4xl tracking-tight fw-bold">
	                            Subscribe to our newsletter.
	                        </h2>
	                        <p class="m-0 mt-3 text-body-secondary text-lg leading-8">
	                            Experience the ease of code deployment with just a click. Simplify your development tasks, and increase productivity.
	                        </p>

	                        <div class="mt-4 mb-2 d-flex flex-column flex-sm-row w-100 gap-2 js-form-inputs">
	                            <label for="emailSubscribe1" class="visually-hidden">Email address</label>
	                            <input type="email" name="EMAIL" id="emailSubscribe1" value="" class="form-control leading-6 text-sm max-w-xl" placeholder="Enter your email">
	                            <button type="submit" name="subscribe" class="btn btn-primary text-white fw-semibold text-sm">Subscribe</button>
	                        </div>

	                        <!-- This div is related to Mailchimp integration and handled by a function in our scripts.js file, so no need to worry about it. -->
	                        <div style="position: absolute; left: -5000px;" aria-hidden="true">
	                            <input type="text" class="js-validate-robot" name="b_a4752870f583bb49a02427b3c_143fa46c21" tabindex="-1" value="">
	                        </div>

	                        <!-- response -->
	                        <div class="js-subscribe-response"></div>

	                    </form>
	                </div>
	            </div>

	            <div class="col-12 col-xl-6">
	                <div class="row row-cols-1 row-cols-sm-2 gx-3 gy-5">
	                    <div class="d-flex flex-column align-items-start">
	                        <div class="p-2 bg-body-tertiary rounded-3 border">
	                            <svg class="text-body-emphasis" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
	                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
	                            </svg>
	                        </div>
	                        <div class="m-0 mt-3 text-body-emphasis fw-semibold">
	                            Weekly articles
	                        </div>
	                        <div class="m-0 mt-2 text-body-secondary leading-7">
	                            Accelerate your deployment process effortlessly. Seamlessly manage your code deployment.
	                        </div>
	                    </div>

	                    <div class="d-flex flex-column align-items-start">
	                        <div class="p-2 bg-body-tertiary rounded-3 border">
	                            <svg class="text-body-emphasis" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
	                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.05 4.575a1.575 1.575 0 10-3.15 0v3m3.15-3v-1.5a1.575 1.575 0 013.15 0v1.5m-3.15 0l.075 5.925m3.075.75V4.575m0 0a1.575 1.575 0 013.15 0V15M6.9 7.575a1.575 1.575 0 10-3.15 0v8.175a6.75 6.75 0 006.75 6.75h2.018a5.25 5.25 0 003.712-1.538l1.732-1.732a5.25 5.25 0 001.538-3.712l.003-2.024a.668.668 0 01.198-.471 1.575 1.575 0 10-2.228-2.228 3.818 3.818 0 00-1.12 2.687M6.9 7.575V12m6.27 4.318A4.49 4.49 0 0116.35 15m.002 0h-.002" />
	                            </svg>
	                        </div>
	                        <div class="m-0 mt-3 text-body-emphasis fw-semibold">
	                            No spam
	                        </div>
	                        <div class="m-0 mt-2 text-body-secondary leading-7">
	                            Accelerate your deployment process effortlessly. Seamlessly manage your code deployment.
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>

	    

	    <div class="container">
	    	<hr class="my-6 text-body-emphasis opacity-10">

	        <div class="d-flex flex-column flex-xl-row gap-5 justify-content-between align-items-xl-center">
	            <div class="order-first order-xl-last">
	                <ul class="nav row gy-4 gx-sm-4 row-cols-2 row-cols-sm-auto">
	                    <li class="nav-item">
	                        <a href="./about.html" class="p-0 text-body-secondary nav-link leading-6 text-sm"> About </a>
	                    </li>
	                    <li class="nav-item">
	                        <a href="./services.html" class="p-0 text-body-secondary nav-link leading-6 text-sm"> Services </a>
	                    </li>
	                    <li class="nav-item">
	                        <a href="./blog.html" class="p-0 text-body-secondary nav-link leading-6 text-sm"> Blog </a>
	                    </li>
	                    <li class="nav-item">
	                        <a href="./contact.html" class="p-0 text-body-secondary nav-link leading-6 text-sm"> Contact us </a>
	                    </li>
	                </ul>
	            </div>

	            <div class="">
	                <a href="./index.html" class="link-body-emphasis d-flex align-items-center text-decoration-none">
	                    <img src="{{ asset('logo/logo.png') }}" height="24" alt="logo" loading="lazy">
	                </a>
	            </div>

	            <div class="order-last order-xl-first">
	                <p class="mb-0 text-body-secondary leading-6 text-sm">
	                    © 
	                    <span class="current-year"></span> 
	                    Company, Inc Distributed by <a href="https://themewagon.com">ThemeWagon</a>
	                </p>
	            </div>
	        </div>
	    </div>  
	</footer>



	<!-- Back to top button -->
	<button type="button" class="btn btn-primary btn-back-to-top rounded-circle justify-content-center align-items-center p-2 text-white">
		<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-caret-up-fill" viewBox="0 0 16 16"> <path d="m7.247 4.86-4.796 5.481c-.566.647-.106 1.659.753 1.659h9.592a1 1 0 0 0 .753-1.659l-4.796-5.48a1 1 0 0 0-1.506 0z"/> </svg>
	</button>

@endsection