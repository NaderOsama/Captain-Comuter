<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="./assets/favicon.ico"> <!-- Favicon -->

    <link rel="stylesheet" href="./css/stlye.css">
    <link rel="stylesheet" href="./css/responsive.css">
    <link rel="stylesheet" type="text/css" href="./css/all.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/js/select2.full.min.js"></script>
    <title> مبادرة تخفيف الزحام المروري</title>
    <style>
        .heading {
            width: fit-content;
            text-align: center;
            margin: 0 auto;
            padding: 10px 30px;
            border-radius: 20px;
            max-width: 575px;
            margin: 10px auto;
            font-size: 24px;
        }
        @media (max-width: 768px) {
            /* Adjust font size for medium-sized screens */
            .heading {
            font-size: 20px;
            max-width: 600px;
            }
        }

        @media (max-width: 480px) {
            /* Adjust font size for smaller screens */
            .heading {
            font-size: 18px;
            max-width: 500px;
            }
        }
        @media screen and (max-width: 420px) {
            .heading {
                font-size: 14px;
                max-width: 400px;
            }
          /* Further adjustments for even smaller screens */
            .questionForm select,
            .questionForm input[type="radio"],
            .questionLabel,
            h2 {
                font-size: 10px;
            }
        
            /* Adjust margins or padding as needed */
            .checkbox-container,
            .radio-container {
                margin-top: 2px;
            }
            form {
                max-width: 700px;
                margin: 0 5px;
                padding: 20px 15px;
                border-radius: 15px;
                direction: rtl;
            }
        }
    </style>
 
</head>

<body>
    <h1 class="heading">شكرا لكونك كار كوميوتر محتمل. يرجي استكمال البيانات التالية وسوف يقوم فريق إدارة كوميوتر بالتواصل معك للرد علي استفساراتك (إن وجدت) ولشرح مزيد من التفاصيل</h1>
    <div >
        <form id="form" action="submit.php" method="post">
            <?php include './components/phase1.php' ?>
            <?php include './components/phase2.php' ?>
            <?php include './components/phase3.php' ?>
            <?php include './components/phase4.php' ?>
            <?php include './components/phase5.php' ?>
            <?php include './components/phase6.php' ?>
            
            <button class="submitBtn" id="submitBtn" type="submitBtn" value="submitBtn">إرسال</button>        
        </form>
    </div>
 
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>       
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const headers = document.querySelectorAll("h2.arrow");

            headers.forEach(header => {
                header.addEventListener("click", function () {
                    const parent = header.parentElement;
                    if (!parent.classList.contains("open")) {
                        closeAllHeaders();
                        parent.classList.add("open");
                    } else {
                        parent.classList.remove("open");
                    }
                });
            });

            function closeAllHeaders() {
                headers.forEach(header => {
                    header.parentElement.classList.remove("open");
                });
            }
            var link = document.querySelector(".arroww");
            
        });

        
    </script>


<script>
    document.addEventListener("DOMContentLoaded", function () {
        const headers = document.querySelectorAll("h2.arrow");

        headers.forEach(header => {
            header.addEventListener("click", function () {
                const sectionId = header.getAttribute("id");
                const section = document.getElementById(sectionId);

                if (section) {
                    const rect = section.getBoundingClientRect();
                    const yOffset = 15; // Adjust this value to control the scrolling position

                    // Calculate the absolute position of the section
                    const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
                    const sectionTop = rect.top + scrollTop;

                    // Scroll to the section with an offset
                    window.scrollTo({
                        top: sectionTop - yOffset,
                        behavior: "smooth"
                    });
                }
            });
        });
    });
</script>

</body>

</html>
