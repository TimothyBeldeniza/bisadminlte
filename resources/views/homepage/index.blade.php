<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BIS - Home</title>
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
      <nav class="navbar navbar-expand-lg navbar-dark menu shadow fixed-top">
        <div class="container">
          <a class="d-flex align-items-center navbar-brand" href="#">
            <img src="{{ asset('homepage-assets/images/BIS - Logo.png') }}" alt="logo image">
            <h3>B I S</h3>
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item"><a class="nav-link active" aria-current="page" href="#">Home</a></li>
              @auth
              <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Dashboard</a></li>
              @endauth
              <li class="nav-item"><a class="nav-link" href="#companies">About Us</a></li>
              <li class="nav-item"><a class="nav-link" href="#testimonials">Announcements & Events</a></li>
              <li class="nav-item"><a class="nav-link" href="#portfolio">Services</a></li>
              @guest
                <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li> 
              @endguest
              </li>
            </ul>
          </div>
        </div>
      </nav>
      
      <section id="home" class="intro-section">
        <div class="container">
          <div class="row align-items-center text-white">
            <!-- START THE CONTENT FOR THE INTRO  -->
            <div data-aos="fade-right"
              data-aos-duration="3000" class="col-lg-6 intros text-start">
              <h1 class="display-2">
                <span class="display-2--intro">Barangay Information System</span>
                <span class="display-2--description lh-base">
                  Lorem ipsum dolor sit amet consectetur, adipisicing elit. Cumque, distinctio.
                </span>
              </h1>
              <button type="button" class="rounded-pill btn-rounded">Get in Touch
                <span><i class="fas fa-arrow-right"></i></span>
              </button>
            </div>
            <!-- START THE CONTENT FOR THE VIDEO -->
            <div data-aos="fade-left"
              data-aos-duration="3000" class="col-lg-6 intros text-end">
              <div class="video-box">
                <img src="{{ asset('homepage-assets/images/arts/ui.png') }}" alt="video illutration" class="img-fluid">
                <a href="#" class="glightbox position-absolute top-50 start-50 translate-middle">
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
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#ffffff" fill-opacity="1" d="M0,160L48,176C96,192,192,224,288,208C384,192,480,128,576,133.3C672,139,768,213,864,202.7C960,192,1056,96,1152,74.7C1248,53,1344,107,1392,133.3L1440,160L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
      </section>

      <!-- START THE COMPANIES SEcTION -->
      <section id="companies" class="companies">
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

      <!-- START SECTION -THE Announcements -->
      <section id="testimonials" class="testimonials">
        <svg  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#ffffff" fill-opacity="1" d="M0,96L48,128C96,160,192,224,288,213.3C384,203,480,117,576,117.3C672,117,768,203,864,213.3C960,224,1056,160,1152,144C1248,128,1344,160,1392,176L1440,192L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z"></path></svg>
        <div data-aos="fade-up" data-aos-duration="3000" class="container">
          
          <div class="row text-center text-white">
            <h1 class="display-3 fw-bold">Announcements & Events</h1>
            <hr style="width:100px; height:3px;" class="mx-auto">
            <!-- <p class="lead pt-1">What our barangay officials are saying</p> -->
          </div>

          <!-- START THE CAROUSEL CONTENT -->
          <div class="row bg-white rounded-3">
            <div class="announcement col-lg-5  p-4">
              <h5 class="fw-bold text-primary">Announcements and Advisories</h5>
              <hr class="text-success">

              <div class="announcement-box overflow-auto">
                <div class="announcement-content text-capitalize">
                  <h5 class="text-primary text-capitalize">Title of Announcement</h5>
                  <p class="text-capitalize">MAGALANG NA MULING PAALALA MULA SA OSCA:
                    TUMAWAG PO MUNA SA MGA BILANG NG TELEPONO NA SUMUSUNOD 
                    8571-3878, 5310-3371,5310-3372 
                    BAGO PO PAPUNTAHIN SI SENIOR SA OSCA-MANILA CITY HALL PARA SA SCHEDULE.
                    MANGYARI PO LAMANG NA TULUNGAN PO NATIN SI SENIOR CITIZEN NA MAKATAWAG SA OSCA PARA SA SCHEDULE BAGO PO SILA PUMUNTA SA CITY HALL PARA SA PAGPROSESO NG ID.
                    SIGURADUHIN PO LAMANG NA DUMATING PO SILA SA ORAS AT ARAW NG KANILANG SCHEDULE. 
                    KAPAG HINDI PO SILA MAKAKARATING KAILANGAN PO NILANG TUMAWAG MULI AT MAGPASCHEDULE.
                    ANG PAGKUHA NG BOOKLETS,  VERIFICATION SA HELP DESK AT IBA PONG SERBISYO AY DI NA PO KAILANGANG MAGPASCHEDULE.
                    ITO AY BILANG PAG IINGAT SA BANTA NG COVID 19,  PAGPAPABUTI NG AMING SERBISYO AT PAGTUGON SA KAUTUSAN NG ATING PUNONG LUNGSOD NG PAG AAYOS NG ATING MGA TANGGAPAN/ LUGAR NG GAWAIN.
                    Masaya po kami na kayo ay mapaglingkuran.</p>
                  <small class="text-dark">Posted: July 07, 2022</small>
                  <hr>
                </div>
                <div class="announcement-content text-capitalize">
                  <h5 class="text-primary text-capitalize">Lorem, ipsum dolor.</h5>
                  <p class="text-capitalize">Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem reprehenderit numquam repellat harum ipsum minus, corrupti aut officiis explicabo labore, est eum quod maxime doloremque, illo expedita dignissimos iste debitis!</p>
                  <small class="text-dark">Posted: July 07, 2022</small>
                  <hr>
                </div>
                <div class="announcement-content text-capitalize">
                  <h5 class="text-primary text-capitalize">Lorem, ipsum dolor.</h5>
                  <p class="text-capitalize">Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem reprehenderit numquam repellat harum ipsum minus, corrupti aut officiis explicabo labore, est eum quod maxime doloremque, illo expedita dignissimos iste debitis!</p>
                  <small class="text-dark">Posted: July 07, 2022</small>
                  <hr>
                </div>
                <div class="announcement-content text-capitalize">
                  <h5 class="text-primary text-capitalize">Lorem, ipsum dolor.</h5>
                  <p class="text-capitalize">Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem reprehenderit numquam repellat harum ipsum minus, corrupti aut officiis explicabo labore, est eum quod maxime doloremque, illo expedita dignissimos iste debitis!</p>
                  <small class="text-dark">Posted: July 07, 2022</small>
                  <hr>
                </div>
              </div>
              
            </div>

            <div class="col-lg-7 p-4">
              <h5 class="fw-bold text-primary">Latest Events</h5>
              <hr class="text-primary">
              <div class="text-end mb-2">
                <button class="btn btn-outline-primary fas fa-long-arrow-alt-left" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                
                </button>
                <button class="btn btn-outline-primary fas fa-long-arrow-alt-right" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                  
                </button>
              </div>
              <div class="align-items-start">
                <div id="carouselExampleCaptions" class=" carousel slide" data-bs-ride="carousel">
                  <div class="carousel-inner">
                    <!-- CAROUSEL ITEM 1 -->
                    <div class="carousel-item active">
                      <!-- TESTIMONIALS CARD -->
                      <div class="testimonials__card">
                        
                        <img class="event-img img-fluid" src="{{ asset('homepage-assets/images/2joints.jpg') }}" alt="">

                        <h5 class="mt-3 event-description text-primary">New Normal sa Nutrisyon Sama Sama gawan ng Solusyon. Brgy. 204 Zone 18 Dist. 2 Ch.Maria Victoria Balawitan.</h5>
                        <p>July 20, 2022</p>
                      </div>
                    </div> 
                    <div class="carousel-item ">
                      <!-- TESTIMONIALS CARD -->
                      <div class="testimonials__card">
                        
                        <img class="event-img img-fluid" src="{{ asset('homepage-assets/images/bingo.jpg') }}" alt="">

                        <h5 class="mt-3 event-description text-primary">FIESTA BINGO BONANZA 2022 AT BARANGAY 204 ZONE 18..CH. MARIA VICTORIA. B. BALAWITAN</h5>
                        <p>July 21, 2022</p>
                      </div>
                    </div> 
                  </div>
                </div>
              </div>
            </div>
            
          </div>
          

        </div>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#ffffff" fill-opacity="1" d="M0,96L48,128C96,160,192,224,288,213.3C384,203,480,117,576,117.3C672,117,768,203,864,213.3C960,224,1056,160,1152,144C1248,128,1344,160,1392,176L1440,192L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
      </section>


    

      

      <!-- START SECTION - THE Services -->

      <section id="portfolio" class="portfolio">
        <div class="container">
          <div data-aos="fade-down"
          data-aos-duration="3000"  class="row text-center mt-5">
            <h1 class="display-3 fw-bold text-capitalize">Services</h1>
            <div class="heading-line"></div>
            <p class="lead">Lorem ipsum dolor sit amet consectetur adipisicing elit. Placeat fugit eius ad.</p>
          </div>


          <!-- START THE Services ITEMS -->
          <div class="row">
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
                    <a href="{{ route('documents.create') }}" class=""><img src="{{ asset('homepage-assets/images/arts/req-doc.jpg') }}" class="img-fluid py-4 rounded"></a>
                  </div>
                  <h4 class="mt-4 text-center "><a href="{{ route('documents.create') }}" class="text-decoration-none">Request Document</a></h4>
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

      <!-- START SECTION  - FOOTER  -->
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
                <a href="https://www.facebook.com/brgy204"><i class="fab fa-facebook"></i></a>

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