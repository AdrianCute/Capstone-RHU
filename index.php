
<!DOCTYPE html>
    <!-- Coding by CodingLab | www.codinglabweb.com -->
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
        <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
         <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
         <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>   
        <link rel="stylesheet" href="css/animate.css">
        <link rel="icon" href="images/LOGO.png">
        <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <script src="js/wow.min.js"></script>
        <script> new WOW().init(); </script>
        <title>Rural Health Unit</title>

        <!-- Swiper CSS -->
        <link rel="stylesheet" href="css/swiper-bundle.min.css">

        <!-- CSS -->
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/stylee.css">                          
    </head>
    <body>

 <div class="modal fade" id="successModal">
  <div class="modal-dialog" role="document">  </div>
 <div class="reg-container">
    <div class="reg-card">
  <div class="reg-header">
    <span class="reg-icon">
      <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
        <path clip-rule="evenodd" d="M18 3a1 1 0 00-1.447-.894L8.763 6H5a3 3 0 000 6h.28l1.771 5.316A1 1 0 008 18h1a1 1 0 001-1v-4.382l6.553 3.276A1 1 0 0018 15V3z" fill-rule="evenodd"></path>
      </svg>
    </span>
    <p class="reg-alert">Message!</p>
  </div>

  <p class="reg-message">
  <?php echo $_GET['success']; ?>  </p>

  <div class="reg-actions">
<button class="reg-read" data-dismiss="modal">Okay, Close!</button>

  </div>
</div>
</div>

</div>
        <main>
            <header>
            <nav class="nav">
                <div class="nav_logo"><a href="#"><img src="images/LOGO.png" alt=""></a>
                <h5 class="navtext" >Management System of<br> Rural Health Unit of San Jose</h5>
            </div>
                <ul class="menu_items">
                <img src="images/times.svg" alt="timesicon" id="menu_toggle" />
                <li><a href="#home" class="nav_link">Home</a></li>
                <li><a href="#services" class="nav_link">Services</a></li>
                <li><a href="#aboutus" class="nav_link">About</a></li>
                <li><a href="#contactus" class="nav_link">Contact Us</a></li>

                </ul>
                <img src="images/bars.svg" alt="timesicon" id="menu_toggle" />
            </nav>
            </header>
            <section class="hero" id="home">
                <div class="log containerr">
                    <div class="column">
                    <h2><span class="typing-animation" id="typewriter"></span></h2>                   
                     <div class="buttons">
                        <button class="btn signup-link"><a href="#register" id="regis">Register</a></button>
                        <button class="btnerer"> <a href="#login"  id="login">Log In</a></button>
                        <button class="btner"> <a href="#contactus">Contact Us</a></button>
                    </div>

                  
                    <script>
    // Text to be typed out
    const textToType = "Management System of Rural\nHealth Unit of San Jose,\nCamarines Sur";
    const typingSpeed = 100; // Adjust the typing speed in milliseconds
    const pauseDuration = 5000; // Pause duration in milliseconds

    const typewriter = document.getElementById('typewriter');
    let currentIndex = 0;

    function typeText() {
      if (currentIndex < textToType.length) {
        if (textToType[currentIndex] === '\n') {
          typewriter.innerHTML += '<br>';
        } else {
          typewriter.innerHTML += textToType[currentIndex];
        }
        currentIndex++;
      } else {
        setTimeout(startTypingAgain, pauseDuration);
        return;
      }
      setTimeout(typeText, typingSpeed);
    }

    function startTypingAgain() {
      currentIndex = 0; // Reset to the beginning
      typewriter.innerHTML = ''; // Clear the content
      typeText();
    }

    // Start the typing animation
    typeText();
  </script>
                    </div>
                    <div class="container">
                        <div class="forms">
                            <div class="form login">
                            <?php if (isset($_GET['error'])) { ?>
                            <div class="error">
    <div class="error__icon">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" viewBox="0 0 24 24" height="24" fill="none"><path fill="#393a37" d="m13 13h-2v-6h2zm0 4h-2v-2h2zm-1-15c-1.3132 0-2.61358.25866-3.82683.7612-1.21326.50255-2.31565 1.23915-3.24424 2.16773-1.87536 1.87537-2.92893 4.41891-2.92893 7.07107 0 2.6522 1.05357 5.1957 2.92893 7.0711.92859.9286 2.03098 1.6651 3.24424 2.1677 1.21325.5025 2.51363.7612 3.82683.7612 2.6522 0 5.1957-1.0536 7.0711-2.9289 1.8753-1.8754 2.9289-4.4189 2.9289-7.0711 0-1.3132-.2587-2.61358-.7612-3.82683-.5026-1.21326-1.2391-2.31565-2.1677-3.24424-.9286-.92858-2.031-1.66518-3.2443-2.16773-1.2132-.50254-2.5136-.7612-3.8268-.7612z"></path></svg>
    </div>
    <div class="error__title"><?php echo $_GET['error']; ?></div>
    <div class="error__close" id="closeErrorBtn"><svg xmlns="http://www.w3.org/2000/svg" width="20" viewBox="0 0 20 20" height="20"><path fill="#393a37" d="m15.8333 5.34166-1.175-1.175-4.6583 4.65834-4.65833-4.65834-1.175 1.175 4.65833 4.65834-4.65833 4.6583 1.175 1.175 4.65833-4.6583 4.6583 4.6583 1.175-1.175-4.6583-4.6583z"></path></svg></div>
</div>

<script>
    // JavaScript to close the error message when the close button is clicked
    const closeErrorBtn = document.getElementById('closeErrorBtn');
    const errorContainer = document.querySelector('.error');

    closeErrorBtn.addEventListener('click', () => {
        errorContainer.style.display = 'none'; // Hide the error message
        // Remove the "error" query parameter from the URL
        const url = new URL(window.location.href);
        url.searchParams.delete('error');
        history.replaceState({}, document.title, url);
    });
</script>

     	           <?php } ?>
                                <span class="title">Login</span>
                            

                                <form action="login/login.php" method="POST">
                                    <div class="input-fields">
                                        <input name="uname" type="text" placeholder="Enter your Username" required>
                                        <i class="uil uil-user icon"></i>
                                    </div>
                                    <div class="input-fields">
                                        <input name="password" type="password" class="password" placeholder="Enter your password" required>
                                        <i class="uil uil-lock icon"></i>
                                        <i class="uil uil-eye-slash showHidePw"></i>
                                    </div>
                
                                    <div class="checkbox-text">
                                        <div class="checkbox-content">
                                            <input type="checkbox" id="logCheck">
                                            <label for="logCheck" class="text">Remember me</label>
                                        </div>
                                        <a href="#" class="text">Forgot password?</a>
                                    </div>

                                    <div class="input-fields button">
                                        <input type="submit" value="Login">
                                    </div>
                                    <div class="login-signup">
                    <span class="text">Not a member?
                        <a href="#" class="text signup-link">Signup Now</a>
                    </span>
                </div>
                        
                                    </form>
                                </div>
                                </div>
                        </div>
                    </div>
                    <script>
