<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- HEADER -->
        <?php include('../includes/header.php'); ?>
    </head>
    <body>
        <!-- SIDEBAR -->
        <?php include('../includes/sidebar.php'); ?>	
 
            <!-- MAIN CONTENT -->
            <main class="flex-1 p-3">
                <div class="flex-1 p-4 text-2xl font-bold overflow-auto">
                    Daily Time Record
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Card 1 -->
                    <div class="bg-white p-4 rounded-lg shadow-md">
                        <h2 class="text-xl font-bold mb-2">Card Title 1</h2>
                        <p class="text-gray-700">This is a description for card 1.</p>
                    </div>
                    <!-- Card 2 -->
                    <div class="bg-white p-4 rounded-lg shadow-md">
                        <h2 class="text-xl font-bold mb-2">Card Title 2</h2>
                        <p class="text-gray-700">This is a description for card 2.</p>
                    </div>
                    <!-- Card 3 -->
                    <div class="bg-white p-4 rounded-lg shadow-md">
                        <h2 class="text-xl font-bold mb-2">Card Title 3</h2>
                        <p class="text-gray-700">This is a description for card 3.</p>
                    </div>
                    <!-- Add more cards as needed -->
                </div>
            </main>
            
        </div>
    
        <!-- FOOTER -->
        <?php include('../includes/footer.php'); ?>
    </body>
</html>