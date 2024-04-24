<?php
require_once "helpers/navbar.php";
?>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        var words = [
            "MLRS - Machine Learning with Remote Sensing",
            "Machine Learning Models with Remote Sensing for the Detection, Quantification, and Forecasting of Greenhouse Gas Emissions from Ruminant Livestock"
        ];
        var index = 0;
        var wordIndex = 0;
        var currentWord = "";
        var typingInterval;

        function startTyping() {
            if (index >= words.length) {
                index = 0;
            }

            currentWord = words[index];
            typingInterval = setInterval(typeCharacter, 50);
        }

        function typeCharacter() {
            if (wordIndex < currentWord.length) {
                var typingText = document.getElementById("typing-text");
                typingText.innerHTML += currentWord[wordIndex];
                wordIndex++;
            } else {
                clearInterval(typingInterval);
                setTimeout(deleteCharacter, 1000);
            }
        }

        function deleteCharacter() {
            typingInterval = setInterval(deleteChar, 50);
        }

        function deleteChar() {
            var typingText = document.getElementById("typing-text");
            typingText.innerHTML = typingText.innerHTML.slice(0, -1);

            if (typingText.innerHTML.length === 0) {
                clearInterval(typingInterval);
                wordIndex = 0;
                index++;
                setTimeout(startTyping, 500);
            }
        }

        startTyping();
    });
</script>
</head>

<body>
    <div class="row">
        <div class="container col s12 m10 offset-m1 l8 offset-l2">
            <br />
            <br />
            <div>
                <h2 style="min-height: 350px">
                    <p id="typing-text"></p>
                </h2>
            </div>
            <div class="card hoverable">
                <div class="card-image">
                    <img src="<?php echo URLROOT . "/img"; ?>/plant.png" class="responsive-img">
                </div>
                <div class="card-content">
                    <p class="home-text flow-text green-text">Greenhouse gas(GHG)  emissions such as methane (CH4), carbon dioxide (CO2), and nitrous oxide (N2O)  from ruminant livestock pose significant challenges to environmental sustainability in Tanzania and Sub-Saharan Africa. However, by harnessing the power of machine learning and remote sensing, we can effectively tackle these challenges. By implementing sustainable livestock management practices and adopting climate-smart agriculture, we can reduce emissions while promoting productivity and resilience in the agricultural sector. Let us work together to protect our environment, ensure food security, and create a sustainable future for Tanzania and Sub-Saharan Africa as a whole.
                        
                    </p>
                </div>
                <div class="card-action">
                    <a href="#" class="waves-effect waves-light btn green">READ MORE</a>
                </div>
            </div>
        </div>
    </div>
</body>

<?php
require_once "helpers/footer.php";
?>