const container = document.querySelector(".container"),
        pwShowHide = document.querySelectorAll(".showHidePw"),
        pwFields = document.querySelectorAll(".password")

    //   js code to show/hide password and change icon
    pwShowHide.forEach(eyeIcon =>{
        eyeIcon.addEventListener("click", ()=>{
            pwFields.forEach(pwField =>{
                if(pwField.type ==="password"){
                    pwField.type = "text";

                    pwShowHide.forEach(icon =>{
                        icon.classList.replace("uil-eye-slash", "uil-eye");
                    })
                }else{
                    pwField.type = "password";

                    pwShowHide.forEach(icon =>{
                        icon.classList.replace("uil-eye", "uil-eye-slash");
                    })
                }
            }) 
        })
    })

</script>
                </div>
            </section>
            </main>
            <script>
                const header = document.querySelector("header");
                const menuToggler = document.querySelectorAll("#menu_toggle");
                menuToggler.forEach(toggler => {
                toggler.addEventListener("click", () => header.classList.toggle("showMenu"));
                });
            </script>    
    <div class="services" id="services">
            <h1>Services Offer</h1>
    <section id="services" class="services">
        <div class="contain"> 
          <div class="section-title">
            <p>The RHU San Jose offers the following.</p>
          </div>
  
          <div class="row">
  
            <div class="col-lg-3 col-md-5 d-flex align-items-stretch mt-4 mt-md-0">
              <div class="icon-box">
                <div class="icon"><i class="fas fa-pills"></i></div>
                <h4><a href="">Dental Services</a></h4>
                <p class="shortened">This Service caters to primary health needs of San Josenian. It includes consultation, diagnosis and giving of appropriate medical services.</p>
                
            </div>
            </div>
  
            <div class="col-lg-3 col-md-5 d-flex align-items-stretch mt-4 mt-lg-0">
              <div class="icon-box">
                <div class="icon"><i class="fas fa-hospital-user"></i></div>
                <h4><a href="">Prenatal Check up</a></h4>
               
                    <p class="shortened">Maternal Care is one of the featured programs in the Department of Health Reform Agenda in conjunction with the country's 
                    Millennium Goal,</p>
    <p class="full-content" style="display: none;"> hence we offer regular pre-natal check up to would be, and expectant mothers in our community to be able to achieve a zero Maternal
                    mortality rate, and to make sure that every delivery is a safe delivery.</p>
    <button class="see-more">See More</button>
              </div>
            </div>
  
            <div class="col-lg-3 col-md-5 d-flex align-items-stretch mt-4 mt-lg-0">
              <div class="icon-box">
                <div class="icon"><i class="fas fa-dna"></i></div>
                <h4><a href="">Family Palanning Services</a></h4>

                    <p class="shortened">Family planning is one of the features programs in the Department of Health Reform Agenda in conjunction with the</p>
    <p class="full-content" style="display: none;">  country's 
                    Millennium Goal, hence we offer regular Family Planning Services for the purpose of birth spacing, responsible parenthood.</p>
    <button class="see-more">See More</button>
                </div>
            </div>
  
            <div class="col-lg-3 col-md-5 d-flex align-items-stretch mt-4 mt-md-0">
              <div class="icon-box">
                <div class="icon"><i class="fas fa-wheelchair"></i></div>
                <h4><a href="">Anti Tuberculosis Program <br>(TB-DOTS)</a></h4>
                    <p class="shortened">Tuberculosis has burdened the country for so many years. Presenty it is still a major health hazard. The Municipal Health Office manages an anti-tuberculosis program.</p>
    <p class="full-content" style="display: none;"> It is geared toward the preventing and controlling the spread/transmission of tuberculosis (TB) in the community. The main objective is to identify and treats patients with TB by providing 
                    anti-tuberculosis medication for free using DOTS. This program caters to the so called TB symptomatic, meaning patients having a chronic cough of more than two weeks coughing out blood, afternoon 
                    low grade fever, body weakness and sudden loss of weight for the last six (6) months.</p>
    <button class="see-more">See More</button>
              </div>
            </div>
  
            <div class="col-lg-3 col-md-5 d-flex align-items-stretch mt-4">
              <div class="icon-box">
                <div class="icon"><i class="fas fa-notes-medical"></i></div>
                <h4><a href="">National Immunization Program (NIP) Services</a></h4>
                <p class="shortened">This is one of the core programs of the Department of Health, under the maternal and child care, giving free vaccines for all the different childhood diseasses</p>
    <p class="full-content" style="display: none;">to the susceptible
                    populace from birth to nine(9) months old. The Municipal Health Office gives bacillus Calmette-Guarin (BCG) vaccine, Hepatitis B vaccine, Diphteri, Pertussis, Tetanus (DPT) vaccine, Oral Polio vaccine (OPV) 
                Inactived Polio Vaccine (IPV) and measles vaccine to neonates before one year of ages.</p>
    <button class="see-more">See More</button>
              </div>
            </div>
            <div class="col-lg-3 col-md-5 d-flex align-items-stretch mt-4">
                <div class="icon-box">
                  <div class="icon"><i class="fas fa-notes-medical"></i></div>
                  <h4><a href="">Basic Laboratory Examination Services</a></h4>
                    <p class="shortened">This service caters to all indigent cardholder under the OPD packageof all the Philippine Health Insurance Corporation for free, but also serves our constituents who would like to avail</p>
    <p class="full-content" style="display: none;"> of the services paying minimum amount for maintenance and financial assistance of the laboratory aid of the capitation fund. Laboratory Examination such as complete blood count (CBC), urinalysis, fecalysis 
                    and spotum examination are available for free for Philhealth OPD cardholder. All other non-cardholders are pay patients and may avail of the following services as enumerated below.</p>
    <button class="see-more">See More</button>
                </div>
              </div>
              <div class="col-lg-3 col-md-5 d-flex align-items-stretch mt-4">
                <div class="icon-box">
                  <div class="icon"><i class="fas fa-notes-medical"></i></div>
                  <h4><a href="">Sanitary Permit</a></h4>
                    <p class="shortened">In accordance to our implementing rules and regulation of Chapter III Food Establishment of the Code Sanitation of the Philippines(P.D. 856)</p>
    <p class="full-content" style="display: none;">No person shall be allowed to engaged in any food related Establishment 
                    without securing sanitaary permit and all other individuals involved in food preparation and handling are required to secure health certificate.</p>
    <button class="see-more">See More</button>
                </div>
              </div>
              <div class="col-lg-3 col-md-5 d-flex align-items-stretch mt-4">
                <div class="icon-box">
                  <div class="icon"><i class="fas fa-notes-medical"></i></div>
                  <h4><a href="">Health Certificate</a></h4>
                  <p class="shortened">In accordance to our implementing rules and regulation of Chapter III</p>
                  <p class="full-content" style="display: none;">Food Establishment of the Code Sanitation of the Philippines(P.D. 856) No person shall be allowed to engaged in any food related Establishment 
                                without securing sanitaary permit and all other individuals involved in food preparation and handling are required to secure health certificate</p>
                                <button class="see-more">See More</button>
                    
         
        </div>

                </div>
              </div>
  
          </div>
  
        </div>
      </section><!-- End Services Section -->

