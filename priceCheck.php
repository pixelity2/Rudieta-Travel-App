<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Price Checker</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="navbar.css">
    <link rel="stylesheet" href="form.css">
</head>
<body>
    <div class="navbar">
        <ul>
            <li><a href="index.php">Home</a></li>
          <li><a href="tips.php">Tips while Traveling</a></li>
          <li><a href="forum.php">Travel Forum</a></li>
          <li><a href="book.php">Book a Trip</a></li>
        </ul>
    </div>
    <h1>Rudieta Travel Price Checker</h1>
    <br>
    <form action="" method="get">
        <label for="from">FROM: </label><br>
        <select name="from" id="from">
            <optgroup label="Near You Airports">
                <option value="SKP">Skopje, North Macedonia</option>
                <option value="PRN">Prishtina, Kosovo</option>
                <option value="TIA">Tirana, Albania</option>
            </optgroup>
                
        </select>
        <br>
        <label for="to">TO: </label><br>
        <select name="to" id="to">
            <optgroup label="Europe">
                <option value="IST">Istanbul, Turkiye</option>
                <option value="LIS">Lisbon, Portugal</option>
                <option value="LND">London, UK</option>
                <option value="PAS">Paris, France</option>
                <option value="ROM">Rome, Italy</option>
            </optgroup>
            <optgroup label="Asia">
                <option value="ANT">Antalya, Turkiye</option>
                <option value="BEJ">Beijing, China</option>
                <option value="MUM">Mumbai, India</option>
                <option value="SEO">Seoul, South Korea</option>
                <option value="TOK">Tokyo, Japan</option>
            </optgroup>
            <optgroup label="America">
                <option value="ARZ">Arizona, US</option>
                <option value="BUE">Buenos Aires, Argentina</option>
                <option value="NYC">New York City, US</option>
                <option value="SFR">San Francisco, US</option>
                <option value="SPL">Sao Paulo, Brazil</option>
            </optgroup>
        </select>
        <br>
        <label for="days">DAYS </label><br>
        <select name="days" id="days">
            <option value="7">7-DAY Trip</option>
            <option value="14">14-DAY Trip</option>
            <option value="21">21-DAY Trip</option>
        </select>
        <br><br>
        
    <?php
    $priceModifier = 5;
    $prices = array(
        'SKP' => array(
            'IST' => array(1099, 1999, 2799),
            'LIS' => array(1999, 3499, 4999),
            'LND' => array(1499, 2799, 3999),
            'PAS' => array(1499, 2799, 3999),
            'ROM' => array(799, 1499, 2149),
            'ANT' => array(1099, 1999, 2799),
            'BEJ' => array(7999, 13999, 19999),
            'MUM' => array(7999, 13999, 19999),
            'SEO' => array(5999, 9999, 15999),
            'TOK' => array(4999, 8999, 12999),
            'ARZ' => array(2999, 4999, 7499),
            'BUE' => array(7999, 13999, 19999),
            'NYC' => array(2499, 4499, 6999),
            'SFR' => array(3799, 6999, 9999),
            'SPL' => array(6999, 12999, 19999)
        ),
        'PRN' => array(
            'IST' => array(1209, 2199, 3079),
            'LIS' => array(2199, 3849, 5499),
            'LND' => array(1649, 3079, 4399),
            'PAS' => array(1649, 3079, 4399),
            'ROM' => array(879, 1649, 2364),
            'ANT' => array(1209, 2199, 3079),
            'BEJ' => array(8799, 15399, 21999),
            'MUM' => array(8799, 15399, 21999),
            'SEO' => array(6599, 10989, 17598),
            'TOK' => array(5499, 9899, 14289),
            'ARZ' => array(3299, 5499, 8249),
            'BUE' => array(8799, 15399, 21999),
            'NYC' => array(2749, 4949, 7699),
            'SFR' => array(4169, 7699, 10998),
            'SPL' => array(7699, 14289, 21999)
        ),
        'TIA' => array(
            'IST' => array(1130, 2060, 2883),
            'LIS' => array(2060, 3605, 5149),
            'LND' => array(1544, 2883, 4159),
            'PAS' => array(1544, 2883, 4159),
            'ROM' => array(823, 1544, 2213),
            'ANT' => array(1130, 2060, 2883),
            'BEJ' => array(8239, 14319, 20799),
            'MUM' => array(8239, 14319, 20799),
            'SEO' => array(6179, 10198, 16398),
            'TOK' => array(5149, 9269, 13388),
            'ARZ' => array(3089, 5149, 7724),
            'BUE' => array(8239, 14319, 20799),
            'NYC' => array(2573, 4643, 7500),
            'SFR' => array(3927, 7209, 10399),
            'SPL' => array(7209, 13388, 20799)
        )
    );
    echo "<button>Check Price</button><br>
</form>
<a href='book.php' target='_blank'><button>Book a Trip</button></a>";
    if(isset($_GET['from']) && isset($_GET['to'])){
        $from = $_GET['from'];
        $to = $_GET['to'];
        $days = $_GET['days'];

        if(array_key_exists($from, $prices) && array_key_exists($to, $prices[$from])){
            echo "<h2>Prices from $from to $to:</h2>";
            $pricePercentage = ($priceModifier / 100);
            if($days == 7){
                $priceOptions = $prices[$from][$to][0];
                $priceModified = $priceOptions + ($pricePercentage * $priceOptions);
                echo "7-DAY Trip $priceModified €";
            } else if($days == 14){
                $priceOptions = $prices[$from][$to][1];
                $priceModified = $priceOptions + ($pricePercentage * $priceOptions);
                echo "14-DAY Trip $priceModified €";
            }
            else if($days == 21){
                $priceOptions = $prices[$from][$to][2];
                $priceModified = $priceOptions + ($pricePercentage * $priceOptions);
                echo "21-DAY Trip $priceModified €";
            } else{
                echo "Destination not found.";
            };
            echo "<br>";

        }
    };
    echo "<br><i>Prices include Taxes and Fees and are in € (EURO) per person.</i><br>
    <i>In the Trip is included: Travel to destination, Food and Hotel, up to 10kg checked bag.</i><br>";
    if($priceModifier == 0){
        echo '<h2>Prices right now are as usual</h2>';
    } else if($priceModifier < 0){
        echo "<h2>Prices right now are lower than usual by $priceModifier %. You should book right now. </h2>";
    }
    else if($priceModifier > 0){
        echo "<h2>Prices right now are higher than usual by $priceModifier %. Maybe try booking later for better pricing.</h2>";
    };
?>


  <script>
        window.addEventListener('DOMContentLoaded', (event) => {
            const urlParams = new URLSearchParams(window.location.search);
            const fromParam = urlParams.get('from');
            const toParam = urlParams.get('to');
            const daysParam = urlParams.get('days');

            if (fromParam && toParam) {
                const fromSelect = document.getElementById('from');
                const toSelect = document.getElementById('to');
                const daysSelect = document.getElementById('days');

                fromSelect.value = fromParam;
                toSelect.value = toParam;
                daysSelect.value = daysParam;
            }
        });
    </script>
</body>
</html>
