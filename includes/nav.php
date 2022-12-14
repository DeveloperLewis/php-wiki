<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
  <a class="navbar-brand" href="#">Wikipedia</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="/">Front Page</a>
      </li>
      <?php
        //Display if you're not logged in
      if(!isset($_SESSION['uid'])) {
        echo '<li class="nav-item">';
        echo '<a class="nav-link" href="/user/register">Register</a>';
        echo '</li>';
      }

      if(!isset($_SESSION['uid'])) {
        echo '<li class="nav-item">';
        echo '<a class="nav-link" href="/user/login">Login</a>';
        echo '</li>';
      }


      //Display if you are logged in
      if(isset($_SESSION['uid'])) {
        echo '<li class="nav-item">';
        echo '<a class="nav-link" href="/user/logout">Logout</a>';
        echo '</li>';
      }

      if(isset($_SESSION['uid'])) {
          if (\classes\models\user\User::isAdmin($_SESSION['uid'])) {
              echo '<li class="nav-item">';
              echo '<a class="nav-link" href="/admin/dashboard">Admin Panel</a>';
              echo '</li>';
          }
      }
      ?>
    </ul>
        </div>
    </div>
</nav>