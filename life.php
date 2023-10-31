  <head>
  
  <?php
// Define initial life points and hero colors
$hero_life_points = [
    "Lux, O Incendiário" => 42,
    "Spark" => 45,
    "Wolfsbane" => 42,
    "Kimerah, A Caçadora de R." => 44,
    "Void" => 37,
];

// Function to get hero color based on hero name
function getHeroColor($heroName) {
    $heroColors = [
        "Lux, O Incendiário" => "linear-gradient(135deg, #5f0c22, #e90441, #5f0c22)",
        "Spark" => "linear-gradient(135deg, #0097B2, #174D57, #0097B2)",
        "Wolfsbane" => "linear-gradient(135deg, #3e871f, #7cd655, #3e871f)",
        "Kimerah, A Caçadora de R." => "linear-gradient(135deg, #a58d2b, #fcdb57, #a58d2b)",
        "Void" => "linear-gradient(135deg, #4c0d55, #7e067d, #4c0d55)",
    ];
    return $heroColors[$heroName];
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the selected heroes
    $your_hero = $_POST["your_hero"];
    $opponent_hero = $_POST["opponent_hero"];
    
    // Update life points based on selected heroes
    $your_hero_life = $hero_life_points[$your_hero];
    $opponent_hero_life = $hero_life_points[$opponent_hero];
    
    // Get hero colors
    $your_hero_color = getHeroColor($your_hero);
    $opponent_hero_color = getHeroColor($opponent_hero);
} else {
    // Default values if form is not submitted
    $your_hero_life = 20; // Default to 20
    $opponent_hero_life = 20; // Default to 20
    $your_hero_color = getHeroColor("Lux, O Incendiário"); // Default color
    $opponent_hero_color = getHeroColor("Lux, O Incendiário"); // Default color
}
?>
<style>
  @font-face {
    font-family: 'CustomFont';
    src: url('BreeAlEgo.ttf') format('ttf'), /* specify font formats */
    /* Add more font formats as needed, like 'ttf', 'otf', etc. */
  }
:root {
  --h: 100vh;
  --w: 100vw;
  --gutter: 8px;
  
}

