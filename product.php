<?php
	// Подключение к базе данных
	$conn = new mysqli('localhost', 'root', '', 'shieldEnergo');

	// Проверка подключения
	if ($conn->connect_error) {
		die("Ошибка подключения: " . $conn->connect_error);
	}

	// Извлечение данных о продукте
	// Получаем ID из URL  
	$productId = isset($_GET['id']) ? intval($_GET['id']) : 0;  

	// Подготовка SQL-запроса  
	$productSql = "SELECT * FROM products WHERE id = ?";  
	$productStmt = $conn->prepare($productSql);  
	$productStmt->bind_param("i", $productId); // связываем параметр  
	$productStmt->execute(); // выполняем запрос  
	$result = $productStmt->get_result(); // получаем результат

	if ($productStmt) {
		$productStmt->bind_param("i", $productId);
		$productStmt->execute();
		$productResult = $productStmt->get_result();
		$product = $productResult->fetch_assoc();
		$productStmt->close();
	} else {
		die("Ошибка в запросе: " . $conn->error);
	}

	if (!$product) {
		die("Продукт не найден.");
	}

	$conn->close();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Korean:wght@400&display=swap" rel="stylesheet" />
    <title><?= htmlspecialchars($product['name']) ?> - ЩитЭнерго.ru</title>
    <link rel="stylesheet" href="src/css/styles.css" />
    <link rel="stylesheet" href="src/css/product_page.css" />
    <link rel="icon" href="src/img/icons/logo2.png" type="image/x-icon" />

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
                    <h2 class="content-main__title">О товаре</h2>
                    <div class="product-info-container">
                        <div class="product-col">
                            <img class="product-image" src="<?= htmlspecialchars('src/img/thumbs/'. $product['img']) ?>" alt="Изображение товара">
                        </div>
                        <div class="product-col">
                            <h1><?= htmlspecialchars($product['title']) ?></h1>
                            <span class="price"><?= htmlspecialchars($product['price']) ?> ₽</span>
                            <desc><?= htmlspecialchars($product['description']) ?></desc>
                            <a class="btn btn-primary" href="https://t.me">Написать нам</a>
                            <a class="btn btn-underline" href="#chars">К характеристикам</a>
                        </div>
                        <div>
                            <h2 id="chars" class="chars-title">Характеристики</h2>
                            <?php
                                echo '<table>
									<tbody>
										<tr><td>Напряжение</td><td>' . $product['voltage'] . '</td></tr>
										<tr><td>Максимальная нагрузка</td><td>' . $product['max_load'] . '</td></tr>
										<tr><td>Количество автоматов</td><td>' . $product['breaker_count'] . '</td></tr>
										<tr><td>Тип автоматов</td><td>' . $product['breaker_type'] . '</td></tr>
										<tr><td>Защита от перегрузки</td><td>' . $product['overload_protection'] . '</td></tr>
										<tr><td>Защита от короткого замыкания</td><td>' . $product['short_circuit_protection'] . '</td></tr>
										<tr><td>Размеры</td><td>' . $product['dimensions'] . '</td></tr>
										<tr><td>Материал корпуса</td><td>' . $product['case_material'] . '</td></tr>
										<tr><td>Степень защиты</td><td>' . $product['protection_level'] . '</td></tr>
										<tr><td>Установка</td><td>' . $product['installation_type'] . '</td></tr>
										<tr><td>Температурный диапазон</td><td>' . $product['temperature_range'] . '</td></tr>
									</tbody>
								</table>';
							?>
                        </div>
                    </div>
                </div>

                <div class="content-side">
                    <h3 class="content-side__title">Сервисы и услуги</h3>
                    
                    <div class="content-side__box">
								<div class="content-side__list">
									<div class="content-side__list-item">
										<img
											class="content-side__list-item--img"
											src="src\img\icons\delivery.png"
											style="width: 60px"
											alt="delivery"
										/>
										<h5 class="content-side__list-item--title">Доставка</h5>
										<p class="content-side__list-item--text">
											Оперативная и быстрая доставка щитов по всей стране.
										</p>
                    </div>
									<div class="content-side__list-item">
										<img
											class="content-side__list-item--img"
											src="src\img\icons\installation.png"
											style="width: 60px"
											alt="Монтаж"
										/>
										<h5 class="content-side__list-item--title">
											Установка и монтаж
										</h5>
										<p class="content-side__list-item--text">
											Установим щит в вашем доме или офисе. Мы предоставляем
											все необходимые инструменты и материалы.
										</p>
									</div>
									<div class="content-side__list-item">
										<img
											class="content-side__list-item--img"
											src="src\img\icons\repair.png"
											style="width: 60px"
											alt="доставка"
										/>
										<h5 class="content-side__list-item--title">
											Обслуживание и ремонт
										</h5>
										<p class="content-side__list-item--text">
											Обслуживание и ремонт щитов в любое время. Мы
											предоставляем гарантию 3 месяца после покупки.
										</p>
									</div>
									
									
								</div>

								<div class="content-side__footer">
									<p class="content-side__footer--item" style="margin-bottom: 8px;">
										ООО "Габка", 2010-2024
									</p>
									<a href="#" class="content-side__footer--item">
										Политика конфидециальности
									</a>
									<a href="#" class="content-side__footer--item">
										Обработка данных
									</a>
									<a class="tele" href="https://t.me/ваш_телеграм_канал">
										<img src="src\img\icons\telegram.png" style="width: 64px" alt="Telegram">
									</a>
									<a class="wats" href="https://wa.me/+79773937040">
										<img src="src\img\icons\whatsapp.png" style="width: 64px" alt="Whatsapp">
									</a>
									<a class="avito" href="https://www.avito.ru/user/465b09289489244ec593683b9b853891/profile">
										<img src="src\img\icons\avito.png" style="width: 64px" alt="Avito">
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
		</main>
    </body>
</html>
