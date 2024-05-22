<!-- component -->
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <!-- Tailwind CSS CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  </head>
  <body>
  <div class="bg-gray-100">
    <div class="container mx-auto py-8">
        <div class="grid grid-cols-4 sm:grid-cols-12 gap-6 px-4">
            <div class="col-span-4 sm:col-span-3">
                <div class="bg-white shadow rounded-lg p-6">
                    <div class="flex flex-col items-center">
                        <img src="https://randomuser.me/api/portraits/men/94.jpg" class="w-32 h-32 bg-gray-300 rounded-full mb-4 shrink-0">

                        </img>
                        <h1 class="text-xl font-bold">John Doe</h1>
                        <p class="text-gray-700">Software Developer</p>
                        <div class="mt-6 flex flex-wrap gap-4 justify-center">
                            <a href="#" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">Contact</a>
                            <a href="#" class="bg-gray-300 hover:bg-gray-400 text-gray-700 py-2 px-4 rounded">Resume</a>
                        </div>
                    </div>
                    <hr class="my-6 border-t border-gray-300">
                    <div class="flex flex-col">
                        <span class="text-gray-700 uppercase font-bold tracking-wider mb-2">Skills</span>
                        <ul>
                            <li class="mb-2">JavaScript</li>
                            <li class="mb-2">React</li>
                            <li class="mb-2">Node.js</li>
                            <li class="mb-2">HTML/CSS</li>
                            <li class="mb-2">Tailwind Css</li>
                        </ul>
                    </div>
                </div>
              </div>
            <div class="col-span-4 sm:col-span-9">
                <div class="bg-white shadow rounded-lg p-6">
                
                </div>
            </div>
        </div>
    </div>
</div>

    <script>
      $(document).ready(function () {
        const monthNames = ["January", "February", "March", "April", "May", "June",
                            "July", "August", "September", "October", "November", "December"];
        let today = new Date();
        let currentMonth = today.getMonth();
        let currentYear = today.getFullYear();

        function renderCalendar(month, year) {
            $('#monthYear').text(`${monthNames[month]} ${year}`);
            let firstDay = new Date(year, month).getDay();
            let daysInMonth = 32 - new Date(year, month, 32).getDate();
            $('#days').empty();
            
            // Create blank days for the first week
            for (let i = 0; i < firstDay; i++) {
                $('#days').append('<div class="text-gray-400"></div>');
            }

            // Create days of the month
            for (let i = 1; i <= daysInMonth; i++) {
                $('#days').append(`<div class="py-2 px-4 rounded cursor-pointer hover:bg-gray-200">${i}</div>`);
            }
        }

        $('#prev').click(function () {
            if (currentMonth === 0) {
                currentMonth = 11;
                currentYear--;
            } else {
                currentMonth--;
            }
            renderCalendar(currentMonth, currentYear);
        });

        $('#next').click(function () {
            if (currentMonth === 11) {
                currentMonth = 0;
                currentYear++;
            } else {
                currentMonth++;
            }
            renderCalendar(currentMonth, currentYear);
        });

        renderCalendar(currentMonth, currentYear);
      });
    </script>
  </body>
</html>