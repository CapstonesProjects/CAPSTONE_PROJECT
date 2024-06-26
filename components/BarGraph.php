<!-- component -->
<div class="antialiased sans-serif  w-lg min-h-screen ">
  <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
  <style>
    body {
      font-family: 'IBM Plex Mono', sans-serif;
    }

    [x-cloak] {
      display: none;
    }

    .line {
      background: repeating-linear-gradient(to bottom,
          #eee,
          #eee 1px,
          #fff 1px,
          #fff 8%);
    }

    .tick {
      background: repeating-linear-gradient(to right,
          #eee,
          #eee 1px,
          #fff 1px,
          #fff 5%);
    }
  </style>


<div class="card-main-container flex max-w-screen max-h-screen overflow-auto">
    <div class="card-container flex flex-col m-2 flex-grow p-4 bg-green-500 shadow-md rounded-md max-w-screen max-h-screen mt-5">
      <div class="card p-3">
        <div class="card-title text-white font-bold text-xl mb-2">Total Violation Cases</div>
        <div class="card-body text-white font-semibold text-lg">1,000</div>
      </div>
    </div>
    <div class="card-container flex flex-col m-2 flex-grow p-4 bg-blue-400 shadow-md rounded-md max-w-screen max-h-screen mt-5">
      <div class="card p-3">
        <div class="card-title text-white font-bold text-xl mb-2">Resolved Cases</div>
        <div class="card-body text-white font-semibold text-lg">800</div>
      </div>
    </div>
    <div class="card-container flex flex-col m-2 flex-grow p-4 bg-red-400 shadow-md rounded-md max-w-screen max-h-screen mt-5">
      <div class="card p-3">
        <div class="card-title text-white font-bold text-xl mb-2">Pending Cases</div>
        <div class="card-body text-white font-semibold text-lg">200</div>
      </div>
    </div>
</div>

  <div x-data="app()" x-cloak class="px-4 w-11/12 h-64">
    <div class="py-10">
      <div class="shadow p-6 rounded-lg bg-white">
        <div class="md:flex md:justify-between md:items-center">
          <div>
            <h2 class="text-xl text-gray-800 font-bold leading-tight">Cases</h2>
            <p class="mb-2 text-gray-600 text-sm">Monthly Average</p>
          </div>

          <!-- Legends -->
          <div class="mb-4">
            <div class="flex items-center">
              <div class="w-2 h-2 bg-blue-600 mr-2 rounded-full"></div>
              <div class="text-sm text-gray-700">cases</div>
            </div>
          </div>
        </div>


        <div class="line my-8 relative">
          <!-- Tooltip -->
          <template x-if="tooltipOpen == true">
            <div x-ref="tooltipContainer" class="p-0 m-0 z-10 shadow-lg rounded-lg absolute h-auto block" :style="`bottom: ${tooltipY}px; left: ${tooltipX}px`">
              <div class="shadow-xs rounded-lg bg-white p-2">
                <div class="flex items-center justify-between text-sm">
                  <div>Cases:</div>
                  <div class="font-bold ml-2">
                    <span x-html="tooltipContent"></span>
                  </div>
                </div>
              </div>
            </div>
          </template>

          <!-- Bar Chart -->
          <div class="flex -mx-2 items-end mb-2">
            <template x-for="data in chartData">

              <div class="px-2 w-1/6">
                <div :style="`height: ${data}px`" class="transition ease-in duration-200 bg-blue-600 hover:bg-blue-400 relative" @mouseenter="showTooltip($event); tooltipOpen = true" @mouseleave="hideTooltip($event)">
                  <div x-text="data" class="text-center absolute top-0 left-0 right-0 -mt-6 text-gray-800 text-sm"></div>
                </div>
              </div>

            </template>
          </div>

          <!-- Labels -->
          <div class="border-t border-gray-400 mx-auto" :style="`height: 1px; width: ${ 100 - 1/chartData.length*100 + 3}%`"></div>
          <div class="flex -mx-2 items-end">
            <template x-for="data in labels">
              <div class="px-2 w-1/6">
                <div class="bg-red-600 relative">
                  <div class="text-center absolute top-0 left-0 right-0 h-2 -mt-px bg-gray-400 mx-auto" style="width: 1px"></div>
                  <div x-text="data" class="text-center absolute top-0 left-0 right-0 mt-3 text-gray-700 text-sm"></div>
                </div>
              </div>
            </template>
          </div>

        </div>
      </div>
    </div>
  </div>

  <script>
    function app() {
      return {
        chartData: [112, 10, 225, 134, 101, 80, 50, 100, 200],
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],

        tooltipContent: '',
        tooltipOpen: false,
        tooltipX: 0,
        tooltipY: 0,
        showTooltip(e) {
          console.log(e);
          this.tooltipContent = e.target.textContent
          this.tooltipX = e.target.offsetLeft - e.target.clientWidth;
          this.tooltipY = e.target.clientHeight + e.target.clientWidth;
        },
        hideTooltip(e) {
          this.tooltipContent = '';
          this.tooltipOpen = false;
          this.tooltipX = 0;
          this.tooltipY = 0;
        }
      }
    }
  </script>
</div>