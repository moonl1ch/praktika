document.addEventListener('DOMContentLoaded', () => {
    const welcomeScreen = document.getElementById('welcome-screen');
    const gameScreen = document.getElementById('game-screen');
    const resultScreen = document.getElementById('result-screen');
    const gameOverScreen = document.getElementById('game-over-screen');

    const startButton = document.getElementById('start-button');
    const playerNameInput = document.getElementById('player-name');
    const playerDisplay = document.getElementById('player-display');
    const timeDisplay = document.getElementById('time-display');
    const powerDisplay = document.getElementById('power-display');
    const scoreDisplay = document.getElementById('score-display');
    const player = document.getElementById('player');
    const gameArea = document.getElementById('game-area');

    let playerName = '';
    let timer;
    let time = 0;
    let power = 50;
    let score = 0;
    let gameInterval;
    let walls = [];
    let batteries = [];
    let isPaused = false;
    let isGameOver = false;
    let playerVelocity = 0;
    const playerSpeed = 5;

    playerNameInput.addEventListener('input', () => {
        startButton.disabled = !playerNameInput.value.trim();
    });

    startButton.addEventListener('click', startGame);
    document.getElementById('restart-button').addEventListener('click', restartGame);
    document.getElementById('restart-button-2').addEventListener('click', restartGame);
    document.addEventListener('keydown', handleKeydown);
    document.addEventListener('keyup', handleKeyup);

    function startGame() {
        playerName = playerNameInput.value.trim();
        playerDisplay.textContent = `Имя: ${playerName}`;
        time = 0;
        power = 50;
        score = 0;
        isPaused = false;
        isGameOver = false;
        clearGameArea();
        updateDisplay();
        switchScreen(gameScreen);
        startTimer();
        startGameLoop();
    }

    function restartGame() {
        clearInterval(timer);
        cancelAnimationFrame(gameInterval);
        switchScreen(welcomeScreen);
    }

    function handleKeydown(event) {
        if (event.key === 'ArrowUp') {
            playerVelocity = -playerSpeed;
        } else if (event.key === 'ArrowDown') {
            playerVelocity = playerSpeed;
        } else if (event.key === 'Escape') {
            pauseGame();
        }
    }

    function handleKeyup(event) {
        if (event.key === 'ArrowUp' || event.key === 'ArrowDown') {
            playerVelocity = 0;
        }
    }

    function movePlayer() {
        let currentTop = parseFloat(player.style.top || '50%');
        currentTop += playerVelocity;
        currentTop = Math.max(0, Math.min(gameArea.offsetHeight - player.offsetHeight, currentTop));
        player.style.top = `${currentTop}px`;
    }

    function startTimer() {
        timer = setInterval(() => {
            if (!isPaused && !isGameOver) {
                time++;
                power = Math.max(0, power - 1);
                updateDisplay();
                if (power <= 0) {
                    endGame(false);
                }
            }
        }, 1000);
    }

    function updateDisplay() {
        timeDisplay.textContent = formatTime(time);
        powerDisplay.textContent = `${power}%`;
        scoreDisplay.textContent = `Очки: ${score}`;
    }

    function formatTime(seconds) {
        const minutes = Math.floor(seconds / 60);
        const remainingSeconds = seconds % 60;
        return `${minutes.toString().padStart(2, '0')}:${remainingSeconds.toString().padStart(2, '0')}`;
    }

    function startGameLoop() {
        gameInterval = requestAnimationFrame(gameLoop);
    }

    function gameLoop() {
        if (!isPaused && !isGameOver) {
            updateGameArea();
            movePlayer();
            if (checkCollision()) {
                endGame(false);
            }
            if (collectBattery()) {
                power = Math.min(100, power + 5);
                score += 10;
            }
            updateDisplay();
            gameInterval = requestAnimationFrame(gameLoop);
        }
    }

    function updateGameArea() {
        const backgroundPositionX = (parseInt(gameArea.style.backgroundPositionX || '0') - 2) % gameArea.offsetWidth;
        gameArea.style.backgroundPositionX = `${backgroundPositionX}px`;
        createWallsAndBatteries();
        moveWallsAndBatteries();
    }

    function createWallsAndBatteries() {
        if (Math.random() < 0.02) {
            const wallHeight = Math.floor(Math.random() * 400) + 100;
            const wallTop = Math.random() < 0.5 ? 0 : gameArea.offsetHeight - wallHeight;
            const wall = document.createElement('div');
            wall.className = 'wall';
            wall.style.height = `${wallHeight}px`;
            wall.style.top = `${wallTop}px`;
            wall.style.left = `${gameArea.offsetWidth}px`;
            gameArea.appendChild(wall);
            walls.push(wall);
        }

        if (Math.random() < 0.01) {
            const batteryTop = Math.floor(Math.random() * (gameArea.offsetHeight - 30));
            const battery = document.createElement('div');
            battery.className = 'battery';
            battery.style.top = `${batteryTop}px`;
            battery.style.left = `${gameArea.offsetWidth}px`;
            gameArea.appendChild(battery);
            batteries.push(battery);
        }
    }

    function moveWallsAndBatteries() {
        walls.forEach((wall, index) => {
            const leftPosition = parseFloat(wall.style.left) - 2;
            if (leftPosition + wall.offsetWidth < 0) {
                wall.remove();
                walls.splice(index, 1);
            } else {
                wall.style.left = `${leftPosition}px`;
            }
        });

        batteries.forEach((battery, index) => {
            const leftPosition = parseFloat(battery.style.left) - 2;
            if (leftPosition + battery.offsetWidth < 0) {
                battery.remove();
                batteries.splice(index, 1);
            } else {
                battery.style.left = `${leftPosition}px`;
            }
        });
    }

    function checkCollision() {
        return walls.some(wall => {
            const playerRect = player.getBoundingClientRect();
            const wallRect = wall.getBoundingClientRect();
            return (
                playerRect.left < wallRect.left + wallRect.width &&
                playerRect.left + playerRect.width > wallRect.left &&
                playerRect.top < wallRect.top + wallRect.height &&
                playerRect.top + playerRect.height > wallRect.top
            );
        });
    }

    function collectBattery() {
        return batteries.some((battery, index) => {
            const playerRect = player.getBoundingClientRect();
            const batteryRect = battery.getBoundingClientRect();
            const collected = (
                playerRect.left < batteryRect.left + batteryRect.width &&
                playerRect.left + playerRect.width > batteryRect.left &&
                playerRect.top < batteryRect.top + batteryRect.height &&
                playerRect.top + playerRect.height > batteryRect.top
            );

            if (collected) {
                battery.remove();
                batteries.splice(index, 1);
            }

            return collected;
        });
    }

    function endGame(success) {
        clearInterval(timer);
        cancelAnimationFrame(gameInterval);
        isGameOver = true;
        switchScreen(success ? resultScreen : gameOverScreen);
        if (success) {
            document.getElementById('result-display').textContent = `Вы выжили! Время: ${formatTime(time)}, Очки: ${score}`;
        } else {
            document.getElementById('result-display').textContent = `Вы проиграли! Время: ${formatTime(time)}, Очки: ${score}`;
        }
    }

    function switchScreen(screen) {
        document.querySelectorAll('.screen').forEach(s => s.classList.remove('active-screen'));
        screen.classList.add('active-screen');
    }

    function pauseGame() {
        isPaused = !isPaused;
        if (!isPaused) {
            startGameLoop();
        }
    }

    function clearGameArea() {
        walls.forEach(wall => wall.remove());
        batteries.forEach(battery => battery.remove());
        walls = [];
        batteries = [];
        player.style.top = '50%';
        playerVelocity = 0;
    }
});
