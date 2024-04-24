        <?php require_once 'helpers/navbar.php'?>
        <br /><br /><br />
<?php
if(isset($_SESSION['login'])) if(!$_SESSION['login']){ header("location: ".URLROOT."home/"); exit;}

echo '
        <div class="container">
            <div class="card card-bg">
                <div class="left">
                    <h5> User Name </h5>
                </div>
                <br />
                <div class="card-content">
                    <ul>
                        <li class="active" style="padding: 1rem;border-bottom: 2px solid black;font-weight: bold;">'.$data["user_details"]["user_name"].'</li>
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
                        <li class="active" style="padding: 1rem;border-bottom: 2px solid black;font-weight: bold;">'.$data["user_details"]["user_email"].'</li>
                    </ul>
                </div>
            </div>


            <div class="card card-bg">
                <div class="left"><h5> User id </h5></div><br />
                <div class="card-content">
                    <ul>
                        <li class="active" style="padding: 1rem;border-bottom: 2px solid black;font-weight: bold;">'.$data["user_id"].'</li>
                    </ul>
                </div>
            </div>

            <div class="card card-bg">
                <div class="left"><h5>Phone </h5></div><br />
                <div class="card-content">
                    <ul>
                        <li class="active" style="padding: 1rem;border-bottom: 2px solid black;font-weight: bold;">'.$data["user_details"]["user_phone"].'</li>
                    </ul>
                </div>
            </div>

            <div class="card card-bg">
                <div class="left">
                    <h5> Payments </h5>
                </div>
                <br />
                <div class="card-content">
                    <ul>
                        <li class="active" style="padding: 1rem;border-bottom: 2px solid #1a237e;font-weight: bold;"> Your service will expire '.$data["user_details"]["user_payment_expire_date"].'</li>
                    </ul>
                </div>
            </div>

            <div class="card card-bg">
                <div class="left">
                    <h5>  </h5>
                </div>
                <br />
                <div class="card-content">
                    <ul>
                        <li class="active" style="padding: 1rem;font-weight: bold;"> <a href="'.URLROOT.'home/reset">Change Password</></li>
                    </ul>
                </div>
            </div>


        </div>
        <br /><br /><br /><br />';

/**
 * 
 * displaying all user's detais also will give an option for enabling user to edit his detais
 * 
 */


?>
<?php require_once 'helpers/footer.php'?>
</body>
</html>