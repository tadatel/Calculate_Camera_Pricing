<?php
/*
Plugin Name: Camera Price Calculator
Description: Calculate installation pricing based on 5 inputs.
Version: 1.0
Author: Mathijs Hoek
*/

// Register the shortcode
function register_camera_price_shortcode() {
    add_shortcode('camera_price_calc', 'camera_price_form');
}
add_action('init', 'register_camera_price_shortcode');

// Shortcode content
function camera_price_form() {
    ob_start(); ?>
    
    <style>
    #camera-price-wrapper {
        width: 100%;
        max-width: 600px;
        margin: 30px auto;
        padding: 25px;
        border: 1px solid #ddd;
        border-radius: 12px;
        background: #fafafa;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        font-family: Arial, sans-serif;
    }
    #camera-price-wrapper h2 {
        text-align: center;
        margin-bottom: 20px;
        color: #0073aa;
    }
    #camera-price-wrapper label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
        color: #333;
    }
    #camera-price-wrapper input,
    #camera-price-wrapper select {
        width: 100%;
        padding: 12px;
        margin-bottom: 15px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 8px;
        box-sizing: border-box;
    }
    #camera-price-wrapper button {
        width: 100%;
        padding: 14px;
        background-color: #0073aa;
        color: white;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-weight: bold;
        transition: 0.2s ease;
    }
    #camera-price-wrapper button:hover {
        background-color: #005f8d;
    }
    #camera-price-result {
        margin-top: 20px;
        padding: 15px;
        background: #f7f7f7;
        border-radius: 10px;
        border: 1px solid #ddd;
        font-size: 20px;
        text-align: center;
        display: none;
    }
    .radio-group {
        display: flex;
        justify-content: center;
        gap: 20px; /* ruimte tussen de radio buttons */
    }
    .radio-group label {
        cursor: pointer;
    }
    .radio-group input[type="radio"] {
        margin-right: 5px; /* kleine ruimte tussen bol en tekst */
    }
    </style>

    <div id="camera-price-wrapper">
        <h2>Bereken uw installatieprijs</h2>

        <label for="meters">Meters kabel</label>
        <input type="number" id="meters" placeholder="Aantal meters" required>

        <label for="type-kabel">Type kabel</label>
        <select id="type-kabel" required>
            <option value="" disabled selected hidden>Selecteer type kabel</option>
            <option value="2">Cat 5</option>
            <option value="3">Cat 6</option>
        </select>

        <label for="montage">Montage</label>
        <select id="montage" required>
            <option value="" disabled selected hidden>Selecteer montage</option>
            <option value="150">Luxe (€150)</option>
            <option value="75">Gewoon (€75)</option>
        </select>

        <label for="camera-aantal">Aantal camera's</label>
        <input type="number" id="camera-aantal" placeholder="Aantal camera's" required>

        <label for="recorder-aantal">Aantal recorders</label>
        <input type="number" id="recorder-aantal" placeholder="Aantal recorders" required>

        <label>POE-switch</label>
        <div class="radio-group">
            <label><input type="radio" name="poe" value="1" required> Ja</label>
            <label><input type="radio" name="poe" value="0" required> Nee</label>
        </div>

        <button id="calculate-btn">Bereken prijs</button>

        <div id="camera-price-result"></div>
    </div>



    <script>
        document.getElementById("calculate-btn").addEventListener("click", function() {

        const meters = parseFloat(document.getElementById("meters").value) || 0;
        const typeKabel = parseInt(document.getElementById("type-kabel").value) || 0; // 2 of 3
        const montage = parseFloat(document.getElementById("montage").value) || 0; // 150 of 75
        const cameras = parseInt(document.getElementById("camera-aantal").value) || 0;
        const recorders = parseInt(document.getElementById("recorder-aantal").value) || 0;
        const poe = parseInt(document.querySelector('input[name="poe"]:checked').value) ? 75 : 0;

        // Berekening
        let total = (meters * typeKabel) + montage + (cameras * 75) + (recorders * 50) + poe;

        // Resultaat tonen
        const resultBox = document.getElementById("camera-price-result");
        resultBox.style.display = "block";
        resultBox.innerHTML = "Totale prijs: € " + total.toFixed(2);

        });
    </script>

    <?php
    return ob_get_clean();
}
?>