<script>
  document.addEventListener("DOMContentLoaded", function () {
    const seeMoreButtons = document.querySelectorAll(".see-more");

    seeMoreButtons.forEach(button => {
      button.addEventListener("click", () => {
        const iconBox = button.parentElement;
        const shortenedContent = iconBox.querySelector(".shortened");
        const fullContent = iconBox.querySelector(".full-content");

        if (shortenedContent.style.display === "none") {
          shortenedContent.style.display = "block";
          fullContent.style.display = "none";
          button.innerText = "See More";
        } else {
          shortenedContent.style.display = "none";
          fullContent.style.display = "block";
          button.innerText = "See Less";
        }
      });
    });
  });
</script>

    <div class="about" id="aboutus"><br/>
        <h1>About Us</h1>
        <img src="images/LOGO.png" alt="">
              <h3 class="wow fadeInLeft">Vision</h3><br/>
              <p class="wow fadeInLeft"> San Jose shall be a Peaceful, Progressive and Self reliant community, with Fully Developed Agricultural and Fishery Productions, Tourism Industry and an Ecologically Balanced Enviroment with Englightened, Healthy, Morally Upright and Productive Citizenry.    </p> <br>
                
               <h3>Mission</h3><br/>
               <P>The Municipal Government of San Jose shall promote the General Welfare of the people through the effective delivery of basic services with a strong political will, full and active Multi-sectorial participation developent of tourism and Agro-Industrial sectors under an Atmosphere of Peace and Sustainable Prosperity.  
               </P>
               </div>

