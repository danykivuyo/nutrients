<?php
require_once "helpers/navbar.php";
?>

<!-- <script>
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
</script> -->
</head>

<body class="purple darken-3">
    <div id="toast-container" class="toast-container green"></div>
    <div class="container">
        <div class="section">
            <br />
            <h2 class="center-align white-text">
                RF Powered Nutrient Data Collector
            </h2>
            <p class="flow-text center-align white-text">
                Collecting and analyzing data from nutrient measuring sensor nodes powered by
                <br><mark style="background-color: yellow;">
                    Radio Frequency Harvesting.
                </mark>
            </p>
        </div>

        <div class="section">
            <div class="row">
                <div class="col s12 m6">
                    <div class="card-panel purple white z-depth-5">
                        <span class="black-text">
                            <h5 class="center-align">Real-Time Data</h5>
                            <p>
                                View real-time data from your nutrient measuring module. Get insights and analytics
                                to improve your nutrient management.
                            </p>
                        </span>
                    </div>
                </div>
                <div class="col s12 m6">
                    <div class="card-panel purple white z-depth-5">
                        <span class=" black-text">
                            <h5 class="center-align">Historical Data</h5>
                            <p>
                                Access historical data and trends to track your nutrient levels over time.
                                Make informed decisions based on detailed analysis.
                            </p>
                        </span>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- Import Materialize CSS and JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <?php
    require_once "helpers/footer.php";
    ?>
</body>