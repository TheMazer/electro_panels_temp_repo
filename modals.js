const searchBtn = document.querySelector('.search-btn')
const searchInput = document.querySelector('.search-box input')


document.addEventListener('DOMContentLoaded', function () {
    const phoneInput = document.getElementById('phone')

    // Обработчик события для фокуса на поле ввода
    phoneInput.addEventListener('focus', function () {
        if (this.value === '') {
            this.value = '+7 ' // Добавляем префикс +7 при фокусировке
        }
    })

    phoneInput.addEventListener('input', function () {
        // Удаляем все символы, кроме цифр
        let value = this.value.replace(/\D/g, '')

        // Удаляем префикс +7, если он есть
        if (value.startsWith('7')) {
            value = value.slice(1)
        }

        // Применяем маску
        if (value.length > 10) {
            value = value.slice(0, 10) // Ограничиваем до 10 цифр
        }

        // Форматируем номер
        let formattedValue = '+7 '
        if (value.length > 0) {
            formattedValue += '(' + value.substring(0, 3)
        }
        if (value.length >= 4) {
            formattedValue += ') ' + value.substring(3, 6)
        }
        if (value.length >= 7) {
            formattedValue += '-' + value.substring(6, 10)
        }

        this.value = formattedValue
    })
})

const menuButton = document.querySelector('.header-burger')
const sidebar = document.getElementById('sidebar')
const closeButton = document.getElementById('closeBtn')

menuButton.addEventListener('click', function () {
    sidebar.classList.toggle('active')
})

closeButton.addEventListener('click', function () {
    sidebar.classList.remove('active')
})

const loginBtn = document.getElementById('loginBtn')
const registerBtn = document.getElementById('registerBtn')
const loginModal = document.getElementById('myModal')
const registerModal = document.getElementById('registerModal')
const closeLogin = document.getElementById('closeLogin')
const closeRegister = document.getElementById('closeRegister')
const loginForm = document.getElementById('loginForm')
const registerForm = document.getElementById('registerForm')


// Открытие модального окна для входа
loginBtn.onclick = function () {
    loginModal.style.display = 'block'
}



// Открытие модального окна для регистрации
registerBtn.onclick = function () {
    registerModal.style.display = 'block'
}

// Закрытие модального окна для входа
closeLogin.onclick = function () {
    loginModal.style.display = 'none'
    resetForm(loginForm) // Сбрасываем форму входа
}

// Закрытие модального окна для регистрации
closeRegister.onclick = function () {
    registerModal.style.display = 'none'
    resetForm(registerForm) // Сбрасываем форму регистрации
}


// Закрытие модальных окон при клике вне их области
window.onclick = function (event) {
    if (event.target == loginModal) {
        loginModal.style.display = 'none'
        resetForm(loginForm) // Сбрасываем форму входа
    }
    if (event.target == registerModal) {
        registerModal.style.display = 'none'
        resetForm(registerForm) // Сбрасываем форму регистрации
    }

}

// Функция сброса формы
function resetForm(form) {
    form.reset() // Сбрасываем значения всех полей формы
}



const filtredArray = (array, value) => {
    console.log(array)
    console.log(value)

    return array.filter(item => {
        return item.title.includes(value)
    })
}


searchInput.addEventListener('input', () => {
    render(filtredArray(cardArray, searchInput.value))
})
