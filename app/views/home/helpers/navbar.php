<!-- desktop navigation bar-->
<?php //print_r($data); ?>
<div class="navbar-fixed">
  <nav class="nav-fixed nav-extended darken-4">
    <div class="nav-wrapper" style="background: #7f058a">
      <a href="#" class="brand-logo"><?php echo strtoupper(SITENAME); ?></a>
      <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li><a href="<?php echo URLROOT . "home/" ?>">Home</a></li>
        <?php if (!isset($_SESSION["login"]) || !isset($_SESSION["user_id"]) || $_SESSION["login"] != "true")
          echo '<li><a href="' . LOGIN . '" >Login</a></li><li><a href="' . REGISTER . '" >Register</a></li>'; ?>
        <!--<li><a href="<?php echo URLROOT . "home/#how" ?>" >How it works</a></li>-->
        <?php if (isset($_SESSION["login"]) && isset($_SESSION["user_id"]) && $_SESSION["login"] == "true")
          echo '<li><a href="' . URLROOT . 'home/plant/' . $_SESSION["user_id"] . '/plant" >Module</a></i><li><a href="' . URLROOT . 'home/farm/' . $_SESSION["user_id"] . '/farm/" >Farms</a></li><li><a class="white-text" href="' . URLROOT . 'home/user/' . $_SESSION["user_id"] . '/notification/" >Notifications</a></li><li><a href="' . URLROOT . 'home/user/' . $_SESSION["user_id"] . '" >Account</a></li><li><a href="' . URLROOT . 'home/logout/" >Logout</a></li>'; ?>
        <?php if (isset($_SESSION["login"]) && isset($_SESSION["user_id"]) && $_SESSION["login"] == "true" && $data["user_details"]["user_role"] == "admin")
          echo '<li><a href="' . URLROOT . 'home/admin">Admin Pannel</li>' ?>
        </ul>
      </div>
      <div class="nav-content" style="background-color: purple !important;">
        <ul class="tabs tabs-transparent">
        <?php if (isset($_SESSION[''])) ?>
        <li class="tab"><a href="<?php if (!(!isset($_SESSION["login"]) || !isset($_SESSION["user_id"]) || $_SESSION["login"] != "true")) {
          echo URLROOT . 'home/plant/' . $_SESSION["user_id"] . '/plant';
        } ?>" class="active">Module</a></li>
        <li class="tab"><a href="<?php if (!(!isset($_SESSION["login"]) || !isset($_SESSION["user_id"]) || $_SESSION["login"] != "true")) {
          echo URLROOT . 'home/farm/' . $_SESSION["user_id"] . '/farm';
        } ?>" class="active">Farms</a></li>
      </ul>
    </div>

  </nav>
</div>

<!-- mobile and tablet side navigation-->
<ul class="sidenav purple purple-text text-darken-3" id="mobile-demo">
  <br><br><br><br>
  <div class="container">
    <div class="section scrollspy">
      <div class="row">
        <div class="card-panel purple lighten-4 z-depth-5" style="backdrop-filter: blur(10px);">

          <li><a class="purple-text text-darken-3" href="<?php echo URLROOT . "home/" ?>"><i
                class="material-icons purple-text text-darken-3">home</i>Home</a></li>
          <?php if (!isset($_SESSION["login"]) || !isset($_SESSION["user_id"]) || $_SESSION["login"] != "true") {
            echo '<li><a class="purple-text text-darken-3" href="' . LOGIN . '" ><i class="material-icons purple-text text-darken-3">person</i>Login</a></li><li><a class="purple-text text-darken-3" href="' . REGISTER . '" ><i class="material-icons purple-text text-darken-3">person_add</i>Register</a></li>';
          } else {
            echo '<li><a class="purple-text text-darken-3" href="' . URLROOT . 'home/farm/' . $_SESSION["user_id"] . '/farm/" ><i class="material-icons purple-text text-darken-3">pie_chart</i>Farms</a></li><li><a class="purple-text text-darken-3" href="' . URLROOT . 'home/user/' . $_SESSION["user_id"] . '/notification/" ><i class="material-icons purple-text text-darken-3">notifications_active</i>Notifications</a></li>';
          } ?>
          <!--<li><a class="purple-text text-darken-3" class="purple-text text-darken-3" href="<?php echo URLROOT . "home/#how" ?>" ><i class="material-icons purple-text text-darken-3">speaker_notes</i>How it works</a></li>-->
          <?php if (isset($_SESSION["login"]) && isset($_SESSION["user_id"]) && $_SESSION["login"] == "true")
            echo '<li><a class="purple-text text-darken-3" href="' . URLROOT . 'home/user/' . $_SESSION["user_id"] . '" ><i class="material-icons purple-text text-darken-3">account_circle</i>Account</a></li><li><a class="purple-text text-darken-3" href="' . URLROOT . 'home/plant/' . $_SESSION["user_id"] . '/plant" ><i class="material-icons purple-text text-darken-3">ev_station</i>Module</a></li><li><a class="purple-text text-darken-3" href="' . URLROOT . 'home/logout/" ><i class="material-icons purple-text text-darken-3">trending_flat</i>Logout</a></li>'; ?>
          <li><a class="purple-text text-darken-3" href="<?php echo URLROOT . "home/about/" ?>"><i
                class="material-icons purple-text text-darken-3">group</i>About Us</a></li>
          <?php if (isset($_SESSION["login"]) && isset($_SESSION["user_id"]) && $_SESSION["login"] == "true" && $data["user_details"]["user_role"] == "admin")
            echo '<li><a class="purple-text text-darken-3" href="' . URLROOT . 'home/admin">Admin Pannel</a></li>' ?>

          </div>
        </div>
      </div>
    </div>
  </ul>