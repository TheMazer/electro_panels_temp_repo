const cardWrapper = document.querySelector('.content-main__list')

const cardArray = [
    {
        id: 0,
        title: 'Щит электрический бытовой 380 Вольт с автоматикой (Для частных домов)',
        price: '60 000',
        address: 'Зеленоград, 2022',
        date: '18 декабря 18:49',
        img: 'щит1.jpg'


    },
    {
        id: 1,
        title: 'Щит электрический бытовой 380 Вольт (Для частных домов)',
        price: '61 000',
        address: 'Зеленоград, 2022',
        date: '18 декабря 18:49',
        img: 'щит2.jpg'
    },
    {
        id: 2,
        title: 'Щит электрический бытовой 380 Вольт (Для частных домов)',
        price: '62 000',
        address: 'Зеленоград, 2022',
        date: '18 декабря 18:49',
        img: 'щит3.jpg'

    },
    {
        id: 3,
        title: 'Щит электрический бытовой 220 Вольт (Для квартир) ',
        price: '63 000',
        address: 'Зеленоград, 2022',
        date: '18 декабря 18:49',
        img: 'щит4.jpg'

    },
    {
        id: 4,
        title: 'Щит электрический бытовой 220 Вольт (Для квартир)',
        price: '64 000',

        address: 'Зеленоград, 2022',
        date: '18 декабря 18:49',
        img: 'щит5.jpg'

    },
    {
        id: 5,
        title: 'Щит электрический бытовой 380 Вольт с автоматикой (Для частных домов)',
        price: '65 000',
        address: 'Зеленоград, 2022',
        date: '18 декабря 18:49',
        img: 'щит6.jpg'

    },
    {
        id: 6,
        title: 'Щит электрический бытовой 380 Вольт (Для частных домов)',
        price: '65 000',
        address: 'Зеленоград, 2022',
        date: '18 декабря 18:49',
        img: 'щит7.jpg'

    },
    {
        id: 7,
        title: 'Щит электрический бытовой 380 Вольт (Для частных домов)',
        price: '65 000',
        address: 'Зеленоград, 2022',
        date: '18 декабря 18:49',
        img: 'щит8.jpg'

    },
    {
        id: 8,
        title: 'Щит электрический бытовой 380 Вольт (Для частных домов)',
        price: '65 000 Р',
        address: 'Зеленоград, 2022',
        date: '18 декабря 18:49',
        img: 'щит9.jpg'

    }
]




const render = cardList => {
    cardWrapper.innerHTML = ''
    const noResultsMessage = document.getElementById('noResultsMessage')

    if (cardList.length === 0) {
        noResultsMessage.style.display = 'block' // Показываем сообщение
    } else {
        noResultsMessage.style.display = 'none' // Скрываем сообщение
        cardList.forEach(item => {
            cardWrapper.insertAdjacentHTML(
                'beforeend',
                `
                <a href="product.html" class="content-main__list-item">
                    <div class="content-main__list-item--img">
                        <img src="src/img/thumbs/${item.img}" style="width: 100%;" alt="${item.title}">
                    </div>
                    <h5 class="content-main__list-item--title">
                        ${item.title}
                    </h5>
                    <strong class="content-main__list-item--price">${item.price} ₽</strong>

                    <div class="content-main__list-item--desk-box">
                        <span class="content-main__list-item--desk">
                            ${item.address}
                        </span>
                        <span class="content-main__list-item--desk">
                            ${item.date}
                        </span>
                    </div>
                </a>
                `
            )
        })
    }
}

cardWrapper.style.justifyContent = `flex-start`
cardWrapper.style.gap = `30px`

render(cardArray)