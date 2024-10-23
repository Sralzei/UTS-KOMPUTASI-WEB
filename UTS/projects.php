<?php 
include 'config.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projects</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="projectstyle.css"> 
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

    <!-- Projects Section -->
    <div class="container mt-5">
        <h2 class="text-center">Projects</h2>
        <div class="row mt-4">
            <?php
            // Query untuk mengambil data dari database
            $sql = "SELECT id, title, description, image_path FROM projects";
            $result = $conn->query($sql);

            if ($result->num_rows > 0):
                while($row = $result->fetch_assoc()): ?>
                    <div class="col-md-4 mb-4">
                        <div class="project-card section" data-media="<?php echo $row['image_path']; ?>" data-type="<?php echo pathinfo($row['image_path'], PATHINFO_EXTENSION); ?>">
                            <h3><?php echo $row['title']; ?></h3>
                            <p><?php echo $row['description']; ?></p>
                        </div>
                    </div>
                <?php endwhile; 
            else: ?>
                <p class="text-center">No projects found.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Modal for Project Media -->
    <div class="modal fade" id="projectModal" tabindex="-1" role="dialog" aria-labelledby="projectModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="projectModalLabel">Project Media</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <img id="projectImage" src="" alt="Project Image" class="img-fluid" style="display: none;">
                    <video id="projectVideo" controls class="img-fluid" style="display: none;">
                        <source src="" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.project-card');
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                    }
                });
            }, { threshold: 0.1 });

            cards.forEach(card => {
                observer.observe(card);
                card.addEventListener('click', function() {
                    const mediaPath = card.getAttribute('data-media');
                    const mediaType = card.getAttribute('data-type');

                    if (mediaType === 'mp4') {
                        document.getElementById('projectVideo').src = mediaPath;
                        document.getElementById('projectVideo').style.display = 'block';
                        document.getElementById('projectImage').style.display = 'none';
                    } else {
                        document.getElementById('projectImage').src = mediaPath;
                        document.getElementById('projectImage').style.display = 'block';
                        document.getElementById('projectVideo').style.display = 'none';
                    }

                    $('#projectModal').modal('show');
                });
            });
        });
    </script>

</body>
</html>

<?php
$conn->close(); // Menutup koneksi
?>
