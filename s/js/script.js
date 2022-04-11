const $ = (el) => document.querySelector(el)
const $$ = (el) => document.querySelectorAll(el)

function history() {
    let code = `<div class="profile__history dl">
    <div class="profile__container df">
        <div class="container__history__products df">
            <span class="profile__history__top__info">Заказ №1 26.12.2021 17:52</span>
            <div class="profile__history__products__info df">
                <div class="product__info df">
                    <img src="image/1.jpg" alt="Изображение">
                    <div class="history__info df">
                        <span class="history__name">Чизкейк “Шоколадный”</span>
                        <span class="history__amount">Количество: 1х</span>
                        <span class="history__price">1270 ₽</span>
                    </div>
                </div>
                <div class="product__info df">
                    <img src="image/1.jpg" alt="Изображение">
                    <div class="history__info df">
                        <span class="history__name">Чизкейк “Шоколадный”</span>
                        <span class="history__amount">Количество: 1х</span>
                        <span class="history__price">1270 ₽</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="container__history__products df">
            <span class="profile__history__top__info">Заказ №1 26.12.2021 17:52</span>
            <div class="profile__history__products__info df">
                <div class="product__info df">
                    <img src="image/1.jpg" alt="Изображение">
                    <div class="history__info df">
                        <span class="history__name">Чизкейк “Шоколадный”</span>
                        <span class="history__amount">Количество: 1х</span>
                        <span class="history__price">1270 ₽</span>
                    </div>
                </div>
                <div class="product__info df">
                    <img src="image/1.jpg" alt="Изображение">
                    <div class="history__info df">
                        <span class="history__name">Чизкейк “Шоколадный”</span>
                        <span class="history__amount">Количество: 1х</span>
                        <span class="history__price">1270 ₽</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="container__history__products df">
            <span class="profile__history__top__info">Заказ №1 26.12.2021 17:52</span>
            <div class="profile__history__products__info df">
                <div class="product__info df">
                    <img src="image/1.jpg" alt="Изображение">
                    <div class="history__info df">
                        <span class="history__name">Чизкейк “Шоколадный”</span>
                        <span class="history__amount">Количество: 1х</span>
                        <span class="history__price">1270 ₽</span>
                    </div>
                </div>
                <div class="product__info df">
                    <img src="image/1.jpg" alt="Изображение">
                    <div class="history__info df">
                        <span class="history__name">Чизкейк “Шоколадный”</span>
                        <span class="history__amount">Количество: 1х</span>
                        <span class="history__price">1270 ₽</span>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>`
    $('.dl').remove();
    $('.profile__inner__info').insertAdjacentHTML('afterend', code);
}

function add() {
    let code = `
    <div class="main__menu__categories cmm add df jcc">
        <div class="mmc df jcc">
            <span onclick="addProduct()">
                <img src="image/add.svg" alt="+">
            Добавить товар</span>
            <span onclick="addSale()">
                <img src="image/add.svg" alt="+">
            Добавить акцию</span>
            <span onclick="addCoupon()">
                <img src="image/add.svg" alt="+">
            Добавить купон</span>
        </div>
    </div>
    `;

    if ($('.edit')) {
        ;
        $('.edit').remove()
        $('.ctg').insertAdjacentHTML('afterend', code);
    } else if ($('.profile__history')) {
        $('.profile__history').remove()
        $('.ctg').insertAdjacentHTML('afterend', code);
    } else if ($('.add')) {
        $('.add').remove()
    } else {
        $('.ctg').insertAdjacentHTML('afterend', code);
    }
};

function edit() {
    let code = `
    <div class="main__menu__categories cmm edit df jcc">
        <div class="mmc df jcc">
            <span onclick="editProduct()">
                <img src="image/settings.svg" alt="+">
            Редактировать товар</span>
            <span onclick="editSale()">
                <img src="image/settings.svg" alt="+">
            Редактировать акцию</span>
            <span onclick="editCoupon()">
                <img src="image/settings.svg" alt="+">
            Редактировать купон</span>
        </div>
    </div>
`;

    if ($('.add')) {
        $('.add').remove()
        $('.ctg').insertAdjacentHTML('afterend', code);
    } else if ($('.profile__history')) {
        $('.profile__history').remove()
        $('.ctg').insertAdjacentHTML('afterend', code);
    } else if ($('.edit')) {
        $('.edit').remove()
    } else {
        $('.ctg').insertAdjacentHTML('afterend', code);
    }
};

