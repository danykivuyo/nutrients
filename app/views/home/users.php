<body>
    <?php require_once 'helpers/navbar.php' ?>
    <br /><br /><br />
    <?php
    if (isset($_SESSION['login'])) if (!$_SESSION['login']) {
        header("location: " . URLROOT . "home/");
        exit;
    }

    ?>

    <div class="container">
        <div class="section scrollspy">
            <div class="row">
                <div class="col s12 m12">
                    <div class="card-panel purple white z-depth-5">
                        <div class="card card-bg gray">
                            <div class="left">
                                <h5> User Name </h5>
                            </div>
                            <br />
                            <div class="card-content">
                                <ul>
                                    <li class="active"
                                        style="padding: 1rem;border-bottom: 2px solid black;font-weight: bold;">
                                        <?php
                                        echo $data["user_details"]["user_name"];
                                        ?>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="card card-bg">
                            <div class="left">
                                <h5>Email </h5>
                            </div>
                            <br />
                            <div class="card-content">
                                <ul>
                                    <li class="active"
                                        style="padding: 1rem;border-bottom: 2px solid black;font-weight: bold;">
                                        <?php
                                        echo $data["user_details"]["user_email"];
                                        ?>
                                    </li>
                                </ul>
                            </div>
                        </div>


                        <div class="card card-bg">
                            <div class="left">
                                <h5> User id </h5>
                            </div><br />
                            <div class="card-content">
                                <ul>
                                    <li class="active"
                                        style="padding: 1rem;border-bottom: 2px solid black;font-weight: bold;">
                                        <?php
                                        echo $data["user_id"];
                                        ?>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="card card-bg">
                            <div class="left">
                                <h5>Phone </h5>
                            </div><br />
                            <div class="card-content">
                                <ul>
                                    <li class="active"
                                        style="padding: 1rem;border-bottom: 2px solid black;font-weight: bold;">
                                        <?php
                                        echo $data["user_details"]["user_phone"];
                                        ?>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="card card-bg">
                            <div class="left">
                                <h5> </h5>
                            </div>
                            <br />
                            <div class="card-content">
                                <ul>
                                    <li class="active" style="padding: 1rem;font-weight: bold;"> <a
                                            href="<?php URLROOT . 'home/reset'; ?>">
                                            Change Password
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br /><br /><br /><br />
    <?php require_once 'helpers/footer.php' ?>
</body>

</html>