<div class="employees" id="Stakeholders">
    <h3>Our Stakeholders</h3>
    <div class="slide-container swiper">
      <div class="slide-content">
          <div class="card-wrapper swiper-wrapper">

              <div class="card swiper-slide">
                  <div class="image-content">
                      <span class="overlay"></span>

                      <div class="card-image">
                          <img src="images/final/jerold.png" alt="" class="card-img">
                      </div>
                  </div>

                  <div class="card-content">
                      <h2 class="name">Municipal Mayor </h2>
                   
                  </div>
              </div>
              <div class="card swiper-slide">
                  <div class="image-content">
                      <span class="overlay"></span>

                      <div class="card-image">
                          <img src="images/final/audie concina.png" alt="" class="card-img"> 
                      </div>
                  </div>

                  <div class="card-content">
                      <h2 class="name">Kagawad on Health</h2>
                    
                  </div>
              </div>
              <div class="card swiper-slide">
                  <div class="image-content">
                      <span class="overlay"></span>

                      <div class="card-image">
                          <img src="images/final/10.png" alt="" class="card-img"> 
                      </div>
                  </div>

                  <div class="card-content">
                      <h2 class="name">Municipal Health Officer</h2>
                     
                  </div>
              </div>
              <div class="card swiper-slide">
                  <div class="image-content">
                      <span class="overlay"></span>

                      <div class="card-image">
                          <img src="images/final/default-avatar.png" alt="" class="card-img">
                      </div>
                  </div>

                  <div class="card-content">
                      <h2 class="name">Management Officer</h2>
                    
                  </div>
              </div>

              <div class="card swiper-slide">
                  <div class="image-content">
                      <span class="overlay"></span>

                      <div class="card-image">
                          <img src="images/final/default-avatar.png" alt="" class="card-img"> <!--naribayan na-->
                      </div>
                  </div>

                  <div class="card-content">
                      <h2 class="name">Medical Technologist</h2>
                  </div>
              </div>
              <div class="card swiper-slide">
                  <div class="image-content">
                      <span class="overlay"></span>

                      <div class="card-image">
                          <img src="images/final/default-avatar.png" alt="" class="card-img"> <!--naribayn na-->
                      </div>
                  </div>

                  <div class="card-content">
                      <h2 class="name">Public Health Nurse</h2>
                    
                  </div>
              </div>
              <div class="card swiper-slide">
                  <div class="image-content">
                      <span class="overlay"></span>

                      <div class="card-image">
                          <img src="images/final/8.png" alt="" class="card-img"> <!--naribayan na-->
                      </div>
                  </div>

                  <div class="card-content">
                      <h2 class="name">Rural Sanitary Inspector</h2>
                    
                  </div>
              </div>
              <div class="card swiper-slide">
                  <div class="image-content">
                      <span class="overlay"></span>

                      <div class="card-image">
                          <img src="images/final/9.png" alt="" class="card-img"> <!--naribayan na-->
                      </div>
                  </div>

                  <div class="card-content">
                      <h2 class="name">Rural Sanitary Inspector</h2>
                     
                  </div>
              </div>

              <!--Midwife-->
              <div class="card swiper-slide">
                <div class="image-content">
                    <span class="overlay"></span>

                    <div class="card-image">
                        <img src="images/final/1.png" alt="" class="card-img"> <!--naribayan na-->
                    </div>
                </div>

                <div class="card-content">
                    <h2 class="name">Rural Health Midwife</h2>
                  
                </div>
            </div>
            <div class="card swiper-slide">
                <div class="image-content">
                    <span class="overlay"></span>

                    <div class="card-image">
                        <img src="images/final/2.png" alt="" class="card-img"> <!--naribayan na-->
                    </div>
                </div>

                <div class="card-content">
                    <h2 class="name">Rural Health Midwife</h2>
                   
                </div>
            </div> <div class="card swiper-slide">
                <div class="image-content">
                    <span class="overlay"></span>

                    <div class="card-image">
                        <img src="images/final/3.png" alt="" class="card-img"> <!--naribayan na-->
                    </div>
                </div>

                <div class="card-content">
                    <h2 class="name">Rural Health Midwife</h2>
                   
                </div>
            </div>
            <div class="card swiper-slide">
                <div class="image-content">
                    <span class="overlay"></span>

                    <div class="card-image">
                        <img src="images/final/4.png" alt="" class="card-img"> <!--naribayan na-->
                    </div>
                </div>

                <div class="card-content">
                    <h2 class="name">Rural Health Midwife</h2>
                  
                </div>
            </div> <div class="card swiper-slide">
                <div class="image-content">
                    <span class="overlay"></span>

                    <div class="card-image">
                        <img src="images/final/6.png" alt="" class="card-img"> <!--naribayan na-->
                    </div>
                </div>

                <div class="card-content">
                    <h2 class="name">Rural Health Midwife</h2>
                
                </div>
            </div>
            <div class="card swiper-slide">
                <div class="image-content">
                    <span class="overlay"></span>

                    <div class="card-image">
                        <img src="images/final/7.png" alt="" class="card-img"> <!--naribayan na-->
                    </div>
                </div>

                <div class="card-content">
                    <h2 class="name">Rural Health Midwife</h2>
                   
                </div>
            </div> <div class="card swiper-slide">
                <div class="image-content">
                    <span class="overlay"></span>

                    <div class="card-image">
                        <img src="images/final/9.png" alt="" class="card-img"> <!--naribayan na-->
                    </div>
                </div>

                <div class="card-content">
                    <h2 class="name">Rural Health Midwife</h2>
                   
                </div>
            </div>
            <div class="card swiper-slide">
                <div class="image-content">
                    <span class="overlay"></span>

                    <div class="card-image">
                        <img src="images/final/5.png" alt="" class="card-img"> <!--naribayan na-->
                    </div>
                </div>

                <div class="card-content">
                    <h2 class="name">Rural Health Midwife</h2>
               
                </div>
            </div>
            </div>
      </div>

      <div class="swiper-button-next swiper-navBtn"></div>
      <div class="swiper-button-prev swiper-navBtn"></div>
      <div class="swiper-pagination"></div>
  </div>
