<html>
    <body>
    <?php require_once 'helpers/navbar.php'?><br /><br /><br />
    <div class="section scrollspy" style="padding: 0%;">
        <?php
        $i = 0;
        if (!empty($data["notifications"])){
        while ($i <= $data["notifications"][0]["notification_key"])
        {
            if(!(isset($data["notifications"][$i]["notification_key"]))){ $i++; continue;}
            if($i == 0){
                echo '
                <div  class="row row-1" style="margin: 0;overflow: hidden;border: 1px solid rgba(0, 0, 0, 0.137);padding: 0.5rem;outline: none;width: 100%;min-width: unset;border-radius: 5px;background-color: rgba(221, 228, 236, 0.301);border-color: rgba(221, 228, 236, 0.459);margin: 2vh 0;overflow: hidden;">
                    <div class="col-2"><img class="img-fluid" src="https://img.icons8.com/office/16/000000/new-message.png" /></div>
                    <div class="col-7"> <p>'.$data["notifications"][$i]["notification_content"].'</p> </div>
                    <div class="right col-3 d-flex justify-content-center"> <a style="color: grey;text-decoration: none;font-size: 0.87rem;font-weight: bold;" href="#"><p clas="">'.$data["notifications"][$i]["notification_sent_at"].'</p></a> </div>
            </div>
                ';
                $i++;
                continue;
            }
            echo '
            <div  class="row row-1" style="margin: 0;overflow: hidden;border: 1px solid rgba(0, 0, 0, 0.137);padding: 0.5rem;outline: none;width: 100%;min-width: unset;border-radius: 5px;background-color: rgba(221, 228, 236, 0.301);border-color: rgba(221, 228, 236, 0.459);margin: 2vh 0;overflow: hidden;">
                <div class="col-2"><img class="img-fluid" src="https://img.icons8.com/office/16/000000/open-envelope.png"/> </div>
                <div class="col-7"> <p>'.$data["notifications"][$i]["notification_content"].'</p> </div>
                <div class="right col-3 d-flex justify-content-center"> <a style="color: grey;text-decoration: none;font-size: 0.87rem;font-weight: bold;" href="#"><p clas="">'.$data["notifications"][$i]["notification_sent_at"].'</p></a> </div>
            </div>
        ';
        $i++;
        }
        }
        else
        {
            echo '<br /><br /><br /><br /><br /><br /><br /><br /><br /><br />';
        }
        ?>
    </div>
    
    <?php
    //var_dump($data["notifications"]);
    ?>
    <?php require_once 'helpers/footer.php'?>
</body>
</html>