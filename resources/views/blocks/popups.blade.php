<div class="popup" id="complete" style="display: none">
    <div class="popup__container popup__container--complete lazy" data-bg="/static/images/common/complete-bg.png">
        <div class="popup__head">
            <div class="popup__title">Спасибо!</div>
            <div class="popup__text">Ваша заявка успешно отправлена, наши менеджеры свяжутся с Вами в ближайшее время.</div>
        </div>
    </div>
</div>
<form class="popup" id="callback" action="{{ route('ajax.callback') }}" style="display: none">
    <div class="popup__container popup__container--callback lazy" data-bg="/static/images/common/callback-bg.png">
        <div class="popup__head">
            <div class="popup__title">Перезвоните мне</div>
            <div class="popup__text">{{ Settings::get('popup_callback') }}</div>
        </div>
        <div class="popup__body">
            <div class="popup__fields">
                <input class="input-field" type="text" name="name" placeholder="Ваше имя" required>
                <input class="input-field" type="tel" name="phone" placeholder="+7 (___) ___-__-__" required>
            </div>
        </div>
        <div class="popup__policy">
            <label class="checkbox checkbox--popup">
                <input class="checkbox__input" type="checkbox" checked required>
                <span class="checkbox__box"></span>
                <span class="checkbox__policy">Согласен на обработку
							<a href="{{ route('policy') }}" target="_blank">персональных данных</a>
						</span>
            </label>
        </div>
        <div class="popup__action">
            <button class="form-submit btn-reset" type="submit" name="submit" aria-label="Отправить">
                <span>Отправить</span>
                <svg width="31" height="12" viewBox="0 0 31 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M30.495 6.49497C30.7683 6.22161 30.7683 5.77839 30.495 5.50503L26.0402 1.05025C25.7668 0.776886 25.3236 0.776886 25.0503 1.05025C24.7769 1.32362 24.7769 1.76684 25.0503 2.0402L29.0101 6L25.0503 9.9598C24.7769 10.2332 24.7769 10.6764 25.0503 10.9497C25.3236 11.2231 25.7668 11.2231 26.0402 10.9497L30.495 6.49497ZM0 6.7H30V5.3H0V6.7Z"
                          fill="white" />
                </svg>

            </button>
        </div>
    </div>
</form>
<form class="popup" id="message" action="{{ route('ajax.free-request') }}" style="display: none">
    <div class="popup__container popup__container--message lazy" data-bg="/static/images/common/message-bg.png">
        <div class="popup__head">
            <div class="popup__title">Отправьте заявку в свободной форме</div>
            <div class="popup__text">И наши менеджеры сформируют предложение по вашему запросу</div>
        </div>
        <div class="popup__body">
            <div class="popup__fields">
                <input class="input-field" type="text" name="name" placeholder="Имя или Название организации" required>
                <input class="input-field" type="tel" name="phone" placeholder="+7 (___) ___-__-__" required>
                <input class="input-field" type="text" name="email" placeholder="Email" required>
                <textarea class="input-field" name="message" placeholder="Задайте Ваш вопрос" required></textarea>
            </div>
        </div>
        <div class="popup__policy">
            <label class="checkbox checkbox--popup">
                <input class="checkbox__input" type="checkbox" checked required>
                <span class="checkbox__box"></span>
                <span class="checkbox__policy">Согласен на обработку
							<a href="{{ route('policy') }}" target="_blank">персональных данных</a>
						</span>
            </label>
        </div>
        <div class="popup__action">
            <button class="form-submit btn-reset" type="submit" name="submit" aria-label="Отправить">
                <span>Отправить</span>
                <svg width="31" height="12" viewBox="0 0 31 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M30.495 6.49497C30.7683 6.22161 30.7683 5.77839 30.495 5.50503L26.0402 1.05025C25.7668 0.776886 25.3236 0.776886 25.0503 1.05025C24.7769 1.32362 24.7769 1.76684 25.0503 2.0402L29.0101 6L25.0503 9.9598C24.7769 10.2332 24.7769 10.6764 25.0503 10.9497C25.3236 11.2231 25.7668 11.2231 26.0402 10.9497L30.495 6.49497ZM0 6.7H30V5.3H0V6.7Z"
                          fill="white" />
                </svg>

            </button>
        </div>
    </div>
</form>
<form class="popup" id="search" action="#" style="display:none">
    <div class="popup__search-field">
        <div class="field field--promo">
            <input class="field__input" type="search" name="search" required>
            <span class="field__highlight"></span>
            <span class="field__bar"></span>
            <label class="field__label">Найти</label>
            <button class="btn-reset field__search" name="submit" aria-label="Найти"></button>
        </div>
    </div>
</form>
