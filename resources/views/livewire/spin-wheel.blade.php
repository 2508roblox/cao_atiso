<div class="min-h-screen bg-green-700 flex flex-col items-center justify-center py-8 px-2">
    <div class="w-full max-w-md mx-auto">
        <div class="glass-card p-8 rounded-2xl shadow-2xl animate-slide-in-up bg-white backdrop-blur-md">
            <div class="flex flex-col items-center">
                <div id="spin_the_wheel" class="relative flex flex-col items-center justify-center" style="width:400px;height:400px;">
                    <canvas id="wheel" width="400" height="400"></canvas>
                    <div id="spin" class="absolute z-30 top-1/2 left-1/2 flex items-center justify-center" style="transform:translate(-50%,-50%);font-family:'Lato',sans-serif;font-size:1.1em;width:120px;height:120px;background:#fff;color:#111; border:4px solid #111;border-radius:50%;cursor:pointer;transition:0.8s;user-select:none;">
                        <div style="position:absolute;top:-16px;left:50%;transform:translateX(-50%);z-index:40;pointer-events:none;">
                            <svg width="18" height="18" viewBox="0 0 32 32"><polygon points="16,0 31,28 1,28" fill="#111"/></svg>
                        </div>
                        <span id="spin-text" style="position:relative;z-index:10;">SPIN</span>
                    </div>
                </div>
                <div id="final-value" class="mt-8 text-center text-lg font-semibold text-green-700">
                    <p>Nhấn nút Quay để bắt đầu!</p>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Sectors config
        const sectors = [
          { color: "#FFBC03", text: "#333333", label: "Sweets" },
          { color: "#FF5A10", text: "#333333", label: "Prize draw" },
          { color: "#FFBC03", text: "#333333", label: "Sweets" },
          { color: "#FF5A10", text: "#333333", label: "Prize draw" },
          { color: "#FFBC03", text: "#333333", label: "Sweets + Prize draw" },
          { color: "#FF5A10", text: "#333333", label: "You lose" },
          { color: "#FFBC03", text: "#333333", label: "Prize draw" },
          { color: "#FF5A10", text: "#333333", label: "Sweets" },
        ];

        // Event system
        const events = {
          listeners: {},
          addListener: function (eventName, fn) {
            this.listeners[eventName] = this.listeners[eventName] || [];
            this.listeners[eventName].push(fn);
          },
          fire: function (eventName, ...args) {
            if (this.listeners[eventName]) {
              for (let fn of this.listeners[eventName]) {
                fn(...args);
              }
            }
          },
        };

        const rand = (m, M) => Math.random() * (M - m) + m;
        const tot = sectors.length;
        const spinEl = document.querySelector("#spin");
        const ctx = document.querySelector("#wheel").getContext("2d");
        const dia = ctx.canvas.width;
        const rad = dia / 2;
        const PI = Math.PI;
        const TAU = 2 * PI;
        const arc = TAU / sectors.length;

        const friction = 0.991; // 0.995=soft, 0.99=mid, 0.98=hard
        let angVel = 0; // Angular velocity
        let ang = 0; // Angle in radians

        let spinButtonClicked = false;

        const getIndex = () => Math.floor(tot - (ang / TAU) * tot) % tot;

        function drawSector(sector, i) {
          const ang0 = arc * i;
          ctx.save();

          // COLOR
          ctx.beginPath();
          ctx.fillStyle = sector.color;
          ctx.moveTo(rad, rad);
          ctx.arc(rad, rad, rad, ang0, ang0 + arc);
          ctx.lineTo(rad, rad);
          ctx.fill();

          // TEXT
          ctx.translate(rad, rad);
          ctx.rotate(ang0 + arc / 2);
          ctx.textAlign = "right";
          ctx.fillStyle = sector.text;
          ctx.font = "bold 16px 'Lato', sans-serif";
          ctx.fillText(sector.label, rad - 18, 10);

          ctx.restore();
        }

        function rotate() {
          const sector = sectors[getIndex()];
          ctx.canvas.style.transform = `rotate(${ang - PI / 2}rad)`;

          document.getElementById('spin-text').textContent = !angVel ? "SPIN" : sector.label;
          spinEl.style.background = sector.color;
          spinEl.style.color = sector.text;
        }

        function frame() {
          // Fire an event after the wheel has stopped spinning
          if (!angVel && spinButtonClicked) {
            const finalSector = sectors[getIndex()];
            events.fire("spinEnd", finalSector);
            spinButtonClicked = false; // reset the flag
            return;
          }

          angVel *= friction; // Decrement velocity by friction
          if (angVel < 0.002) angVel = 0; // Bring to stop
          ang += angVel; // Update angle
          ang %= TAU; // Normalize angle
          rotate();
        }

        function engine() {
          frame();
          requestAnimationFrame(engine);
        }

        function init() {
          sectors.forEach(drawSector);
          rotate(); // Initial rotation
          engine(); // Start engine
          spinEl.addEventListener("click", () => {
            if (!angVel) angVel = rand(0.25, 0.45);
            spinButtonClicked = true;
          });
        }

        init();

        events.addListener("spinEnd", (sector) => {
          document.getElementById('final-value').innerHTML = `<p>Kết quả: <span class='text-green-700 font-bold text-xl'>${sector.label}</span></p>`;
        });
    </script>
</div>
