<?php
    // Variables
    $num1 = 0;
    $num2 = 0;
    $result = 0;
    $operator = "";
    $error = "";
    // Default decimal = 2
    $precision = 2;

    if(isset($_POST["submit"]))
    {
        $num1 = $_POST['num1'];
        $num2 = $_POST['num2'];
        $operator = $_POST['operator'];

        // Let user choose how many decimals he wants
        if(is_numeric($_POST['sliderDecimals']))
        {
        $precision = $_POST['sliderDecimals'];
        }

        // Display error when num1 and num2 are empty
        if (empty($num1) && empty($num2))
        {
            $error = "Please enter all numbers";
        }

        // Check number values
        else if (is_numeric($num1) && is_numeric($num2))
        {
            if($operator == "plus")
            { 
                $result = $num1 + $num2;
            }
            
            if($operator == "multiply")
            {
                $result = $num1 * $num2;
            }
            
            if($operator == "divide")
            {
                if($num2 == 0)
                {
                    $error = "You cannot divide by 0";
                }
                else
                {
                    $result = $num1 / $num2;
                }
            }
            
            if($operator == "min")
            {
                $result = $num1 - $num2;
            }

            if($operator== "power")
            {
                $result = pow($num1,$num2);
            }
        }

        else if (is_numeric($num1))
        {
            if($operator == "sqrt")
            {
                if($num1 < 0)
                {
                    $error = "You cannot use negative numbers";
                }
                else
                {
                    $result = sqrt($num1);
                }

            }
        }

        if($operator == "mileKM")
        {
            $result = $num1 * 1.609;
        }

        if($operator == "KMmile")
        {
            $result = $num1 * 0.621;
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name ="description" content="Calculator with PHP">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <title>Calculator++</title>
</head>
    <body>
        <!-- Giving body the darkmode button class id -->
        <div id="dark-mode-button" onclick="darkModeButtonClick()">
            Dark / Light mode
        </div>
            <div class="container">
                <div class="top-part">
                    <!-- Echo result in top-part to see answer -->
                    <?php
                    if($error != "")
                    {
                        echo $error;
                    }
                    else
                    {
                        $result = round($result, $precision);
                        echo $result;
                    }
                    ?>
                </div>
            <div class="top-dash"></div>
            <div class="bottom-part">
                <form method="POST" action="">
                    <ul>
                        <li>
                            <!-- Define what Number 1 is -->
                            <label>Number 1</label>
                            <input name="num1" class="input-numbers" type="number" value="" placeholder="Your first number">
                        </li>
                        <li>
                            <!-- Operator list -->
                            <label>Operator</label>
                            <select name="operator" id="operator-list">
                                <option value="plus">+</option>
                                <option value="min">-</option>
                                <option value="multiply">*</option>
                                <option value="divide">/</option>
                                <option value="sqrt">Extraction of roots</option>
                                <option value="power">Power</option>
                                <option value="mileKM">Mile to kilometer</option>
                                <option value="KMmile">Kilometer to mile</option>
                            </select>
                        </li>
                        <!-- Define what Number 2 is -->
                        <li id="second-input">
                            <label>Number 2</label>
                            <input name="num2" class="input-numbers" type="number" value="" placeholder="Your second number">
                        </li>   
                        <li>
                            <!-- Define what Decimals is and adding a range slider -->
                            <label>Decimals:</label>
                            <input id="decimals-input" class="input-numbers-decimals" type="text" name="sliderDecimals" placeholder="How many decimals?" readonly/>
                            <input id="decimals-slider" class="range-slider" type="range" min="1" max="10" step="1" value="1">
                        </li>
                        <li>
                            <!-- Define what btn-calculate and reset does -->
                            <input class="btn-calculate" name="submit" type="submit" value="Calculate">
                            <input class="btn-reset" name="reset" type="submit" value="Reset">
                        </li>
                    </ul>
                </form>
            </div>
        </div>  
        <!-- Add js to get the decimalslider working -->
        <script type="text/javascript">
            let decimalSlider = document.getElementById("decimals-slider");
            let decimalsInput = document.getElementById("decimals-input");

            decimalSlider.oninput = function() {
                decimalsInput.value = this.value;
                console.log(decimalsInput.value);
            }
            console.log(decimalsInput.value);

            // Hide second input from "sqrt"
            let operatorlist = document.getElementById("operator-list");
            let secondInput = document.getElementById("second-input");

            operatorlist.oninput = function() {
                let selectedOperator = this.value;
                if (selectedOperator == "sqrt") {
                    secondInput.style.display = "none";
                } else if (selectedOperator == "mileKM"){
                    
                    secondInput.style.display = "none";
                }
                else if (selectedOperator == "KMmile"){
                    
                    secondInput.style.display = "none";
                }
                else {
                    secondInput.style.display = "block";
                }
            }

            // Define what will happen when click on darkmodebutton
            let darkModeButtonClick = function() {
                if (document.body.className == "darkmode") {
                    document.body.className = ""
                    document.body.className = localStorage.darkmode = "";
                } else {
                    document.body.className = localStorage.darkmode = "darkmode";
                    document.body.className = "darkmode"
                }
            }

            // Save option darkmode in localStorage so the option will stay when refreshing the browser
            document.body.className = localStorage.darkmode;
        </script>
    </body>
</html>