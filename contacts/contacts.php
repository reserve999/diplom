<?php
//global $name, $email, $phone, $subject, $message;

//session_start();

include('/OSPanel/domains/chat.ru/contacts/db.php'); // подключаем и устанавливаем соединение с БД
if (!empty($_POST["send"])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $subject = $_POST["subject"];
    $message = $_POST["message"];

    global $name, $email, $phone, $subject, $message;
    // Recipient email

    $toMail = "cvsnt@bk.ru";
    // Build email header
    $header = "От: " . $name . "\n<" . $email . ">\r\nСообщение: ";
    // Send email
    if (mail($toMail, $subject, $message, $header)) {
        // Store contactor data in database
        $sql = $con->query("INSERT INTO contacts_list(name, email, phone, subject, message, sent_date) VALUES ('{$name}', '{$email}', '{$phone}', '{$subject}', '{$message}', now())");
        if (!$sql) {
            die("MySQL query failed.");
        } else {
            $response = array(
                "status" => "alert-success",
                "message" => "Мы получили ваш запрос и сохранили информацию, свяжемся с вами в ближайшее время!"
            );
        }
    } else {
        $response = array(
            "status" => "alert-danger",
            "message" => "Сообщение не удалось отправить, попробуйте еще раз!"
        );
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/img/favicon.ico" type="image/x-icon">
    <title>Контакты</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/snackbar.css">
    <!-- <link rel="stylesheet" href="/styles/reset.min.css" />
    <link rel="stylesheet" href="/styles/style.css" />
    <link rel="stylesheet" href="/styles/header-9.css" /> -->
    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">



    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <style>
        .container {
            max-width: 500px;
            margin: 50px auto;
            text-align: left;
            font-family: sans-serif;
        }

        form {
            border: 1px solid #dfdfdf;
            background: #f0fdff;
            padding: 40px 50px 45px;
        }

        .form-control:focus {
            border-color: #002a80;
            box-shadow: none;
        }

        label {
            font-weight: 600;
            font-size: 18px;
            color: #002a80;
        }

        .error {
            color: red;
            font-weight: 400;
            display: block;
            padding: 6px 0;
            font-size: 14px;
        }

        .form-control.error {
            border-color: red;
            padding: .375rem .75rem;
        }

        .btn-primary {
            color: #fff;
            background-color: #002a80;
            border-color: #002a80;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light aqua" style="padding: 1% 11%; font-size: 20px;">
        <a href="/index.html" class="brand"> <img src="/img/logo_cvs.svg" width="240px" border="0" alt="Новые Технологии :: Системы CVS (Computer Video Security)" align="left"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <!--   <li class="nav-item ">
                <a class="nav-link" href="#">Home </a>
              </li> -->
                
                <li class="nav-item">
                    <a class="nav-link" href="/knowledge_base/dist/knowledge_base.html">База знаний</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/contacts/contacts.php">Контакты</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="/main.php">Личный кабинет <span class="sr-only">(current)</span></a>
                </li>
        </div>
    </nav>

    <div class="centered" style="width: auto; height: auto; background: #FFFFFF; margin: 2% 11%; padding: 1%; outline: 1px solid #dfdfdf; border-radius: 5px; text-align: justify;">
        <div class="xb_FE" style="width: auto; height: auto; ">
            <!-- <div style="text-align: left; margin: 10px 20px;">
             
            </div>
        -->
            <!--  <hr style="width: auto;">  -->

            <!-- CONTENT -->
            <div class="wrap" style="text-align: justify;">
                <p style="color:#002a80; font-size: 20px; "><b>ООО «Новые Технологии»</b></p>

                <div>
                    <b style="color:#002a80; font-size: 18px">Другие зарегистрированные наименования фирмы:</b>
                    <p style="margin-left: 30px;"> <b> Сокращенное наименование: ООО «НТ»</b></p>
                    <p style="margin-left: 30px;"> <b> Наименование на английском языке: «New Technologies» Limited
                            liability company</b></p>
                    <p style="margin-left: 30px;"> <b> Сокращенное наименование на английском языке: «NT» LLC</b>
                    </p>
                </div>

                <div>
                    <b style="color:#002a80; font-size: 18px">Адрес:</b><br>
                    <p style="margin-left: 30px; "> <b>142280, РФ, Московская область, г. Протвино, ул. Ленина, 10 -
                            81</b></p>
                </div>

                <a name="call"></a>
                <div>
                    <b style="color:#002a80; font-size: 18px">Телефон:</b>

                    <!-- 
                   <span class="int20" style="margin-left: 30px; ">&#x260E;</span> 
                   <span class="int22" style="margin-left: 30px; ">&#x2709;</span> 
                      -->
                    <p style="margin-left: 30px; "><b> +7 495 765 64 44 - коммерческие вопросы</b>
                    </p>
                </div>

                <div>
                    <b style="color:#002a80; font-size: 18px">E-mail:</b>
                    <p style="margin-left: 30px; "><b>cvsnt@cvsnt.ru - общие и коммерческие вопросы</b></p>
                    <p style="margin-left: 30px; "><b>support@cvsnt.ru - вопросы по техподдержке</b></p>
                </div>



                <div>
                    <div class="container mt-5">
                        <center style="color:#002a80; font-size: 18px"><b>Форма обратной связи</b></center>
                        <?php if (!empty($response)) { ?>
                            <div class="alert text-center <?php echo $response['status']; ?>" role="alert">
                                <?php echo $response['message']; ?>
                            </div>
                        <?php } ?>

                        <form action="" name="contactForm" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Имя</label>
                                <input type="text" class="form-control" name="name" id="name">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" id="email">
                            </div>
                            <div class="form-group">
                                <label>Номер телефона</label>
                                <input type="text" class="form-control" name="phone" id="phone">
                            </div>
                            <div class="form-group">
                                <label>Тема</label>
                                <input type="text" class="form-control" name="subject" id="subject">
                            </div>
                            <div class="form-group">
                                <label>Сообщение</label>
                                <textarea class="form-control" name="message" id="message" rows="4"></textarea>
                            </div>
                            <input type="submit" name="send" value="Отправить" class="btn btn-primary btn-block">
                        </form>
                    </div>
                </div>



                <!-- Карта -->
                <div style="padding: 1% 1%">
                    <!--  <a href="https://yandex.ru/maps/?um=constructor%3A86b9983a26a7594df9565911af2a82cd6bd8160589f924d5dc1b459f2a59a3d2&amp;source=constructorStatic"
                        target="_blank"><img src="img/map_nt.png" alt="Адрес офиса ООО «Новые Технологии»"></a> -->
                    <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A78ac60ca1a5fdc4face8d9c39da1ebd212a68f98118dc58f651e0f9150bc01c4&amp;width=100%&amp;height=518&amp;lang=ru_RU&amp;scroll=true"></script>
                </div>
                <!-- Карта -->


            </div>
            <!-- CONTENT -->
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <!-- Scripts -->
    <script src="assets/js/snackbar.js"></script>
    <script src="js/header-9.js"></script>
    <script>
        $(function() {
            $("form[name='contactForm']").validate({
                // Define validation rules
                rules: {
                    name: "required",
                    email: "required",
                    phone: "required",
                    subject: "required",
                    message: "required",
                    name: {
                        required: true
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    phone: {
                        required: true,
                        minlength: 10,
                        maxlength: 20,
                        number: true
                    },
                    subject: {
                        required: true
                    },
                    message: {
                        required: true
                    }
                },
                // Specify validation error messages
                messages: {
                    name: "Введите имя",
                    email: {
                        required: "Введите email",
                        minlength: "Введите корректный email"
                    },
                    phone: {
                        required: "Введите номер телефона",
                        minlength: "Длина должна составлять не менее 10 символов",
                        maxlength: "Длина не должна превышать 20 символов"
                    },
                    subject: "Введите тему",
                    message: "Введите сообщение"
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.min.js"></script>
</body>

</html>