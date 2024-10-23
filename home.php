<?php 
include 'config.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portofolio</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="homestyle.css"> 
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

    <header class="header">
        <h1>Selamat datang di Websiteku!</h1>
        <p>Ini adalah website yang berisi tentang portofolio ku sebagai pemilik website.</p>
    </header>

    <div class="content container">
        
        <?php  
        // Query untuk mengambil data
        $sql = "SELECT title, description, image_path, link FROM portfolio";
        $result = $conn->query($sql);

        if ($result->num_rows > 0):
            while($row = $result->fetch_assoc()): ?>
                <a href="<?php echo $row['link']; ?>" class="additional-link">
                    <div class="additional-section">
                        <img src="<?php echo $row['image_path']; ?>" alt="<?php echo $row['title']; ?> Icon">
                        <div>
                            <h2><?php echo $row['title']; ?></h2>
                            <p><?php echo $row['description']; ?></p>
                        </div>
                    </div>
                </a>
            <?php endwhile; 
        else: ?>
            <p>Tidak ada data yang ditemukan.</p>
        <?php endif; ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Animasi Header
            const header = document.querySelector('.header');
            header.classList.add('visible'); // Menambahkan kelas visible untuk header

            // Animasi Additional Sections
            const sections = document.querySelectorAll('.additional-section');
            sections.forEach((section, index) => {
                setTimeout(() => {
                    section.classList.add('visible'); // Menambahkan kelas visible setelah delay
                }, index * 300); // Delay bertahap untuk setiap section
            });
        });
    </script>
</body>
</html>

<?php
$conn->close(); 
?>