.app,
.page,
body,
html {
  min-height: var(--h);
  width: var(--w);
  min-width: var(--w);
  max-width: var(--w);
}
body {
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  margin: 0;
  background: #000;
  font-weight: 700;
  font-family: mono45-headline, monospace, -apple-system, BlinkMacSystemFont,
    segoe ui, Roboto, Oxygen-Sans, Ubuntu, Cantarell, helvetica neue, sans-serif;
  touch-action: manipulation;
  text-wrap: pretty;
      background: linear-gradient(135deg, #0097B2, #174D57, #0097B2);
    background-size: 200% 200%;
    background-position: 0 0;
    animation: gradientAnimation 10s ease infinite;
    margin: 0;
    font-family: 'CustomFont', BreeAlEgo;
    touch-action: manipulation;
    text-wrap: pretty;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    flex-direction: column;

}

[data-counter-ui] {
  display: none;
  flex-direction: column;
}
.playfield {
  padding: var(--gutter);
  display: flex;
  flex-grow: 1;
  flex-direction: column;
}
.group {
  display: flex;
  flex-grow: 1;
  flex-direction: column;
}
.player {
  margin: var(--gutter);
  display: flex;
  flex-grow: 1;
  position: relative;
  border-radius: 16px;
  box-shadow: inset 0 0 0 3px rgba(255, 255, 255, 0.3);
  background: <?php echo $opponent_hero_color; ?>; 
    background-size: 200% 200%;
    background-position: 0 0;
    animation: gradientAnimation 10s ease infinite;

}
.player div:nth-child(1):active ~ .wrap-life .life:before {
  background: rgba(255, 255, 255, 0.3);
}
.player div:nth-child(2):active ~ .wrap-life .life:after {
  background: rgba(255, 255, 255, 0.3);
}
.player-count-2 .p-1 {
  flex-direction: row-reverse;
}
.player-count-2 .p-1 .wrap-life {
  transform: rotate(180deg);
    border-radius: 16px;
  box-shadow: inset 0 0 0 3px rgba(255, 255, 255, 0.3);
  background: <?php echo $your_hero_color; ?>;
      background-size: 200% 200%;
    background-position: 0 0;
    animation: gradientAnimation 10s ease infinite;
  
}

.btn {
  cursor: pointer;
  display: flex;
  flex-grow: 1;
  align-items: center;
}
.btn span {
  flex-grow: 1;
}
.btn + .btn {
  text-align: right;
}
.wrap-life {
  position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  pointer-events: none;
}


.wrap-life input {
  pointer-events: auto;
  background: 0 0;
  color: #fff;
  border: none;
  text-align: center;
  font-size: 18px;


}
.wrap-life input::-moz-placeholder {
  color: rgba(255, 255, 255, 0.3);
}
.wrap-life input::placeholder {
  color: rgba(255, 255, 255, 0.3);
}
.life {
  font-size: 90px;
  color: #fff;
  text-align: center;
  display: flex;
  justify-content: center;
  align-items: center;
  margin-bottom: -0.15em;
  margin-top: 0.1em;
}
.life:after,
.life:before {
  font-size: 24px;
  width: 1em;
  line-height: 0.99em;
  height: 1em;
  background: rgba(255, 255, 255, 0.16);
  color: #fff;
  border-radius: 50%;
  transition: 0.2s ease all;
  font-weight: 500;
}
.life:before {
  content: "-";
  margin-right: 10px;
}
.life:after {
  content: "+";
  margin-left: 10px;
}

[data-btn-restart] {
  margin: 0 calc(var(--gutter) * 2) calc(var(--gutter) * 2);
  height: 48px;
  border-radius: 11px;
  border: none;
  background: rgba(255, 255, 255, 0.16);
  color: #fff;
  font-size: 22px;
  line-height: 48px;
  display: flex;
  justify-content: center;
  align-items: center;
}
[data-btn-voltar] {
  margin: 0 calc(var(--gutter) * 2) calc(var(--gutter) * 2);
  height: 48px;
  border-radius: 11px;
  border: none;
  background: rgba(255, 255, 255, 0.16);
  color: #fff;
  font-size: 22px;
  line-height: 48px;
  display: flex;
  justify-content: center;
  align-items: center;
}

@keyframes gradientAnimation {
  0% {
    background-position: 0% 0%;
  }

  50% {
    background-position: 100% 100%;
  }

  100% {
    background-position: 0% 0%;
  }
}


</style>
    <script>
        function addLife() {
            document.getElementById("your_hero_life").value++;
        }

        function removeLife() {
            document.getElementById("your_hero_life").value--;
        }
    </script>
  </head>


    <script>
        // JavaScript to handle life changes
        function changeLife(player, action) {
            var lifeElement = document.querySelector('[data-life-' + player + ']');
            var currentLife = parseInt(lifeElement.textContent);
            
            if (action === 'add') {
                currentLife += 1;
            } else if (action === 'remove') {
                currentLife -= 1;
            }
            
            lifeElement.textContent = currentLife;
        }

        // JavaScript to handle restart button click
        document.addEventListener('DOMContentLoaded', function() {
            var restartButton = document.querySelector('[data-btn-restart]');
            restartButton.addEventListener('click', function() {
                // Reset life points to initial values
                var yourHeroLife = <?php echo $hero_life_points[$your_hero]; ?>;
                var opponentHeroLife = <?php echo $hero_life_points[$opponent_hero]; ?>;
                document.querySelector('[data-life-1]').textContent = yourHeroLife;
                document.querySelector('[data-life-2]').textContent = opponentHeroLife;
            });
        });
    </script>	
	
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Life Counter</title>
</head>
<body>
    <div class="page player-count-2" data-counter-ui="" style="display: flex;">
        <div class="playfield">
            <div class="group g-1">
                <div class="player p-1">
                    <div class="btn" onclick="changeLife(1, 'remove')"></div>
                    <div class="btn" onclick="changeLife(1, 'add')"></div>
                    <div class="wrap-life">
                        <div data-life-1="" class="life"><?php echo $your_hero_life; ?></div>
                        <input type="text" value="<?php echo ucfirst($your_hero); ?>" readonly>
                    </div>
					
                </div>
				<div data-btn-restart="">Girar dado</div>
                <div class="player p-2">
                    <div class="btn" onclick="changeLife(2, 'remove')"></div>
                    <div class="btn" onclick="changeLife(2, 'add')"></div>
                    <div class="wrap-life">
                        <div data-life-2="" class="life"><?php echo $opponent_hero_life; ?></div>
                        <input type="text" value="<?php echo ucfirst($opponent_hero); ?>" readonly>
                    </div>
                </div>
            </div>
        </div>
        <div data-btn-restart="">Reiniciar</div>
		<div data-btn-voltar="" onclick="window.location.href = 'index.php'">Voltar</div>

    </div>
</body>
</html>