</div>
      
       <!-- Swiper JS -->
      <script src="js/swiper-bundle.min.js"></script>
  
      <!-- JavaScript -->
      <script src="js/script.js"></script> 
        <div class="info-box">
            <h1>Informations</h1>
     <div class="information">
        <div class="wrapper">
      <i id="left" class="fa-solid fa-angle-left"></i>
      <ul class="carousel">
        <li class="card-serve">
          <div class="img"><img src="images/img1.png"  alt="img" class="enlarge-image" data-image-url="images/img1.png"draggable="false">
</div>
          <h2>OPD Check up</h2>
        </li>
        <li class="card-serve">
          <div class="img"><img src="images/img2.png" class="enlarge-image" data-image-url="images/img2.png" alt="img" draggable="false"></div>
          <h2>Prenatal Checkup</h2>
        </li>
        <li class="card-serve">
          <div class="img"><img src="images/img3.png"  class="enlarge-image" data-image-url="images/img3.png"  alt="img" draggable="false"></div>
          <h2>Sanitary Permit</h2>
        </li>
        <li class="card-serve">
          <div class="img"><img src="images/img4.png"  class="enlarge-image" data-image-url="images/img4.png" alt="img" draggable="false"></div>
          <h2>Health Certificate</h2>
        </li>
        <li class="card-serve">
          <div class="img"><img src="images/img5.png"  class="enlarge-image" data-image-url="images/img5.png" alt="img" draggable="false"></div>
          <h2>Basic laboratory <br>Examination</h2>
        </li>
        <li class="card-serve">
          <div class="img"><img src="images/img6.png"  class="enlarge-image"  data-image-url="images/img6.png" alt="img" draggable="false"></div>
          <h2>National Immunization <br>Program</h2>
        </li>
        <li class="card-serve">
          <div class="img"> <img src="images/img7.png" class="enlarge-image" data-image-url="images/img7.png" alt="img" draggable="false"></div>
          <h2>Family Planning Services</h2>
        </li>
        <li class="card-serve">
          <div class="img"><img src="images/img8.png"   class="enlarge-image"  data-image-url="images/img8.png" alt="img" draggable="false"></div>
          <h2>Dental Services</h2>
        </li>
      </ul>
      <i id="right" class="fa-solid fa-angle-right"></i>
    </div>
    <script>
        const wrapper = document.querySelector(".wrapper");
const carousel = document.querySelector(".carousel");
const firstCardWidth = carousel.querySelector(".card-serve").offsetWidth;
const arrowBtns = document.querySelectorAll(".wrapper i");
const carouselChildrens = [...carousel.children];

let isDragging = false, isAutoPlay = true, startX, startScrollLeft, timeoutId;

let cardPerView = Math.round(carousel.offsetWidth / firstCardWidth);

carouselChildrens.slice(-cardPerView).reverse().forEach(card => {
    carousel.insertAdjacentHTML("afterbegin", card.outerHTML);
});

carouselChildrens.slice(0, cardPerView).forEach(card => {
    carousel.insertAdjacentHTML("beforeend", card.outerHTML);
});

carousel.classList.add("no-transition");
carousel.scrollLeft = carousel.offsetWidth;
carousel.classList.remove("no-transition");

arrowBtns.forEach(btn => {
    btn.addEventListener("click", () => {
        carousel.scrollLeft += btn.id == "left" ? -firstCardWidth : firstCardWidth;
    });
});

