<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Under Maintenace</title>

    <link rel="stylesheet" href="{{asset('maintenance/dist/tailwind.css')}}">
</head>
<body class="bg-gradient">

    <div class="container mx-auto">
      
        <section class="flex flex-wrap lg:flex-nowrap justify-center h-screen relative">
            <div class="my-auto font-poppins text-gray-200 text-center lg:text-left">
                <h1 class="font-medium text-5xl py-3">SITE EN <br> MODE MAINTENANCE</h1>
                <p class="lg:w-5/6">Nous avons apporté toutes les améliorations techniques et nous reviendrons très bientôt. Merci de votre patience !</p>

                <div class="bg-gray-50 p-3 px-5 sm:w-96 rounded-md my-8 mx-auto lg:mx-0 flex">
                    <input type="text" class="border-0 flex-grow" placeholder="Your email Address">
                    <button class="text-gray-500 hover:text-red-400">S'ABONNER</button>
                </div>
            </div>

            <div class="my-auto text-center w-3/4 lg:w-2/5">
                <img class="rounded-full image1 animate-moveY" src="maintenance/assets/img1.jpg" alt="image1">
                <img class="image2 animate-rotateZ" src="maintenance/assets/img2.png" alt="image2">
                <img class="image3  animate-rotateZ" src="maintenance/assets/img3.png" alt="image3">
            </div>
    
        </section>


    </div>
</body>
</html>