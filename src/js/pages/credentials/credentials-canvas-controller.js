const CANVAS = document.getElementById("background-elements-canvas");
const CTX = CANVAS.getContext('2d');
const BALL_MAX_SIZE = 5;
const BALL_MIN_SIZE = 60;

function SetCanvasSize()
{
   CANVAS.width = window.innerWidth;
   CANVAS.height = window.innerHeight;
}

SetCanvasSize();
window.addEventListener("resize", SetCanvasSize);

BALLS = [];
function Overlay(x1, y1, radius1, x2, y2, radius2)
{
   for(const BALL of BALLS)
   {
      const distance = Math.sqrt((x1 - x2) ** 2 + (y1 - y2) ** 2);
      return distance < radius1 + radius2;
   }
}

const BALL_COLOURS = ['#D96021', '#FD2C30', '#27DB67', '#F0932D', '#D92194', '#8621D9', '#21D4D9', '#CBD921', '#EFE47C'];
const BALLS_AMOUNT = 12;

function DrawCircles() {
   for (let i = 0; i < BALLS_AMOUNT; i++) {
      const RADIUS = Math.random() * (BALL_MAX_SIZE - BALL_MIN_SIZE) + BALL_MIN_SIZE;
       let x, y;

       let overlayed;
       do {
           x = Math.random() * (CANVAS.width - RADIUS * 2) + RADIUS;
           y = Math.random() * (CANVAS.height - RADIUS * 2) + RADIUS;

           overlayed = false;
           for(const BALL of BALLS)
           {
               if(Overlay(x, y, RADIUS, BALL.x, BALL.y, BALL.RADIUS))
               {
                  overlayed = true;
                  break;
               }
           }

       } while (overlayed);

       const BALL_COLOUR = BALL_COLOURS[Math.floor(Math.random() * BALL_COLOURS.length)];

       CTX.beginPath();
       CTX.arc(x, y, RADIUS, 0, Math.PI * 2);
       CTX.fillStyle = BALL_COLOUR;
       CTX.fill();

       BALLS.push({ x, y, RADIUS });
   }
}

DrawCircles();