const dragStart = (e) => {
    isDragging = true;
    carousel.classList.add("dragging");
    startX = e.pageX;
    startScrollLeft = carousel.scrollLeft;
}

const dragging = (e) => {
    if(!isDragging) return; 
    carousel.scrollLeft = startScrollLeft - (e.pageX - startX);
}

const dragStop = () => {
    isDragging = false;
    carousel.classList.remove("dragging");
}

const infiniteScroll = () => {
    if(carousel.scrollLeft === 0) {
        carousel.classList.add("no-transition");
        carousel.scrollLeft = carousel.scrollWidth - (2 * carousel.offsetWidth);
        carousel.classList.remove("no-transition");
    }
    else if(Math.ceil(carousel.scrollLeft) === carousel.scrollWidth - carousel.offsetWidth) {
        carousel.classList.add("no-transition");
        carousel.scrollLeft = carousel.offsetWidth;
        carousel.classList.remove("no-transition");
    }

    clearTimeout(timeoutId);
    if(!wrapper.matches(":hover")) autoPlay();
}

const autoPlay = () => {
    if(window.innerWidth < 800 || !isAutoPlay) return;
    timeoutId = setTimeout(() => carousel.scrollLeft += firstCardWidth, 2500);
}
autoPlay();

carousel.addEventListener("mousedown", dragStart);
carousel.addEventListener("mousemove", dragging);
document.addEventListener("mouseup", dragStop);
carousel.addEventListener("scroll", infiniteScroll);
wrapper.addEventListener("mouseenter", () => clearTimeout(timeoutId));
wrapper.addEventListener("mouseleave", autoPlay);
    </script>
        </div> 
        
        </div>     
    </div>
<section id = "banner-one" class = "banner-one text-center">
            <div class = "container-quote text-white">
                <blockquote class = "lead"><i class = "fas fa-quote-left"></i> 
                When you are young and healthy, it never occurs to you that in a 
                single second your whole life could change.  
                <i class = "fas fa-quote-right"></i> <br>- Anonim Nano</blockquote>
            </div>
      </section>

    <div class="ccontainer"id="contactus">
    <center><h1>Contact Us</h1></center>
    <div class="ccontent">
      <div class="left-side">
        <div class="address details">
          <i class="fas fa-map-marker-alt"></i>
          <div class="topic">Address</div>
          <div class="text-one">San Jose</div>
          <div class="text-two">Camarines Sur</div>
        </div>
        <div class="phone details">
          <i class="fas fa-phone-alt"></i>
          <div class="topic">Phone</div>
          <div class="text-one">09462387335</div>
  
        </div>
        <div class="email details">
          <i class="fas fa-envelope"></i>
          <div class="topic">Email</div>
          <div class="text-one">Rhu@gmail.com</div>
       
        </div>
      </div>
      <div class="right-side">
        <div class="topic-text">Send us a message</div>
        <p>If you have any question or inquiries you want to know,please do not hesitate to drop us a message here.</p>
      <form action="front-backend/contactus.php" method="POST">
        <div class="input-box">
          <input type="text" name="name" placeholder="Enter your name">
        </div>
        <div class="input-box">
          <input type="text" name="email" placeholder="Enter your email">
        </div>
        <div class="input-box message-box">
        <input type="text" name="message" placeholder="Enter your message">
        <div class="buttoner">
          <button class="contact_button" type="submit" value="Send Now" >Send Now</button>
        </div>
      </form>
    </div>
    </div>
  </div>
        </div>
    
     <footer class="footer">
        <div class="containers">
            <div class="footer-box">
                <div class="footer-col">
                    <h4>Rural Health Unit</h4>
                    <ul>                        
                        <li><a href="#home">Home</a></li>
                        <li><a href="#aboutus">About us</a></li>
                        <li><a href="#services">Our Services</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Government links</h4>
                    <ul>
                        <li><a href="https://doh.gov.ph/">Department of Health</a></li>
                        <li><a href="https://op-proper.gov.ph/">Office of the President</a></li>
                        <li><a href="https://ovp.gov.ph/">Office of the Vice President</a> </li>
                        <li><a href="http://legacy.senate.gov.ph/">Office of the Senate of the Philippinest</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Visit Us</h4>
                    <div class="social-links">
                        <a href="https://web.facebook.com/lgusanjosecamsur22"><i class="fab fa-facebook-f"></i></a>
                    </div>
                </div>
            </div>
        </div>          
   </footer>     
   <a class="bottom-up" href="#"> <i class="fas fa-arrow-up"></i> </a>
   <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" >
                <h5 class="modal-title" id="imageModalLabel">Image</h5>
                <div class="close" data-dismiss="modal">+</div>
            </div>
            <div class="modal-body" style="background-color: #265df2;">
                <img id="enlargedImg" src="" alt="Enlarged Image">
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="register-modal">
  <div class="modal-dialog" role="document">  </div>
  
  <div class="modal-body">
  <div class="container-box">
                      <div class="close" data-dismiss="modal">+</div>
                      <div class="title">Registration</div>
                      <div class="content">
                        <form action="register/register-user.php" method="POST" enctype="multipart/form-data">

                          <div class="user-details">
                            <div class="input-box">
                              <span class="details">First Name <span class="red">*</span></span>
                              <input type="text" name="fname" placeholder="Enter your First Name" required>
                            </div>
                            <div class="input-box">
                              <span class="details">Middle Name <span class="red">*</span></span>
                              <input type="text" name="mname" placeholder="Enter your Middle Name" required>
                            </div>
                            <div class="input-box">
                              <span class="details">Last Name <span class="red">*</span></span>
                              <input type="text" name="lname" placeholder="Enter You last Name" required>
                            </div>
                            <div class="input-box">
                              <span class="details">Birthday <span class="red">*</span></span>
                              <input type="date" name="bday" placeholder="Enter You Birthday" required>
                            </div>
                            <div class="input-box">
      <span class="details">Username <span class="red">*</span></span>
      <input type="text" name="uname" id="uname" placeholder="Enter your username" required>
      <div id="uname-error" class="error-message"></div>
    </div>
                            <div class="input-box">
                              <span class="details">Barangay <span class="red">*</span></span>
                              <Select  name="address" placeholder="Enter your Barangay" >
                                <option disabled selected>Select Barangay</option>
                                <option>Adiangao</option>
            <option>Bagacay</option>
            <option>Bahay</option>
            <option>Boclod</option>
            <option>Calalahan</option>
            <option>Calawit</option>
            <option>Camagong</option>
            <option>Catalotoan</option>
            <option>Danlog</option>
            <option>Del Carmen</option>
            <option>Dolo</option>
            <option>Kinalansan</option>
            <option>Mampirao</option>
            <option>Manzana/option>
            <option>Minoro</option>
            <option>Palale</option>
            <option>Ponglon</option>
            <option>Pugay</option>
            <option>Sabang</option>
            <option>Salogon</option>
            <option>San Antonio</option>
            <option>San Juan</option>
            <option>San Vicente</option>
            <option>Santa Cruz</option>
            <option>Soledad</option>
            <option>Tagas</option>
            <option>Tambangan</option>
            <option>Telegrapo</option>
            <option>Tominawog</option>
                              </Select>


                            </div>
                            <div class="input-box">
                              <span class="details">Phone Number <span class="red">*</span></span>
                              <input type="text" name="number" id="number" placeholder="+63" required>
                              <div id="number-error" class="error-message"></div>

                            </div>
                            <div class="input-box">
  <span class="details">Password <span class="red">*</span></span>
  <input type="password" name="password" id="password" placeholder="Enter your password" required>
  <div id="password-errors" class="error-message"></div>

