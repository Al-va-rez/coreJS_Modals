<?php
session_start();
if (!isset($_SESSION['username'])) {
  header("Location: login.php");
} else if ($_SESSION['is_admin']) {
  header("Location: all_users.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Dashboard</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/core-js-bundle@3.33.3/minified.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
  <nav class="navbar navbar-light bg-light border-bottom shadow-sm">
    <div class="container d-flex justify-content-between align-items-center">
      <span class="navbar-brand fw-bold">User Dashboard</span>
      <button id="logoutBtn" class="btn btn-outline-danger">Logout</button>
    </div>
  </nav>

  <main class="container my-5">
    <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
    <p>You are logged in as a regular user.</p>
  </main>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const logoutBtn = document.getElementById('logoutBtn');

      logoutBtn.addEventListener('click', async () => {
        try {
          const response = await fetch('api.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ action: 'logout' })
          });

          const result = await response.json();

          if (result.status === 'success') {
            Swal.fire({
              icon: 'success',
              text: result.message,
              timer: 1500,
              showConfirmButton: false
            });
            setTimeout(() => window.location.href = 'login.php', 1500);
          } else {
            Swal.fire('Error', result.message, 'error');
          }
        } catch (error) {
          Swal.fire('Error', error.message, 'error');
        }
      });
    });
  </script>
</body>
</html>