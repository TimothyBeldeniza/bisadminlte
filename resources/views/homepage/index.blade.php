<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Learning Bootstrap v5 with sass</title>
    <link rel="stylesheet" href="{{ asset('homepage-assets/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('homepage-assets/assets/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('homepage-assets/assets/vendors/css/glightbox.min.css') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
    
    <!-- AOS CSS AND JS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

</head>
<body>
    <!-- START THE NAVBAR SECTION -->
    <nav class="navbar navbar-expand-lg  navbar-dark menu shadow fixed-top">
        <div class="container">
          <a class="navbar-brand d-flex align-items-center" href="#">
              <img class="image-fluid bis-logo" src="images/BIS - Logo.png" alt="logo-image">
              <h3 class="fw-bold ms-2"> B I S</h3>
          </a>
          
          <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Services</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Announcements</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">FAQ</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Contact</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      
      
      <!-- START THE INTRO SECTION -->
      <section id="home" class="intro-section position-relative">
          <div class="container">
            <div class="row align-items-center text-dark">
              <!-- START THE CONTENT FOR THE INTRO -->
              <div data-aos="fade-right"
              data-aos-duration="3000" class="col-md-6 intros text-start">
                  <h1 class="display-2">
                      <span class="text-light display-2--intro">Barangay Information System</span>
                      <span class="text-light display-2--description lh-base">
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Cumque, distinctio.
                      </span>
                  </h1>

                  <button type="button" class="rounded-pill btn-rounded">Get in Touch
                    <span>
                        <i class="fas fa-arrow-right"></i>
                    </span>
                  </button>
              </div>

              <!-- START THE CONTENT FOR THE VIDEO -->
              <div data-aos="fade-left"
              data-aos-duration="3000" class="col-md-6 intros text-end">
                <div class="video-box">

                    <img src="{{ asset('homepage-assets/images/arts/ui.png') }}" alt="video illustration " class="img-fluid">
                
                    <a href="#" class="glightbox">
                      <span>
                        <i class="fas fa-play-circle"></i>
                      </span>

                      <span class="border-animation border-animation--border-1"></span>
                      <span class="border-animation border-animation--border-2"></span>

                    </a>
                </div>
              </div>
            </div>
          </div>
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#ffffff" fill-opacity="1" d="M0,96L40,122.7C80,149,160,203,240,197.3C320,192,400,128,480,106.7C560,85,640,107,720,144C800,181,880,235,960,229.3C1040,224,1120,160,1200,138.7C1280,117,1360,139,1400,149.3L1440,160L1440,320L1400,320C1360,320,1280,320,1200,320C1120,320,1040,320,960,320C880,320,800,320,720,320C640,320,560,320,480,320C400,320,320,320,240,320C160,320,80,320,40,320L0,320Z"></path></svg>
          
        
        </section>
      

      <!-- START THE COMPANIES SEcTION -->
      <section class="companies">
        <div class="container-fluid">
          <div data-aos="fade-down"
          data-aos-duration="3000" class="row text-center">
            <h4 class="fw-bold lead mb-3 mt-3">BIS</h4>
            <div class="heading-line mb-5"></div>
          </div>
        </div>

        
        <div class="container-fluid">
          <div class="row d-flex align-items-center">
            <div data-aos="fade-right"
            data-aos-duration="3000" class="p-0 col-lg-6">
              <img src="{{ asset('homepage-assets/images/barangay.jpg') }}" alt="" class="h-100 w-100 img-fluid">
            </div>
            <div data-aos="fade-left"
            data-aos-duration="3000" class="p-4 col-lg-6">
              <h3 class="mb-4">Experience Barangay Information System in Tondo</h3>
              <p>We at Tondo Barangay Information System take pride in the level of services we’re offering. 
                Aside from the state-of-the-art equipment, our barangay team is fully equipped with knowledge and experience in the field.</p>
            </div>
          </div>
        </div>
      </section>

      <!-- START SECTION 5 -THE Testimonials -->
      <section id="testimonials" class="testimonials">
        <svg  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#ffffff" fill-opacity="1" d="M0,96L48,128C96,160,192,224,288,213.3C384,203,480,117,576,117.3C672,117,768,203,864,213.3C960,224,1056,160,1152,144C1248,128,1344,160,1392,176L1440,192L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z"></path></svg>
        <div data-aos="fade-up" data-aos-duration="3000" class="container">
          <div class="row text-center text-white">
            <h1 class="display-3 fw-bold">Announcements</h1>
            <hr style="width:100px; height:3px;" class="mx-auto">
            <p class="lead pt-1">What our barangay officials are saying</p>
          </div>

          <!-- START THE CAROUSEL CONTENT -->
          <div class="row align-items-center">
            <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
              <div class="carousel-inner">
                <!-- CAROUSEL ITEM 1 -->
                <div class="carousel-item active">
                  <!-- TESTIMONIALS CARD -->
                  <div class="testimonials__card">
                    <p class="lh-lg">
                      <i class="fas fa-quote-left"></i>
                      Lorem ipsum dolor sit amet consectetur, adipisicing elit. Tempore, temporibus omnis maxime, possimus veniam sint aliquam deserunt labore optio ipsum repudiandae.
                      Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores atque obcaecati repudiandae similique eaque consequuntur, dolore illo accusamus molestiae. Consequuntur qui ipsum commodi nobis quos dolore cupiditate odit fugiat sint!
                      Lorem ipsum dolor sit amet consectetur adipisicing elit. Provident nisi eveniet, sunt sapiente veniam in facere, explicabo consequuntur illo, modi nihil expedita quis. Magni quae necessitatibus totam praesentium tempora? Quasi!
                      <i class="fas fa-quote-right"></i>
                      
                    </p>
                  </div>
                  <!-- client picture -->
                  <div class="testimonials__picture">
                    <img src="{{ asset('homepage-assets/images/officials/bart.png') }}" alt="official-1 picture" class="rounded-circle img-fluid">
                  </div>

                  <!-- client name & role -->
                  <div class="testimonials__name">
                    <h3>Jon Jeremiah Bartolome</h3>
                    <p class="fw-light">Chairman</p>
                  </div>
                </div>

                <!-- CAROUSEL ITEM 2 -->
                <div class="carousel-item">
                  <!-- TESTIMONIALS CARD -->
                  <div class="testimonials__card">
                    <p class="lh-lg">
                      <i class="fas fa-quote-left"></i>
                      Lorem ipsum dolor sit amet consectetur, adipisicing elit. Tempore, temporibus omnis maxime, possimus veniam sint aliquam deserunt labore optio ipsum repudiandae.
                      Lorem ipsum dolor sit amet consectetur adipisicing elit. Saepe cum libero suscipit! Repellat ipsum numquam quae nulla placeat, incidunt nostrum nisi nihil, sit aspernatur temporibus et nam? Quibusdam, aperiam laborum.
                      Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos, est rerum vero sit maxime blanditiis dolorem error neque sint omnis excepturi esse? Est ratione odio architecto minima, sit quo et?
                      <i class="fas fa-quote-right"></i>
                      
                    </p>
                  </div>
                  <!-- client picture -->
                  <div class="testimonials__picture">
                    <img src="{{ asset('homepage-assets/images/officials/baste.png') }}" alt="official-1 picture" class="rounded-circle img-fluid">
                  </div>

                  <!-- client name & role -->
                  <div class="testimonials__name">
                    <h3>Sebastian Carlo Cabiades</h3>
                    <p class="fw-light">Secretary</p>
                  </div>
                </div>
              </div>
              <div class="text-center">
                <button class="btn btn-outline-light fas fa-long-arrow-alt-left" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                
                </button>
                <button class="btn btn-outline-light fas fa-long-arrow-alt-right" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                  
                </button>
              </div>

            </div>
          </div>

        </div>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#ffffff" fill-opacity="1" d="M0,96L48,128C96,160,192,224,288,213.3C384,203,480,117,576,117.3C672,117,768,203,864,213.3C960,224,1056,160,1152,144C1248,128,1344,160,1392,176L1440,192L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
      </section>


      <!-- START SECTION 6 - FAQ -->

      <section id="faq" class="faq">
        <div class="container">
          <div class="row text-center">
            <h1 class="display-3 fw-bold text-uppercase">faq</h1>
            <div class="heading-line"></div>
            <p class="lead">Frequently asked questions, get knowledge before hand</p>
          </div>

          <!-- ACCORDION CONTENT -->
          <div class="row mt-5">
            <div class="col-md-12">
              <div class="accordion" id="accordionExample">
                <!-- ACCORDION ITEM 1 -->
                <div data-aos="zoom-in-up" class="accordion-item shadow mb-3">
                  <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                      What are the main features?
                    </button>
                  </h2>
                  <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                      <strong>This is the first item's accordion body.</strong> It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                    </div>
                  </div>
                </div>
                <!-- ACCORDION ITEM 2 -->
                <div data-aos="zoom-in-up" class="accordion-item shadow mb-3">
                  <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                      Question #2
                    </button>
                  </h2>
                  <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                      <strong>This is the second item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                    </div>
                  </div>
                </div>
                <!-- ACCORDION ITEM 3 -->
                <div data-aos="zoom-in-up" class="accordion-item shadow mb-3">
                  <h2 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                      Question #3
                    </button>
                  </h2>
                  <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                      <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                    </div>
                  </div>
                </div>
                <!-- ACCORDION ITEM 4 -->
                <div data-aos="zoom-in-up" class="accordion-item shadow mb-3">
                  <h2 class="accordion-header" id="headingFour">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                      Question #4
                    </button>
                  </h2>
                  <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                      <strong>This is the fourth item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- START SECTION 7 - THE PROPERTIES -->

      <section id="portfolio" class="portfolio">
        <div class="container">
          <div class="row text-center mt-5">
            <h1 class="display-3 fw-bold text-capitalize">Services</h1>
            <div class="heading-line"></div>
            <p class="lead">Lorem ipsum dolor sit amet consectetur adipisicing elit. Placeat fugit eius ad.</p>
          </div>


          <!-- START THE PORTFOLIO ITEMS -->
          <div class="row">
            <!-- <div class="col-lg-4 col-md-6 border border-success d-flex align-items-center justify-content-center p-3">
              <div class="portfolio-box shadow border border-dark ">
                <img src="images/arts/document-scan.png" alt="" atl="portfolio 7 image" title="portfolio 7 picture" class="img-fluid">
                <div class="portfolio-info border border-danger">
                  <div class="caption">
                    <h4>Authentication</h4>
                    <p>Scan Document</p>
                  </div>
                </div>
              </div>
            </div> -->

            <div data-aos="fade-right"
            data-aos-duration="3000" class="col-lg-4 col-md-6 mt-4 ">
              <div class="card border-2 p-4 ">
                <div class="card-body icon-box ">
                  <div class="icon">
                    <a href="#" class=""><img src="{{ asset('homepage-assets/images/arts/scan.jpg') }}" class="img-fluid py-4 rounded"></a>
                  </div>
                  <h4 class="mt-4 text-center "><a href="#" class="text-decoration-none">Scan Document</a></h4>
                </div>
              </div>
            </div>
            <div data-aos="fade-up"
            data-aos-duration="3000" class="col-lg-4 col-md-6 mt-4 ">
              <div class="card border-2 p-4 ">
                <div class="card-body icon-box ">
                  <div class="icon">
                    <a href="#" class=""><img src="{{ asset('homepage-assets/images/arts/req-doc.jpg') }}" class="img-fluid py-4 rounded"></a>
                  </div>
                  <h4 class="mt-4 text-center "><a href="#" class="text-decoration-none">Request Document</a></h4>
                </div>
              </div>
            </div>
            <div data-aos="fade-left"
            data-aos-duration="3000" class="col-lg-4 col-md-6 mt-4 ">
              <div class="card border-2 p-4 ">
                <div class="card-body icon-box ">
                  <div class="icon">
                    <a href="#" class=""><img src="{{ asset('homepage-assets/images/arts/file-com.jpg') }}" class="img-fluid py-4 rounded"></a>
                  </div>
                  <h4 class="mt-4 text-center "><a href="#" class="text-decoration-none">File Complaint</a></h4>
                </div>
              </div>
            </div>
            
            
          </div>
        </div>
      </section>

      <!-- START SECTION 8 GET STARTED -->
      <section id="contact" class="get-started">
        <div data-aos="fade-up"
          data-aos-duration="3000" class="container">
          <div class="row text-center">
            <h1 class="display-3 fw-bold text-capitalize">Get Started</h1>
            <div class="heading-line"></div>
            <p class="lh-lg">
              Lorem, ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus corrupti ab nesciunt!
            </p>
          </div>
          <!-- START THE CTA CONTENT -->
          <div class="row text-white">
            <div class="col-12 col-lg-6 gradient shadow p-3">
              <div class="cta-info w-100">
                <h4 class="display-4 fw-bold">100% Satisfaction Guaranteed</h4>
                <p class="lh-lg">
                  Lorem ipsum dolor, sit amet consectetur adipisicing elit. Sequi laborum, voluptate esse suscipit repudiandae incidunt ut. Laborum illum pariatur natus exercitationem.
                </p>
                <h3 class="display-3--brief">What will be the next step?</h3>
                <ul class="cta-info__list">
                  <li>We'll prepare the proposal</li>
                  <li>We'll discuss it together</li>
                  <li>Let's start the discussion</li>
                </ul>
              </div>
            </div>
            <div class="col-12 col-lg-6 bg-white shadow p-3">
              <div class="form w-100 pb-2">
                <h4 class="display-3--title mb-5">Ask a question</h4>
                <form action="#" class="row">
                  <div class="col-lg-6 mb-3">
                    <input type="text" placeholder="First Name" id="inputFirstName" class="form-control form-control-lg shadow">
                  </div>
                  <div class="col-lg-6 mb-3">
                    <input type="text" placeholder="Last Name" id="inputLastName" class="form-control form-control-lg shadow">
                  </div>
                  <div class="col-lg-12 mb-3">
                    <input type="email" placeholder="Email Address" id="inputEmail" class="form-control form-control-lg shadow">
                  </div>
                  <div class="col-lg-12 mb-3">
                    <textarea name="message" placeholder="Message" id="message" cols="30" rows="8" class="form-control form-control-lg shadow"></textarea>
                  </div>
                  <div class="text-center d-grid mt-1">
                    <button type="button" class="btn btn-primary rounded-pill pt-3 pb-3">
                      Submit
                      <i class="fas fa-paper-plane"></i>
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- START SECTION 9 - FOOTER  -->
      <footer class="footer">
        <div class="container">
          <div data-aos="fade-up"
          data-aos-duration="3000" class="row">
            <!-- CONTENT FOR THE MOBILE NUMBER -->
            <div class="col-md-4 col-lg-4 contact-box pt-1 d-md-block d-lg-flex d-flex">
              <div class="contact-box__icon">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-phone-call" viewBox="0 0 24 24" stroke-width="1" fill="none" stroke-linecap="round" stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                  <path d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2" />
                  <path d="M15 7a2 2 0 0 1 2 2" />
                  <path d="M15 3a6 6 0 0 1 6 6" />
                </svg>
              </div>
              <div class="contact-box__info">
                <a href="" class="contact-box__info--title">+63 908 123 4567</a>
                <p class="contact-box__info--subtitle">Mon-Fri 9am-6pm</p>
              </div>
            </div>
            <!-- CONTENT FOR EMAIL -->
            <div class="col-md-4 col-lg-4 contact-box pt-1 d-md-block d-lg-flex d-flex">
              <div class="contact-box__icon">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-mail-opened" viewBox="0 0 24 24" stroke-width="1" fill="none" stroke-linecap="round" stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                  <polyline points="3 9 12 15 21 9 12 3 3 9" />
                  <path d="M21 9v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10" />
                  <line x1="3" y1="19" x2="9" y2="13" />
                  <line x1="15" y1="13" x2="21" y2="19" />
                </svg>
              </div>
              <div class="contact-box__info">
                <a href="" class="contact-box__info--title">puptbis@gmail.com</a>
                <p class="contact-box__info--subtitle">Online Support</p>
              </div>
            </div>
            <!-- CONTENT FOR LOCATION -->
            <div class="col-md-4 col-lg-4 contact-box pt-1 d-md-block d-lg-flex d-flex">
              <div class="contact-box__icon">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-map-2" viewBox="0 0 24 24" stroke-width="1" fill="none" stroke-linecap="round" stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                  <line x1="18" y1="6" x2="18" y2="6.01" />
                  <path d="M18 13l-3.5 -5a4 4 0 1 1 7 0l-3.5 5" />
                  <polyline points="10.5 4.75 9 4 3 7 3 20 9 17 15 20 21 17 21 15" />
                  <line x1="9" y1="4" x2="9" y2="17" />
                  <line x1="15" y1="15" x2="15" y2="20" />
                </svg>
              </div>
              <div class="contact-box__info">
                <a href="" class="contact-box__info--title">Manila, Philippines</a>
                <p class="contact-box__info--subtitle">204 Zone 18 District II, Tondo</p>
              </div>
            </div>
          </div>
        </div>
        <!-- START THE SOCIAL MEDIA CONTENT  -->
        <div class="footer-sm" style="background-color: #212121;">
          <div class="container">
            <div data-aos="fade-up"
            data-aos-duration="3000" class="row py-4 text-center text-white">
              <div class="col-lg-5 col-md-6 mb-0 mx-auto">
                connect with us on social media
              </div>
              <div class="col-lg-7 col-md-6">
                <a href="#"><i class="fab fa-facebook"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-tiktok"></i></a>
                <a href="#"><i class="fab fa-linkedin"></i></a>
              </div>
            </div>
          </div>
        </div>

        <!-- START THE CONTENT FOR THE COMPANY INFO -->
        <div class="container mt-5">
          <div data-aos="fade-up"
          data-aos-duration="3000" class="row text-white justify-content-center mt-3 pb-3">
            <div class="col-12 col-sm-6 col-lg-6 mx-auto">
              <h5 class="text-capitalize fw-bold">Barangay Information System</h5>
              <hr class="bg-white d-inline-block mb-4" style="width: 60px; height: 2px;">
              <p class="lh-lg">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Earum, et sed? Fugit molestiae cumque delectus magni consequuntur.
              </p>
            </div>
            <div class="col-12 col-sm-6 col-lg-2 mb-4 mx-auto">
              <h5 class="text-capitalize fw-bold">Products</h5>
              <hr class="bg-white d-inline-block mb-4" style="width: 60px; height: 2px;">
              <ul class="list-inline company-list">
                <li><a href="#">Lorem Ipsum</a></li>
                <li><a href="#">Lorem Ipsum</a></li>
                <li><a href="#">Lorem Ipsum</a></li>
                <li><a href="#">Lorem Ipsum</a></li>
              </ul>
            </div>
            <div class="col-12 col-sm-6 col-lg-2 mb-4 mx-auto">
              <h5 class="text-capitalize fw-bold">Useful Links</h5>
              <hr class="bg-white d-inline-block mb-4" style="width: 60px; height: 2px;">
              <ul class="list-inline company-list">
                <li><a href="#">Your Account</a></li>
                <li><a href="#">Become an Affiliate</a></li>
                <li><a href="#">Create an account</a></li>
                <li><a href="#">Help</a></li>
              </ul>
            </div>
            <div class="col-12 col-sm-6 col-lg-2 mb-4 mx-auto">
              <h5 class="text-capitalize fw-bold">Contact</h5>
              <hr class="bg-white d-inline-block mb-4" style="width: 60px; height: 2px;">
              <ul class="list-inline company-list">
                <li><a href="#">Lorem Ipsum</a></li>
                <li><a href="#">Lorem Ipsum</a></li>
                <li><a href="#">Lorem Ipsum</a></li>
                <li><a href='https://www.freepik.com/vectors/mobile-app'>Mobile app vector created by storyset - www.freepik.com</a></li>
              </ul>
            </div>
          </div>
        </div>
        <!-- START THE COPYRIGHT INFO  -->

        <div class="footer-bottom pt-5 pb-5">
          <div class="container">
            <div class="row text-center text-white">
              <div class="col-12">
                <div class="footer-bottom__copyright">
                  &copy Copyright 2021 <a href="#">Barangay Information System </a> | Created by <a href="#">Team Bard</a> 
                </div>
              </div>
            </div>
          </div>
        </div>
      </footer>

      <!-- BACK TOP BUTTON  -->
      <a href="#" class="shadow btn-primary rounded-circle back-to-top">
        <i class="fas fa-chevron-up"></i>
      </a>
      


    <script>
      AOS.init();
    </script>
    <script src="{{ asset('homepage-assets/assets/vendors/js/glightbox.min.js') }}"></script>

    <script type="text/javascript">
      const lightbox = GLightbox(
          {
            'href': 'https://www.youtube.com/watch?v=9YFyTQZIm1M&list=PLYdH4usCOJ0dX7AMnKo7tOHqEsq27JEc1&index=1&t=41s',
            'type': 'video',
            'source': 'youtube', //vimeo, youtube or local
            'width': 900,
            'autoPlayVideos': true,
          },
      );
    </script>

    <script src="{{ asset('homepage-assets/assets/js/bootstrap.bundle.js') }}"></script>
</body>
</html>