</div>
<div class="input-box">
  <span class="details">Confirm Password <span class="red">*</span></span>
  <input type="password" name="confirm" id="confirm" placeholder="Confirm your password" required>
  <div id="password-error" class="error-message"></div>

</div>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    var passwordInput = document.getElementById('password');
    var confirmInput = document.getElementById('confirm');
    var numberInput = document.getElementById('number');
    var errorDiv = document.getElementById('password-error');
    var errorDic = document.getElementById('password-errors');
    var numberErrorDiv = document.getElementById('number-error');
    var unameInput = document.getElementById('uname');
    var unameErrorDiv = document.getElementById('uname-error');
    var submitBtn = document.getElementById('submitBtn');

    passwordInput.addEventListener('input', validatePassword);
    confirmInput.addEventListener('input', validatePassword);
    numberInput.addEventListener('input', validateNumber);
    unameInput.addEventListener('input', function () {
      validateUsername(unameInput.value);
    });

    validatePassword();

    function validatePassword() {
      var password = passwordInput.value;
      var confirm = confirmInput.value;

      passwordInput.classList.remove('error-border');
      confirmInput.classList.remove('error-border');
      errorDiv.textContent = '';
      errorDic.textContent = ''; // Clear the errors when the user starts typing

      // Check if password is empty
      if (password === '') {
        enableSubmit(false);
        return;
      }

      // Check if password contains at least one capital letter and one number
      var passwordRegex = /^(?=.*[A-Z])(?=.*\d)/;
if (!passwordRegex.test(password) || password.length < 8) {
  errorDic.textContent = 'Password must contain at least one capital letter, one number, and be at least 8 characters long';
  passwordInput.classList.add('error-border');
  enableSubmit(false);
  return;
} else {
  // Clear error class and error message if validation passes
  passwordInput.classList.remove('error-border');
}

      // Check if confirmation is empty
      if (confirm === '') {
        enableSubmit(false);
        return;
      }

      // Check if password matches confirmation
      if (password !== confirm) {
        errorDiv.textContent = 'Password does not match';
        passwordInput.classList.add('error-border');
        confirmInput.classList.add('error-border');
        enableSubmit(false);
        return;
      }

      enableSubmit(true);
    }

    function validateNumber() {
  var phoneNumber = numberInput.value;

  // Remove error class and clear error message initially
  numberInput.classList.remove('error-border');
  numberErrorDiv.textContent = '';

  // Check if the phone number is numeric and starts with "+63"
  if (!/^\+63\d+$/.test(phoneNumber)) {
    if (!/^\d+$/.test(phoneNumber)) {
      numberErrorDiv.textContent = 'Phone number must contain only numeric digits';
    } else {
      numberErrorDiv.textContent = 'Phone number must start with +63';
    }
    numberInput.classList.add('error-border');
    enableSubmit(false);
  } else {
    // Clear error class and error message if validation passes
    numberInput.classList.remove('error-border');
    enableSubmit(true);
  }
}

