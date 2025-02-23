<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Planner</title>

    <!-- Bootstrap and Font Awesome -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="../css/service.css">
    <link rel="stylesheet" href="../css/customerHome.css">
</head>

<body>
    <!-- Navigation Bar -->
    <?php include "customerNavbar.php" ?>

    <br><br><br><br>

    <!-- Full-width Image -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 text-center">
                <img src="../images/services/pl03.jpeg" class="img-fluid" alt="Full Width Image">
            </div>
        </div>


        <!-- Event Sections -->
        <div class="container mt-5">
            <div class="row align-items-center">
                <div class="col-md-3">
                    <div class="list-group">
                        <!-- Wedding Event Button -->
                        <a href="#wedding-theme"
                            class="list-group-item list-group-item-dark d-flex justify-content-between align-items-center">
                            Wedding Events <i class="fas fa-angle-right"></i>
                        </a>
                        <!-- Birthday Event Button -->
                        <a href="#Birthday-theme"
                            class="list-group-item list-group-item-dark d-flex justify-content-between align-items-center">
                            Birthday Events <i class="fas fa-angle-right"></i>
                        </a>
                        <a href="#Award-Ceremony-theme"
                            class="list-group-item list-group-item-dark d-flex justify-content-between align-items-center">
                            Award Ceremony <i class="fas fa-angle-right"></i>
                        </a>
                        
                    </div>
                </div>

                <div class="col-md-3 text-center">
                    <img src="../images/services/se (1).jpeg" class="img-fluid rounded" alt="Wedding Event">
                </div>

                <div class="col-md-3 text-center">
                    <img src="../images/services/se (2).jpeg" class="img-fluid rounded" alt="Celebration Event">
                </div>
                <div class="col-md-3 text-center">
                    <img src="../images/services/se(3).jpeg" class="img-fluid rounded" alt="Celebration Event">
                </div>
            </div>
        </div>


    </div>
    </div>

    <!-- Event Categories -->
    <div class="container my-5">
        <div class="row">
            <!-- Wedding Categories -->
            <div class="col-md-4">
                <div class="card p-3">
                    <h5>Wedding Categories</h5>
                    <ul class="list-unstyled">
                        <li><i class="fa-solid fa-check-circle text-success me-2"></i> Religious Wedding</li>
                        <li><i class="fa-solid fa-check-circle text-success me-2"></i> Cultural Wedding</li>
                        <li><i class="fa-solid fa-check-circle text-success me-2"></i> Classic Wedding</li>
                        <li><i class="fa-solid fa-check-circle text-success me-2"></i> Destination Wedding</li>
                        <li><i class="fa-solid fa-check-circle text-success me-2"></i> Beach Wedding</li>
                        <li><i class="fa-solid fa-check-circle text-success me-2"></i> Garden Wedding</li>
                        <li><i class="fa-solid fa-check-circle text-success me-2"></i> Micro Wedding</li>
                        <li><i class="fa-solid fa-check-circle text-success me-2"></i> Backyard Wedding</li>
                    </ul>
                </div>
            </div>

            <!-- Birthday Categories -->
            <div class="col-md-4">
                <div class="card p-3">
                    <h5>Birthday Categories</h5>
                    <ul class="list-unstyled">
                        <li><i class="fa-solid fa-check-circle text-success me-2"></i> Classic Birthday Party</li>
                        <li><i class="fa-solid fa-check-circle text-success me-2"></i> Surprise Birthday Party</li>
                        <li><i class="fa-solid fa-check-circle text-success me-2"></i> Destination Birthday</li>
                        <li><i class="fa-solid fa-check-circle text-success me-2"></i> Home Birthday Party</li>
                        <li><i class="fa-solid fa-check-circle text-success me-2"></i> Outdoor Birthday Party</li>
                        <li><i class="fa-solid fa-check-circle text-success me-2"></i> Garden Party</li>
                        <li><i class="fa-solid fa-check-circle text-success me-2"></i> Micro Party</li>
                        <li><i class="fa-solid fa-check-circle text-success me-2"></i> Beach Birthday Party</li>
                    </ul>
                </div>
            </div>


            <div class="col-md-4">
                <div class="card p-3">
                    <h5>Wedding Categories</h5>
                    <ul class="list-unstyled">
                        <li><i class="fa-solid fa-check-circle text-success me-2"></i> Entertainment & Arts</li>
                        <li><i class="fa-solid fa-check-circle text-success me-2"></i> Business & Corporate</li>
                        <li><i class="fa-solid fa-check-circle text-success me-2"></i> Government & Public Service</li>
                        <li><i class="fa-solid fa-check-circle text-success me-2"></i> Environmental & Sustainability</li>
                        <li><i class="fa-solid fa-check-circle text-success me-2"></i> Fashion & Beauty</li>
                        <li><i class="fa-solid fa-check-circle text-success me-2"></i> Social Media & Digital Content</li>
                        <li><i class="fa-solid fa-check-circle text-success me-2"></i> Cultural & Heritage</li>
                        <li><i class="fa-solid fa-check-circle text-success me-2"></i> Academia & Education</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    </div>

    <div class="container mt-4">
        <div class="service-section">
            <div class="service-header">
                <span class="toggle-icon" onclick="toggleService()">−</span>
                <h2 id="wedding-theme">Event / Wedding Themes and Concepts Design</h2>
            </div>
            <div class="service-content">
                <p>This section contains details about various event and wedding themes and design concepts.</p>
            </div>
        </div>
    </div>


    <div class="container my-5">
        <div class="row">
            <!-- Image Column -->
            <div class="col-lg-6">
                <img src="../images/services/ser.we.01.jpeg" width="600px" class="img-fluid" alt="Wedding Image">
            </div>

            <!-- Text Content Column -->
            <div class="col-lg-6"> <br>
                <h1 class="text-center">WEDDING</h1>
                <p class="text-muted" style="font-size: 1.2rem; text-align: justify;">
                    Dreams flora & Dreams Event Company specializes in creating unforgettable wedding experiences through unique and
                    personalized themes and concept designs. With a keen eye for detail and a passion for elegance,
                    Dream Event Company transforms every venue into a stunning visual masterpiece, tailored to your
                    vision and style. <br><br>
                    Whether you're dreaming of a classic romantic celebration, a whimsical fairytale affair, or a bold,
                    modern celebration, their expert team offers a wide range of themes, from vintage glamour to boho
                    chic and everything in between. They provide full-service wedding design, including custom decor,
                    lighting, floral arrangements, and themed set-ups, ensuring that every aspect of your big day
                    reflects your love story.
                </p>
            </div>


            <div class="row justify-content-center mt-4">
                <div class="col-md-3 text-center">
                    <button class="btn btn-success order-btn" onclick="window.location.href='weddingPackage.php'">ORDER NOW</button>
                </div>
            </div>


        </div>
    </div>




    <div class="container mt-4">
        <div class="service-section">
            <div class="service-header">
                <span class="toggle-icon" onclick="toggleService()">−</span>
                <h2 id="Birthday-theme">Event / Birthday Themes and Concepts Design</h2>
            </div>
            <div class="service-content">
                <p>This section contains details about various event and Birthday themes and design concepts.</p>
            </div>
        </div>
    </div>


    <div class="container my-5">
        <div class="row">
            <!-- Image Column -->
            <div class="col-lg-6"> <br>
                <img src="../images/services/birthday22.jpeg" width="600px" class="img-fluid" alt="Birthday Image">
            </div>

            <!-- Text Content Column -->
            <div class="col-lg-6">
                <h1 class="text-center">BIRTHDAY</h1>
                <p class="text-muted" style="font-size: 1.2rem; text-align: justify;">
                    At Dreams flora & Dreams Event Company, we specialize in creating magical and unforgettable birthday celebrations
                    tailored to your unique vision. Whether it’s a fun-filled kids’ birthday party, a stylish teen
                    celebration, or an elegant milestone birthday, we bring creativity and innovation to every event.
                    Our expert team curates customized themes ranging from fairy tales, superheroes, enchanted forests,
                    luxury glamour, tropical vibes, and futuristic designs, ensuring a breathtaking experience for you
                    and your guests. <br> <br> We handle everything from themed decorations, personalized cakes,
                    creative
                    backdrops, lighting effects, entertainment, and interactive activities to transform your special day
                    into a dream come true.

                    With our attention to detail and passion for perfection, we guarantee a birthday event that reflects
                    your personality and leaves lasting memories. Let us turn your dream birthday theme into a reality
                    with Dream Event Company!
                </p>
            </div>

            <div class="row justify-content-center mt-4">
                <div class="col-md-3 text-center">
                    <button class="btn btn-success order-btn" onclick="window.location.href='birthdayPackage.php'" >ORDER NOW</button>
                </div>
            </div>

        </div>
    </div>


    <div class="container mt-4">
        <div class="service-section">
            <div class="service-header">
                <span class="toggle-icon" onclick="toggleService()">−</span>
                <h2 id="Award-Ceremony-theme">Event /  Award Ceremony Themes and Concepts Design</h2>
            </div>
            <div class="service-content">
                <p>This section contains details about various event and wedding themes and design concepts.</p>
            </div>
        </div>
    </div>


    <div class="container my-5">
        <div class="row">
            <!-- Image Column -->
            <div class="col-lg-6">
                <img src="../images/services/award.jpeg" width="600px" class="img-fluid" alt="Wedding Image">
            </div>

            <!-- Text Content Column -->
            <div class="col-lg-6"> <br>
                <h1 class="text-center">AWARD CEREMONY</h1>
                <p class="text-muted" style="font-size: 1.2rem; text-align: justify;">
                    Dreams flora & Dreams Event Company specializes in curating exceptional award ceremonies that
                     exude elegance, prestige, and unforgettable grandeur. With a meticulous attention 
                     to detail and a passion for sophisticated event design, we transform every venue 
                     into a stunning stage that celebrates excellence. <br><br>

                    Whether you’re hosting a corporate recognition gala, an industry award night, or a 
                    prestigious red-carpet event, our expert team crafts bespoke themes that align with
                    your brand and vision. From glamorous Hollywood-style evenings to modern and sleek 
                    corporate affairs, we design every aspect with precision—custom stage designs, breathtaking
                    lighting, immersive decor, and seamless audiovisual production. <br><br>

                    At Dream Event Company, we ensure that every moment, from the grand entrance to the final 
                    ovation, is a spectacular experience that leaves a lasting impression on your guests and 
                    honorees. Let us turn your award ceremony into an unforgettable celebration of achievement 
                    and success.
                </p>
            </div>


            <div class="row justify-content-center mt-4">
                <div class="col-md-3 text-center">
                    <button class="btn btn-success order-btn" onclick="window.location.href='awardCeramonyPackage.php'" >ORDER NOW</button>
                </div>
            </div>


        </div>
    </div>







    <!-- Contact Section -->
    <div class="container mt-5">
        <div class="row justify-content-center">
            <!-- Left Side - Contact Box -->
            <div class="col-md-6">
                <div class="card text-center p-4 shadow">
                    <h3 class="mb-3">Get in Touch</h3>
                    <p><i class="fa-solid fa-location-dot"></i> Location: <a href="Honey Business
                        24 Fifth st., Los Angeles, USA">Honey Business
                            24 Fifth st., Los Angeles, USA</a></p>
                    <p><i class="fas fa-envelope text-primary me-2"></i> Email: <a
                            href="Dreamevent@gmail.com">Dreamevent@gmail.com</a></p>
                    <p><i class="fas fa-phone text-success me-2"></i> Phone: <a href="tel:+1234567890">+1234567890</a>
                    </p>
                    <!-- <button class="btn btn-primary mt-3">Contact Us</button> -->
                </div>
            </div>

            <!-- Right Side - Text Box -->
            <div class="col-md-4">
                <div class="text-box p-4">
                    <h6 class="fw-bold">COMPETITIVE RATES</h6>
                    <p>In our industry, contacts, negotiating deals, and experience ensure you get the best prices.</p>
                    <h6 class="fw-bold">REDUCTION OF STRESS</h6>
                    <p>We guide you through the process, making wedding planning fun, exciting, and stress-free.</p>
                    <h6 class="fw-bold">PROFESSIONAL CONSULTANCY</h6>
                    <p>We work with the top vendors in Sri Lanka, giving you access to the best service providers.</p>
                    <h6 class="fw-bold">SAVE YOUR PRECIOUS TIME</h6>
                    <p>Don't waste hours trying to find reliable vendors. We present you with perfect matches.</p>
                </div>
            </div>
        </div>
    </div> <br><br>



    <!-- Footer Section -->
    <?php include 'footer.php'  ?>




    <!-- Bootstrap and Font Awesome JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
