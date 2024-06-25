<?php require_once 'helpers/navbar.php' ?>
PAYMENT PAGE
<br /><br /><br />
<style>
    @media only screen and (max-width: 600px) {
        #pay-container {
            max-width: 80%;
        }
    }
</style>

<div id="pay-container" class="card mt-50 mb-50"
    style="margin: auto;width: 600px;padding: 3rem 3.5rem;box-shadow: 0 6px 20px 0 rgba(0, 0, 0, 0.19);margin-top: 50px;margin-bottom: 50px;@media(max-width:767px) {.card {width: 90%;padding: 1.5rem;}@media(height:1366px) {.card {width: 90%;padding: 8vh;}}">
    <div class="card-title mx-auto" style="font-weight: 700;font-size: 2.5em;">
    </div>
    <div class="nav" style="display: flex;">
        <ul class="mx-auto" style="list-style-type: none;display: flex;padding-inline-start: unset;margin-bottom: 6vh">
            <li class="active" style="padding: 1rem;border-bottom: 2px solid black;font-weight: bold;"><a
                    style="color: black;text-decoration: none;" href="#">Buy Units</a></li>
        </ul>
    </div>
    <form id="payment-form" action="<?php echo URLROOT . 'home/user/' . $_SESSION["user_id"] . '/pay2'; ?>"
        method="POST">
        <span id="card-header">Units :</span>
        <div class="col-7"> <input onclick='document.getElementById("payment-form").submit();' name="unit"
                style="border: none;outline: none;font-size: 1rem;font-weight: 600;color: #000;width: 100%;min-width: unset;background-color: transparent;border-color: transparent;margin: 0;"
                type="text" placeholder="kWh"> </div>
        <button style="all: initial; * {all: unset;};">
            <div onclick='document.getElementById("payment-form").submit();' class="row row-1"
                style="margin: 0;overflow: hidden;border: 1px solid rgba(0, 0, 0, 0.137);padding: 0.5rem;outline: none;width: 100%;min-width: unset;border-radius: 5px;background-color: rgba(221, 228, 236, 0.301);border-color: rgba(221, 228, 236, 0.459);margin: 2vh 0;overflow: hidden;">
                <div class="col-2"><img class="img-fluid"
                        src="https://img.icons8.com/color/48/000000/mastercard-logo.png" /></div>
                <div class="col-7"> <input
                        style="border: none;outline: none;font-size: 1rem;font-weight: 600;color: #000;width: 100%;min-width: unset;background-color: transparent;border-color: transparent;margin: 0;"
                        disabled type="text" placeholder="**** **** **** 3193"> </div>
                <div class="col-3 d-flex justify-content-center"> <a
                        style="color: grey;text-decoration: none;font-size: 0.87rem;font-weight: bold;" href="#">Remove
                        card</a> </div>
            </div>
        </button><br />
        <button style="all: initial; * {all: unset;};">
            <div class="row row-1"
                style="margin: 0;overflow: hidden;border: 1px solid rgba(0, 0, 0, 0.137);padding: 0.5rem;outline: none;width: 100%;min-width: unset;border-radius: 5px;background-color: rgba(221, 228, 236, 0.301);border-color: rgba(221, 228, 236, 0.459);margin: 2vh 0;overflow: hidden;">
                <div class="col-2"
                    style="border: none;outline: none;background-color: transparent;margin: 0;padding: 0 0.8rem;"><img
                        class="img-fluid" src="https://img.icons8.com/color/48/000000/visa.png" /></div>
                <div class="col-7"> <input
                        style="border: none;outline: none;font-size: 1rem;font-weight: 600;color: #000;width: 100%;min-width: unset;background-color: transparent;border-color: transparent;margin: 0;"
                        type="text" placeholder="**** **** **** 4296"> </div>
                <div class="col-3 d-flex justify-content-center"> <a
                        style="color: grey;text-decoration: none;font-size: 0.87rem;font-weight: bold;" href="#">Remove
                        card</a> </div>
            </div>
        </button><br /> <span id="card-header" style="font-weight: bold;font-size: 0.9rem">Add new card:</span>
        <div class="row-1"
            style="border: 1px solid rgba(0, 0, 0, 0.137);padding: 0.5rem;outline: none;width: 100%;min-width: unset;border-radius: 5px;background-color: rgba(221, 228, 236, 0.301);border-color: rgba(221, 228, 236, 0.459);margin: 2vh 0;overflow: hidden;">
            <div class="row row-2"
                style="border: none;outline: none;background-color: transparent;margin: 0;padding: 0 0.8rem"> <span
                    id="card-inner">Card holder name</span> </div>
            <div class="row row-2"
                style="border: none;outline: none;background-color: transparent;margin: 0;padding: 0 0.8rem"> <input
                    style="border: none;outline: none;font-size: 1rem;font-weight: 600;color: #000;width: 100%;min-width: unset;background-color: transparent;border-color: transparent;margin: 0;"
                    type="text" placeholder="Bojan Viner"> </div>
        </div>
        <div class="row three" style="margin: 0;overflow: hidden;overflow: hidden;justify-content: space-between;">
            <div class="col-7" style="padding-left: 0;">
                <div class="row-1"
                    style="border: 1px solid rgba(0, 0, 0, 0.137);padding: 0.5rem;outline: none;width: 100%;min-width: unset;border-radius: 5px;background-color: rgba(221, 228, 236, 0.301);border-color: rgba(221, 228, 236, 0.459);margin: 2vh 0;overflow: hidden;">
                    <div class="row row-2"> <span id="card-inner">Card number</span> </div>
                    <div class="row row-2"> <input
                            style="border: none;outline: none;font-size: 1rem;font-weight: 600;color: #000;width: 100%;min-width: unset;background-color: transparent;border-color: transparent;margin: 0;"
                            type="text" placeholder="5134-5264-4"> </div>
                </div>
            </div>
            <div class="col-2"
                style="border: none;outline: none;background-color: transparent;margin: 0;padding: 0 0.8rem"> <input
                    style="border: none;outline: none;font-size: 1rem;font-weight: 600;color: #000;width: 100%;min-width: unset;background-color: transparent;border-color: transparent;margin: 0;"
                    type="text" placeholder="Exp. date"> </div>
            <div class="col-2"
                style="border: none;outline: none;background-color: transparent;margin: 0;padding: 0 0.8rem"> <input
                    style="border: none;outline: none;font-size: 1rem;font-weight: 600;color: #000;width: 100%;min-width: unset;background-color: transparent;border-color: transparent;margin: 0;"
                    type="text" placeholder="CVV"> </div>
        </div> <button type="submit" name="submit" class="indigo btn d-flex mx-auto"><b>Add card</b></button>
    </form>
</div>

<?php
/**
 * m-pesa payment is implemented here
 * 
 */
?>
<?php require_once 'helpers/footer.php' ?>
</body>

</html>