// Add an event listener to allow only numeric and plus sign input
numberInput.addEventListener('input', function (event) {
  // Remove non-numeric and non-plus characters from the input value
  var cleanedValue = event.target.value.replace(/[^\d+]/g, '');

  // Update the input value with only numeric and plus characters
  event.target.value = cleanedValue;
});

 



    function validateUsername(username) {
      unameInput.classList.remove('error-border');
      unameErrorDiv.textContent = '';

      // Check if the username is empty
      if (username === '') {
        unameErrorDiv.textContent = 'Username must not be empty';
        unameInput.classList.add('error-border');
        enableSubmit(false);
        return;
      }

      // Send an AJAX request to check if the username is taken
      var xhr = new XMLHttpRequest();
      xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
          if (xhr.responseText === 'taken') {
            unameErrorDiv.textContent = 'Username is already taken';
            unameInput.classList.add('error-border');
            enableSubmit(false);
          } else {
            // Clear error class and error message if validation passes
            unameInput.classList.remove('error-border');
            enableSubmit(true);
          }
        }
      };
      xhr.open('POST', 'data.php', true);

      // Use FormData to send data
      var formData = new FormData();
      formData.append('username', username);

      xhr.send(formData);
    }

    function enableSubmit(enable) {
      submitBtn.disabled = !enable;
    }
  });
</script>




                            <div class="inputbox">
                            <span class="details">Profile Picture</span>
                            <div class="images_images">

										<div class="container-img">
										  		<div class="img-area" data-img="">
												<i class='bx bxs-cloud-upload icon'></i>
												<h3>Upload Image</h3>
												<p>Image size must be less than <span>2MB</span></p>
										  	</div>
											  <label for="file" class="custom-file-input add">Choose Image</label>
										  	<input name="image" type="file" id="file" accept="image/*" class="select-image" hidden>
										</div>   
											<script>
												// Get the file input element and the container img element
												const fileInput = document.getElementById("file");
												const imgArea = document.querySelector(".img-area");
												// Add an event listener to the file input
												fileInput.addEventListener("change", function(event) {
													    const selectedFile = event.target.files[0];
													    if (selectedFile) {
													        const reader = new FileReader();
													        // When the reader has loaded the image, display it in the imgArea
													        reader.onload = function() {
													            imgArea.innerHTML = `
													                <img src="${reader.result}" alt="Uploaded Image">
												                <p>${selectedFile.name}</p>
												            `;
											        };
												        reader.readAsDataURL(selectedFile);
											    }
											});

											</script>
                          </div>
                          </div>
                          </div>
                       

                          <div class="button">
    <input type="submit" name="submit" value="Register" id="submitBtn" disabled>
  </div>
  
<script>
  document.addEventListener('DOMContentLoaded', function () {
    var submitBtn = document.getElementById('submitBtn');

    function enableSubmit(enable) {
      submitBtn.disabled = !enable;
    }
  });
</script>
                        </form>
                      </div>
                    </div>
                    </div>

</div>
   <script>
        // Check if the user is on the home page
        function isHomePage() {
            // You'll need to implement this function based on your website's structure
            // For example, if your home page URL is "https://example.com/", you could check:
            return window.location.href === 'https://example.com/';
        }

        // Handle scrolling events
        function handleScroll() {
            var anchorElement = document.querySelector('a.bottom-up');

            // Check if the user is on the home page
            if (!isHomePage()) {
                // If not on the home page, check scroll position
                if (window.scrollY > 0) {
                    // If scrolled down, show the button
                    anchorElement.style.display = 'block';
                } else {
                    // If at the top, hide the button
                    anchorElement.style.display = 'none';
                }
            }
        }

        // Call the function when the page finishes loading
        window.addEventListener('load', function () {
            handleScroll(); // Initial check
            window.addEventListener('scroll', handleScroll); // Listen for scroll events
        });
    </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
<script>
  $(document).ready(function () {
    // Parse the URL parameters
    const urlParams = new URLSearchParams(window.location.search);

    // Check if 'success' parameter exists in the URL
    if (urlParams.has('success')) {
      // Show the modal
      $('#successModal').modal('show');
    }
  });

</script>


<script>
    $(document).ready(function () {
        $('.signup-link').on('click', function () {
            $('#register-modal').modal('show');
        });
    });
</script>

<script>
		$(document).ready(function() {
    $(".enlarge-image").click(function() {
        var imageUrl = $(this).data("image-url");
        $("#enlargedImg").attr("src", imageUrl);
        $("#imageModal").modal("show");
    });
});
	</script>


</body>
</html>