<!-- Footer Section -->
<footer class="pt-5 pb-4" style="background-color: rgb(245, 245, 167); color: black;">
    <div class="container text-center text-md-start">
        <div class="row">

            <!-- Company Info -->
            <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                <h5 class="text-uppercase mb-4 font-weight-bold">Dreams Flora & Dreams Event</h5>
                <p>
                   We Provide the best solutions for your dream events. We will be in touch with you as per your needs and help you 
                   the best we can. Stay connected & grow with Us!
                </p>
            </div>

            <!-- Quick Links -->
            <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
                <h5 class="text-uppercase mb-4 font-weight-bold">Quick Links</h5>
                <p><a href="customerHome.php" class="footer-link">Home</a></p>
                <p><a href="aboutUs.php" class="footer-link">About Us</a></p>
                <p><a href="service.php" class="footer-link">Service</a></p>
                <p><a href="#" class="footer-link">Gallery</a></p>
                <p><a href="mailto:dreamsevent@gmail.com" class="footer-link">Contact Us</a></p>
                <p><a href="viewFAQ.php" class="footer-link">FAQ</a></p>
                <p><a href="terms.php" class="footer-link">Terms & condition</a></p>
            </div>

            <!-- Partners -->
            <div class="col-md-3 col-lg-2 mx-auto mt-3">
                <h5 class="text-uppercase mb-4 font-weight-bold">Our Top Partners</h5>
                <p><a href="#" class="footer-link">Lassana Flora</a></p>
                <p><a href="#" class="footer-link">WAO</a></p>
                <p><a href="#" class="footer-link">Mihin Tours</a></p>
                <p><a href="#" class="footer-link">Lanka Express Transport & Logistics</a></p>
                <p><a href="#" class="footer-link">Sritaly.com</a></p>
            </div>

            <!-- Contact Info -->
            <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
                <h5 class="text-uppercase mb-4 font-weight-bold">Contact</h5>
                <p><i class="fas fa-map-marker-alt me-2"></i>G4HP+PPV,Agalawatta-Matugama Rd,Matugama.</p>
                <p><i class="fas fa-envelope me-2"></i> info@company.com</p>
                <p><i class="fas fa-phone me-2"></i> +94 719058047</p>
            </div>
        </div>

        <hr class="mb-4">

        <!-- Social Media & Share Button -->
        <div class="row align-items-center">
            <div class="col-md-7 col-lg-8">
                <p>© 2024 All Rights Reserved by:
                    <a href="#" class="footer-link"><strong>The Providers</strong></a>
                </p>
            </div>

            <div class="col-md-5 col-lg-4 text-center text-md-right">
                <ul class="list-unstyled list-inline">
                    <li class="list-inline-item">
                        <a href="https://www.facebook.com/share/19oZv8CM1f/ " target= "blank" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
                    </li>
                    <li class="list-inline-item">
                        <a href="https://www.youtube.com/@dreamsflora3750" target = "blank" class="social-icon"><i class="fab fa-youtube"></i></a>
                    </li>
                </ul>
                
                <!-- Share Button -->
                <button class="btn btn-primary mt-3" onclick="toggleSharePopup()">
                    <i class="fas fa-share-alt"></i> Share
                </button>
            </div>
        </div>
    </div>
</footer>

<!-- Share Pop-up -->
<div id="sharePopup" class="share-popup">
    <div class="share-content">
        <span class="close-btn" onclick="toggleSharePopup()">&times;</span>
        <h4>Share this page</h4>
        <div class="share-icons">
            <a href="https://api.whatsapp.com/send?text=Check%20this%20out:%20Dreams%20Flora%20-%20Your%20go-to%20floral%20expert%20for%20weddings,%20events,%20and%20special%20occasions!%20Visit%20us%20https://www.facebook.com/share/19oZv8CM1f/" target="_blank">
                <i class="fab fa-whatsapp"></i>
            </a>
            <a href="https://www.facebook.com/sharer/sharer.php?u=https://www.facebook.com/share/19oZv8CM1f/" target="_blank">
                <i class="fab fa-facebook"></i>
            </a>
            <a href="https://twitter.com/intent/tweet?url=https://www.facebook.com/share/19oZv8CM1f/" target="_blank">
                <i class="fab fa-twitter"></i>
            </a>
            <a href="mailto:?subject=Check%20this%20out&body=  https://www.facebook.com/share/19oZv8CM1f/">
                <i class="fas fa-envelope"></i>
            </a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
<script src="https://kit.fontawesome.com/a076d05399.js"></script>

<!-- Share Pop-up Script -->
<script>
    function toggleSharePopup() {
        const popup = document.getElementById('sharePopup');
        popup.style.display = (popup.style.display === 'block') ? 'none' : 'block';
    }
</script>

<!-- Share Pop-up Styling -->
<style>
    .share-popup {
        display: none;
        position: fixed;
        bottom: 20%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 300px;
        background: white;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
        padding: 15px;
        border-radius: 8px;
        text-align: center;
    }

    .share-popup .close-btn {
        position: absolute;
        top: 5px;
        right: 10px;
        font-size: 18px;
        cursor: pointer;
    }

    .share-icons a {
        display: inline-block;
        margin: 10px;
        font-size: 24px;
        text-decoration: none;
        color: black;
    }

    .share-icons a:hover {
        color: #007bff;
    }
</style>