function addProduct() {
    let code = `
    <div class="addP df jcc">
        <form action="#" method="POST" class="df">
            <label for="name">Название</label>
            <input type="text" name="name" id="name" placeholder="Название" required>
            <label for="image">Изображение</label>
            <input type="text" name="image" id="image" placeholder="Изображение" required>
            <label for="price">Цена</label>
            <input type="number" name="price" id="price" placeholder="Цена" required>
            <label for="portions">Порции</label>
            <input type="number" name="portions" id="portions" placeholder="Порции" required>
            <label for="weight">Вес</label>
            <input type="number" name="weight" id="weight" placeholder="Вес" required>
            <p class="df ai">Категория
            <select name="select" required>
            <option value="" selected>Выберите категорию</option> 
            <option value="Пироги">Пироги</option>
            <option value="Торты">Торты</option>
            <option value="Круассаны">Круассаны</option>
            <option value="Круассаны">Пончики</option>
            <option value="Пирожки">Пирожки</option>
            <option value="Чизкейки">Чизкейки</option>
            </select></p>
            <label for="desc">Описание</label>
            <textarea name="desc" id="desc" placeholder="Описание" cols="30" rows="10" required></textarea>
            <label for="usb">Срок годности</label>
            <textarea name="usb" id="usb" placeholder="Срок годности" cols="30" rows="10" required></textarea>
            <label for="def_mtd">Способ разморозки</label>
            <textarea name="def_mtd" id="def_mtd" placeholder="Способ разморозки" cols="30" rows="10" required></textarea>
            <label for="ingredients">Состав</label>
            <textarea name="ingredients" id="ingredients" placeholder="Состав" cols="30" rows="10" required></textarea>
            <label for="cpfc">КБЖУ</label>
            <input type="text" name="cpfc" id="cpfc" placeholder="КБЖУ" required>
            <input type="hidden" name="create_product">
            <div class="df jcc btn">
                <button class="df ai jcc">Создать</button>
            </div>
        </form>
    </div>
    `;
    if ($('.addS')) {
        $('.addS').remove();
        $('.add').insertAdjacentHTML('beforeend', code);
    } else if ($('.addC')) {
        $('.addC').remove();
        $('.add').insertAdjacentHTML('beforeend', code);
    } else if ($('.addP')) {
        $('.addP').remove();
    } else {
        $('.add').insertAdjacentHTML('beforeend', code);
    };
};

function addSale() {
    let code = `
    <div class="addS df jcc">
        <form action="#" method="POST" class="df">
            <label for="name">Название акции</label>
            <input type="text" name="name" id="name" placeholder="Название акции" required>
            <label for="image">Изображение акции</label>
            <input type="text" name="image" id="image" placeholder="Изображение акции" required>
            <label for="text">Описание акции</label>
            <textarea name="text" id="text" cols="30" rows="10" placeholder="Описание акции" required></textarea>
            <input type="hidden" name="create_sale">
            <div class="df jcc btn">
                <button class="df ai jcc">Создать</button>
            </div>
        </form>
    </div>
    `;
    if ($('.addP')) {
        $('.addP').remove();
        $('.add').insertAdjacentHTML('beforeend', code);
    } else if ($('.addC')) {
        $('.addC').remove();
        $('.add').insertAdjacentHTML('beforeend', code);
    } else if ($('.addS')) {
        $('.addS').remove();
    } else {
        $('.add').insertAdjacentHTML('beforeend', code);
    };
};

function addCoupon() {
    let code = `
    <div class="addC df jcc">
        <form action="#" method="POST" class="df">
            <label for="id">Код купона</label>
            <input type="text" name="id" id="id" placeholder="Код купона" required>
            <label for="name">Название купона</label>
            <input type="text" name="name" id="name" placeholder="Название купона" required>
            <label for="discount">Скидка купона</label>
            <input type="number" name="discount" id="discount" placeholder="Скидка купона" required>
            <input type="hidden" name="create_coupon">
            <div class="df jcc btn">
                <button class="df ai jcc">Создать</button>
            </div>
        </form>
    </div>
    `;
    if ($('.addP')) {
        $('.addP').remove();
        $('.add').insertAdjacentHTML('beforeend', code);
    } else if ($('.addS')) {
        $('.addS').remove();
        $('.add').insertAdjacentHTML('beforeend', code);
    } else if ($('.addC')) {
        $('.addC').remove();
    } else {
        $('.add').insertAdjacentHTML('beforeend', code);
    };
};

function addComments() {
    let code = `
    <div class="commentSend">
        <form class="df" action="#" method="POST">
            <label for="reviews">Ваш отзыв</label>
            <textarea name="reviews" id="reviews" maxlength="120"></textarea>
            <label for="reviews">Ваша оценка</label>
            <div class="rating-area df">
                <input type="radio" id="star-5" name="rating" value="5">
                <label for="star-5" title="Оценка «5»"></label>	
                <input type="radio" id="star-4" name="rating" value="4">
                <label for="star-4" title="Оценка «4»"></label>    
                <input type="radio" id="star-3" name="rating" value="3">
                <label for="star-3" title="Оценка «3»"></label>  
                <input type="radio" id="star-2" name="rating" value="2">
                <label for="star-2" title="Оценка «2»"></label>    
                <input type="radio" id="star-1" name="rating" value="1">
                <label for="star-1" title="Оценка «1»"></label>
            </div>
            <div class="gap df jcc ai">
            <span onclick="cancelComments()" class="df jcc ai">
                <img src="image/cancel.svg" alt="Отмена"class="img df ai">
            </span>
            <button class="df jcc ai">Отправить</button>
            </div>
        </form>
    </div>
    `;

    if ($('.btn__reviews')) {
        $('.btn__reviews').remove()
        $('.prd_comments').insertAdjacentHTML('afterend', code);
    } else if ($('.commentSend')) {
        $('.commentSend').remove()
        $('.prd_comments').insertAdjacentHTML('afterend', code);
    } else {
        $('.prd_comments').insertAdjacentHTML('afterend', code);
    }
};

function cancelComments() {
    let code =`
    <div class="prd_comments">
        <a onclick="addComments()" class="btn__reviews">Написать отзыв</a>
    </div>
    `;
    if ($('.commentSend')) {
        $('.commentSend').remove()
        $('.prd_comments').insertAdjacentHTML('beforeend', code);
    }
};

