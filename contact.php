<?php 
include 'config.php';

$query = "SELECT * FROM kontak";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="kontakstyle.css">
</head>
<body>
    
  <!-- Navigation Bar -->
  <nav class="navbar navbar-expand-lg">
        <a class="navbar-brand" href="home.php">Portofolio</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link" href="home.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="about.php">About Me</a></li>
                <li class="nav-item"><a class="nav-link" href="projects.php">Projects</a></li>
                <li class="nav-item"><a class="nav-link" href="certificate.php">Certificates</a></li>
                <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
            </ul>
        </div>
    </nav>

    <!-- Background Section -->
    <div class="background">
        <div class="contact-form">
            <div class="tab-buttons">
                <button id="contactBtn" class="active" onclick="showTab('contact')">Kontak Saya</button>
                <button id="socialBtn" onclick="showTab('social')">Sosial Media</button>
            </div>

            <div class="tab-container">
                <!-- Contact Info Section -->
                <div id="contact" class="tab-content active">
                    <h3>Kontak Saya</h3>
                    <?php while($row = mysqli_fetch_assoc($result)): ?>
                        <?php if ($row['type'] == 'email' || $row['type'] == 'phone'): ?>
                            <div class="social-link">
                                <i class="<?php echo $row['type'] == 'phone' ? 'fab fa-whatsapp' : 'fas fa-envelope'; ?>"></i>
                                <a href="<?php echo $row['link']; ?>" target="_blank"><?php echo $row['text']; ?></a>
                            </div>
                        <?php endif; ?>
                    <?php endwhile; ?>
                </div>

                <!-- Social Media Section -->
                <div id="social" class="tab-content">
                    <h3>Sosial Media</h3>
                    <?php mysqli_data_seek($result, 0); // Reset pointer ke awal hasil query ?>
                    <?php while($row = mysqli_fetch_assoc($result)): ?>
                        <?php if ($row['type'] != 'email' && $row['type'] != 'phone'): ?>
                            <div class="social-link">
                                <i class="fab fa-<?php echo $row['type']; ?>"></i>
                                <a href="<?php echo $row['link']; ?>" target="_blank"><?php echo $row['text']; ?></a>
                            </div>
                        <?php endif; ?>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    </div>

    <script>
    function showTab(tabName) {
        // Get all elements
        const contactTab = document.getElementById("contact");
        const socialTab = document.getElementById("social");
        const contactBtn = document.getElementById("contactBtn");
        const socialBtn = document.getElementById("socialBtn");

        // Remove active class from all elements
        [contactTab, socialTab].forEach(tab => tab.classList.remove("active"));
        [contactBtn, socialBtn].forEach(btn => btn.classList.remove("active"));

        // Add active class to selected elements
        if (tabName === "contact") {
            contactTab.classList.add("active");
            contactBtn.classList.add("active");
        } else {
            socialTab.classList.add("active");
            socialBtn.classList.add("active");
        }
    }
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
