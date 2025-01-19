<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Korean:wght@400&display=swap" rel="stylesheet">
    <title>ЩитЭнерго.ru</title>
    <link rel="stylesheet" href="src/css/styles.css">
    <link rel="icon" href="src/img/icons/logo2.png" type="image/x-icon">

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap" rel="stylesheet">
</head>
<body>
    <header class="header">
        <div class="container">
				<div class="heder-box">
					<div class="header-logo">
						<img src="src\img\icons\logo.png" style="width: 50px" alt="логотип" />
						<a href="index.html"> ЩитЭнерго.ru </a>
						<link
							href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
							rel="stylesheet"
						/>
					</div>
					<div class="header-controls">
						<button class="header-burger">Menu</button>
						<!-- Кнопка для мобильного меню -->
						<div class="desktop-controls">
							<button type="button" class="btn btn-outline" id="loginBtn">
								Вход
							</button>

							<button type="button" class="btn btn-primary" id="registerBtn">
								Регистрация
							</button>
						</div>
					</div>

					<!-- Модальное окно для входа -->
					<div id="myModal" class="modal">
						<div class="modal-content">
							<span class="close" id="closeLogin">&times;</span>
							<form action="">
								<h1>Войти</h1>
								<div class="input-box">
									<input type="text" placeholder="Введите ваше имя" required />
									<i class="bx bxs-user"></i>
								</div>
								<div class="input-box">
									<input
										type="password"
										placeholder="Введите пароль"
										required
									/>
									<i class="bx bxs-lock-alt"></i>
								</div>
								<div class="remember">
									<label> Запомнить меня <input type="checkbox" /> </label>
									<a href="#">Забыли пароль?</a>
								</div>
								<button type="submit" class="btn">Войти</button>
								<div class="register-link">
									<p>
										Нет аккаунта?
										<a href="#" id="openRegisterModal">Зарегистрироваться</a>
									</p>
								</div>
							</form>
						</div>
					</div>

					<!-- Модальное окно для регистрации -->
					<div id="registerModal" class="modal">
						<div class="modal-content">
							<span class="close" id="closeRegister">&times;</span>
							<form action="">
								<h1>Регистрация</h1>
								<div class="input-box">
									<input type="text" placeholder="Введите ваше имя" required />
									<i class="bx bxs-user"></i>
								</div>
								<div class="input-box">
									<input
										type="password"
										placeholder="Введите пароль"
										required
									/>
									<i class="bx bxs-lock-alt"></i>
								</div>
								<div class="input-box">
									<input
										type="tel"
										id="phone"
										placeholder="Введите номер телефона"
										required
									/>
									<i class="bx bxs-phone"></i>
								</div>
								<div class="input-box">
									<input
										type="text"
										placeholder="Введите электронную почту"
										required
									/>
									<i class="bx bxl-gmail"></i>
								</div>
								<button type="submit" class="btn">Зарегистрироваться</button>
								<div class="register-link">
									<p>Уже есть аккаунт? <a href="#">Войти</a></p>
								</div>
							</form>
						</div>
					</div>

					<div class="sidebar" id="sidebar">
						<button class="close-btn" id="closeBtn">&times;</button>
						<!-- Кнопка закрытия -->
						<button class="btn btn-outline" id="loginBtnMobile">Вход</button>
						<button class="btn btn-primary" id="registerBtnMobile">
							Регистрация
						</button>
					</div>

					<div class="header-burger">
						<img src="src\img\icons\menu.png" style="width: 30px" alt="menu" />
					</div>
				</div>
        </div>
    </header>
    <main>
			<section class="Search">
				<div class="container">
					<div class="search-box">
						<input type="text" placeholder="Введите запрос" />
						<button class="btn btn-primary search-btn">
							<span class="search-btn__text">Найти</span>
						</button>
					</div>
				</div>
			</section>
        <section class="content">
            <div class="container">
                <div class="content-box">
                    <div class="content-main">
                        <h2 class="contant-main__title">Рекомендации для вас</h2>

                        <div id="noResultsMessage" style="display: none; color: red">
                            По вашему запросу ничего не нашлось
                        </div>

                        <div class="content-main__list">
                            <?php
                            // Подключение к базе данных
                            $conn = new mysqli('localhost', 'root', '', 'shieldEnergo');

                            // Проверка подключения
                            if ($conn->connect_error) {
                                die("Ошибка подключения: " . $conn->connect_error);
                            }

                            // Запрос данных
                            $sql = "SELECT * FROM products";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                // Вывод карточек
                                while ($row = $result->fetch_assoc()) {
                                    echo '
                                    <a href="product.php?id='. $row["id"]. '" class="content-main__list-item">
                                        <div class="content-main__list-item--img">
                                            <img src="src/img/thumbs/' . $row["img"] . '" alt="' . $row["title"] . '">
                                        </div>
                                        <h5 class="content-main__list-item--title">' . $row["title"] . '</h5>
                                        <strong class="content-main__list-item--price">' . $row["price"] . ' ₽</strong>
                                        <div class="content-main__list-item--desk-box">
                                            <span class="content-main__list-item--desk">' . $row["address"] . '</span>
                                            <span class="content-main__list-item--desk">' . $row["date"] . '</span>
                                        </div>
                                    </a>';
                                }
                            } else {
                                echo '<p id="noResultsMessage">По вашему запросу ничего не нашлось</p>';
                            }

                            $conn->close();
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>
</html>
